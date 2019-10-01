<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
} ?>

<?php 

  $clicked_emp=mysqli_real_escape_string($connection,$_GET['user_id']);
  $old_query="SELECT * FROM emp WHERE id='{$clicked_emp}' LIMIT 1 ";
  $result=mysqli_query($connection,$old_query);

  if($result){
    if(mysqli_num_rows($result)==1){
      $clicked_user=mysqli_fetch_assoc($result);

    $name=$clicked_user['full_name'];
    $email=$clicked_user['email'];
    $company=$clicked_user['company'];
    $job_post=$clicked_user['job_post'];
    $employee_level=$clicked_user['employee_level'];
    $address=$clicked_user['address'];
    $tel=$clicked_user['tel'];
    $age=$clicked_user['age'];
    $salary=$clicked_user['salary'];
    $img=$clicked_user['img'];

    }
  }

  
  if(isset($_POST['submit'])){
    $name=mysqli_real_escape_string($connection,$_POST['name']);
    $email=mysqli_real_escape_string($connection,$_POST['email']);
    $company=mysqli_real_escape_string($connection,$_POST['company']);
    $job_post=mysqli_real_escape_string($connection,$_POST['job_post']);
    $employee_level=mysqli_real_escape_string($connection,$_POST['employee_level']);
    $address=mysqli_real_escape_string($connection,$_POST['address']);
    $tel=mysqli_real_escape_string($connection,$_POST['tel']);
    $age=mysqli_real_escape_string($connection,$_POST['age']);
    $salary=mysqli_real_escape_string($connection,$_POST['salary']);
    $id=mysqli_real_escape_string($connection,$_POST['id']);

    $file_name=$_FILES['image']['name'];
    $file_size=$_FILES['image']['size'];
    $file_type=$_FILES['image']['type'];
    $file_tmp_name=$_FILES['image']['tmp_name'];

    $upload_to='emp_img/';
    move_uploaded_file($file_tmp_name, $upload_to.$file_name);
    $img_location=$upload_to.$file_name;

    $edit_query=" UPDATE emp SET full_name='{$name}',email='{$email}',company='{$company}',job_post='{$job_post}',employee_level='{$employee_level}',address='{$address}',tel='{$tel}',age='{$age}',salary='{$salary}',img='{$img_location}' WHERE id='{$id}' LIMIT 1 ";
    

    $result=mysqli_query($connection,$edit_query);
    if($result){
      header('Location:my-employees.php?Employee_edited=true');
    }
    else{
      echo "database error";
    }
  }


 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="img/favi.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Edit Employee | Employee Management System</title>
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

    <div class="container">
      
       <div class="row">
         <div class="mainbox col-md-9">
            <form action="edit-employee.php?user_id=<?php echo $clicked_emp; ?>" method="post" enctype="multipart/form-data">
            <div class="col-md-8">
              <h3>Enter Employee Details</h3><br>

              <input type="hidden" name="id" value=" <?php echo $clicked_emp; ?> " >
              <label for="username">Full Name</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  
                </div>
                <input type="text" class="form-control" id="name" placeholder="full name" name="name" 
                <?php echo "value=\"{$name}\"" ?> required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your full name is required.
                </div>
              </div><br>

              <label for="email">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" 
              <?php echo "value=\"{$email}\"" ?>>
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div><br>

              <label for="company">Company</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  
                </div>

                <input type="text" class="form-control" id="company" name="company" placeholder="Company name" 
                <?php echo "value=\"{$company}\"" ?> >
                <div class="invalid-feedback" style="width: 100%;">
                  Your full name is required.
                </div>
              </div><br>


              <label for="job_post">Job post</label>
              <div class="input-group">
                <div class="input-group-prepend">               
                </div>
                <input type="text" class="form-control" id="job_post" name="job_post" placeholder="job post" 
                <?php echo "value=\"{$job_post}\"" ?> required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your job post is required.
                </div>
              </div><br>


              <label for="employee_level">Employee Level</label>
              <div class="input-group">
                <div class="input-group-prepend">               
                </div>
                <input type="text" class="form-control" name="employee_level" id="employee_level" 
                <?php echo "value=\"{$employee_level}\"" ?> placeholder="Employee Level" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your employee level is required.
                </div>
              </div><br>

              <label for="address">Address</label>
              <div class="input-group">
                <div class="input-group-prepend">               
                </div>
                <input type="text" class="form-control" name="address" id="address" placeholder="address" 
                <?php echo "value=\"{$address}\"" ?> required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your job address is required.
                </div>
              </div><br>

              <label for="tel">Phone Number</label>
              <div class="input-group">
                <div class="input-group-prepend">               
                </div>
                <input type="text" name="tel" class="form-control" id="tel" placeholder="Phone Number" 
                <?php echo "value=\"{$tel}\"" ?> required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your phone number is required.
                </div>
              </div><br>


              <label for="age">Age</label>
              <div class="input-group">
                <div class="input-group-prepend">               
                </div>
                <input type="text" class="form-control" name="age" id="age" placeholder="Age" 
                <?php echo "value=\"{$age}\"" ?> required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your Age is required.
                </div>
              </div><br>


               <label for="salary">salary</label>
              <div class="input-group">
                <div class="input-group-prepend">               
                </div>
                <input type="text" class="form-control" name="salary" id="salary" placeholder="salary" 
                <?php echo "value=\"{$salary}\"" ?> required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your salary is required.
                </div>
              </div><br>

              <img src="<?php echo $img ; ?>" alt="" width="200px"><br><br> <input type="file" name="image" id=""  > 
              <br><br>


              <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit" >Submit</button><br>


            </div>
            </form>


           
         </div><!-- mainbox -->







         <div class="sidebar col-md-3">
          <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
     <div class="card-header">Header</div>
  <div class="card-body">
    <h5 class="card-title">Primary card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
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