<nav class="a-h-10 bg-gray-300 p-4">

    <div class="flex justify-between">
        <div>
            Welcome back Mr <strong><?= $_SESSION['admin']->getFirstName() ?> </strong>
        </div>
        <div>
            logout
        </div>
    </div>

</nav>