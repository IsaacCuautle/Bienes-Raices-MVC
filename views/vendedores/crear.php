<main class="contenedor seccion contenido-centrado">

    <h2>Registrar Vendedor</h2>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
       
    <?php include __DIR__ . '/formulario.php' ?>

        <input type="submit" value="Registrar Vendedor" class="boton boton-verde" actiom = "/admin">

    </form>

</main>