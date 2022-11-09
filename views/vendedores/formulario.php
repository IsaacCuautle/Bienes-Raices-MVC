<fieldset>
    <legend>Información General</legend>
    <label for="nombre">Nombre(s):</label>
    <input name="vendedor[nombre]" type="text" id="nombre" placeholder="Nombre del vendedor" value="<?php echo
                                                                                        s($vendedores->nombre); ?>">

    <label for="apellido">Apellido: </label>
    <input name="vendedor[apellido]" type="text" id="apellido" placeholder="Apelllidos del vendedor" value="<?php echo s($vendedores->apellido); ?>">

    <label for="telefono">Telefono: </label>
    <input name="vendedor[telefono]" type="text" placeholder="Telefono del vendedor" id="telefono" value='<?php echo 
    s($vendedores->telefono); ?>'>


    
</fieldset>