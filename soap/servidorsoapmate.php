<?php

// api.php

require_once 'C:/xampp/htdocs/DWES/DWES_7/vendor/autoload.php';
require "Mate.php";



$serverUrl = "http://localhost/DWES/DWES_7/soap/servidorsoapmate.php";
$options = [
    'uri' => $serverUrl,
];
$server = new \Laminas\Soap\Server(null, $options);

if (isset($_GET['wsdl'])) {
    $soapAutoDiscover = new \Laminas\Soap\AutoDiscover(new \Laminas\Soap\Wsdl\ComplexTypeStrategy\ArrayOfTypeSequence());
    $soapAutoDiscover->setBindingStyle(array('style' => 'document'));
    $soapAutoDiscover->setOperationBodyStyle(array('use' => 'literal'));
    $soapAutoDiscover->setClass('Mate');
    $soapAutoDiscover->setUri($serverUrl);
    
    header("Content-Type: text/xml");
    echo $soapAutoDiscover->generate()->toXml();
} else {
    $soap = new \Laminas\Soap\Server($serverUrl . '?wsdl');
    $soap->setObject(new \Laminas\Soap\Server\DocumentLiteralWrapper(new Mate()));
    $soap->handle();
}

?>