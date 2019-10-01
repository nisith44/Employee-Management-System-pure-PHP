<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
} ?>



<?php 

require_once('PHPMailer/PHPMailerAutoload.php');

    $name;
    $email;
    $company;
    $address;
    $salary;
   
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

$mail=new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth=true;
$mail->SMTPSecure='ssl';
$mail->Host='smtp.gmail.com';
$mail->Port='465';
$mail->isHTML();
$mail->Username='nisithheshan44@gmail.com';
$mail->Password='nisiya4444123';

$mail->Subject='hello world';
$mail->Body="Hello ".$name." !";
$mail->AddAddress($email);
$mail->Send();

header("Location:manage-employee.php?user_id={$clicked_emp}");






 ?>