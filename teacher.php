<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: index.php');
    }
    if (!$_SESSION['is_teacher']) {
        header('Location: student.php');
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
                <div class="col-lg-7 col-md-6 col-sm-8 col-10">
                        <style>
                            table {
                                border-collapse: collapse;
                                width: 90%;
                            }
                            th, td {
                                border: 1px solid black;
                                padding: 8px;
                                text-align: left;
                                white-space: normal;
                                word-wrap: break-word;
                            }
                            .mathjax-equation {
                                max-width: 200px;
                                overflow: hidden;
                                white-space: normal;
                                word-wrap: break-word;
                            }
                            .image-cell img {
                                max-width: 100px;
                                height: auto;
                                cursor: pointer;
                            }
                            .modal {
                                display: none;
                                position: fixed;
                                z-index: 999;
                                padding-top: 30px;
                                left: 0;
                                top: 0;
                                width: 100%;
                                height: 100%;
                                overflow: auto;
                                background-color: rgba(0, 0, 0, 0.8);
                            }
                            .modal-content {
                                margin: auto;
                                display: block;
                                width: 80%;
                                max-width: 800px;
                                max-height: 80%;
                            }
                            .modal-content img {
                                width: 100%;
                                height: auto;
                            }
                            .close {
                                color: #fff;
                                position: absolute;
                                top: 10px;
                                right: 25px;
                                font-size: 35px;
                                font-weight: bold;
                                transition: 0.3s;
                                cursor: pointer;
                            }
                            .close:hover {
                                color: #bbb;
                            }
                        </style>
                        <!-- <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
                        <script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_CHTML"></script> -->
                        <script>
                            // Function to open modal
                            function openModal(imageSrc) {
                                var modal = document.getElementById("modal");
                                var modalImg = document.getElementById("modal-image");
                                modal.style.display = "block";
                                modalImg.src = imageSrc;
                            }
                            // Function to close modal
                            function closeModal() {
                                var modal = document.getElementById("modal");
                                modal.style.display = "none";
                            }

                            // Event listener to close modal on click outside the image
                            window.addEventListener("click", function(event) {
                                var modal = document.getElementById("modal");
                                if (event.target === modal) {
                                    closeModal();
                                }
                            });

                            // Function to toggle table visibility
                            function toggleTable() {
                                var table = document.getElementById("prklady-table");
                                table.style.display = table.style.display === "none" ? "table" : "none";
                            }
                        </script>
                        
                        <?php
                            
                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['uploaded_file'])) {
                                
                                $uploadedFile = $_FILES['uploaded_file'];
                               
                                $regex = '/\\\\section\*\{(.+?)\}.*?\\\\begin\{task\}(.*?)\\\\end\{task\}.*?\\\\begin\{solution\}(.*?)\\\\end\{solution\}/s';

                    
                    $vzorce = array();
                    $riesenia = array();
                    $blokoveSchema = array();

                    
                        $obsah = file_get_contents($uploadedFile['tmp_name']);

                        
                        preg_match_all($regex, $obsah, $vysledok, PREG_SET_ORDER);
                        
                        // Prechádzanie cez všetky nájdené príklady
                        foreach ($vysledok as $index => $prklad) {
                            $cisloPrkladu = $prklad[1];
                            $uloha = $prklad[2];
                            $riesenie = $prklad[3];

                            // Odstrániť "$" zo vzorcov úlohy a riešenia
                            $uloha = str_replace('$', '', $uloha);
                            $riesenie = str_replace('$', '', $riesenie);

                            // Získať názov obrázka z úlohy
                            preg_match('/\\\\includegraphics{.*?\/(.*?)}/', $uloha, $obrazokVysledok);
                            $obrazok = $obrazokVysledok[1];

                            // Odstrániť "includegraphics" zo začiatku názvu obrázka v úlohe
                            $uloha = preg_replace('/\\\\includegraphics{.*?\/(.*?)}/', '', $uloha);

                            // Ak nie je definovaná bloková schéma, pridaj hodnotu "žiadna schéma"
                            if (empty($obrazok)) {
                                $blokoveSchema[] = 'žiadna schéma';
                            } else {
                                $blokoveSchema[] = $cestaSuborov . $obrazok;
                            }

                            // Pridať úlohu a riešenie do príslušných polí
                            $vzorce[] = array(
                                'subor' => $cisloPrkladu,
                                'uloha' => trim($uloha)
                            );
                            $riesenia[] = trim($riesenie);
                                
                            }}
