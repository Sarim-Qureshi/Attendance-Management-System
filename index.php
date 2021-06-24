<?php
session_start();
if(isset($_SESSION['username'])){
    header('location: home.php');
}
require "dbconn.php";
$login=false;
$showerror=false;

if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $sql = "SELECT * FROM `faculty_login` WHERE `username`='$username'";
    $result = mysqli_query($conn, $sql);
    
    if($result) {
        $num = mysqli_num_rows($result); 
        if($num==1){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password'])){
                $login=true;
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['username']=$username;
            }
            else{
                $showerror=true;
            }
        }
        else{
            $showerror=true;
        }
    }

}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management System</title>  
    <link href="main.css" type="text/css" rel="stylesheet"></link>
</head>
<body>
    <div id="container">

    
<div id="heading">Attendance Management System</div> 
        <div id="box-login">
            <div id="title">Login Panel</div>
            <form action="index.php" method="POST">
               <input type="text" maxlength="20" placeholder="username" name="username" class="formelem" required>
               <input type="password" maxlength="20" placeholder="password" name="password" class="formelem" required>
                 <input type="submit" value="login" id="login">
                 <br>
                 <input type="button" value="register" id="register">
                 <div id="error" style="display:none; font-family:consolas; font-size:1em;">Invalid credentials! Enter correct username and password to login</div>
            </form>
        </div>
    </div>
    <?php
if($login){
    header("location: home.php");
}
if($showerror){
echo'
<script>
    document.getElementById("box-login").style.height = "55%";
    document.getElementById("error").style.display = "block";
    setTimeout(() => {
        document.getElementById("box-login").style.height = "50%";
        document.getElementById("error").style.display = "none";
       }, 3000);
</script>';
}
?>
    <script src="main.js"></script>
</body>
</html>
