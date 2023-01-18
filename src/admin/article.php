<!doctype html>
<html lang="en">

<?php
    $title = "Article";
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
                    <div class="flex items-center">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Article</span>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Overview</span>
                    </div>
                </li>
            </ul>
        </div>

        <h1 class="text-xl text-bold">Articles</h1>

        <div class="container mt-5 ml-7">
            <div class="flex justify-between align-center my-7 ">
                <div class="">
                    <i class="fas fa-search"></i>
                    <input class="rounded py-1" type="text" id="search">
                </div>
                <div>
                    <label class="btn btn-primary py-0" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"  >add article</label>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Job</th>
                        <th>Favorite Color</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        //$_SESSION['admin']->getAllArticle();
                    ?>
                    <tr>
                        <th>3</th>
                        <td>Brice Swyre</td>
                        <td>Tax Accountant</td>
                        <td>Red</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>





        <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-md md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Adding New Articles</h3>
                        <div class="flex justify-between" id="progressbarArticles">
                            <label class="bg-blue-500 rounded-badge p-2 text-white text-xs hidden">
                                <i class="fas fa-arrow-left"></i> Previous
                            </label>
                            <span class="bg-blue-500 rounded-badge p-2 text-white text-xs hidden" id="countArticles">1</span>
                            <label class="bg-blue-500 rounded-badge p-2 text-white text-xs hidden">
                                Next <i class="fas fa-arrow-right"></i>
                            </label>
                        </div>
                        <form class="space-y-6 d-flex">
                            <div class="form-control my-5">
                                <div>
                                    <label for="article-title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Article title</label>
                                    <input type="text" name="article-title" id="article-title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="exemple@exemple.com" required>
                                </div>
                                <div>
                                    <label for="article-content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your content</label>
                                    <textarea name="article-content" id="article-content" placeholder="Article Content ..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required></textarea>
                                </div>

                                <div>
                                    <label for="article-author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select the Author</label>
                                    <select name="article-author" id="article-author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                        <option value="" selected></option>

                                        <?php
                                        $authors = $_SESSION['admin']->adminController->getAllAuthor();

                                        foreach ($authors as $author):
                                            ?>
                                            <option value=<?=$author['id']?> > <?=$author['first_name'] ." ". $author['last_name'] ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="article-category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select the Author</label>
                                    <select name="article-category" id="article-category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                        <option value="" selected></option>

                                        <?php
                                        $categories = $_SESSION['admin']->adminController->getAllCategory();

                                        foreach ($categories as $category):
                                            ?>
                                            <option value=<?=$category['id']?> > <?=$category['name'] ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <a href="#" class="mt-7 text-blue-800" onclick="addArticleField(event)">Add another article</a>
                            <button type="button" name="save" onclick="saveArticle()" class="w-full text-blue-600 hover:text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Save articles
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </main>



    <?php include "./includes/footer.php";?>
</section>

<?php
include "./includes/scripts-js.php";
?>

</body>
</html>