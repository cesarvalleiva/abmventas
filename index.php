<?php

$page = "Ventas";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "config.php";
include_once "entidades/producto.php";
include_once "entidades/cliente.php";
include_once "entidades/venta.php";

if ($_POST) {
    if (isset($_POST["btnInsertarVenta"])) {
        $venta = new Venta();
        $venta->cargarDesdeRequest($_REQUEST);
        $venta->insertar();
    }
}

//obtiene todo los productos
$producto = new Producto();
$aProductos = $producto->obtenerTodos();

$cliente = new Cliente();
$aClientes = $cliente->obtenerTodos();

$venta = new Venta();
$aVentas = $venta->obtenerTodos();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ABM Clientes | <?php echo $page; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include_once "includes/menu.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $page; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $page; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal-sm">Agregar</button>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if($aVentas != ""){ foreach ($aVentas as $venta) : ?>
                      <tr>
                        <td><?php echo $venta->cliente; ?></td>
                        <td><?php echo $venta->producto; ?></td>
                        <td align="center">$ <?php echo $venta->precio; ?></td>
                        <td align="center"><?php echo date("d/m/Y", strtotime($venta->fecha)); ?></td>
                      </tr>
                    <?php endforeach; }?>
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php include_once "includes/footer.php"; ?>
</div>
<!-- ./wrapper -->

<div class="modal fade" id="modal-sm">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar venta</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" action="" method="post">
          <label for="">Cliente</label>
          <select name="cliente" id="cliente" style="width: 100%;">
            <option value="">Seleccionar cliente</option>
            <?php if($aClientes != ""){ foreach ($aClientes as $cliente) : ?>
              <option value="<?php echo $cliente->idCliente; ?>"><?php echo $cliente->nombre; ?></option>
            <?php endforeach; }?>
          </select>
          <br /><br />
          <label for="">Producto</label>
          <select name="producto" id="producto" style="width: 100%;">
            <option value="">Seleccionar producto</option>
            <?php if($aProductos != ""){ foreach ($aProductos as $producto) : ?>
              <option value="<?php echo $producto->idProducto; ?>"><?php echo $producto->nombre; ?></option>
            <?php endforeach; }?>
          </select>
          <br /><br />
          <label for="">Precio:</label>
          <input type="text" class="form-control" name="txtPrecio" id="txtPrecio" placeholder="Ingrese el precio">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <input type="submit" class="btn btn-primary" name="btnInsertarVenta" id="btnInsertar" value="Insertar">
      </div>
          </form>
      </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
</body>
</html>
