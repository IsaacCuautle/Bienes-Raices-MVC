<h1 class="fw-300 centrar-texto" data-cy="heading-contacto">Contacto</h1>
<?php if($mensaje){
    echo "<p data-cy='alerta-envio' class='alerta exito'>".$mensaje."</p>";
} ?>
<img src="/build/img/destacada3.jpg" alt="Imagen Principal">


<main class="contenedor seccion contenido-centrado">
    <h2 class="fw-300 centrar-texto" data-cy="heading-formulario">Llena el Formulario de Contacto</h2>

    <form data-cy="formulario-contacto" class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre:</label>
            <input data-cy="input-nombre" type="text" id="nombre" placeholder="Tu Nombre" name="contacto[nombre]" required>

            <label for="mensaje">Mensaje: </label>
            <textarea data-cy="input-mensaje" id="mensaje" name="contacto[mensaje]" required></textarea>

        </fieldset>


        <fieldset>
            <legend>Información sobre Propiedad</legend>
            <label for="opciones">Vende o Compra</label>
            <select data-cy="input-opciones" id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="cantidad" >Cantidad:</label>
            <input data-cy="input-cantidad" type="number" min="0" max="10000" step="5" name="contacto[precio]" required>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <p>Como desea ser Contactado:</p>

            <div class="forma-contacto">
                <label for="telefono">Teléfono</label>
                <input data-cy="input-radio" type="radio" name="contacto[contacto]" value="telefono" id="telefono" required>

                <label for="correo">E-mail</label>
                <input data-cy="input-radio" type="radio" name="contacto[contacto]" value="correo" id="correo" required>
            </div>

            <div id="contacto"></div>

            


        </fieldset>

        <input type="submit" value="Enviar" class="boton boton-verde">

    </form>
</main>