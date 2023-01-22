<?php


if(!session_id()){
    require_once "./autoload.php";
    session_start();
}


if(isset($_GET['createArticles']))  // "php://input" is a read-only stream that allows you to read raw data from the request body
    $_SESSION['admin']->adminController->createArticles( json_decode(file_get_contents('php://input'), true));

if(isset($_GET['deleteArticles']))
    $_SESSION['admin']->deleteArticle($_GET['id']);

if(isset($_GET['getAllArticles']))
    echo json_encode($_SESSION['admin']->getAllArticle());

if(isset($_GET['searchArticle']))
    echo json_encode($_SESSION['admin']->searchArticle($_GET['searchArticle']));