<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php include_once __DIR__ . '/components/navbar.php'; ?>

    <header class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center display-1">Sono un profilo</h1>
                <div class="col-6">
                    <h3>Modifica il tuo profilo</h3>
                    <form method="POST" action="/profile/update">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Indirizzo Email</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $_SESSION['user']['email'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
                        <button type="submit" class="btn btn-warning">Modifica</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>