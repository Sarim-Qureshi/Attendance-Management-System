<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: index.php');
}
require "navbar.php";
echo '
<div id="editcontainer">
<div id="editlist">
<span>
<button id="eb1" onclick="editstudent()">Edit Student Details</button>
</span>
<span>
<button id="eb2" onclick="">Edit course Details</button>
</span>
<div id="editstudentcont">
<form action="edit.php" method="POST">
<input type="text" placeholder="Enter student id" required class="formelem">
<input type="submit" value="Enter" name="esb1" id="esb1">
</form>
</div>
</div>
<script src="main.js"></script>
';


echo '
<script>
document.getElementById("homeli").style.color="white";
document.getElementById("asli").style.color="white";
document.getElementById("att").style.color="white";
document.getElementById("edt").style.color="blue";
document.getElementById("about").style.color="white";
</script>
</body> 
</html>
';
?>
