<nav class="a-h-10 bg-gray-300 p-4">

    <div class="flex justify-between">
        <div>
            Welcome back Mr <strong><?= $_SESSION['admin']->getFirstName() ?> </strong>
        </div>
        <a href="http://localhost:8080/src/controller/auth.php?logout=true">
            <div class="font-bold flex justify-center items-center gap-2 hover:text-blue-700">
                <i class="fas fa-sign-out-alt"></i>
                logout
            </div>
        </a>
    </div>

</nav>