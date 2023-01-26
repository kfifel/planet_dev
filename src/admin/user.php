<!doctype html>
<html lang="en">

<?php
$title = "user";
require_once "includes/header.php";
?>

<body class="flex">

<?php
$page = "user";
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
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">User</span>
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


        <h1 class="text-2xl my-6" >Users (<?= $_SESSION['admin']->getNumRowOfTable('user')?>) </h1>

        <div>
            <?php
            if (isset($_SESSION['message'])):
                ?>
                <div id="alert-success" class="flex p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        <span class="font-bold">Alert:</span> <?= $_SESSION['message'] ?>
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-success" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <?php
                unset($_SESSION['message']);
            elseif(isset($_SESSION['error'])):
                ?>

                <div id="alert-error" class="flex p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        <span class="font-bold">Error:</span> <?= $_SESSION['error'] ?>
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8" data-dismiss-target="#alert-error" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>

                <?php
                unset($_SESSION['error']);
            endif;
            ?>
        </div>


        <div class="container mt-5 ml-7">
            <div class="flex justify-between align-center my-7 ">
                <div class="">
                    <i class="fas fa-search"></i>
                    <label for="search"><input class="rounded py-1" type="text" id="search" onkeyup="searchUser()" placeholder="search bar ..."></label>
                </div>
                <div>
                    <label
                            class="bg-blue-400 px-5 py-2 rounded-lg"
                            data-modal-target="authentication-modal"
                            data-modal-toggle="authentication-modal"
                            onclick="setEnvironmentAdd()"
                    >
                        add user
                    </label>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                    <tr>
                        <th class="cat-th1 th1">first name</th>
                        <th class="cat-th2 w-30">last name</th>
                        <th class="cat-th2 w-30">email</th>
                        <th class="cat-th2 w-30">actions</th>
                    </tr>
                    </thead>
                    <tbody id="body-users">
                    <?php
                    $users = $_SESSION['admin']->getAllUsers();
                    foreach ($users as $user):
                        ?>
                        <tr>
                            <td><?= $user['first_name'] ?></td>
                            <td><?= $user['last_name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td>

                                <div class="flex gap-8">
                                    <button
                                            class="bg-transparent text-green-600 bg-white"
                                            data-modal-target="authentication-modal"
                                            data-modal-toggle="authentication-modal"
                                    >
                                        <i class="fas fa-pen"></i>
                                    </button>

                                    <button class="bg-transparent text-red-700 bg-white" onclick="">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <button class="bg-transparent text-blue-700 bg-white">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>

                            </td>
                        </tr>
                    <?php endforeach ?>
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
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white" id="title-model">Adding New User</h3>
                        <form class="space-y-6 d-flex" action="../controller/userController.php" method="post">
                            <div class="form-control my-5">
                                <input type="hidden" name="id" id="user-id">
                                <div>
                                    <label for="user-first-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User name</label>
                                    <input type="text" onblur="" name="user-first-name" id="user-first-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="title of the user here please" required>

                                    <label for="user-last-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User name</label>
                                    <input type="text" onblur="" name="user-last-name" id="user-last-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="title of the user here please" required>

                                </div>
                            </div>
                            <button type="submit" name="save-user" id="submit-user" class="w-full text-blue-600 hover:text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center outline ">
                                Save user
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

<script src="../../assets/scripts/js/user.service.js"></script>

</body>
</html>