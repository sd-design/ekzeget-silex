<?php

@session_start();

Class CaptchaMath {
    public $objId = "";
    private $imageWidth = 100;
    private $imageHeight = 100;
    private $font = "monofont.ttf";
    private $possibleChar = "123456789";
    private $captchatextcolor = "0x142864";
    private $captchaNoicecolor = "0x142864";
    private $mathsOperation = "+-*";

    function generateCaptcha() {
        $numberone = substr($this->possibleChar, mt_rand(0, strlen($this->possibleChar) - 1), 1);
        $numbertwo = substr($this->possibleChar, mt_rand(0, strlen($this->possibleChar) - 1), 1);
        $operator = substr($this->mathsOperation, mt_rand(0, strlen($this->mathsOperation) - 1), 1);

        switch ($operator) {
            case "+": $output = $numberone + $numbertwo;
                break;
            case "-": $output = $numberone - $numbertwo;
                break;
            case "*": $output = $numberone * $numbertwo;
                break;
        }
        $captchaCode = $numberone . $operator . $numbertwo;

        $_SESSION["pdocrudcaptcha".$this->objId] = $output;
        $fontSize = $this->imageHeight * 0.50;
        $image = @imagecreate($this->imageWidth, $this->imageHeight);

        /* setting the background, text and noise colours here */
        $background_color = imagecolorallocate($image, 255, 255, 255);

        $textColorArray = $this->hexrgb($this->captchatextcolor);
        $textColor = imagecolorallocate($image, $textColorArray['red'], $textColorArray['green'], $textColorArray['blue']);

        $arr_noice_color = $this->hexrgb($this->captchaNoicecolor);
        $image_noise_color = imagecolorallocate($image, $arr_noice_color['red'], $arr_noice_color['green'], $arr_noice_color['blue']);

        $textbox = imagettfbbox($fontSize, 0, $this->font, $captchaCode);
        $x = ($this->imageWidth - $textbox[4]) / 2;
        $y = ($this->imageHeight - $textbox[5]) / 2;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $this->font, $captchaCode);


        /* Show captcha image in the page html page */
        header('Content-Type: image/jpeg'); // defining the image type to be shown in browser widow
        imagejpeg($image); //showing the image
        imagedestroy($image); //destroying the image instance
    }

    function hexrgb($hexstr) {
        $int = hexdec($hexstr);
        return array("red" => 0xFF & ($int >> 0x10),
            "green" => 0xFF & ($int >> 0x8),
            "blue" => 0xFF & $int);
    }

}
$captcha = new CaptchaMath();
$captcha->objId = $_GET["objId"];
$captcha->generateCaptcha();