<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexió i creació de taula BBDD</title>
</head>
<body>
    <h2>Conectem amb MySQL y creem la base de dades y la taula:</h2>
    <ol>
        <li><?php
            //conectem amb mysql
            $BBDDConected = new mysqli('localhost','root');

            //Confirmem la conexió
            if($BBDDConected)
            {
                echo 'Conexió amb la base de dades realitzada correctament';
            }
            else
            {
                echo 'Error al conectar amb la BBDD: '.$BBDDConected->error;
            }
        ?></li>

        <li><?php
            // Importem el ficher de creació de la BBDD, la taula y el contingut
            $creacioMySQL=file_get_contents('../db/usuaris.sql');

            //asegurem que s'ha pogut extreure correctament l'informació del fitxer
            // echo $creacioMySQL.'<br>';

            //En cas de que estigui vuit informem de l'error
            if($creacioMySQL=="")
            {
                echo 'Error al extreure las consultas de mysql<br>';
            }
            else
            {
                echo 'Informació de las consultas de mysql extreta correctament<br>';

                //Dividim tot string per cada ; que indicaria el final d'una sentència
                $queriesDividides = explode(';', $creacioMySQL);
                
                //Per casa sentencia, fem la seva execució a BBDD
                foreach($queriesDividides as $querie)
                {
                    if(!empty($querie))
                    {
                        if($BBDDConected->query($querie))
                        {
                            echo 'Consulta executada correctament';
                        }
                        else
                        {
                            echo 'Error al conectar amb la BBDD: '.$BBDDConected->error;
                        }
                    }
                }
            }
            
        //tanquem la sessió
        $BBDDConected = null;
    ?>
</body>
</html>