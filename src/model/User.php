<?php

declare(strict_types=1);

class User extends Person
{
    private string $email;
    private string $password;

    public function __construct(int|null $id, string $first_name, string $last_name  , string $email ='', string $password = '')
    {
        $this->email = $email;
        $this->password = hash("sha256", $password);
        parent::__construct( $id,  $first_name,  $last_name);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getAllArticles():array{

        return Database::connect()->query("
        select a.id as id, a.title as title, a.content as content, CAST(a.published_date AS DATE) as published_date, c.name as category,
                       concat(a2.last_name , ' ', a2.first_name) as author, a2.id as id_author, c.id as id_category
                from article a 
                    inner join author a2 on a.author_id = a2.id
                    inner join category c on a.category_id = c.id ")
            ->fetchAll();
    }

}
