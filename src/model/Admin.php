<?php

declare(strict_types=1);
require_once "../includes/autoload.php";

class Admin extends Person
{
    protected string $password;
    protected string $email;


    public function __construct(int|null $id, string $first_name, string $last_name, string $password = '', string $email ='')
    {
        $this->email = $email;
        $this->password = hash("sha256", $password);
        parent::__construct($id, $first_name, $last_name);
    }



    public function createArticle(Article $article): bool
    {
        return false;
    }


    public function deleteArticle(): bool
    {

        return false;
    }


    public function getArticleById( $id): Article|null
    {

        return null;
    }

    public function updatArticle( $id, Article $article): bool
    {

        return false;
    }


    public function getAllArticle(): array
    {

        return [];
    }


    public function createAuthor(Article $author): bool
    {
        // TODO implement here
        return false;
    }

    public function addUser(User $uer): bool
    {
        $query = "insert into user value (null, '".$uer->getFirstName()."', '".$uer->getLastName()."', '".$uer->getEmail()."', '".$uer->getPassword()."')";
        return (bool) Database::connect()->query($query);
    }
}

