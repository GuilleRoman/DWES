<?php
header('Content-Type: application/json; charset=utf-8');
// Esta API tiene dos posibilidades; Mostrar una lista de autores o mostrar la información de un autor específico.
include('gestionLibros.php');

function get_lista_autores(){
    //Esta información se cargará de la base de datos
    $lista_autores= GestionLibros::getListaAutores();
    
    return $lista_autores;
}
/** 
     * Busca a un autor y sus libros, utilizando para ello la id del autor.
     * @param $nombre es el nombre del autor
     * @return $datos devuelve los datos obtenidos de MySQL
     * @author Guillermo Román Medrano guilleromanm@gmail.com
     * @version 3.1.0 estable
     */
function get_datos_autor($nombre){
  $datos = array();
  $datos['autor']=  GestionLibros::getDatosAutor($nombre);
  $autor_id = $datos['autor']['id']; 
  $datos['libros']=  GestionLibros::getLibrosAutor($autor_id); 
  //echo 
  
  return $datos;
}

function get_lista_libros(){
  $datos=  GestionLibros::getListaLibros(); 

    return $datos;
}

function get_datos_libro($id){
  $datos=  GestionLibros::getDatosLibro($id); 

    return $datos;
}
//cogemos los datos de la base de datos, pasando las letras.
function getLibrosPorLetra($letras){
  $datos= GestionLibros::getLibrosPorLetra($letras);

  return $datos;
}

$posibles_URL = array("get_lista_autores", "get_datos_autor", "get_lista_libros", "get_datos_libro", "get_libros_letras");

$valor = "Ha ocurrido un error";
// Si se encuentra en el header los parámetros, se llama a su método
if (isset($_GET["action"]) && in_array($_GET["action"], $posibles_URL))
{
  switch ($_GET["action"])
    {
      case "get_lista_autores":
        $valor = get_lista_autores();
        break;
      case "get_datos_autor":
        if (isset($_GET["nombre"]))
            $valor = get_datos_autor($_GET["nombre"]);
        else
            $valor = "Argumento no encontrado";
        break;
      case "get_lista_libros":
            $valor = get_lista_libros();
            break;
      case "get_datos_libro":
            if (isset($_GET["id"]))
            $valor = get_datos_libro($_GET["id"]);
      case "get_libros_letras":
            if (isset($_GET["letras"]))
            $valor = getLibrosPorLetra($_GET["letras"]);
        else
            $valor = "Argumento no encontrado";
        break;
    }
}


// Aquí se crea un string en base a los datos devueltos por la base de datos, para poder ser usados por el cliente.
// posteriormente se devuelven mediante exit() a la solicitud a la api.
  
//$valor =json_encode($valor);
//$resultado =json_decode($valor, true);
$texto = "";
$datosAutor= "<ul><li> AUTOR<hr>ID: ".$valor['autor']['id']." <br> Nombre: ".$valor['autor']["nombre"]." <br> Apellidos: ".$valor['autor']["apellidos"]." <br> Nacionalidad: ".$valor['autor']["nacionalidad"];
$libros = "";
foreach ($valor['libros'] as $libro){
  
  $libros .= "<br> ID: ".$libro["id"]."<br> Título: ".$libro["titulo"]."<br> Fecha de publicación: ".$libro["f_publicacion"]."<br>";
}
$result = $datosAutor."<br><br> LIBROS<hr>".$libros;
exit($result);

?>