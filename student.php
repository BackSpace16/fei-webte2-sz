<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);

    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: index.php');
    }
    if ($_SESSION['is_teacher']) {
        header('Location: teacher.php');
    }

    require_once 'config.php';

    $errMessage = null;
    $sql = "SELECT * FROM tests LEFT JOIN taskgroups ON tests.task_group = taskgroups.id WHERE tests.student = :student ORDER BY tests.created DESC";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(":student", $_SESSION["id"], PDO::PARAM_STR);

    if ($stmt->execute()) {
        $tests = $stmt->fetchAll();
    }
    else {
        $errMessage = "Chyba v spojení s databázou.";
    }

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
                    <a href="index.php" class="nav-link active" aria-current="page">
                        <img class="icona" src="icons/home_white.svg" width="16" height="16">
                        Domov
                    </a>
                </li>
                <li>
                    <a href="help.php" class="nav-link link-dark">
                        <img class="icona" src="icons/help.svg" width="16" height="16">
                        Návod
                    </a>
                </li>
            </ul>
            
            <?php
                if (isset($_SESSION['id'])) {                    
                    echo '<div>
                        <div>
                            <a class="btn btn-primary w-100" href="logout.php">Odhlásiť sa</a>
                        </div>
                    </div>';
                }
            ?>
        </div>

        <div class="flex-column flex-shrink-0 bg-light smol-navbar">
            <a href="index.php" class="d-block py-3 px-1 link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Domov">
                <img src="img/logo.png" width="64" height="30">
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">  
            <li class="nav-item">
                    <a href="index.php" class="nav-link active py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Domov" data-bs-original-title="Domov">
                        <img src="icons/home_white.svg" width="24" height="24">
                    </a>
                </li>
                <li>
                    <a href="help.php" class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Návod" data-bs-original-title="Návod">
                        <img src="icons/help.svg" width="24" height="24">
                    </a>
                </li>
            </ul>

            <?php
                if (isset($_SESSION['id'])) {                    
                    echo '<div class="dropdown border-top">
                        <a href="logout.php" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none" aria-label="Odhlásiť sa" data-bs-original-title="Odhlásiť sa">
                            <img src="icons/logout.svg" alt="mdo" width="24" height="24">
                        </a>
                    </div>';
                }
            ?>
        </div>

        <div class="content">
            <div class="d-flex justify-content-center">
                <div class="col-sm-10 col-11">
                    <table class="col-12">
                        <tr class="col-12 p-3 text-center">
                            <th class="col-3 ps-3"><h4>Test</h4></th>
                            <th class="col-3"><h4>Hodnotenie</h4></th>
                            <th class="col-3"><h4>Vytvorené</h4></th>
                            <th class="col-3 pe-3"><h4>Odovzdané</h4></th>
                        </tr>
                    </table>
                    <hr>
                    <?php
                        foreach($tests as $test) {
                            $id = $test[0];
                            if ($test["submitted"] != null && $test["points"] != null) {
                                echo '<a href="test.php?t='.$id.'"><div class="alert alert-dark d-flex mb-2" role="alert">
                                        <div class="col-3 text-start">
                                            '.$test["name"].'
                                        </div>
                                        <div class="col-3 text-center">
                                            '.$test["points"].' / '.$test["points_available"].'
                                        </div>
                                        <div class="col-3 text-center">
                                            '.$test["created"].'
                                        </div>
                                        <div class="col-3 text-center">
                                            '.$test["submitted"].'
                                        </div>
                                    </div></a>';
                            }
                            else {
                                echo '<a href="test.php?t='.$id.'"><div class="alert alert-success d-flex mb-2" role="alert">
                                        <div class="col-3 text-start">
                                            '.$test["name"].'
                                        </div>
                                        <div class="col-3 text-center">
                                            Neodovzdané
                                        </div>
                                        <div class="col-3 text-center">
                                            '.$test["created"].'
                                        </div>
                                        <div class="col-3 d-flex justify-content-center">
                                            <div class="col-8">
                                                <form action="test.php?t='.$id.'">
                                                    <input type="button" class="btn btn-sm btn-primary" value="Odovzdať">
                                                </form>
                                            </div>
                                        </div>
                                    </div></a>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>