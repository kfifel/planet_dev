<nav class="a-h-10 bg-gray-300 p-4">

    <div class="flex justify-between">
        <div>
            Welcome back Mr <strong><?= $_SESSION['admin']->getFirstName() ?> </strong>
        </div>
        <a href="http://localhost:8080/src/controller/auth.php?logout=true">
            <div class="font-bold">
                logout
            </div>
        </a>
    </div>

</nav>