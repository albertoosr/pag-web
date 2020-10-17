<?php
try {
    $mbd = new PDO('mysql:host=localhost;dbname=paginacion', 'root', '');
    // echo "conexion exitosa";
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>