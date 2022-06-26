<?php
  include '../controller/Authorize.php';
  include '../controller/ComplaintController.php';

  $id = $_GET['id'];
  $data = get_complaint($id);
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
            <h1 class="m-0">Edit Complaint</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Complaint</li>
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
        <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Edit Complaint</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="../controller/ComplaintController.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <input type="text" id="id" name="id" value="<?php echo $data['comp_id'] ?>" hidden>
                  <div class="form-group form-status">
                    <label for=" exampleInputEmail1">Status: </label> <span class="badge <?php

                      if($data['comp_status'] == "APPROVED") {
                        echo 'bg-success';
                      }else if($data['comp_status'] == "REJECTED") {
                        echo 'bg-danger';
                      }else{
                        echo 'bg-warning';
                      }

                    ?>"><?php echo $data['comp_status'] ?></span></td>
                  </div>
                  <div class="form-group">
                      <label for=" exampleInputEmail1">Student ID: </label> <?php echo $data['matrix_no'] ?>
                  </div>
                  <div class="form-group">
                    <label for=" exampleInputEmail1">Student Name: </label> <?php echo $data['user_name'] ?>
                  </div>
                  <div class="form-group">
                    <label for=" exampleInputEmail1">Complaint Description</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"><?php echo $data['comp_desc'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Evidence File (if any)</label><br>

                    <?php 
                      if($data['attached_file'] != NULL || $data['attached_file'] != "" ) {

                        ?>
                        <div id="view-file" class="view-file">
                          <a class='btn btn-secondary btn-sm'><i class='fas fa-file'></i></a>
                            <a><?php echo $data['attached_file'] ?></a>
                            <a onclick="removeFile()"><i class='fas remove-file fa-times'></i></a>
                            <input type="text" id="curr-file" name="curr-file" value="<?php echo $data['attached_file'] ?>" hidden>
                          </div>
                        <?php
                      }else{
                        ?>
                        <div id="add-file" class="add-file">
                          <p>No File Attached</p><a onclick="addFile()" class="btn btn-sm btn-secondary">Add File</a>
                        </div>
                          
                        <?php
                      }
                    ?>
                    <div id="input-hide" class="input-group input-hide">
                      <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-check anon-checkbox">
                    <input type="checkbox" name="hide" class="form-check-input" value="1" id="exampleCheck1" <?php echo $data['hide'] == "1" ? "checked" : ""  ?>>
                    <label class="form-check-label" for="exampleCheck1">Submit as Anonymous</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  
                  <div class="response-btn">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                  </div>
                  <a onclick="javascript:history.go(-1)" class="btn btn-secondary">Back</a>
                </div>
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
