<?php
require 'dbConnect.php';
session_start();
function loginRegister(){
  if(isset($_SESSION['userid'])){
  session_destroy();
  }
  if(isset($_POST['login']) || isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $namalengkap = $_POST['namalengkap'];
    $alamat = $_POST['alamat'];
    $image = date("Y-m-d") .time() . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],'userimage/'. $image);

    if(isset($_POST['login'])){
      $verify = mysqli_query(conn(),"SELECT * FROM user WHERE Email = '$email' AND Password = '$password'");
      $sessionId = mysqli_fetch_assoc($verify);
      $_SESSION['userid'] = $sessionId['UserID'];
      (mysqli_num_rows($verify) == 1) ? header('location:index.php') : header('location:login.php');
    }else if(isset($_POST['register'])){
      mysqli_query(conn(),"INSERT INTO user VALUES('','$username','$password','$email','$namalengkap','$alamat','$image')");
      header('location:index.php');
    }
  }
}
loginRegister();
?>