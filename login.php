<?php
require 'loginRegister.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujikom | Login</title>
</head>
<body><hr>
    <style>
    .login{
        width:500px;
        height:420px;
        border:5px solid black;
        background:#DCDCDC;
       
    }
    input{
        width:400px;
        height:40px;
        margin-top:50px;
        font-size:25px;
    }
    p{
        font-size:20px;
        text-align:left;
        margin-left:50px;
    }
    button{
        width:100px;
        height: 50px;
        font-size:20px;
    }
   
   
    </style>
    <center><h1>Login Akun</h1><hr><br>
    <div class="login">
    <h1>Login </h1>
    <form action="config/aksilogin.php" method="POST">
                        <label class="form-label">Username</label>
                        <input type="username" name="username" class="form-control" required>
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <div class="d-grid mt-2"><br>
                            <button class="btn btn-primary " type="submit" name="kirim">MASUK</button>
                        </div>
                    </form>
                    <p>Belum punya akun?? <a href="register.php">Daftar disini</a></p>
    </div>
    </center>
</body>
</html>