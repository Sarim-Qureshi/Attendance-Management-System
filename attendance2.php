<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: index.php');
}
require "navbar.php";
require "dbconn.php";
$name = json_decode($_COOKIE['name']);
$id = json_decode($_COOKIE['id']);
$absid = json_decode($_COOKIE['absid']);
$subject = $_SESSION['subject'];
$date = $_SESSION['date'];

$changed = false;

if(!empty($absid)){
echo '
<script>
console.log("'.$absid[0].'");

console.log("'.$_SESSION['date'].'");
console.log("'.$_SESSION['subject'].'");
</script>
';
if(empty($name) and empty($id)){
    $sql = "DELETE FROM `attendance` WHERE `subject`='$subject' AND `date`='$date'";
    $result = mysqli_query($conn, $sql);
    if($result) $changed=true;
}
else{
    $sql = "DELETE FROM `attendance` WHERE `subject`='$subject' AND `date`='$date'";
    $result = mysqli_query($conn, $sql);
    if($result) $changed=true;
    for($x=0;$x<sizeof($name);$x++){
        echo "$name[$x]";
        $sql = "INSERT INTO `attendance` (`name`, `id`, `subject`, `date`) VALUES ('$name[$x]', '$id[$x]', '$subject', '$date');";
        $result = mysqli_query($conn, $sql);
    }
}
}
else{
    for($x=0;$x<sizeof($name);$x++){
        echo "$name[$x]";
        $sql = "INSERT INTO `attendance` (`name`, `id`, `subject`, `date`) VALUES ('$name[$x]', '$id[$x]', '$subject', '$date');";
        $result = mysqli_query($conn, $sql);
        if($result) $changed=true;
    }
}
mysqli_close($conn);

if($changed){
    echo '
<div id="attendance2container">
<div id="text" style="color:green">Success! The attendance was marked for the subject '.$subject.' on '.$date.'</div>
</div>
';
}
else{
    echo '
<div id="attendance2container">
<div id="text" style="color:red">Error! The attendance was not marked! Please contact the owner of this site</div>
</div>
';
}
echo '
<script>
document.getElementById("homeli").style.color="white";
document.getElementById("asli").style.color="white";
document.getElementById("att").style.color="blue";
document.getElementById("edt").style.color="white";
document.getElementById("about").style.color="white";
</script>
</body> 
</html>
';


?>