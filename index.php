<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in</title>
</head>
<body>
    <div class="container">

        <form action="src/controller/auth.php" method="post">
            <div class="form-control">
                <label for="email">email :</label>
                <input type="text" name="email" id="email" placeholder="">
            </div>

            <div class="form-control">
                <label for="password">password :</label>
                <input type="password" name="password" id="password" placeholder="">
            </div>

            <div>
                <button class="btn btn-primary" name="login" id="connexion">Connexion</button>
            </div>
        </form>
    </div>
</body>
</html>