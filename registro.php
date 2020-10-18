<?php 

    include_once('conexion.php');
    // registro
    $stmt = $mbd->prepare("INSERT INTO productos (id, producto) VALUES (null, :product)");
    $producto = $_POST['producto'];
    $stmt->bindParam(':product', $producto, PDO::PARAM_STR);
    $stmt->execute();

    header('Location:index.php');

?>