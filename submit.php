<?php
    var_dump($_POST);
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

    $sql = "SELECT * FROM tests WHERE tests.id = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(":id", $_POST["test"], PDO::PARAM_STR);

    if ($stmt->execute() && $stmt->rowCount() == 1) {
        $test = $stmt->fetch();
        if($test['submitted'] == null || $test['points'] == null)
            header('Location: index.php');

            
        $sql = "UPDATE tests SET submitted = :submitted, students_solution = :solution, points = :points WHERE tests.id = :id";
        $stmt = $pdo->prepare($sql);
        $date = date("Y-m-d H:i:s");
        $answer = $_POST["answer"];
        if($answer == "" || $answer == null) {
            $answer = "-";
            $points = 0;
        }
        else
            $points = 10;

        $stmt->bindParam(":submitted", $date, PDO::PARAM_STR);
        $stmt->bindParam(":solution", $answer, PDO::PARAM_STR);
        $stmt->bindParam(":points", $points, PDO::PARAM_STR);
        $stmt->bindParam(":id", $_POST["test"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            unset($stmt);
            header("location: index.php");
        } else
            header("location: index.php");

        unset($stmt);
        
    }
    else {
        header('Location: index.php');
    }
?>