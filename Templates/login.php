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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <h1 class="display-1 text-center">Login!</h1>
                <form method="POST" action="/login/submit">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input required name="password" type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="secret_code" class="form-label">Codice Segreto:</label>
                        <input required name="secret_code" type="password" class="form-control" id="secret_code">
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
        <div class="col-6">

        <table class="table table-secondary table-striped mt-4">
                    <thead>
                      <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Ruoli</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">admin@admin.com</th>
                        <td>12345678</td>
                        <td>Ruolo: Amministratore</td>
                      </tr>
                      <tr>
                        <th scope="row">user@user.com</th>
                        <td>12345678</td>
                        <td>Ruolo: Utente</td>
                      </tr>
                      <tr>
                        <th scope="row">lockeduser@user.com</th>
                        <td></td>
                        <td>Ruolo: Utente Bloccato</td>
                      </tr>
                    </tbody>
                  </table>
                  </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>