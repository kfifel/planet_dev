<?php

final class Database
{
    private static string $host;
    private static string $dbname;
    private static string $user;
    private static string $password;

    private static ?PDO $conn = null;

    private function __construct(){

    }

    private static function setDatabaseInfo():void{
        self::$host = "localhost";
        self::$dbname = "planet_dev";
        self::$user = "root";
        self::$password = "";
    }

    public static function connect(): PDO{
        if(self::$conn === null ){
            self::setDatabaseInfo();
            try{
                self::$conn = new PDO("mysql:host=".self::$host.";dbname=".self::$dbname.";", self::$user, self::$password);
                self::$conn->setattribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                return self::$conn;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        return self::$conn;
    }

    public static function disconnect():void{
        self::$conn = null;
    }
}