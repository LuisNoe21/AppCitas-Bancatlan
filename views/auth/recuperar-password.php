<h1 class="nombre-pagina">Recuperar Contraseña</h1>
<p class="descripcion-pagina">Coloca tu nueva contraseña</p>

<?php 
include_once  __DIR__ . "/../templates/alertas.php" //importo las alertas los templates dentro de views
?>


 <?php  if($error) return null; ?> <!--si hay un error no me mostrara el html -->
<form class="formualrio" method="POST">

<div class="campo">
        <label for="password">Contraseña</label>
        <input 
        type="password"
        id="password"
        placeholder="Tu nueva Contraseña"
        name="password"
        
        />
</div>
<input type="submit" class="boton" value="Guardar nueva contaseña">
    
</form>

<div class="acciones">
    <a href="/">Ya tienes una cuenta? Inicia sesión</a>
    <a href="/crear-cuenta">Aun no tienes una cuenta? Crear una</a>
</div>

