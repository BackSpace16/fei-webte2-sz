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
    $sql = "SELECT * FROM testgroups LEFT JOIN taskgroups ON testgroups.testgroup = taskgroups.id WHERE taskgroups.open < :nowdatetime AND taskgroups.close > :nowdatetime ORDER BY testgroups.task;";
    $stmt = $pdo->prepare($sql);

    $date = date("Y-m-d H:i:s");
    $stmt->bindParam(":nowdatetime", $date, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $tests = $stmt->fetchAll();
        $index = rand(0,count($tests)-1);
        $test = $tests[$index];
        unset($stmt);

        $sql = "INSERT INTO tests (student,task,task_group,created) VALUES (:student, :task, :taskgroup, :created)";
        $stmt = $pdo->prepare($sql);

        var_dump($test);

        $stmt->bindParam(":student", $_SESSION['id'], PDO::PARAM_STR);
        $stmt->bindParam(":task", $test["task"], PDO::PARAM_STR);
        $stmt->bindParam(":taskgroup", $test["testgroup"], PDO::PARAM_STR);
        $stmt->bindParam(":created", $date, PDO::PARAM_STR);

        if ($stmt->execute()) {
            unset($stmt);
            header("location: index.php");
        } else
            header("location: index.php");

        unset($stmt);


        //header('Location: index.php');
    }
    else {
        header('Location: index.php');
    }
?>