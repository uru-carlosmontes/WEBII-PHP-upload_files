<?php

$files = $_FILES["photos"];

// cantidad de archivos enviados
$countFiles = count($files["name"]);

// file_exists puede ser utilizad tanto para verificar si un archivo existe
// como tambien para verificar si un directorio existe

if (!file_exists("c:\\test")) {
	mkdir("c:\\test");
}

// se mueven los archivos desde la carpeta temporal hacia la carpeta de destino
// se implementa la funcion getFileExt; el (.) es el caracter que 
// permite realizar concatenaciones entre Strings

for ($i = 0; $i < $countFiles; $i++) {
	move_uploaded_file($files["tmp_name"][$i], "c:\\test\\".($i + 1).".".getFileExt($files["type"][$i]));
}

// retorno un mensaje al cliente

echo json_encode([
	"status" => 200,
	"response" => "Todos los Archivos han sido guardados"
]);

// -------------- FUNCIONES ADICIONALES --------------------------

// explode es la funcion de PHP similar al split en Java y JavaScript
// la funcion getFileExt permite saber la extension del archivo 
// utilizando como referencia el mime-type
function getFileExt($mime) {
	$type = explode('/', $mime)[1];
	return $type;
}