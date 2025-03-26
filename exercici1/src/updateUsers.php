<!-- ACTUALITZACIÓ D'USUARIS A BBDD AMB PDO -->

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
    echo "Conexió amb MySQL feta correctament.<br>";

    } 
    catch (PDOException $e) 
    {
        echo( "Error de connexió amb MySQL: " . $e->getMessage());
    }

    //Seleccionem la BBDD
    $conexio->exec("USE mp07s4uf3");

    //confirmem conexió
    if(!$conexio)
    {
        echo( 'Error al conectar amb la BBDD: '.$conexio->error.'<br>');
    }

    //ACTUALITZEM EL REGISTRE A LA BBDD  
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //guardem les variables donades al formulari
        $id = $_POST['id'];
        $nom = $_POST['name'];
        $email = $_POST['email'];
        $edat = $_POST['age'];

        //Confirmem que les variables son correctes
        echo 'id: '.$id.' Nom: '.$nom.' Email: '.$email.' Edat: '.$edat;

        //preparem la consulta a sql
        $sql =  'UPDATE usuaris SET nom = :nom, email = :email, edat = :edat WHERE id = :id';
        $stmt = $conexio->prepare($sql);

        //executem la actualització
        if ($stmt->execute(['nom' => $nom, 'email' => $email, 'edat' => $edat, 'id' => $id]))
       {
            $_SESSION['message'] = "Usuari actualitzat correctament.";
            $_SESSION['result']="OK";
       }
       else
       {
            $_SESSION['message'] = "Error en actualitzar  usuari.";
            $_SESSION['result']="";
       }

        // echo(" Usuari actualitzat correctament.<br>");

        //retornem a la pagina index, perqu emostri la nova informació actualitzada
        header('Location: ../public/index.php');
    }
?>