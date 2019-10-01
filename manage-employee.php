<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
} ?>

<?php 
    $name;
    $email;
    $company;
    $address;
    $salary;
    $msg;
   
    $clicked_emp=mysqli_real_escape_string($connection,$_GET['user_id']);
    $old_query="SELECT * FROM emp WHERE id='{$clicked_emp}' LIMIT 1 ";
    $result=mysqli_query($connection,$old_query);

      if($result){
    if(mysqli_num_rows($result)==1){
      $clicked_user=mysqli_fetch_assoc($result);

    $name=$clicked_user['full_name'];
    $email=$clicked_user['email'];
    $company=$clicked_user['company'];
    $address=$clicked_user['address'];
    $salary=$clicked_user['salary'];
   

    }}

if (isset($_POST['typed'])) {
  $msg=mysqli_real_escape_string($connection,$_POST['msg']);
  require_once('inc/functions.php');

  mymail($msg,$email);
}

  $clicked_emp=mysqli_real_escape_string($connection,$_GET['user_id']);
  $msg;
  $company='';
  $user_name="";
  $user_id=$_SESSION['user_id'];
  $query_admin="SELECT * FROM admin WHERE id='{$user_id}' LIMIT 1";
  $result=mysqli_query($connection,$query_admin);

  if ($result) {
    if(mysqli_num_rows($result)==1){
    $admins=mysqli_fetch_assoc($result);
    $company=$admins['company'];
    $user_name=$admins['first_name']." ".$admins['last_name'];

    }
  }

  

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="img/favi.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Manage Employee | Employee Management System</title>
  </head>
  <body>
  
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <img src="img/favi_w.png" alt="" width="30px">
  <a class="navbar-brand" href="#" style="color: white;">Employee Management System  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" ">
      <li class="nav-item active">
        <a class="nav-link"  href="#" style="color: white;">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" style="color: white;">Link</a>
      </li>
      
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <div class="log" style="color: white;">Welcome <?php echo $_SESSION['user_name'] ; ?> | <a href="logout.php" style="color: white;">Logout</a>
    </form>
  </div>
</nav>

<br><br>

    <div class="container-fluid">
      
       <div class="row">
         <div class="mainbox col-md-9">
          <div class="smallbox" style="margin-left: 50px;">
         Send details to employee : 
            <a href="send-mail.php?user_id=<?php echo $clicked_emp ; ?>"  class="btn btn-success">Send Email</a> <br>
            Send Special Email : <br>
            <form action="manage-employee.php?user_id=<?php echo $clicked_emp; ?>" method="post" name="msg">
              <textarea name="msg" id="" cols="100" rows="10" ><?php echo "Dear ".$name; ?></textarea><br>
              <input type="submit" name="typed" value="Send typed mail" class="btn btn-success">
            </form>
            
          </div>
         </div><!-- mainbox -->







         <div class="sidebar col-md-3">
          <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
     <div class="card-header">Your details</div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $user_name ; ?></h5>
    <p class="card-text">company : <?php echo $company; ?>
      <br> 
    </p>
  </div>
</div> 

<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
  <div class="card-header">Header</div>
  <div class="card-body">
    <h5 class="card-title">Success card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
<div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
  <div class="card-header">Header</div>
  <div class="card-body">
    <h5 class="card-title">Danger card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
<div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
  <div class="card-header">Header</div>
  <div class="card-body">
    <h5 class="card-title">Warning card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
         </div><!-- sidebar -->

       </div> <!-- row -->

    </div><!-- container -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>