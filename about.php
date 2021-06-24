<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: index.php');
}
require "navbar.php";
echo '
<script>
document.getElementById("homeli").style.color="white";
document.getElementById("asli").style.color="white";
document.getElementById("att").style.color="white";
document.getElementById("edt").style.color="white";
document.getElementById("about").style.color="blue";
</script>
</body> 
</html>
';
?>
