<?php
    session_start();
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
     <!-- PDF-generate -->
     <script src=
 "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js">
    </script>



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
                    <?php
                        if (!isset($_SESSION['id'])) {
                            echo '<a href="index.php" class="nav-link link-dark" aria-current="page">';
                            echo '<img class="icona" src="icons/person.svg" width="16" height="16">';
                            echo ' Prihlásiť sa';                        }
                        else {
                            if ($_SESSION['is_teacher'])
                                echo '<a href="teacher.php" class="nav-link link-dark" aria-current="page">';
                            else
                                echo '<a href="student.php" class="nav-link link-dark" aria-current="page">';
                            echo '<img class="icona" src="icons/home.svg" width="16" height="16">';
                            echo ' Domov';  
                        }
                    ?>
                    </a>
                </li>
                <li>
                    <a href="help.php" class="nav-link active">
                        <img class="icona" src="icons/help_white.svg" width="16" height="16">
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
            <a href="index.php" class="d-block py-3 px-1 link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Olympijské hry">
                <img src="img/logo.png" width="64" height="30">
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <?php
                        if (!isset($_SESSION['id'])) {
                            echo '<a href="index.php" class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Prihlásiť sa" data-bs-original-title="Prihlásiť sa">';
                            echo '<img src="icons/person.svg" width="24" height="24">';
                        }
                        else {
                            if ($_SESSION['is_teacher'])
                                echo '<a href="teacher.php" class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Domov" data-bs-original-title="Domov">';
                            else
                                echo '<a href="student.php" class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Domov" data-bs-original-title="Domov">';
                            echo '<img src="icons/home.svg" width="24" height="24">';
                        }
                    ?>
                    </a>
                </li>
                <li>
                    <a href="help.php" class="nav-link active py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Návod" data-bs-original-title="Návod">
                        <img src="icons/help_white.svg" width="24" height="24">
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
        
        <div class="content" >
        <div class="d-flex justify-content-center">
            <div class="col-sm-10 col-11">
                <div class="text-center">
                    <h2>Návod na použitie</h2>
                </div>
                <hr>
                <div id="contentToConvert">
                    <h5>Prihlásenie</h5>
                    <p>Registrovaný používateľ sa prihlási pomocou emailu a hesla uvedené 
                        pri registrácii(v našom prípade už registrovaných v readME).
                         Po úšešnom prihlásení študenta alebo učiteľa je presmerovaný 
                         do svojej časti aplikácie na základe role (podľa toho či je
                          učiteľ alebo študent)</p>
                         
                    <p>Registrovaný používateľ sa prihlási pomocou emailu a hesla 
                        uvedené pri registrácii
                        (v našom prípade už registrovaných v readME).
                     Po úšešnom prihlásení študenta alebo učiteľa je presmerovaný 
                     do svojej časti aplikácie na základe role
                      (podľa toho či je učiteľ alebo študent)</p>
                     
                     
                     <br><h5>Návod - učiteľ</h5><br>
                     
                     <p>Na stránke si môžete vybrať ktorého študenta zvoliť ,
                         priradiť mu úlohu ,
                        zadať body na ulohu . 
                        Na bočnej lište si možete kliknu na navod , domov,
                         alebo sa odhlasit.

                    </p>
                    <p>Vo formuláre môžete nahrať subor s LaTex súbormi s príkladmi.
                        Ďalej si može po kliknutí na zobraziť/skryť tabulku 
                        zobrazit tabulku s nahratými príkladmi so súboru.
                        Druhým kliknutím sa tabulka zatvorí.
                    </p>
                    <br><h5>Návod - študent</h5><br>

                    <p>Na stránke si môžete priradené úlohy od učiteľa. 
                        Na bočnej lište si možete kliknu na navod , domov,
                         alebo sa odhlásit.

                    </p>
                    <p>Na stránke sú zobrazené jeho úlohy. Tie ktoré niesú odovzdané 
                        môže odovzdať. Tie ktoré už sú odovzdané za tie môže
                        študent vidieť dosiahnuté body
                    </p>
                        </div>
                
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
    <button class="btn btn-primary btn-sm" onclick="generatePDF()">Create PDF</button>
</div>

  
<script type="text/javascript">
    function generatePDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        const contentToConvert = document.getElementById('contentToConvert');
        const excludedTags = ['h5', 'p'];

        const elements = contentToConvert.getElementsByTagName('*');
        let textContent = '';

        for (let i = 0; i < elements.length; i++) {
            const currentTag = elements[i].tagName.toUpperCase();
            const text = elements[i].textContent.trim();

            if (!excludedTags.includes(currentTag) && text) {
                if (textContent) {
                    textContent += '\n'; 
                }
                textContent += text;
            }
        }

        doc.text(textContent, 15, 15);

        doc.save("newFile.pdf");
    }
</script>




</body>
</html>