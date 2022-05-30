<?php 

class User {

    public static function authenticate ($username, $password) {
       return $_POST['username'] == 'ksharma' && $_POST['password'] == 'secret';
    }

}