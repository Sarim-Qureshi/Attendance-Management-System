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
document.getElementById("edt").style.color="blue";
document.getElementById("about").style.color="white";
</script>
</body> 
</html>
';
?>
