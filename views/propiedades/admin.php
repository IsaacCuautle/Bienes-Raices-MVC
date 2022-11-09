<main class="contenedor seccion contenido-centrado">
    <h1>Administrador de Bienes Raices</h1>

    <?php 
    if($mensaje){ 

        $mensaje01 = mostrarNotificacion(intval($mensaje));

    if ($mensaje) { ?>

        <p class="alerta exito"><?php echo s($mensaje01) ?></p>

       <?php }
    } 
    
    ?>



    <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo Vendedor</a>
    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td>
                        <img src="/imagenes/<?php echo $propiedad->imagen; ?>"" width=" 100" class="imagen-tabla">
                    </td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name="id_eliminar" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" href="/admin/propiedades/borrar" class="boton boton-rojo" value="Borrar">
                        </form>

                        <a href="propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton boton-verde">Actualizar</a>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>

            </tr>
        </thead>

        <tbody>
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono ?></td>
                    <td>
                        <form method="POST" lass="w-100" action="/vendedores/borrar">
                            <input type="hidden" name="id_eliminar" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" href="/vendedores/borrar" class="boton boton-rojo" value="Borrar">
                        </form>

                        <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton boton-verde">Actualizar</a>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</main>

