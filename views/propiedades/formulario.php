<fieldset>
    <legend>Información General</legend>
    <label for="titulo">Titulo:</label>
    <input name="propiedad[titulo]" type="text" id="titulo" placeholder="Titulo Propiedad" value="<?php echo
                                                                                        s($propiedad01->titulo); ?>">

    <label for="precio">Precio: </label>
    <input name="propiedad[precio]" type="number" id="precio" placeholder="Precio" value="<?php echo s($propiedad01->precio); ?>">

    <label for="imagen">Imagen: </label>
    <input name="propiedad[imagen]" type="file" id="propiedad[imagen]">


    <?php if ($propiedad01->imagen) : ?>

        <img src="/imagenes/<?php echo "$propiedad01->imagen" ?>">

    <?php endif; ?>


    <label for="descripcion">Descripción:</label>
    <textarea name="propiedad[descripcion]" id="descripcion"><?php echo s($propiedad01->descripcion); ?></textarea>

</fieldset>


<fieldset>
    <legend>Información Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input name="propiedad[habitaciones]" type="number" min="1" max="10" step="1" id="habitaciones" value="<?php echo   s($propiedad01->habitaciones); ?>">

    <label for="wc">Baños:</label>
    <input name="propiedad[wc]" type="number" min="1" max="10" step="1" id="wc" value="<?php echo s($propiedad01->wc); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input name="propiedad[estacionamiento]" type="number" min="1" max="10" step="1" id="estacionamiento" value="<?php echo s($propiedad01->estacionamiento); ?>">

</fieldset>

<fieldset>

    <legend>Vendedor</legend>
    <label for="vendedor">Vendedor</label>
    <select name="propiedad[vendedorId]" id= vendedor>
        <option selected value="">--Seleccione--</option>
        <?php foreach($vendedores as $vendedor){ ?>
            <option 
            <?php echo $propiedad01->vendedorId === $vendedor->id ? 'selected' : '' ?>
            value="<?php echo s($vendedor->id) ?>" ><?php echo s($vendedor->nombre)." ".s($vendedor->apellido)?> </option>
        <?php } ?>
</fieldset>