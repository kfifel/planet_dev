<?php

    require_once "../includes/autoload.php";
    session_start();

if(!isset($_SESSION['admin']))
    header("Location: http://localhost:8080");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.1/flowbite.min.css"  rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.46.1/dist/full.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../../assets/style/main.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title><?=$title?></title>
</head>