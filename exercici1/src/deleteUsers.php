<!-- ELIMINACIO D'USUARIS A BBDD AMB PDO -->
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

    //CREEM  EL NOU REGISTRE A LA BBDD  
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //guardem les variables donades al formulari
        $id = $_POST['delete'];
        echo(" ID a eliminar: " . $id.'<br>');

        //preparem la consulta a sql
        $sql = 'DELETE from usuaris where id = :id';
        $stmt = $conexio->prepare($sql);

        //executem la insercció
        if ( $stmt->execute(['id' => $id]))
       {
            $_SESSION['message'] = "Usuari eliminat correctament.";
            $_SESSION['result']="OK";
       }
       else
       {
            $_SESSION['message'] = "Error en eliminar usuari.";
            $_SESSION['result']="";
       }

        echo(" Usuari eliminat correctament.<br>");

        //retornem a la pagina index, perqu emostri la nova informació actualitzada
        header('Location: ../public/index.php');
    }
?>