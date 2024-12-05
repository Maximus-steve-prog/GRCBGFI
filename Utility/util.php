<?php

    class util {
        //Input method value for Sanitization
        public function ValidateEmail($datas) {
            $datas = trim($datas);
            $datas = stripcslashes($datas);
            $datas = htmlspecialchars($datas);
            $datas = strip_tags($datas);
            $datas = filter_var($datas,FILTER_VALIDATE_EMAIL);
            return $datas;
        }  
        public function ConfigEmail($datas) {
            $datas = trim($datas);
            $datas = stripcslashes($datas);
            $datas = htmlspecialchars($datas);
            $datas = strip_tags($datas);
            $datas = filter_var($datas,FILTER_SANITIZE_EMAIL);
            return $datas;
        }  
        public function ValidateInt($datas) {
            $datas = trim($datas);
            $datas = stripcslashes($datas);
            $datas = htmlspecialchars($datas);
            $datas = strip_tags($datas);
            $datas = filter_var($datas,FILTER_VALIDATE_INT);
            return $datas;
        }    
        public function ValidateString($datas) {
            $datas = trim($datas);
            $datas = stripcslashes($datas);
            $datas = htmlspecialchars($datas);
            $datas = strip_tags($datas);
            $datas = filter_var($datas,FILTER_SANITIZE_STRING);
            return $datas;
        }    
    }
?>