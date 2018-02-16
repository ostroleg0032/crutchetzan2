<?php

namespace core\lib;

class SimpleImage {

    private $image;
 
    public function __construct($image_name) {
        $file = $_FILES[$image_name];
        $image_type = $file["type"];
        if ($image_type == 'image/jpeg') {
            $this->image = imagecreatefromjpeg($file["tmp_name"]);
        } elseif ($image_type == 'image/gif') {
            $this->image = imagecreatefromgif($file["tmp_name"]);
        } elseif ($image_type == 'image/png') {
            $this->image = imagecreatefrompng($file["tmp_name"]);
        }
    }

    function get_width() {
        return imagesx($this->image);
    }
    function get_height() {
        return imagesy($this->image);
    }

    function resize($width, $height) {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->get_width(), $this->get_height());
        $this->image = $new_image;
    }

    public function get_data() {
        ob_start();
        imagepng($this->image);
        $data = ob_get_contents();
        ob_end_clean();
        return $data;
    }
}