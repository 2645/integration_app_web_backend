<?php

class ImageHandler {

    const FOLDER = "uploads/";
    const FORMATS = array("image/jpeg", "image/gif", "image/png");

    static function validateImage($fileName) {
        if (is_numeric(array_search($_FILES[$fileName]['type'], ImageHandler::FORMATS, true))) {
            return "";
        } else {
            return "please upload a jpg, png or gif file";
        }
    }
    
    static function uploadImage($fileName, $patientID) {
        $uploadfile = ImageHandler::FOLDER . $patientID;
        move_uploaded_file($_FILES[$fileName]['tmp_name'], $uploadfile);
        return $uploadfile;
    }
}
?>

