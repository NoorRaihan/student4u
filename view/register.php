<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CPS v1.6 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../view/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../view/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../view/dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>CPS v1.6</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new Student</p>
      <div class="err" id="err" style="text-align: center; display: none;">
        <p style="color: red;">Matrics No already existed!</p>
      </div>
      <form action="../controller/RegisterController.php" method="post">

        <div class="input-group mb-3">
          <input type="text" name="matrix" class="form-control" placeholder="Student ID">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-address-card"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" name="fname" class="form-control" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" name="phone" class="form-control" placeholder="Phone Number">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-mobile-alt"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="text-center">
          <p><b>Gender</b></p>
          <input type="radio" id="male" name="gender" value="M">
          <label for="male">Male</label>
          <input type="radio" id="fem" name="gender" value="F" style="margin-left: 40px;">
          <label for="fem">Female</label>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Register Now</button>
        </div>
        

      </form>

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
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
<script>

  modal = document.getElementById("modalInfo");
  error = document.getElementById("err");
    
  <?php
  if(isset($_SESSION['modal'])) {
    ?>
    modal.style.display = "block";
    <?php
  }

  if(isset($_SESSION['err'])) {
    ?>
    error.style.display = "block";
    <?php
    unset($_SESSION['err']);
  }
  ?>

  function closeModal()
  {
    error = document.getElementById("modalInfo");
    modal.style.display = "none";
    <?php
    if($_SESSION['modal'] == 2){
      unset($_SESSION['modal']);
      unset($_SESSION['message']);
    }else{
      unset($_SESSION['modal']);
      unset($_SESSION['message']);
      ?>
      window.location.href = "login.php";
      <?php
    }

    ?> 
  }

</script>
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
