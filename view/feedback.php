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
            <h1 class="m-0">Help and Feedback</h1>
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
        <div class="row">
          <div class="col">
            <h2 class="m-0">Feedback</h2>
            <form action="https://formspree.io/f/mjvlqkyr" method="post">
                <div class="card-body">
                  <input type="text" id="id" name="id" value="<?php echo $data['user_id'] ?>" hidden>
                  <div class="form-group">
                    <label for=" exampleInputEmail1">Email: </label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="email@example.com">
                  </div>
                  <div class="form-group">
                    <label for=" exampleInputEmail1">Message: </label>
                    <textarea class="form-control" name="message"cols="30" rows="10"></textarea>
                  </div>
                </div>
                
                <!-- /.card-body -->

                <div>
                  <div class="response-btn mb-3">
                    <button type="submit" class="btn btn-primary">Send</button>
                  </div>
                </div>
              </form>
          </div>
          <div class="col" style="padding-left: 150px">
            <h2 class="mb-4">Get Help?</h2>
            <div>
              <strong class="mb-4">Customer Service Hotline</strong>
              <br>
              <br>
              <p><u>Technical Difficulties</u><br>+60177387782 : Mr. Raihan</p>
              <br>
              <p><u>Administration Feedback</u><br>+60177387782 : Mr. Imtiaz</p>
              <br>
              <p><u>Product Service</u><br>+60177387782 : Ms. Amirah <br>+60177387782 : Ms. Faathimah </p>

              <a href="member.php">Our Team</a>
            </div>
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
