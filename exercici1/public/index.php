<?php
 session_start();
 require '../src/getUsers.php';


 //recogim els posibles misatges d'error o validació
 $message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    if(isset($_SESSION['result']) && $_SESSION['result'] =="OK")
    {
        $color="green";
    }
    else
    {
        $color="red";
    }
    // buidem les variables message i result de la sessió
    unset($_SESSION['message']);
    unset($_SESSION['result']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDEX</title>
</head>
<body>
    <h1>BBDD USUARIS</h1>

    <!-- Depen de si tenim o no missatge registrat, el mostrem o no -->
    <?php if (!empty($message)):
        echo"<p style=color:$color> $message </p>";
     endif; ?>

    <h2>Usuaris actuals:</h2>
    
        <!-- CRREM UNA TAULA AMB TOTS EL USUARIS ACTUALS -->
        <table>
            <tr>
                <th class="hide"></th> <!-- casella per guardar l'informació del id del registre-->
                <th>NOM</th>
                <th>EMAIL</th>
                <th>EDAT</th>
                <th class="hide"></th> <!-- casella per el botó actualitzar -->
                <th class="hide"></th> <!-- casella per el botó eliminar -->
            </tr>
            <?php
                foreach($resultPDO as $result)
                {
                    echo '
                    <tr>
                        <form id="users-form" method="POST" action="../src/updateUsers.php">
                            <td class="line"><input type="hidden" name="id" value="' . $result['id'] . '"></td>
                            <td class="line"><input type="text" name="name" value="' . $result['nom'] . '"></td>
                            <td class="line"><input type="text" name="email"  value="' . $result['email'] . '"></td>
                            <td class="line"><input type="text" name="age"  value="' . $result['edat'] . '"></td>
                             <td>
                                <button class="custom-btn btn-5" type="submit" name="submit_update">Actualizar</button>
                            </td>
                        </form>
                        <td>
                           <form method="POST" action="../src/deleteUsers.php">
                                <input type="hidden" name="delete" value="'. $result['id'] .'">
                                <button class="custom-btn btn-5" type="submit" name="submit_delete">Eliminar</button>
                            </form>
                        </td>
                    </tr>';
                }
            ?>
        </table>
    
    <!-- CREEM UN NOU FORMULARI PER AFEGUIR USUARIS A BBDD -->
    <h2>Registrar un nou usuari:</h2>
    <div class="containerForm">
        <form method="POST" class="RegisterUsuari" name="createNew" action="../src/postUser.php">
            <div class="form-row">
                <p>Nom: <input class="register-input" type="text" name="name" required></p>
                <p>Email: <input class="register-input" type="email" name="email" required></p>
                <p>Edat: <input class="register-input" type="number" name="age" required></p>
            </div>
            <button class="custom-btn btn-5 btn-register" type="submit" name="create">Registrar Usuari</button>
        </form>
    </div>
    

</body>
</html>