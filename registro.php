<?php 

    include_once('conexion.php');
    // registro
    $stmt = $mbd->prepare("INSERT INTO productos (id, producto) VALUES (null, :product)");

    $producto = $_POST['producto'];
    $stmt->bindParam(':product', $producto, PDO::PARAM_STR);
    $stmt->execute();

    // $_POST['producto'] = '';
    // echo "<div class='alert alert-success' role='alert'> producto registrado</div>";

    header('Location:index.php');

?>