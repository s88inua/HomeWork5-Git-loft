<?php

require_once './vendor/autoload.php';



    try {
        $dsn = "mysql:host=127.0.0.1; dbname=burger; charset=utf8";
        $pdo = new PDO($dsn , 'mysql' , 'mysql');
        $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $phone = $_GET['phone'];
        $email = $_GET['email'];
        $name = $_GET['name'];
        $street = $_GET['street'];
        $home = $_GET['home'];
        $part = $_GET['part'];
        $appt = $_GET['appt'];
        $floor = $_GET['floor'];
        $comment = $_GET['comment'];
        $payment = $_GET['payment'];
        $callback = $_GET['callback'];
        if ($payment == 1) {
            $payment = "Потребуется сдача";
        } elseif ($payment == 2) {
            $payment = "Оплата по карте";
        } else {
            $payment = "Уточнить у клиента";
        }

        if (isset($callback)) {
            $callback = "Перезвонить";
        } else {
            $callback = "Не звонить";

        }
        $address = $street . " " . $home . " Корпус: {$part} " . "Квартира: {$appt} " . "Этаж: {$floor}";

        If (empty($phone) or empty($email) or empty($name)) {
            echo "Укажите обязательно Телефон, Почтовый адресс и Ваше Имя";
        } else {
            $query = "select * from users where email = '{$email}'";
            $select_from_users = $pdo->prepare($query);
            $select_from_users->execute();
            $result = $select_from_users->fetchAll();
            $first_order = false;
        if (empty($result)) {
            $orders = 1;
            $query = "insert into users (name, email, orders, phone) values ('$name', '$email', '$orders', '$phone')";
            $insert_user = $pdo->prepare($query);
            $insert_user->execute();
            $user_id_null = $pdo->query("SELECT (user_id) FROM users WHERE name = '$name' AND phone='$phone'")->fetchAll(PDO::FETCH_COLUMN);
            foreach ($user_id_null as $user_id){
                $insert_order = $pdo->prepare("insert into orders (user_id, address, callback, payment, comment, date) values ('$user_id', '$address', '$callback', '$payment', '$comment', NOW())");
                $insert_order->execute();
            }

            $first_order = true;
            } elseif ($result) {
             $user = $result[0];
                $user_id = $user['user_id'];
                $order = $user['orders'] + 1;
                $query = "UPDATE users SET orders = '$order' WHERE user_id = '$user_id'";
                $add_order = $pdo->prepare($query);
                $add_order->execute();
            $insert_order = $pdo->prepare("insert into orders (user_id, address, callback, payment, comment, date) values ('$user_id', '$address', '$callback', '$payment', '$comment', NOW())");
            $insert_order->execute();
            }
/*         else {
                $orders = 1;
                $query = "insert into users (name, email, orders, phone) values ('$name', '$email', '$orders', '$phone')";
                $insert_user = $pdo->prepare($query);
                $insert_user->execute();
                $first_order = true;
            }
            $insert_order = $pdo->prepare("insert into orders (user_id, address, callback, payment, comment, date) values ('$user_id', '$address', '$callback', '$payment', '$comment', NOW())");
            $insert_order->execute();
            if ($insert_order->execute()) {*/
            $order_id = $pdo->prepare("SELECT MAX(id) FROM orders WHERE user_id = '$user_id'");
                $order_id->execute();
                $order_id = $order_id->fetchColumn();
                $order_number = $pdo->prepare("SELECT COUNT(*) as total FROM orders WHERE user_id = '$user_id'");
                $order_number->execute();
                $order_number = $order_number->fetchColumn();

                // Проверочный текст

                echo "Ваш заказ успешно размещен." . "</br>";
                echo "Уважаемый " . $name . ", Ваш заказ №" . $order_id . " успешно размещен." . "</br>";
                echo "Заказ будет доставлен по адресу: {$address}" . "</br>";
                if ($first_order) {
                    $firstOrder = "Спасибо за ваш первый заказ! ";
                    echo $firstOrder;
                } else {

                    $firstOrder = "Спасибо, это ваш {$order_number} заказ! ";
                    echo $firstOrder;
                }

                $fileName = 'file.txt';
                $content = "Уважаемый " . $name . ", Ваш заказ №" . $order_id . " успешно размещен. Доставка по адресу: {$address}" . $firstOrder;
                $length = file_put_contents($fileName , $content . "\r\n" , FILE_APPEND);

            // Create the Transport
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                ->setUsername('alex.tolkom.1985@gmail.com')
                ->setPassword('hdflr123IF@')
            ;

// Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);

// Create a message
            $message = (new Swift_Message('Wonderful Subject'))
                ->setFrom(['alex.tolkom.1985@gmail.com' => 'Alex Tolkom'])
                ->setTo([$email])
                ->setBody($content)
            ;

// Send the message
            $result = $mailer->send($message);

            }
        }


    catch
        (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }


