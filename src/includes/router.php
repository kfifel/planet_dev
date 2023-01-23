<?php


if(!session_id()){
    require_once "./autoload.php";
    session_start();
}

if(isset($_GET['createArticles']))  // "php://input" is a read-only stream that allows you to read raw data from the request body
    $_SESSION['admin']->adminController->createArticles( json_decode(file_get_contents('php://input'), true));

if(isset($_GET['updateArticle']))  // "php://input" is a read-only stream that allows you to read raw data from the request body
    echo $_SESSION['admin']->updateArticle( json_decode(file_get_contents('php://input'), true)) ? "true" : "false";

if(isset($_GET['deleteArticles']))
    $_SESSION['admin']->deleteArticle($_GET['id']);

if(isset($_GET['getAllArticles'])){
    if(isset($_GET['sort']) && preg_match("/^[a-zA-Z]*$/", $_GET['sort']))
        if(isset($_GET['meth'])  && preg_match("/^[a-zA-Z]*$/", $_GET['meth']))
            echo json_encode($_SESSION['admin']->getAllArticle( $_GET['sort'], $_GET['meth']));
        else
            echo json_encode($_SESSION['admin']->getAllArticle( $_GET['sort']));
    else
        echo json_encode($_SESSION['admin']->getAllArticle());

}

if(isset($_GET['searchArticle']))
    echo json_encode($_SESSION['admin']->searchArticle($_GET['searchArticle']));

if(isset($_GET['getArticleById']))
    echo json_encode($_SESSION['admin']->getArticleById($_GET['id']));

