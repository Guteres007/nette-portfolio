<?php


namespace App\Services;


class FileUploader
{
    private $text;
    public function __construct($text)
    {
        $this->text = $text;
    }

    public function showMessage() {
        echo $this->text;
    }
}
