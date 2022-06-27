<?php
    include '../controller/Authorize.php';
    include_once '../model/database.php';
    include '../controller/MPPController.php';
    include '../controller/UserController.php';

    //get a DB connection
    $instance = Database::getInstance();
    $conn = $instance->getDBConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

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
            <h1 class="m-0">Assign MPP</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">MPP</li>
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
                <h3 class="card-title">Assign MPP</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="matric" class="form-control" placeholder="Search Matrics No">
                        <input type="submit" class="btn btn-success" value="Search" name="search-matric">
                    </div>
                </form>
              <form action="../controller/MPPController.php" method="post" enctype="multipart/form-data">

                  <?php

                    if(isset($_GET['matric'])) {

                        $matrix = $conn->real_escape_string($_GET['matric']);
                        $user = getUserByMatrix($matrix);
                        //var_dump($user);
                            if($user != NULL) {

                        ?>
                        <input type="hidden" name="id" value="<?php echo $user['user_id'] ?>">
                        <input type="hidden" name="role" value="<?php echo $user['role_id'] ?>">
                        <div class="form-group">
                            <label for=" exampleInputEmail1">Matrics Number : </label><?php echo $user['matrix_no'] ?>
                        </div>
                        <div class="form-group">
                            <label for=" exampleInputEmail1">Student Name : </label> <?php echo $user['user_name'] ?>
                        </div>
                        <div class="form-group">
                            <label for=" exampleInputEmail1">Student Role : </label> <?php echo $user['role_desc'] ?>
                        </div>
                        <div class="form-group">
                            <label for=" exampleInputEmail1">Student Position : </label> <?php echo $user['position'] == NULL ? "Normal Student" : $user['position'] ?>
                        </div>
                        <div class="form-group">
                            <label for=" exampleInputEmail1">MPP Position : </label>
                            <input type="text" name="position" class="form-control" placeholder="MPP Position">
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                        
                        <div class="response-btn">
                            <button type="submit" name="assign" class="btn btn-primary">Assign as MPP</button>
                        </div>
                        <a href="../view/student_view.php" class="btn btn-secondary">Back</a>
                        </div>
                        <?php
                            }else{
                                echo "Student Data Not Found!";
                            }
                    }
                  ?>
              </form>
            </div>
            <!-- /.card -->
            <!-- Modal -->
            <div class="modal fade show" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Message</h5>
                      <button type="button" class="close" onclick="closeModal()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p><?php echo $_SESSION['message'] ?></p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" onclick="closeModal()" data-dismiss="modal">Close</button>
                    </div>
                  </div>
              </div>
            </div>
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
