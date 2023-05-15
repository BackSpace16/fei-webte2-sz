<?php
    // TODO if prihlaseny -> redirect

    

    $errMessage = null;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (checkEmpty($_POST['name']) === true)
            $errMessage = "Zadajte meno.";
        if (checkEmpty($_POST['password']) === true)
            $errMessage = "Zadajte heslo.";

    }

    // TODO validacia s db
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
    <script src="js/form.js"></script>
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
                        <img class="icona" src="icons/person_white.svg" width="16" height="16">
                        Prihlásiť sa
                    </a>
                </li>
                <li>
                    <a href="help.php" class="nav-link link-dark">
                        <img class="icona" src="icons/help.svg" width="16" height="16">
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
            <div class="col-lg-4 col-md-6 col-sm-8 col-10">
                <div class="text-center">
                    <h2>Prihlásiť sa</h2>
                </div>
                <hr>
                <?php
                    if ($errMessage) {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            '.$errMessage.'
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                ?> 
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return registerFormValidate()">
                    <label for="name"><h5>Meno</h5></label>
                    <div class="input-group input-group-lg w-100" id="form-name">
                        <input required class="form-control w-100" oninput="textValid(this)" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" type="text" name="name" id="name">
                    </div>
                    <label for="password" class="pt-2"><h5>Heslo</h5></label>
                    <div class="input-group input-group-lg w-100" id="form-password"> 
                        <input required class="form-control w-100" oninput="emptyValid(this)" type="password" name="password" id="password">
                    </div>
                    <hr>
                    <input type="submit" name="register-btn" id="register-btn" value="Prihlásiť" class="btn btn-primary btn-lg">
                </form>
            </div>
        </div>
    </div>
</body>
</html>