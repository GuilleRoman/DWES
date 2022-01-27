<html lang="en">
<head>
  <meta charset="utf-8">
  <title>  <?php echo("Título de la tarea 4")?>  </title> 
  <!-- CSS only -->
  <style>
 p{
     justify-self:center;
     margin-top:100px
     text-shadow: 2px 0 0 #fff, -2px 0 0 #fff, 0 2px 0 #fff, 0 -2px 0 #fff, 1px 1px #fff, -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff;
     text-align:center;
     font-family: Verdana;
     border:3px solid white;
     border-radius:10px;
     width:auto;
     margin-left:25%;
     margin-right:25%;
     font-size: larger;
}   
body{
    display: flex; 
    flex-direction: column; 
    padding:15px;
    background-color: LightBlue;
    
}
h1{
    text-align:center;
}
 }
    </style>
</head> 
<body class="d-flex justify-content-center align-items-center" 
  style=" display: flex; flex-direction: column; padding:15px">
    <header>
    <h1 style="font-family: lucida handwriting;">Tarea 7 - Servicio SOAP</h1>
    </header>

<?php
header("Content-Type: text/html;charset=UTF-8");
require_once 'C:/xampp/htdocs/DWES/DWES_7/vendor/autoload.php';
$opts = array(
    'ssl' => array(
        'ciphers' => 'RC4-SHA',
        'verify_peer' => false,
        'verify_peer_name' => false
    )
);
$params = array(
    'encoding' => 'UTF-8',
    'verifypeer' => false,
    'verifyhost' => false,
    'soap_version' => SOAP_1_1,
    'trace' => 1,
    'exceptions' => 1,
    'connection_timeout' => 180,
    'stream_context' => stream_context_create($opts)
);
ini_set("soap.wsdl_cache_enabled", "0");
$wsdlUrl = 'http://localhost/DWES/DWES_7/soap/servidorsoapmate.php?wsdl';
$cliente = new SoapClient($wsdlUrl, $params);
//$cliente = new Laminas\Soap\Client('C:/xampp/htdocs/DWES/DWES_7/soap/servidorsoapmate.php?wsdl', $params);
$functions = $cliente->__getFunctions ();
//var_dump ($functions);

// si le pasamos parámetros los coge de la URL
if ( isset($_GET["a"]) && isset($_GET["b"])) {
    $result = $cliente->__soapCall('potencia', [['base' => $_GET["a"], 'exponente' => $_GET["b"]]]);
    $resultSuma= $cliente->__soapCall('suma', [['op1' => $_GET["a"], 'op2' => $_GET["b"]]]);
    //$result = $cliente->potencia(2,3);
    echo "<p> El resultado del método potencia para los parámetros ".$_GET["a"]." como base
    y ".$_GET["b"]." como exponente es: ".$result->potenciaResult;"</p>";
    echo "<br>";
    echo "<p> El resultado del método suma para los parámetros ".$_GET["a"]."
    y ".$_GET["b"]." es: ".$resultSuma->sumaResult;"</p>";

//Si no se pasan parámetros utiliza estos datos
}else {


$result = $cliente->__soapCall('potencia', [['base' => 5, 'exponente' => 4]]);
$resultSuma= $cliente->__soapCall('suma', [['op1' => 10, 'op2' => 4]]);
echo "<p> El resultado del método potencia para los parámetros por defecto: -> base 5 y exponente 4 es ".
$result->potenciaResult."</p>";
    echo "<br>";
    echo "<p> El resultado del método suma para los parámetros por defecto: -> 10 y  4 es ".
    $resultSuma->sumaResult."</p>";

//echo "Respuesta:<br>" . $cliente->getLastResponse() . "<br>";*/
}
?>

     
