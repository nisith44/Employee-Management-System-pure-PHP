<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
} ?>

<?php 
   $user_list="";
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

 
  $query="SELECT * FROM emp WHERE is_deleted=0 AND company='{$company}' ORDER BY full_name ";
  $users=mysqli_query($connection,$query);
  $emp_count=0;
  $total_salary=0;

  if($users){
    while($user=mysqli_fetch_assoc($users)){
      $emp_count++;
      $total_salary=$total_salary+$user['salary'];
      $user_list.="<tr>";
      $user_list.="<td>{$user['full_name']}</td>";
      $user_list.="<td>{$user['address']}</td>";
      $user_list.="<td>{$user['job_post']}</td>";
      $user_list.="<td>Rs : {$user['salary']}</td>";      
      $user_list.="<td><a href=\"edit-employee.php?user_id={$user['id']}\">Edit</a>
      <a href=\"delete-employee.php?user_id={$user['id']}\" onclick=\"return(confirm('are you sure ?')) ;\">Delete</a>
      <a href=\"manage-employee.php?user_id={$user['id']}\">Manage</a>
      </td>"; 
      
      $user_list.="</tr>";
    }
  }else{echo "database error";}

  $unreg_user_list="";
  $query="SELECT * FROM emp WHERE is_deleted=2 AND company='{$company}' ORDER BY full_name ";
  $users=mysqli_query($connection,$query);
  $unreg_count=0;
  

  if($users){
    while($user=mysqli_fetch_assoc($users)){
      $unreg_count++;      
      $unreg_user_list.="<tr>";
      $unreg_user_list.="<td>{$user['full_name']}</td>";
      $unreg_user_list.="<td>{$user['address']}</td>";
      $unreg_user_list.="<td>{$user['job_post']}</td>";
      $unreg_user_list.="<td>Rs : {$user['salary']}</td>";      
      $unreg_user_list.="<td><a href=\"edit-employee.php?user_id={$user['id']}\">Edit</a>
      <a href=\"approve-employee.php?user_id={$user['id']}\" onclick=\"return(confirm('are you sure ?')) ;\">Approve</a>
      <a href=\"manage-employee.php?user_id={$user['id']}\">Manage</a>
      <a href=\"delete-employee.php?user_id={$user['id']}\" onclick=\"return(confirm('are you sure ?')) ;\">Delete</a>
      </td>"; 
      
      $unreg_user_list.="</tr>";
    }
  }else{echo "database error";}

  if(isset($_POST['search_button'])){
  $search_key=mysqli_real_escape_string($connection,$_POST['search_key']);

  $query="SELECT * FROM emp WHERE is_deleted=0 AND company='{$company}' AND full_name LIKE '%{$search_key}%' ORDER BY full_name ";
  $users=mysqli_query($connection,$query);
  

  if($users){
    $user_list="";
    while($user=mysqli_fetch_assoc($users)){
     
      
      $user_list.="<tr>";
      $user_list.="<td>{$user['full_name']}</td>";
      $user_list.="<td>{$user['address']}</td>";
      $user_list.="<td>{$user['job_post']}</td>";
      $user_list.="<td>Rs : {$user['salary']}</td>";      
      $user_list.="<td><a href=\"edit-employee.php?user_id={$user['id']}\">Edit</a>
      <a href=\"delete-employee.php?user_id={$user['id']}\" onclick=\"return(confirm('are you sure ?')) ;\">Delete</a>
      <a href=\"manage-employee.php?user_id={$user['id']}\">Manage</a>
      </td>"; 
      
      $user_list.="</tr>";
    }
  }else{echo "database error";}

  $query="SELECT * FROM emp WHERE is_deleted=2 AND company='{$company}' AND full_name LIKE '%{$search_key}%' ORDER BY full_name ";
  $users=mysqli_query($connection,$query);
  
  
  $unreg_user_list="";
  if($users){
    while($user=mysqli_fetch_assoc($users)){
           
      $unreg_user_list.="<tr>";
      $unreg_user_list.="<td>{$user['full_name']}</td>";
      $unreg_user_list.="<td>{$user['address']}</td>";
      $unreg_user_list.="<td>{$user['job_post']}</td>";
      $unreg_user_list.="<td>Rs : {$user['salary']}</td>";      
      $unreg_user_list.="<td><a href=\"edit-employee.php?user_id={$user['id']}\">Edit</a>
      <a href=\"approve-employee.php?user_id={$user['id']}\" onclick=\"return(confirm('are you sure ?')) ;\">Approve</a>
      <a href=\"manage-employee.php?user_id={$user['id']}\">Manage</a>
      <a href=\"delete-employee.php?user_id={$user['id']}\" onclick=\"return(confirm('are you sure ?')) ;\">Delete</a>
      </td>"; 
      
      $unreg_user_list.="</tr>";
    }
  }else{echo "database error";}

}


