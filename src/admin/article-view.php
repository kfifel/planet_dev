<!doctype html>
<html lang="en">

<?php
$title = "article detail";
require_once "includes/header.php";
?>

<body class="flex">

<?php
$page = "article";
include "./includes/sidebar.php";
?>

<section class="main">
    <?php include "./includes/navbar.php";?>



    <main class="main-content bg-gray-200">
        <div>
            <ul class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="dashboard.php" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Home
                    </a>
                </li>
                <li aria-current="page">
                    <a href="article.php" class="flex items-center">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Article</span>
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Overview</span>
                    </div>
                </li>
            </ul>
        </div>

        <h1 class="text-2xl text-bold my-6">View article</h1>

        <?php
            $article =$_SESSION['admin']->getArticleById($_GET['id']);
        ?>

        <div class="container">
            <div class="flex justify-between my-6">
                <h1 class="text-bold text-4xl">
                    <?= $article['title'] ?>
                </h1>
                <h1 class="text-xl italic">
                    Category: <span class="font-bold"> <?= $article['category'] ?> </span>
                </h1>
            </div>

            <p> <?= $article['content'] ?></p>
            <label class="text-lg">author : <span class="italic"> <?= $article['author'] ?> </span></label><br>
            <label class=""> published date: <?=$article['published_date']?></label>
        </div>
    </main>



    <?php include "./includes/footer.php";?>
</section>

<?php
include "./includes/scripts-js.php";
?>

</body>
</html>