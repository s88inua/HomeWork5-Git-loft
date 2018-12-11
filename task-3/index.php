<?

require_once '../vendor/autoload.php';

use WideImage\WideImage as WideImage;


$image = WideImage::loadFromFile(__DIR__.'./images/pic.png');
$watermark = WideImage::loadFromFile(__DIR__.'./images/logo.png');
$image->rotate(45)->merge($watermark, 1000, 600)->rotate(-45)->resize(200)->saveToFile('./images/image.png');

$FinalImage = WideImage::loadFromFile(__DIR__.'./images/image.png');
$FinalImage->output('png');


