<?php 

$arrFiles = array();
$ruta_miniatura="imagenes/thumbs/";
$ruta_full="imagenes/full/";
$iterator = new FilesystemIterator($ruta_miniatura);
foreach($iterator as $entry) {
    
    echo '<a href="'.$ruta_full.$arrFiles[] = $entry->getFilename().'"><img src="'.$ruta_miniatura.$arrFiles[] = $entry->getFilename().'" style="height:200px; padding:10px;"></a>';
   
}




