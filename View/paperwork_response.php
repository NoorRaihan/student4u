<?php
  include '../controller/Authorize.php';
  include '../controller/PaperworkController.php';


  $id = intval($_GET['id']);
  $data = getPaperworkByID($id);
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
            <h1 class="m-0">Submission Detail</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Paperwork Submission</li>
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
        <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Submission Detail</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="../controller/PaperworkController.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                <input type="hidden" name="id" value="<?php echo $id?>">
                <div class="form-group form-status" style="margin-top: 20px;">
                    <label for=" exampleInputEmail1">Status: </label> <span class="badge <?php

                      if($data['sub_status'] == "APPROVED") {
                        echo 'bg-success';
                      }else if($data['sub_status'] == "REJECTED") {
                        echo 'bg-danger';
                      }else{
                        echo 'bg-warning';
                      }

                    ?>"><?php echo $data['sub_status'] ?></span></td>
                </div>
                <div class="form-group">
                    <label for=" exampleInputEmail1">Student Position</label>
                    <p><?php echo $data['sender_role'] ?></p>
                  </div>
                  <div class="form-group">
                    <label for=" exampleInputEmail1">Program/Event Name</label>
                    <p><?php echo $data['program_name'] ?></p>
                  </div>
                  <div class="form-group">
                    <label for=" exampleInputEmail1">Club/Association</label>
                    <p><?php echo $data['club_name'] ?></p>
                  </div>
                  <div class="form-group">
                    <label for=" exampleInputEmail1">Advisor Name</label>
                    <p><?php echo $data['advisor'] ?></p>
                  </div>
                  <div class="form-group">
                    <div class="date-show-flex">
                      <div class="date-show-child">
                        <label for=" exampleInputEmail1">Submission Date :</label>
                        <?php echo $data['created_at'] ?>
                      </div>
                      <div class="date-show-child">
                        <label for=" exampleInputEmail1">Edited :</label>
                        <?php echo $data['updated_at'] ?>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Paperwork Document</label>
                    <div class="input-group">
                      <div class="custom-file">
                      <?php 
                      if($data['attached_file'] != NULL || $data['attached_file'] != "" ) {

                      ?>
                        <div id="view-file" class="view-file">
                          <a href="<?php echo $data['attached_file'] ?>" class='btn btn-secondary btn-sm'><i class='fas fa-file'></i></a>
                            <a><?php echo $data['attached_file'] ?></a>
                          </div>
                        <?php
                      }else{
                        ?>
                        <div id="add-file" class="add-file">
                          <p>No File Attached</p>
                        </div>
                          
                        <?php
                      }
                      ?>
                      
                      </div>
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                      <label for=" exampleInputEmail1">MPP Comments/Response</label>
                      <textarea class="form-control" name="response" id="exampleFormControlTextarea1" rows="3" placeholder="We will take action immediately"></textarea>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputFile">Returned Document</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="response-btn">
                    <button type="submit" name="approve" class="btn btn-success">Approve</button>
                    <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                  </div>
                  <a onclick="javascript:history.go(-1)" class="btn btn-secondary">Back</a>
              </div>
              </form>
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
</script>
</body>
</html>
