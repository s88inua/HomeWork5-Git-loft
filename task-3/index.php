<?

require_once '../vendor/autoload.php';

use WideImage\WideImage as WideImage;

if (TRUE){
$image = WideImage::loadFromFile(__DIR__.'./images/pic1.png');
$watermark = WideImage::loadFromFile(__DIR__.'./images/logo.gif');
$image->merge($watermark, 500, 500)->resize(200)->saveToFile('./images/image1.jpg');
echo 'OK';
} else { echo 'NO';}


