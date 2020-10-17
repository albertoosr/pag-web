<!-- producto -->

<?php

include_once('conexion.php');

$sql = 'SELECT * FROM productos';
$consulta = $mbd->prepare($sql);
$consulta->execute();

$res = $consulta->fetchAll();
// var_dump($res);
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <!-- font google -->
  <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@400;600&display=swap" rel="stylesheet">

  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/39610b5df0.js" crossorigin="anonymous"></script>

  <!-- style -->
  <link rel="stylesheet" href="style.css">

  <title>Paginación!</title>
</head>

<body>

  <!-- paginador -->
  <?php
    $total_productos = $consulta->rowCount();
    $paginas = $total_productos / 3;
    $paginas = ceil($paginas);
  ?>

  <div class="container">
    <h4 class="py-3">Ejemplo de paginación</h4>
    <!-- mostrar productos por pagina -->
    <?php
    $productos_paginas = 3;
    if (!$_GET) {
      header('Location:index.php?pagina=1');
    }

    // if ($_GET['pagina'] <= 0 || $_GET['pagina'] >= $paginas + 1) {
    //   header('Location:index.php?pagina=1');
    // } //Esto es necesario cuando ya tienes productos registrados

    $star = ($_GET['pagina'] - 1) * $productos_paginas;

    $sql_produc = 'SELECT * FROM productos LIMIT :star,:nproductos';
    $snt_articulo = $mbd->prepare($sql_produc);
    $snt_articulo->bindParam(':star', $star, PDO::PARAM_INT);
    $snt_articulo->bindParam(':nproductos', $productos_paginas, PDO::PARAM_INT);
    $snt_articulo->execute();

    $rsult_articulos = $snt_articulo->fetchAll();
    ?>

    <form action="registro.php" method="post" id="form">
      <div class="form-group">
        <input type="text" placeholder="Producto" name="producto" class="add-productos">
        <input type="submit" class="btn btn-success" value="Agregar"></input>
        <!-- <button type="button" class="btn btn-success" onclick="registro()"> Agregar</button> -->
      </div>
    </form>

    <!-- <div id="menssage" class="text-center py-1">
    </div> -->

    <table class="table" id="reload">
      <thead class="thead-dark" id="table">
        <tr class="">
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>

      <tbody id="">
        <?php foreach ($rsult_articulos as $productos) : ?>
          <tr class="table-product">
            <th scope="row"><?php echo $productos['id'] ?></th>
            <td><?php echo $productos['producto'] ?></td>
            <td>
              <a href="#"><i class="fas fa-trash icon-delete"></i></a>
            </td>
            <td>
              <a href="#"><i class="far fa-edit icon-edit"></i></a>
            </td>
          </tr>
      </tbody>
    <?php endforeach ?>
    </table>


    <!-- paginación -->
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
          <a class="page-link" href="index.php?pagina=<?php echo $_GET['pagina'] - 1 ?>" tabindex="-1">Anterior</a>
        </li>

        <?php for ($i = 0; $i < $paginas; $i++) : ?>

          <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>">
            <a class="page-link" href="index.php?pagina=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a>
          </li>

        <?php endfor ?>

        <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
          <a class="page-link" href="index.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a>
        </li>
      </ul>
    </nav>
  </div>

  <!-- <script type="text/javascript">
    function registro() {
      var form = $('#form');
      var url = form.attr('action');

      $.ajax({
        type: "POST",
        url: 'registro.php',
        data: form.serialize(),
        success: function(data) {

          $('#menssage').append(data);
          $('#reload').DataTable().reload();
        }

      });

    }

    function reload() {
      var table = $('#reload').DataTable({
        ajax: "data.json"
      });

      setInterval(function() {
        table.ajax.reload();
      }, 30000);
    }
  </script> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>

</html>