<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
} ?>

<?php 
$email;

$user_id=$_SESSION['user_id'];
$query_admin="SELECT * FROM admin WHERE id='{$user_id}' LIMIT 1";
$result=mysqli_query($connection,$query_admin);

  if ($result) {
    if(mysqli_num_rows($result)==1){
    $admins=mysqli_fetch_assoc($result);
    $admin_company=$admins['company'];

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

    $file_name=$_FILES['image']['name'];
    $file_size=$_FILES['image']['size'];
    $file_type=$_FILES['image']['type'];
    $file_tmp_name=$_FILES['image']['tmp_name'];

    $upload_to='emp_img/';
    move_uploaded_file($file_tmp_name, $upload_to.$file_name);
    $img_location=$upload_to.$file_name;

    $add_query="INSERT INTO emp (full_name,email,company,job_post,employee_level,address,tel,age,is_deleted,salary,img) 
      VALUES ('{$name}','{$email}','{$company}','{$job_post}',{$employee_level},'{$address}','{$tel}',{$age},0,'{$salary}','{$img_location}')
    ";

    $result=mysqli_query($connection,$add_query);
    if($result){
      require_once('inc/functions.php');
      $msg="you are Success registerd to ".$company;
      
      mymail($msg,$email);
      header('Location:my-employees.php?Employee_added=true');
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

    <title>Add Employee | Employee Management System</title>
  </head>
  <body>
  
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <img src="img/favi_w.png" alt="" width="30px">
  <a class="navbar-brand" href="#" style="color: white;margin-left: 20px">Employee Management System  </a>
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
            <form action="add-employee.php" method="post" enctype="multipart/form-data">
            <div class="col-md-8">
              <h3>Enter Employee Details</h3><br>
              <label for="username">Full Name</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  
                </div>
                <input type="text" class="form-control" id="name" placeholder="full name" name="name" required>

                <div class="invalid-feedback" style="width: 100%;">
                  Your full name is required.
                </div>

              </div>
              
              <br>

              <label for="email">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div><br>

              <label for="company">Company</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  
                </div>

                <input type="text" class="form-control" id="company" name="company" value="<?php echo $admin_company ?>"  >
                <div class="invalid-feedback" style="width: 100%;">
                  Your full name is required.
                </div>
              </div><br>


              <label for="job_post">Job post</label>
              <div class="input-group">
                <div class="input-group-prepend">               
                </div>
                <input type="text" class="form-control" id="job_post" name="job_post" placeholder="job post" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your job post is required.
                </div>
              </div><br>


              <label for="employee_level">Employee Level</label>
              <div class="input-group">
                <div class="input-group-prepend">               
                </div>
                <input type="text" class="form-control" name="employee_level" id="employee_level" placeholder="Employee Level" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your employee level is required.
                </div>
              </div><br>

              <label for="address">Address</label>
              <div class="input-group">
                <div class="input-group-prepend">               
                </div>
                <input type="text" class="form-control" name="address" id="address" placeholder="address" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your job address is required.
                </div>
              </div><br>

              <label for="tel">Phone Number</label>
              <div class="input-group">
                <div class="input-group-prepend">               
                </div>
                <input type="text" name="tel" class="form-control" id="tel" placeholder="Phone Number" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your phone number is required.
                </div>
              </div><br>


              <label for="age">Age</label>
              <div class="input-group">
                <div class="input-group-prepend">               
                </div>
                <input type="text" class="form-control" name="age" id="age" placeholder="Age" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your Age is required.
                </div>
              </div><br>


               <label for="salary">salary</label>
              <div class="input-group">
                <div class="input-group-prepend">               
                </div>
                <input type="text" class="form-control" name="salary" id="salary" placeholder="salary" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your salary is required.
                </div>
              </div><br>

              Employee image : <input type="file" name="image" id=""  > <br><br>

              <img src="<?php  ?>" alt="">


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