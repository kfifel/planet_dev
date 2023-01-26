<?php

include_once '../includes/autoload.php';

class auth{
    public function __construct()
    {
    }

    public function login():void{
        session_start();
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = hash('sha256', $_POST['password']);

        $query = "select * from admin where `email` = :email and `password` = :password";
        $sth = Database::connect()->prepare($query);
        $sth->bindParam(':email', $email);
        $sth->bindParam(':password', $password);
        $sth->execute();
        $res = $sth->fetch();
        if($res)
        {
            $_SESSION['admin'] = new Admin(...$res);
            var_dump($_SESSION['admin']);
            header("Location: ../../src/admin/dashboard.php");
        }
        else
        {
            $query = "select * from user where `email` = '".$email."' and `password` = '".$password."'";
            $res = Database::connect()->query($query)->fetch();

            if($res)
            {
                $_SESSION['user'] = new User(...$res);
                header("Location: ../../src/user/dashboard.php");
            }
            else
            {
                $_SESSION['error'] = 'Email or password incorrect!';
                header("Location: ../../index.php");
            }
        }
    }

    public function logout():void
    {
        session_destroy();
        header("Location: http://localhost:8080");
    }
}


$auth = new auth();
if(!session_id())
    session_start();
if(isset($_POST['login'])) $auth->login();
if(isset($_GET['logout'])) $auth->logout();
