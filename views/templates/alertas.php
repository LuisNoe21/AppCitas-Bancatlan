<?php 

foreach ($alertas as $key => $mensajes): // foreach que me imprime la key y los mensajes

    foreach($mensajes as $mensaje): //forecah que me imprime la alerta

        ?>
<div class="alerta <?php echo $key; ?>">
 <?php echo $mensaje; ?> <!-- imprime las alertas -->
</div>
        <?php
    endforeach;  //fin del each
    
endforeach;//fin del each

?>