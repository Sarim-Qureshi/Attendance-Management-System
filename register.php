<?php
require "dbconn.php";
$login=false;
$showerror=false;
// Remember to remove echo errors
if($_SERVER['REQUEST_METHOD']=='POST'){
    $faculty_id = $_POST['fid'];
    $email_id = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
 

    $sql = "SELECT * FROM `faculty_register` WHERE `faculty_id`='$faculty_id' and `faculty_email`='$email_id'";
    $result = mysqli_query($conn, $sql);
    
    if($result) {
        $num = mysqli_num_rows($result); 
        if($num>0){
            $row=mysqli_fetch_assoc($result);
            if($row['is_registered']==1){
                $showerror = "Error! You have already registered";
            }
            else{
                echo mysqli_error($conn);
                $sql = "SELECT * FROM `faculty_login` WHERE `username`='$username'";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $num = mysqli_num_rows($result); 
                    if($num==1) $showerror = "Username already exists! Enter a different username";
                    else{
                        echo mysqli_error($conn);
                        if($password==$cpassword){
                            $password = password_hash($password, PASSWORD_DEFAULT);
                            $login=true;
                            $sql = "INSERT INTO `faculty_login` (`faculty_id`, `username`, `password`) VALUES ('$faculty_id', '$username', '$password');";
                            mysqli_query($conn, $sql);
                            $sql = "UPDATE `faculty_register` SET `is_registered` = '1' WHERE `faculty_id` = '$faculty_id';";
                            mysqli_query($conn, $sql);
                        }    
                        else{
                            echo mysqli_error($conn);
                            $showerror = "Error! The passwords do not match";
                        }
                    }
                }
            }
        }
        else{
            echo mysqli_error($conn);
            $showerror="Error! faculty id or email id is incorrect";
        }
    }
    else{
        echo mysqli_error($conn);
        $showerror = "Error! faculty id or email id is incorrect";
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
    <link href='main.css' type='text/css' rel='stylesheet'></link>
</head>
<body>
    <div id="container">

        <div id="heading">Attendance Management System</div> 
        <div id="box-register">
            <div class="title">Register</div>
            <form action="register.php" method="POST">
                <input type="email" maxlength="20" placeholder="email id" name="email" class="formelem" required>
                <input type="text" maxlength="20" placeholder="faculty id" name="fid" class="formelem" required>
               <input type="text" maxlength="20" placeholder="username" name="username" class="formelem" required>
               <input type="password" maxlength="20" placeholder="password" name="password" class="formelem" required minlength="8">
               <input type="password" maxlength="20" placeholder="confirm password" name="cpassword" class="formelem" required minlength="8">
               <input type="submit" value='register' id="signup">
            </form>
            <div id="error-register" style="display:none; font-family:consolas; font-size:1em; text-align:center;"></div>
        </div>
    </div>

<?php
if($login){
    echo '
    <script>
    document.getElementById("box-register").style.height = "70%";
    elem = document.getElementById("error-register")
    elem.style.display = "block";
    elem.innerHTML = "Success! You are registered";
    elem.style.color = "green";
    setTimeout(() => {
        document.getElementById("box-register").style.height = "64%";
        document.getElementById("error-register").innerHTML = "";
        document.getElementById("error-register").style.color = "red";
        document.getElementById("error-register").style.display = "none";
        location = "index.php";
       }, 3000);
    </script>
    ';
}
if($showerror){
    
    echo '
    <script>
    document.getElementById("box-register").style.height = "70%";
    elem = document.getElementById("error-register")
    elem.style.display = "block";
    elem.innerHTML = "'.$showerror.'";
    elem.style.color = "red";
    setTimeout(() => {
        document.getElementById("box-register").style.height = "64%";
        document.getElementById("error-register").innerHTML = "";
        document.getElementById("error-register").style.display = "none";
       }, 3000);
    </script>
    ';
}
?>


    <script src="main.js"></script>
</body>
</html>