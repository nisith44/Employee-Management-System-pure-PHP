<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
} ?>

<?php 

  $clicked_emp=mysqli_real_escape_string($connection,$_GET['user_id']);
  $delete_query= " UPDATE emp SET is_deleted=0 WHERE id='{$clicked_emp}' LIMIT 1 ";
  $result=mysqli_query($connection,$delete_query);

  if($result){
    $email;
    $company;
    $name;
   
	$clicked_emp=mysqli_real_escape_string($connection,$_GET['user_id']);
	$old_query="SELECT * FROM emp WHERE id='{$clicked_emp}' LIMIT 1 ";
	$result=mysqli_query($connection,$old_query);

  if($result){
    if(mysqli_num_rows($result)==1){
      $clicked_user=mysqli_fetch_assoc($result);

    $email=$clicked_user['email'];
    $company=$clicked_user['company'];
    $name=$clicked_user['full_name'];

   

    }}




  	require_once('inc/functions.php');
      $msg="dear ".$name." the managers of ".$company." approved your application in Employee management system";
      
      mymail($msg,$email);
    header('Location:my-employees.php?approve=1');
  }

  


 ?>

