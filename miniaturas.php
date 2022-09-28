<?php
crearMiniatura($_FILES['imagen']['name']);
function crearMiniatura($nombreArchivo){
  $finalWidth=250;                          /*ancho final de la imagen*/  
  $dirFullImage='imagenes/full/';           /*directorio de las imagenes HD*/
  $dirThumbImage='imagenes/thumbs/';         /*directorio de imagenes en miniatua*/
  $tmpName= $_FILES['imagen']['tmp_name'];  /*ruta de la imagen de donde proviene*/
  $finalName=$dirFullImage.$_FILES['imagen']['name']; /*ruta y nombre final de la imagen full*/
  
  /* copiar la imagen a la carpeta full*/
  copiarImagen($tmpName,$finalName);   
  
  
  $im=null;
  /*valida que sea una imagen JPG*/
  if(preg_match('/[.](jpg)$/', $nombreArchivo)){
      /*crea la ima*/
      $im= imagecreatefromjpeg($finalName);
  }else if(preg_match('/[.](gif)$/', $nombreArchivo)){
      $im= imagecreatefromgif($finalName);
  }else if(preg_match('/[.](png)$/', $nombreArchivo)){
      $im= imagecreatefrompng($finalName);
  }
  /*las medidas de la imagen que se esta creando*/
  $width= imagesx($im);
  $height= imagesy($im);
  
  /*medidas de la miniatura*/
  $minWidth= $finalWidth;
  $minHeight= floor($height * ($finalWidth/$width)); /*altura proporcional*/
  
  /* crea una imagen con las medidas de thumb*/
  $imageTrueColor= imagecreatetruecolor($minWidth, $minHeight);
  
  /*copia y cambia el tamano de una imagen*/
  imagecopyresized($imageTrueColor, $im,0,0,0,0, $minWidth, $minHeight, $width, $height);
  
  /*validamos los directorios*/
  if(!file_exists($dirThumbImage)){
      if(!mkdir($dirThumbImage)){
          die("hubo un erro con la miniatura");          
      }
  }
  
  /*copia la imagen a un fichero*/
  imagejpeg($imageTrueColor, $dirThumbImage.$nombreArchivo);
  
  
}

function copiarImagen($origen,$destino){
    move_uploaded_file($origen, $destino);
    
}
