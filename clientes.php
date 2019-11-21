<?php $page = "Clientes";

include_once "config.php";
include_once "entidades/cliente.php";

if ($_POST) {
    if (isset($_POST["btnInsertar"])) {
        $cliente = new Cliente();
        $cliente->cargarDesdeRequest($_REQUEST);
        $cliente->insertar();
    } else if (isset($_POST["btnBorrar"])) {
        $cliente = new Cliente();
        $cliente->cargarDesdeRequest($_REQUEST);
        $cliente->borrar();
    } else if (isset($_POST["btnActualizar"])) {
        $cliente = new Cliente();
        $cliente->cargarDesdeRequest($_REQUEST);
        $cliente->actualizar();
    }
}

//obtiene todos los clientes
$cliente = new Cliente();
$aClientes = $cliente->obtenerTodos();

if (isset($_GET["cliente"])) {
    $cliente->obtenerPorId($_GET["cliente"]);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>ABM Clientes | <?php echo $page; ?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
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
          <div class="col-lg-6">
            <div class="card card-primary card-outline">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="txtDNI">DNI:</label>
                    <input type="text" required class="form-control" name="txtDNI" id="txtDNI" value="<?php echo $cliente->dni; ?>">
                    <input type="hidden" class="form-control" name="txtCliente" id="txtCliente" value="<?php echo $cliente->idCliente; ?>">
                  </div>
                  <div class="form-group">
                    <label for="txtNombre">Nombre y apellido:</label>
                    <input type="text" required class="form-control" name="txtNombre" id="txtNombre" value="<?php echo $cliente->nombre; ?>">
                  </div>
                  <div class="form-group">
                    <label for="txtTelefono">Teléfono:</label>
                    <input type="text" class="form-control" name="txtTelefono" id="txtTelefono" value="<?php echo $cliente->telefono; ?>">
                  </div>
                  <div class="form-group">
                    <label for="txtCorreo">Correo:</label>
                    <input type="text" class="form-control" name="txtCorreo" id="txtCorreo" value="<?php echo $cliente->correo; ?>">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" name="btnInsertar" id="btnInsertar" value="Insertar">
                  <a href="clientes.php" class="btn btn-secondary">Limpiar</a>
                  <input type="submit" class="btn btn-danger" name="btnBorrar" id="btnBorrar" value="Borrar">
                  <input type="submit" class="btn btn-success" name="btnActualizar" id="btnActualizar" value="Actualizar">
                </div>
              </form>
            </div>
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Clientes</h5>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead>                  
                    <tr>
                      <th style="width: 8%; text-align: center;">ID</th>
                      <th style="width: 45%">Nombre</th>
                      <th style="width: 47%">Correo</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($aClientes != ""){ foreach ($aClientes as $cliente) : ?>
                      <tr>
                        <td align="center"><a href="clientes.php?cliente=<?php echo $cliente->idCliente; ?>"><?php echo $cliente->idCliente; ?></a></td>
                        <td><a href="clientes.php?cliente=<?php echo $cliente->idCliente; ?>"><?php echo $cliente->nombre; ?></a></td>
                        <td><?php echo $cliente->correo; ?></td>
                      </tr>
                    <?php endforeach; }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php include_once "includes/footer.php"; ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
