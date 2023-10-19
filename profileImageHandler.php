<?php
class Image{
    private $path;

    function __construct($width=200 , $height=200 ,$char)
    {
        $this->path = "images/".time().".png";
        $image = imagecreate($width ,$height);
        $red = rand(0,255);
        $green = rand(0,255);
        $blue = rand(0,255);
        imagecolorallocate($image ,$red , $green , $blue);
        $font = 'D:\Xampp\Font\Roboto-Regular.ttf';
        $textColor = imagecolorallocate($image ,255,255,255);
        imagettftext($image,100,0,55,150,$textColor,$font,$char);
        imagepng($image ,$this->path);
        imagedestroy($image);
    }
    function getPath(){
        return $this->path;
    }
}
?>