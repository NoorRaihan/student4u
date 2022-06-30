<?php
  include '../controller/Authorize.php';
  include '../controller/ClubController.php';

  $id = $_GET['id'];
  $data = getClubByID($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student4U | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../view/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../view/dist/css/student4u.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../view/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../view/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../view/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../view/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../view/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../view/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../view/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

    <?php include '../view/includes/sidebar.php' ?>

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Club Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Club</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card">
              <div class="card-header" style="background-color: #FFA500;">
                <h3 class="card-title">Club Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="../controller/ComplaintController.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                      <label for=" exampleInputEmail1">Club ID: </label> <?php echo $data['club_id'] ?>
                  </div>
                  <div class="form-group">
                    <label for=" exampleInputEmail1">Club Name: </label> <?php echo $data['club_name'] ?>
                  </div>
                <!-- /.card-body -->
              </form>
              <div class="card-footer">
                  <a onclick="javascript:history.go(-1)" class="btn btn-secondary">Back</a>
              </div>
            </div>
            <!-- /.card -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="">Student4U</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php include '../view/includes/js.php' ?>

<script>
  $(function () {
    bsCustomFileInput.init();
  });

  function removeFile() {
    $file_view = document.getElementById("view-file");
    $input_form = document.getElementById("input-hide");
    $file = document.getElementById("curr-file");
    $file_view.style.visibility = "hidden";
    $file_view.style.display = "none";
    $input_form.style.visibility = "visible";
    $file.value = "";

  }

  function addFile() {
    $file_add = document.getElementById("add-file");
    $input_form = document.getElementById("input-hide");
    $file_add.style.visibility = "hidden";
    $file_add.style.display = "none";
    $input_form.style.visibility = "visible";

  }
</script>
</body>
</html>
