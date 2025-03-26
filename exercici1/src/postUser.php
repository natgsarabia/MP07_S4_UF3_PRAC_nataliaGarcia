<!-- CREACIÓ D'USUARIS A BBDD AMB PDO -->
<?php
 session_start();
 //conectem amb mysql
 try {
    $conexio = new PDO(
        "mysql:host=localhost",
        "root",
        ""
    );

    $conexio->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexió amb MySQL feta correctament.";

    } 
    catch (PDOException $e) 
    {
        error_log( "Error de connexió amb MySQL: " . $e->getMessage());
    }

    //Seleccionem la BBDD
    $conexio->exec("USE mp07s4uf3");

    //confirmem conexió
    if(!$conexio)
    {
        error_log( 'Error al conectar amb la BBDD: '.$conexio->error.'<br>');
    }

    //CREEM  EL NOU REGISTRE A LA BBDD  
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //guardem les variables donades al formulari
        $nom = $_POST['name'];
        $email = $_POST['email'];
        $edat = $_POST['age'];

        //preparem la consulta a sql
        $sql = 'INSERT INTO usuaris (nom, email, edat) VALUES (:nom, :email, :edat)';
        $stmt = $conexio->prepare($sql);

        //executem la insercció
       if ( $stmt->execute(['nom' => $nom, 'email' => $email, 'edat' => $edat]))
       {
            $_SESSION['message'] = "Usuari registrat correctament.";
            $_SESSION['result']="OK";
       }
       else
       {
            $_SESSION['message'] = "Error en registrar usuari.";
            $_SESSION['result']="";
       }

        //retornem a la pagina index, perqu emostri la nova informació actualitzada
        header('Location: ../public/index.php');
    }
?>