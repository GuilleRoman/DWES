<?php
class GestionLibros{

    var $servername="localhost";
    var $db="libros";
    var $username="username";
    var $password="";

    /** 
     * Función que devuelve un objeto mysqli que representa una conexión a base de datos
     * También elige la base de datos requerida 
     * @param string $servername nombre del servidor utilizado
     * @param string $db nombre de la base de datos a utilizar
     * @param string $username nombre de usuario a utilizar
     * @param string $password contraseña a utilizar
     * @return devuelve la plantilla twig para ese artículo en la ruta especificada
     * @author Guillermo Román Medrano guilleromanm@gmail.com
     * @version 2.1.0 estable
     */
    static function conexion($servername,$db,$username,$password){
    $connection = new mysqli($servername,$username, $password);
        if (!$connection) {
        return null;
        } else {
            $connection->select_db($db);
            return $connection;
        }
    
    }

    /** 
     * Crea una tabla con nombre autor
     * @return echo muestra un mensaje
     * @author Guillermo Román Medrano guilleromanm@gmail.com
     * @version 2.1.0 estable
     */
    static function crearTablaAutor(){
    $mysqli = gestionLibros::conexion("localhost","libros", "root", "");
    $sql="CREATE TABLE IF NOT EXISTS Autor (
        id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,  
        nombre VARCHAR(30) NOT NULL,
        apellidos VARCHAR(30) NOT NULL,
        nacionalidad VARCHAR(30) NOT NULL
        )";
            
