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
        if( !empty($article['title']) && !empty($article['content']) && !empty($article['author'])  && !empty($article['category'])
            && is_numeric($article['author']) && is_numeric($article['category'])
        ):
            $query = "insert into article 
                (id, title, content, published_date, category_id, author_id) 
                    values
                (null, :title , :content, :published_date, :category_id, :author_id)";
            $sth = Database::connect()->prepare($query);

            $sth->bindValue(':title', $article['title']);
            $sth->bindValue(':content', $article['content']);
            $sth->bindValue(':published_date', date("Y-m-d") );
            $sth->bindValue(':author_id', $article['author'] );
            $sth->bindValue(':category_id', $article['category']);
            return $sth->execute();
        else:
            return false;
        endif;
    }


    public function deleteArticle(int $id): void
    {
        echo Database::connect()->query("delete from article where id = $id")?
            "true"
            : "false";
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