<?php

declare(strict_types=1);

class Admin extends Person
{
    protected string $password;
    protected string $email;

    public AdminController $adminController;

    public function __construct(int|null $id, string $first_name, string $last_name, string $password = '', string $email ='')
    {
        $this->email = $email;
        $this->password = hash("sha256", $password);
        parent::__construct($id, $first_name, $last_name);
        $this->adminController = new AdminController();
    }



    public function createArticle(array $article): bool
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

    public function updateArticle( $id, Article $article): bool
    {

        return false;
    }


    public function getAllArticle(): array
    {
        return Database::connect()->query("
                select a.id as id, a.title as title, a.content as content, a.published_date as published_date, c.name as category, concat(a2.last_name , ' ', a2.first_name) as username
                from article a 
                    inner join author a2 on a.author_id = a2.id
                    inner join category c on a.category_id = c.id  
                    ")
            ->fetchAll(PDO::FETCH_ASSOC)
        ;
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