        if ($mysqli->query($sql) === TRUE){
            echo "Tabla Autor creada<br>";
        }
    }

    /** 
     * 
     * Crea una tabla con nombre Libro
     * @return echo muestra un mensaje
     * @author Guillermo Román Medrano guilleromanm@gmail.com
     * @version 2.1.0 estable
     */
    static function crearTablaLibro(){
        $mysqli = gestionLibros::conexion("localhost","libros", "root", "");
        $sql = "CREATE TABLE IF NOT EXISTS Libro (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
            titulo VARCHAR(60) NOT NULL,
            f_publicacion DATE,
            id_autor INT(6),
            FOREIGN KEY (id_autor) REFERENCES Autor(id)
            ON DELETE CASCADE
            )";
                
            if ($mysqli->query($sql) === TRUE){
                echo "Tabla Libro creada<br>";
            }
        }
    
    /** 
     * Busca un autor en la bd por el id
     * @param $autor_id es la id del autor a encontrar
     * @return echo muestra un mensaje
     * @author Guillermo Román Medrano guilleromanm@gmail.com
     * @version 2.1.0 estable
     */
    static function getDatosAutor($nombre){
        $mysqli = gestionLibros::conexion("localhost","libros", "root", "");
        if (isset($nombre)) {
            // Code here
            $sql = "SELECT * FROM Autor WHERE nombre LIKE '%".$nombre."%'";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                $emparray = array();
                while($row =mysqli_fetch_assoc($result)){
                    $emparray = $row;
                    //echo json_encode($emparray);
                }
                return $emparray;
                } else {
                    return null;
                }
          } 
    }

    /** 
     * Busca los libros de un autor por el id
     * @param $autor_id es la id del autor para encontrar los libros
     * @return echo muestra un mensaje
     * @author Guillermo Román Medrano guilleromanm@gmail.com
     * @version 2.1.0 estable
     */
    static function getLibrosAutor($autor_id){
        $mysqli = GestionLibros::conexion("localhost","libros", "root", "");
        if (isset($autor_id)) {
            // Code here
            $sql = "SELECT * FROM Libro WHERE id_autor=$autor_id";
            $result = $mysqli->query($sql);
                if ($result->num_rows > 0) {
                //return "ID: " . $row["id"]. " - Título: "  . $row["titulo"]. " Fecha de publicación: ". $row["f_publicacion"]. " ID del Autor: ". $row["id_autor"]."<br>";
                    $emparray = array();
                    while($row =mysqli_fetch_assoc($result)){
                        $emparray[] = $row;
                        
                    }
                    //echo json_encode($emparray);
                    return $emparray;
                } else {
                    return null;
                }
          } 
    }

    /** 
     * Busca un libro en la bd por el id
     * @param $libro_id es la id del libro a encontrar
     * @return echo muestra un mensaje
     * @author Guillermo Román Medrano guilleromanm@gmail.com
     * @version 2.1.0 estable
     */
    static function getDatosLibro($libro_id){
        $mysqli = GestionLibros::conexion("localhost","libros", "root", "");
        $sql = "SELECT * FROM Libro WHERE id=$libro_id";
        $result = $mysqli->query($sql);
                if ($result->num_rows > 0) {
                
                $emparray = array();
                while($row =mysqli_fetch_assoc($result)){
                    $emparray = $row;
                    //echo json_encode($emparray);
                }
                return $emparray;
                } else {
                    return null;
                }
    }
    /** 
     * Elimina un autor mediante su id y todos los libros asociados
     * @param $autor_id es la id del autor a borrar
     * @return echo muestra un mensaje
     * @author Guillermo Román Medrano guilleromanm@gmail.com
     * @version 2.1.0 estable
     */
    static function borrarAutor($autor_id){
        $mysqli = GestionLibros::conexion("localhost","libros", "root", "");
        $sql = "DELETE FROM Autor WHERE id=$autor_id";
        if ($mysqli->query($sql) === TRUE) {
            echo true;
            return null;
        }else echo false;
            return null;
    }

    /** 
     * Elimina un libro mediante su id
     * @param $libro_id es la id del autor a borrar
     * @return echo muestra un mensaje
     * @author Guillermo Román Medrano guilleromanm@gmail.com
     * @version 2.1.0 estable
     */
    static function borrarLibro($libro_id){
        $mysqli = GestionLibros::conexion("localhost","libros", "root", "");
        $sql = "DELETE FROM Libro WHERE id=$libro_id";
        
        if ($mysqli->query($sql) === TRUE) {
            echo true;
            return null;
        }else echo false;
            return null;
    }

    static function getListaAutores(){
        $mysqli = GestionLibros::conexion("localhost","libros", "root", "");
            // Code here
            $sql = "SELECT * FROM Autor";
            $result = $mysqli->query($sql);
                if ($result->num_rows > 0) {
                //return "ID: " . $row["id"]. " - Título: "  . $row["titulo"]. " Fecha de publicación: ". $row["f_publicacion"]. " ID del Autor: ". $row["id_autor"]."<br>";
                    $emparray = array();
                    while($row =mysqli_fetch_assoc($result)){
                        $emparray[]= $row;
                        
                    }
                    //echo json_encode($emparray);
                    return $emparray;
                } else {
                    return null;
                }
           
    }
    static function getListaLibros(){
        $mysqli = GestionLibros::conexion("localhost","libros", "root", "");
            // Code here
            $sql = "SELECT * FROM Libro";
            $result = $mysqli->query($sql);
                if ($result->num_rows > 0) {
                //return "ID: " . $row["id"]. " - Título: "  . $row["titulo"]. " Fecha de publicación: ". $row["f_publicacion"]. " ID del Autor: ". $row["id_autor"]."<br>";
                    $emparray = array();
                    while($row =mysqli_fetch_assoc($result)){
                        $emparray[] = $row;
                        
                    }
                    //echo json_encode($emparray);
                    return $emparray;
                } else {
                    return null;
                }
           
    }
    // este método realiza una query y devuelve un array con el resultado.
    static function getLibrosPorLetra($letras){
        $mysqli = GestionLibros::conexion("localhost","libros", "root", "");
        $sql = "SELECT * FROM Libro WHERE titulo LIKE '%".$letras."%'";
        $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                $emparray = array();
                while($row =mysqli_fetch_assoc($result)){
                    $emparray[] = $row;
                    
                }
                
                return $emparray;
            } else {
                return null;
            }
    }

    //fin clase gestionLibros
}

?>