?>
                       
                       <div class="row">
                        <h3>Nahratie súboru:</h3>
                            <div class="col-sm">
                            <form method="POST" enctype="multipart/form-data">
                            <!-- <label for="file">Select a file:</label> -->
                            <input type="file" class="form-control" id="file" name="uploaded_file" required>
                            </div>
                            <div class="col-sm">
                            <button type="submit" class="btn btn-primary">Nahrať súbor</button>
                            </div>
                       </div>
                        
                       <br>

                            <h3>Tabuľka načítaných príkladov: </h3>
                        <button id="toggle-button" class="btn btn-primary" onclick="toggleTable()">Zobraziť / Skryť tabuľku</button>

                        <table id="prklady-table" class="table" style="display:none;">
                            <thead>
                                <tr>
                                    <th>Číslo príkladu</th>
                                    <th>Vzorec</th>
                                    <th>Riešenie</th>
                                    <th>Bloková schéma</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include('config.php');
                                // Prechádzanie cez všetky nájdené príklady
                                foreach ($vzorce as $index => $prklad) {
                                    $cisloPrkladu = $prklad['subor'];
                                    $uloha = $prklad['uloha'];
                                    $riesenie = $riesenia[$index];
                                    $obrazok = $blokoveSchema[$index];

                                    //$ulohaa = $prklad['uloha'];
                                    
                                    //modifikovana uloha aj riesenie... upraveny string kvoli vypisu
                                    $tags = array("\begin{equation*}","end{equation*}","\\");
                                    $Muloha = str_replace($tags,"", $uloha);
                                    $Mriesenie = substr($riesenie, 18, -15);



                                    $sqlCheck = "SELECT COUNT(*) FROM tasks WHERE name = :name";
                                        $stmtCheck = $pdo->prepare($sqlCheck);
                                        $stmtCheck->bindParam(":name", $cisloPrkladu, PDO::PARAM_STR);
                                        $stmtCheck->execute();
                                        $count = $stmtCheck->fetchColumn();




                                     if ($count == 0) {
                                        // Insert a new task if it doesn't exist
                                        $sqlInsert = "INSERT INTO tasks (name, description, image, solution) VALUES (:name, :description, :image, :solution)";
                                        $stmtInsert = $pdo->prepare($sqlInsert);
                                        $stmtInsert->bindParam(":name", $cisloPrkladu, PDO::PARAM_STR);
                                        $stmtInsert->bindParam(":description", $Muloha, PDO::PARAM_STR);
                                        $stmtInsert->bindParam(":image", $obrazok, PDO::PARAM_STR);
                                        $stmtInsert->bindParam(":solution", $Mriesenie, PDO::PARAM_STR);
                                        $stmtInsert->execute();
                                    }

                                    
                                }

                                $query = "SELECT * FROM tasks";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();
                                $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                                foreach ($tasks as $task) {

                                    
                                    echo "<tr>";
                                    echo "<td>" . $task['name'] . "</td>";
                                    echo "<td>" . $task['description'] . "</td>";
                                    echo "<td>" . $task['solution'] . "</td>";


                                
                                    //echo '<td><img src="data:image/png;charset=utf8;base64,'.base64_encode($task['image']).'"width="88" height="31"></td>';
                                

                                    $imageData = $task['image'];

                                    if (strlen($imageData) > 15) {
                                        $base64Image = base64_encode($imageData);
                                        echo "<td><img src='data:image/jpeg;base64," . $base64Image . "' alt='Task Image' width='120' height='50'></td>";
                                    } else {
                                        echo "<td>Žiadna schéma</td>";
                                    }
                        


                                    echo "</tr>";
                                }
                                //unset($stmt);
                                ?>
                            </tbody>
                        </table>
                        <h3>Pridenie úlohy študentovi</h3>
                        <?php
                            include('config.php');

                            

                            // Select all students from the users table with the role "Student"
                            $sqlStudents = "SELECT * FROM users WHERE name = 'Študent'";
                            $stmtStudents = $pdo->prepare($sqlStudents);
                            $stmtStudents->execute();
                            $students = $stmtStudents->fetchAll(PDO::FETCH_ASSOC);
                            ?>

                            <!-- Generate the <select> tag with student options -->
                            <div class="row">
                            <div class="column">
                            <select class="form-select" name="student">
                            <?php foreach ($students as $student): ?>
                                <option value="<?php echo $student['id']; ?>">
                                <?php echo $student['username']; ?>
                                </option>
                            <?php endforeach; ?>
                            </select>
                            </div>
                            <div class="column">
                            <?php
                                include('config.php');
                                $sqlp = "SELECT * FROM tasks ";
                                $stmtp = $pdo->prepare($sqlp);
                                $stmtp->execute();
                                $p = $stmtp->fetchAll(PDO::FETCH_ASSOC);
                            ?>

                            <!-- Generate the <select> tag with student options -->
                            <select class="form-select" name="p">
                            <?php foreach ($p as $task): ?>
                                <option value="<?php echo $task['id']; ?>">
                                <?php echo $task['name']; ?>
                                </option>
                            <?php endforeach; ?>
                            </select> 
                            </div>
                            <div class="column">
                            <button  class="btn btn-primary">Priraď úlohu</button>
                            </div>

                            </div>

                        <!-- Modal -->
                        <div id="modal" class="modal">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <img class="modal-content" id="modal-image">
                        </div>

                        <script>
                            // MathJax configuration and rendering
                            MathJax.Hub.Config({
                                tex2jax: {
                                    inlineMath: [['$', '$'], ['\\(', '\\)']]
                                }
                            });
                            MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                        </script>

                </div>
            </div>
        </div>
    </div>
</body>
</html>