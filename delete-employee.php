<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
} ?>

<?php 

  $clicked_emp=mysqli_real_escape_string($connection,$_GET['user_id']);
  $delete_query= " UPDATE emp SET is_deleted=1 WHERE id='{$clicked_emp}' LIMIT 1 ";
  $result=mysqli_query($connection,$delete_query);

  if($result){
    header('Location:my-employees.php?deleted=1');
  }

  


 ?>

