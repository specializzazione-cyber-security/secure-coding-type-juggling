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
    <?php include_once __DIR__ . '/../components/navbar.php'; ?>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 mt-5">
                <h2 class="text-center display-5">Brute Force Attacks:</h2>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; foreach($logBox['warnings'] as $logLine): ?>
                <tr>
                <th scope="row"><?php $i++; echo $i ?></th>
                <td><?php echo $logLine ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
            </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2 class="text-center display-5">Access Logs:</h2>
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Info</th>
                    <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0; foreach($logBox['logs'] as $logLine): ?>
                    <tr>
                    <th scope="row"><?php $i++; echo $i ?></th>
                    <td><?php echo $logLine[0] ?></td>
                    <td><?php echo $logLine[1] ?></td>
                    <td><?php echo $logLine[2] ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>