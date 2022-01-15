

    <main class="contenedor seccion">
        <h1 class="nombre-pagina">Contacto</h1>

        <?php if($mensaje) { ?>
        <p class="alerta exito"><?php echo $mensaje; ?></p>
    <?php } ?>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
        </picture>

        <p class="descripcion-pagina">Llene el formulario de contacto</p>

        <form class="formulario-contacto" action="/contacto" method="POST">
            <fieldset>
                <legend>Información Personal</legend>

                <label for="nombre">Nombre Completo</label>
                <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" required>
               

                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
          

                <label for="opciones" >Dirigido a: </label>
                <select id="opciones" name="contacto[tipo]" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="Banca por internet">Banca por internet</option>
                    <option value="Banca Movil">Banca Movil</option>
                    <option value="POS">POS</option>
                    <option value="Call Center">Call Center</option>
                    <option value="Recursos Humanos">Recursos Humanos</option>
                    <option value="Afiliaciones">Afiliaciones</option>
                    
                </select>


                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input  type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
                </div>

                <div class="contacto-inj" id="contacto"></div>

               

            
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>

       
        <div class="acciones">
    <a href="/">Ya tienes una cuenta? Inicia Sesión</a>
    
    <script src="/public/build/js/app.js"></script>
</div>
    </main>

