<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php 
include_once  __DIR__ . "/../templates/alertas.php" //importo las alertas los templates dentro de views
?>




 <form class="formualrio" method="POST" action="/"> <!-- le paso el metodo y la ruta -->
    <div class="campo">
        <label for="email">Email</label>
        <input 
        type="email"
        id="email"
        placeholder="Tu Email"
        name="email"
        
        />
    </div>

    <div class="campo">
        <label for="password">Contraseña</label>
        <input 
        type="password"
        id="password"
        placeholder="Tu Contraseña"
        name="password"
        
        />

        
    </div>

    <input type="submit" class="boton" value="Iniciar Sesión">
</form>

<div class="acciones">
    <a href="/crear-cuenta">Aun no tienes una cuenta? Crear una</a>
    <a href="/olvide">Olvidaste tu contraseña</a>
    <a href="/contacto">Contáctanos</a>
</div>