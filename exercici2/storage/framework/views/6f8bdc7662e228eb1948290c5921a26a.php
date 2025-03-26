<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LARAVEL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/usuaris">BBDD Usuarios</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/postUsuaris">Crear nuevo Usuario</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/putUsuaris">Actualizar usuario</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/deleteUsuaris">Eliminar usuario</a>
      </li>
    </ul>
  </div>
</nav>
    <h1>BBDD USUARIS</h1>
  

    <!-- REVISEM ELS MISSATGES -->
     <!-- Succes -->
     <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Error -->
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <p>Error al editar l'usuari</p>
            <p>Motius:</p>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <h2>Usuaris:</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>USUARI</th>
                <th>EMAIL</th>
                <th>EDAT</th>
                <th class="hide"></th> <!-- casella per el botó actualitzar -->
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $usuaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuari): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <tr>
                <form id="users-form" method="POST" action="<?php echo e(route('usuaris.update', $usuari->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <td><input type="text" style="border:0px" name="nom" value="<?php echo e($usuari->nom); ?>"></td>
                    <td><input type="text" style="border:0px" name="email"  value="<?php echo e($usuari->email); ?>"></td>
                    <td><input type="text" style="border:0px" name="edat"  value="<?php echo e($usuari->edat); ?>"></td>
                    <td>
                        <button class="custom-btn btn-5" type="submit" name="submit_update">Actualizar</button>
                    </td>
                </form>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\M7-DESENVOLUPAMENT_WEB_DENTORN_SERVIDOR\MP07_S4_UF3_PRAC_nataliaGarcia\exercici2\resources\views/edit.blade.php ENDPATH**/ ?>