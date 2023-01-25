<?php

include_once '../includes/autoload.php';
class AuthorController{
    public static function creatAuthor(array $author):bool
    {
        return Database::connect()->prepare("insert into author values (null, ?, ?)")
            ->execute([$author['author-first-name'], $author['author-last-name']]);
    }
}

if(!session_id())
    session_start();
if(isset($_POST['save-author'])){
    if( preg_match("/^[a-zA-Z\s]+$/", $_POST['author-first-name']) && preg_match("/^[a-zA-Z\s]+$/", $_POST['author-last-name'])):
        if(AuthorController::creatAuthor($_POST))
            $_SESSION['message'] = "author has been saved!";
        else
            $_SESSION['error'] = "author has not been saved!";
    else:
        $_SESSION['error'] = "Error in type of input, Only character are allowed here!";
    endif;

    header("Location: ../admin/author.php");
}