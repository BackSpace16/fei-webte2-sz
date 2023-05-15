<?php
    // TODO if prihlaseny -> redirect
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>WEBTE2 | Záverečné zadanie</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.3/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.3/datatables.min.js"></script>

    <link href="css/style.css" rel="stylesheet"/>
</head>
<body>
    <div class="page">
        <div class="d-xl-flex flex-column flex-shrink-0 p-3 bg-light big-navbar">
            <a href="." class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <img class="icona" src="img/logo.png" width="250" height="115">
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="index.php" class="nav-link link-dark" aria-current="page">
                        <img class="icona" src="icons/person.svg" width="16" height="16">
                        Prihlásiť sa
                    </a>
                </li>
                <li>
                    <a href="help.php" class="nav-link active">
                        <img class="icona" src="icons/help_white.svg" width="16" height="16">
                        Návod
                    </a>
                </li>
            </ul>
        </div>

        <div class="flex-column flex-shrink-0 bg-light smol-navbar">
            <a href="index.php" class="d-block py-3 px-1 link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Olympijské hry">
                <img src="or.svg" width="64" height="30">
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <a href="index.php" class="nav-link active py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Prehľad" data-bs-original-title="Prehľad">
                        <img src="table_white.svg" width="24" height="24">
                    </a>
                </li>
                <li>
                    <a href="people.php" class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Športovci" data-bs-original-title="Športovci">
                        <img src="person.svg" width="24" height="24">
                    </a>
                </li>
            </ul>
        </div>

        <div class="content">
        <div class="d-flex justify-content-center">
            <div class="col-sm-10 col-11">
                <div class="text-center">
                    <h2>Návod na použitie</h2>
                </div>
                <hr>
                <div>
                    bla bla bla tba
                </div>
            </div>
        </div>
    </div>
</body>
</html>