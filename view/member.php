<?php
  include '../controller/Authorize.php';
  include '../controller/UserController.php';
  include_once '../controller/RoleValidation.php';

  $uid = $_SESSION['user_id'];
  $data = getUserByUID($uid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CPS v1.6 | Dashboard</title>

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
            <h1 class="m-0">Dev Team</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Feedback</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row team-pic">
            <div class="col">
                <img src="../view/dist/img/riak.jpg" class="rounded-circle img-thumbnail img-team">
                <h5>NOOR RAIHAN ABD RAHIM</h5>
                <h6>2020821002 (CS110)</h6>
                <h6>JCS1104E</h6>
                <h6>BACKEND DEVELOPER | PROJECT LEAD</h6>
                <h6>blazerred17@gmail.com</h6>
            </div>
            <div class="col">
                <img src="../view/dist/img/im.jpg" class="rounded-circle img-thumbnail img-team">
                <h5>MUHAMMAD IMTIAZ AZIZ</h5>
                <h6>2020418738 (CS110)</h6>
                <h6>JCS1104E</h6>
                <h6>FRONTEND DEVELOPER</h6>
                <h6>email</h6>
            </div>
            <div class="col">
                <img src="../view/dist/img/danish.jpg" class="rounded-circle img-thumbnail img-team">
                <h5>MUHAMMAD DANISH</h5>
                <h6>2020461046 (CS110)</h6>
                <h6>JCS1104E</h6>
                <h6>MOBILE DEVELOPER</h6>
                <h6>email</h6>
            </div>
        </div>
        <div class="row team-pic">
            <div class="col">
                <img src="../view/dist/img/mira.jpg" class="rounded-circle img-thumbnail img-team">
                <h5>AMIRAH AFIQAH</h5>
                <h6>2020461046 (CS110)</h6>
                <h6>JCS1104E</h6>
                <h6>MOBILE DEVELOPER</h6>
                <h6>email</h6>
            </div>
            <div class="col">
                <img src="../view/dist/img/timah.jpg" class="rounded-circle img-thumbnail img-team">
                <h5>FAATHIMATUL KAUTHAR</h5>
                <h6>2020461046 (CS110)</h6>
                <h6>JCS1104E</h6>
                <h6>MOBILE DEVELOPER</h6>
                <h6>email</h6>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="https://github.com/NoorRaihan/student4u">CPS v1.6</a>.</strong>
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

  modal = document.getElementById("modalInfo");
    
  <?php
  if(isset($_SESSION['modal'])) {
    ?>
    modal.style.display = "block";
    <?php
    unset($_SESSION['modal']);
    unset($_SESSION['message']);
  }
  ?>

  function closeModal()
  {
    modal = document.getElementById("modalInfo");
    modal.style.display = "none";
  }

  $(function () {
    bsCustomFileInput.init();
  });

</script>
</body>
</html>
