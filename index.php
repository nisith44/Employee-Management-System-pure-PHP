<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php if (isset($_SESSION['user_id'])) {
  header('Location: my-employees.php');
} ?>

<?php 
  $errors=array();
  if(isset($_POST['submit'])){

    if(!isset($_POST['email']) || strlen(trim($_POST['email']))==0){
      $errors[]='invalid or missing email';
    }

    if(!isset($_POST['password']) || strlen(trim($_POST['password']))==0){
      $errors[]='invalid or missing password';
    }

    if(empty($errors)){
      $email=mysqli_real_escape_string($connection,$_POST['email']);
      $password=mysqli_real_escape_string($connection,$_POST['password']);
      $hashed_password=sha1($password);

      $query=" SELECT * FROM admin
               WHERE email='{$email}' AND
               password='{$hashed_password}' 
               LIMIT 1" ;

      $result_set=mysqli_query($connection,$query) ;
        

      if($result_set){
        if(mysqli_num_rows($result_set)==1){
          $user=mysqli_fetch_assoc($result_set);
          $_SESSION['user_id']=$user['id'];
          $_SESSION['user_name']=$user['first_name'];

          header('Location:my-employees.php');
        }
        else{ $errors[]='invalid username or password';}
      }else{ $errors[]='database query failed';}
    }


  }



 ?>


<!doctype html>
<html lang="en">
  <head>


<script type="text/javascript">
    $(window).on('load',function(){
        $('#exampleModal').modal('show');
    });
</script>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favi.png">
    <title>Employee Management System | Log In</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/cover/cover.css" rel="stylesheet">
    <link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/examples/cover/cover.css">
    <link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css">
  </head>

  <body class="text-center" background="img/aaa.jpg">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand" style="padding-right: 50px;">Employee Management System</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active" href="#">Home</a>
            <a class="nav-link" href="#">About</a>
            <a class="nav-link" href="#">Contact</a>
          </nav>
        </div>
      </header>

       <div class="login " style="margin: 0 auto;width: 70%;background-color: white;">
         <form class="form-signin" method="post" action="index.php">
      
      <h1 class="h3 mb-3 font-weight-normal " style="color: #1C2833 ;">Please sign in</h1>

        <?php if(isset($errors) && !empty($errors)){
          echo '<p class="error alert alert-danger">Invalid username or password</p>';
        }

         ?>
        <!-- <p class="error">Invalid username or password</p> -->  

        <?php if(isset($_GET['logout'])){
          echo '<p class="info alert alert-success">you have succesfully logout from the system</p>';
          } ?>

      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        
      </div>
      <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
       </div>









       <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="login " style="margin: 0 auto;width: 70%;background-color: white;">
         <form class="form-signin" method="post" action="index.php">
      
      <h1 class="h3 mb-3 font-weight-normal " style="color: #1C2833 ;">Please sign in</h1>

        <?php if(isset($errors) && !empty($errors)){
          echo '<p class="error alert alert-danger">Invalid username or password</p>';
        }

         ?>
        <!-- <p class="error">Invalid username or password</p> -->  

        <?php if(isset($_GET['logout'])){
          echo '<p class="info alert alert-success">you have succesfully logout from the system</p>';
          } ?>

      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        
      </div>
      <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
      
      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>System Design By <a href="#">Nisith Heshan</a></p>
        </div>
      </footer>
    </div>

    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="https://getbootstrap.com/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://getbootstrap.com/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/dist/js/bootstrap.min.js"></script>
  </body>
</html>
<?php mysqli_close($connection);?>