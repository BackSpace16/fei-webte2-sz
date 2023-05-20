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

    $sql = "SELECT * FROM tests LEFT JOIN tasks ON tests.task = tasks.id LEFT JOIN taskgroups ON tests.task_group = taskgroups.id WHERE tests.id = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(":id", $_GET["t"], PDO::PARAM_STR);
    $test_id = $_GET["t"];

    if ($stmt->execute() && $stmt->rowCount() == 1) {
        $test = $stmt->fetch();
        if($test['student'] != $_SESSION['id'])
            header('Location: index.php');
    }
    else {
        header('Location: index.php');
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
    <!-- MathJax -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    <link href="css/style.css" rel="stylesheet"/>
    <script src="js/test.js"></script>
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
                        <img class="icona" src="icons/home.svg" width="16" height="16">
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
                    <a href="index.php" class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Domov" data-bs-original-title="Domov">
                        <img src="icons/home.svg" width="24" height="24">
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
                    <div class="d-flex">
                        <h2 class="col-8"><?php
                            echo $test['name'];
                        ?></h2>
                        <h5 class="col-4 text-end"><?php
                            $date = new DateTimeImmutable($test['created']);
                            echo 'Vytvorené: '.$date->format('d. m. Y H:i');
                        ?></h5>
                    </div>
                    <hr>
                    <?php
                        echo '<div>'.$test['description'].'</div>';
                        echo '<div class="d-flex justify-content-center"><img src="data:image/png;charset=utf8;base64,'.base64_encode($test['image']).'" alt=""></div>';
                    ?>
                    <hr>
                    <?php if($test['submitted'] != null && $test['points'] != "null"){?>
                    <div class="d-flex">
                        <div class="col-9 d-flex">
                            <div class="col-2 text-end">
                                <?php echo 'Vaša odpoveď:'; ?>
                            </div>
                            <div class="col-4 text-center">
                                <?php echo '\('.$test['students_solution'].'\)'; ?>
                            </div>
                            <div class="col-2 text-end">
                                <?php echo 'Správna odpoveď:'; ?>
                            </div>
                            <div class="col-4 text-center">
                                <?php echo '\('.$test['solution'].'\)'; ?>
                            </div>
                        </div>
                        <div class="col-3 d-flex flex-wrap text-center">
                            <div class="col-12">
                                <?php $date = new DateTimeImmutable($test['submitted']); echo 'Odovzdané '.$date->format('d. m. Y H:i'); ?>
                            </div>
                            <div class="col-12">
                                <?php echo 'Hodnotenie: <b>'.$test['points'].' / '.$test['points_available'].'</b>'; ?>
                            </div>
                        </div>
                    </div>
                    <?php } else {?>
                    <div class="col-12 d-flex">
                        <div class="col-9 d-flex">
                            <div class="col-9 d-flex text-end">
                                <?php echo 'Vaša odpoveď:  <div id="answer" class="ms-3"></div>'; ?>
                            </div>
                        </div>
                        <div class="col-3 d-flex flex-wrap text-end">
                            <div class="col-12">
                                <?php echo 'Maximálny možný počet bodov: <b>'.$test['points_available'].'</b>'; ?>
                            </div>
                        </div>
                    </div>
                    <form action="submit.php" method="post">
                        <label for="answer-field" class="mt-3 form-label">Vaša odpoveď v LaTeX:</label>
                        <div class="d-flex">
                            <div class="input-group w-75 mb-3 me-3">
                                <input type="hidden" name="test" value="<?php echo($test_id); ?>">
                                <input type="text" class="form-control" id="answer-field" name="answer" placeholder="\dfrac{}{}" oninput="inputTex(this)">
                            </div>
                            <div class="col-3">
                                <input type="submit" class="btn btn-primary" id="answer-submit" value="Odovzdať">
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                    <?php //var_dump($test); ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>