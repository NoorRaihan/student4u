<?php
  include '../controller/Authorize.php';
  include '../controller/ClubController.php';
  include_once '../controller/RoleValidation.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student4U | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="../view/dist/css/student4u.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../view/plugins/fontawesome-free/css/all.min.css">
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
            <h1 class="m-0">Club List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Club List</li>
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Club List</h3>

                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 table-complaint-parent">
              <div class="add-complaint">
                  <?php

                    if($role == 2) {
                      echo "<a href='club_create.php' class='btn btn-sm btn-success'><i class='fas fa-plus-square'></i> Add Club</a>";
                    }

                  ?>
                </div>
                <table class="complaint-table table table-hover table-bordered table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Club Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $club = getAllClub();
                        while($data = $club->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $data['club_id'] ?></td>
                                    <td><?php echo $data['club_name'] ?></td>
                                    <td>
                                        <div class="action-form">
                                          <form action="club_show.php" class="action-form-child">
                                            <button type="submit" name="id" value="<?php echo $data['club_id'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                          </form>

                                          <?php

                                            if($role == 2) {

                                              ?>

                                            <form action="club_edit.php" method="GET" class="action-form-child">
                                              <button type="submit" name="id" value="<?php echo $data['club_id'] ?>" class="btn btn-sm btn-success"><i class="fas fa-pen"></i></button>
                                            </form>
                                            <button onclick="passID(<?php echo $data['club_id'] ?>)" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete"><i class="fas fa-trash"></i></button>

                                              <?php
                                            }
                                          
                                          ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Are you confirm to delete this submission?</p>
                    </div>
                    <div class="modal-footer">
                      <form action="../controller/ClubController.php" method="POST">
                        <input name="id" id="id" type="hidden">
                        <button type="submit" name="delete" value="delete" class="btn btn-danger">Delete</button>
                      </form>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal -->
              <div class="modal" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="https://github.com/NoorRaihan/student4u">Student4U</a>.</strong>
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

  function passID(id) {
    input = document.getElementById("id");
    input.value = id;
  }
</script>
</body>
</html>
