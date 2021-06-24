<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: index.php');
}
require "navbar.php";
echo '
<div id="homecontainer"><div id="homecontainertitle">Attendance Management System</div>
<div id="homecontainerbody">Manage student\'s attendance in a smart and easy way</div>
</div>
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

