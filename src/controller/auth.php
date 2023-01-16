<?php

include_once '../includes/autoload.php';

class auth{
    public function __construct()
    {
    }

    public function login():void{
        $email = $_POST['email'];
        $password = hash('sha256', $_POST['password']);

        $query = "select * from admin where `email` = '".$email."' and `password` = '".$password."'";
        $res = Database::connect()->query($query)->fetch(PDO::FETCH_ASSOC);

        if($res)
        {
            session_start();
            $_SESSION['admin'] = new Admin(...$res);
            header("Location: ../../admin/dashboard.php");
        }
        else
        {
            $query = "select * from user where `email` = '".$email."' and `password` = '".$password."'";
            $res = Database::connect()->query($query)->fetch(PDO::FETCH_ASSOC);

            if($res)
            {
                $_SESSION['user'] = new User(...$res);
                header("Location: ../../user/dashboard.php");
            }
        }
    }
}


$auth = new auth();
if(isset($_POST['login'])) $auth->login();
