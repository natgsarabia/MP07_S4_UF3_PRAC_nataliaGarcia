
<!-- EXTREURE REGISTRES DE LA BBDD -->
 
<?php
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
    // echo '<h2>Fem la conexio amb la BBDD</h2>';

    $conexio->exec("USE mp07s4uf3");

    if($conexio)
    {
        // echo 'Conexió amb la base de dades realitzada correctament<br>';
    }
    else
    {
        error_log( 'Error al conectar amb la BBDD: '.$conexio->error.'<br>');
    }

    //INICEM CONSULTA AMB MYSQLi
    // echo '<h2>Fem la consulta amb PDO</h2>';

    //DEFINIM LA CONSULTA
    $result = $conexio->prepare("SELECT * FROM usuaris");
    
    //Definim la variable del where que li pasarem, igual que a Mysql li passem així per evitar injeccion
    $result->execute();

    //Guardem els resultats
    $resultPDO = $result->fetchAll(PDO::FETCH_ASSOC);

    // //Revisar per pantalla que ha recollit bé les dades
    // foreach ($resultPDO as $row) {
    //     echo $row['nom'] . " - " . $row['email'] ." - edat:". $row['edat'] . "<br>";
    // }

    
    //tanquem la sessió
    $conexio = null;
?>