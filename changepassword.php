<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: index.php');
}
require "navbar.php";
echo '
<div id="cpcontainer">
<div id="cpformcontainer">
<div class="title">Change Password</div>
<form action="changepassword.php" method="POST">
<input type="text" maxlength="20" placeholder="username" name="username" class="formelem" required>
<input type="password" maxlength="20" placeholder="old password" name="old_password" class="formelem" required minlength="8">
<input type="password" maxlength="20" placeholder="new password" name="new_password" class="formelem" required minlength="8">
<input type="password" maxlength="20" placeholder="confirm new password" name="cpassword" class="formelem" required minlength="8">
<input type="submit" value="Change Password" id="cpbtn">
</form>
<div id="error-cp" style="display:none; font-family:consolas; font-size:1em; text-align:center;"></div>
</div>
</div>
';
$changed=false;
$error=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    require "dbconn.php";
    $username = $_POST['username'];
    $oldpass = $_POST['old_password'];
    $newpass = $_POST['new_password'];
    $cpass = $_POST['cpassword'];

    $sql = "SELECT * FROM `faculty_login` WHERE `username`='$username'";
    $result = mysqli_query($conn, $sql);
    
    $num = mysqli_num_rows($result); 
    if($num==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($oldpass, $row['password'])){
            if($newpass==$cpass){
                $changed=true;
                $password=password_hash($newpass, PASSWORD_DEFAULT);
                $sql = "UPDATE `faculty_login` SET `password` = '$password' WHERE `username` = '$username';";
                mysqli_query($conn, $sql);
            }
            else{
                $error="Error! The new passwords do not match";
            }
        }
        else{
            $error="Error! Password is incorrect";
        }
    }
    else{
        $error="Error! Username is incorrect";
    }
    mysqli_close($conn);
}



if($changed){
    echo '<script>
    elem = document.getElementById("error-cp")
    elem.style.display = "block";
    elem.innerHTML = "Success! your password was changed";
    elem.style.color = "green";
    setTimeout(() => {
        document.getElementById("error-cp").innerHTML = "";
        document.getElementById("error-cp").style.color = "red";
        document.getElementById("error-cp").style.display = "none";
       }, 3000);
    </script>';
}
if($error){
    echo '<script>
    elem = document.getElementById("error-cp")
    elem.style.display = "block";
    elem.innerHTML = "'.$error.'";
    elem.style.color = "red";
    setTimeout(() => {
        document.getElementById("error-cp").innerHTML = "";
        document.getElementById("error-cp").style.display = "none";
       }, 3000);
    </script>';
}


echo '
<script>
document.getElementById("homeli").style.color="blue";
document.getElementById("asli").style.color="white";
document.getElementById("att").style.color="white";
document.getElementById("edt").style.color="white";
document.getElementById("about").style.color="white";
</script>
</body> 
</html>
';
?>