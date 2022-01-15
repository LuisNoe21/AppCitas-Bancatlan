<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario</p>

<?php 
include_once  __DIR__ . "/../templates/alertas.php" //importo las alertas los templates dentro de views
?>

<form class="formulario" method="POST" action="/crear-cuenta"> <!-- le paso el metodo y la ruta -->
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
        type="text"
        id="nombre"
        name="nombre"
        placeholder="Tu Nombre"
        value="<?php echo s($usuario->nombre); ?>"   /> <!-- toma el valor del nombre del cliente y al hacer el post no lo borra, lo que hace que funcionen las alertas, los 2 parametros que toma son la variable de usuario tal cual esta en logincontroller y tambien el nombre del campo de la bd-->
  <!-- la funcion s sanitiza el html -->
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
        type="text"
        id="apellido"
        name="apellido"
        placeholder="Tu apellido"
        value="<?php echo s($usuario->apellido); ?>" /> <!-- toma el valor del apellido del cliente y al hacer el post no lo borra, lo que hace que funcionen las alertas, los 2 parametros que toma son la variable de usuario tal cual esta en logincontroller y tambien el nombre del campo de la bd-->
    <!-- la funcion s sanitiza el html -->
    </div>

    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input 
        type="tel"
        id="telefono"
        name="telefono"
        placeholder="Tu telefono"
        value="<?php echo s($usuario->telefono); ?>" /> <!-- toma el valor del telefono del cliente y al hacer el post no lo borra, lo que hace que funcionen las alertas, los 2 parametros que toma son la variable de usuario tal cual esta en logincontroller y tambien el nombre del campo de la bd-->
    <!-- la funcion s sanitiza el html -->
    </div>

    <div class="campo">
        <label for="email">Email</label>
        <input 
        type="email"
        id="email"
        name="email"
        placeholder="Tu email"
        value="<?php echo s($usuario->email); ?>" /> <!-- toma el valor del email del cliente y al hacer el post no lo borra, lo que hace que funcionen las alertas, los 2 parametros que toma son la variable de usuario tal cual esta en logincontroller y tambien el nombre del campo de la bd-->
    <!-- la funcion s sanitiza el html -->
    </div>

    <div class="campo">
        <label for="password">Contraseña</label>
        <input 
        type="password"
        id="password"
        name="password"
        placeholder="Tu contraseña" 
        /> <!-- De la pasword no lo hacemos que no queremos que nos guarde la password despues de hacer el post-->
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">

    
</form>

<div class="acciones">
    <a href="/">Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/olvide">Olvidaste tu contraseña</a>
    <a href="/contacto">Contáctanos</a>
</div>