if(isset($_POST['j_search_button'])){
  $search_key=mysqli_real_escape_string($connection,$_POST['j_search_key']);

  $query="SELECT * FROM emp WHERE is_deleted=0 AND company='{$company}' AND job_post LIKE '%{$search_key}%' ORDER BY full_name ";
  $users=mysqli_query($connection,$query);
  

  if($users){
    $user_list="";
    while($user=mysqli_fetch_assoc($users)){
     
      
      $user_list.="<tr>";
      $user_list.="<td>{$user['full_name']}</td>";
      $user_list.="<td>{$user['address']}</td>";
      $user_list.="<td>{$user['job_post']}</td>";
      $user_list.="<td>Rs : {$user['salary']}</td>";      
      $user_list.="<td><a href=\"edit-employee.php?user_id={$user['id']}\">Edit</a>
      <a href=\"delete-employee.php?user_id={$user['id']}\" onclick=\"return(confirm('are you sure ?')) ;\">Delete</a>
      <a href=\"manage-employee.php?user_id={$user['id']}\">Manage</a>
      </td>"; 
      
      $user_list.="</tr>";
    }
  }else{echo "database error";}


  $query="SELECT * FROM emp WHERE is_deleted=2 AND company='{$company}' AND job_post LIKE '%{$search_key}%' ORDER BY full_name ";
  $users=mysqli_query($connection,$query);
  
  
  $unreg_user_list="";
  if($users){
    while($user=mysqli_fetch_assoc($users)){
           
      $unreg_user_list.="<tr>";
      $unreg_user_list.="<td>{$user['full_name']}</td>";
      $unreg_user_list.="<td>{$user['address']}</td>";
      $unreg_user_list.="<td>{$user['job_post']}</td>";
      $unreg_user_list.="<td>Rs : {$user['salary']}</td>";      
      $unreg_user_list.="<td><a href=\"edit-employee.php?user_id={$user['id']}\">Edit</a>
      <a href=\"approve-employee.php?user_id={$user['id']}\" onclick=\"return(confirm('are you sure ?')) ;\">Approve</a>
      <a href=\"manage-employee.php?user_id={$user['id']}\">Manage</a>
      <a href=\"delete-employee.php?user_id={$user['id']}\" onclick=\"return(confirm('are you sure ?')) ;\">Delete</a>
      </td>"; 
      
      $unreg_user_list.="</tr>";
    }
  }else{echo "database error";}


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
    <link rel="stylesheet" href="css/sticky_footer.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

   <script>$(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});</script>

    <title>My Employees | Employee Management System</title>
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
      
       <div class="row" style="margin-bottom: 150px;">
         <div class="mainbox col-md-9">

         <div class="row" style="margin-left: 7px;">
           <div class="col-xs-2">
             <a href="add-employee.php"  class="btn btn-success" >+ Add Employee</a>
           </div>

           <div class="col-xs-5" style="margin-left: 10px;">
             <form class="form-inline" name="n_search" method="post" >
          <div class="form-group  mb-2">
            <input type="text" class="form-control" id="search" name="search_key" placeholder="Employee Name">
          </div>
          <button type="submit" class="btn btn-primary mb-2" name="search_button">Search by Name</button>
        </form>
           </div>

           <div class="col-xs-5" style="margin-left: 10px;">
             <form class="form-inline" name="j_search" method="post">
          <div class="form-group  mb-2">
            <input type="text" class="form-control" id="search" name="j_search_key" placeholder="job post">
          </div>
          <button type="submit" class="btn btn-info mb-2" name="j_search_button">Search by Job Post</button>
        </form>
           </div>
         </div>
          


<!-- search -->
        

         
<!-- search end -->           

<br>

<?php if(isset($_GET['Employee_added'])){
          echo '<div class="alert alert-success alert-dismissible" role="alert">
  New Employee Added Succesfully !   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
          } ?>

          <?php if(isset($_GET['Employee_edited'])){
          echo '<div class="alert alert-primary alert-dismissible" role="alert">
   Employee Edited Succesfully !   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
          } ?>

          <?php if(isset($_GET['deleted'])){
          echo '<div class="alert alert-danger alert-dismissible" role="alert">
   Employee deleted Succesfully !   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
          } ?>

          <?php if(isset($_GET['approve'])){
          echo '<div class="alert alert-success alert-dismissible" role="alert">
   Employee Approved Succesfully !   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
          } ?>

          <h4>My Employees</h4>

             <table id="dtBasicExample" class="masterlist table" border="2px">
      <tr class="table-primary">
        <th>name</th>
        <th>address</th>
        <th>Job post</th>
        <th>salary</th>
        <th>Actions</th>
        
      </tr>
      
      <?php echo $user_list; ?>

    </table> <br><br>
            <h4>Registered and Not approved Employees</h4>
           <table class="masterlist table" border="2px">
      <tr class="table-primary">
        <th>name</th>
        <th>address</th>
        <th>Job post</th>
        <th>salary</th>
        <th>Actions</th>
        
      </tr>
      
      <?php echo $unreg_user_list; ?>

    </table>
         </div><!-- mainbox -->







         <div class="sidebar col-md-3">
          <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
     <div class="card-header">Your details</div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $user_name ; ?></h5>
    <p class="card-text">company : <?php echo $company; ?>
      <br> employees : <?php echo $emp_count; ?>
      <br> total salary : Rs. <?php echo $total_salary; ?>
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
     <footer class="footer">
      <div class="container ">
       <div class="row">
         <div class="col-md-6 text-white">Copyright 2017-2018 | Employee Management System</div><br>
         <div class="col-md-6 text-white">System By <a target="_blank" href="https://www.facebook.com/nisithheshanbro">Nisith heshan</a> </div>
       </div>
        
      </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>