<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: index.php');
}
require "navbar.php";
require "dbconn.php";
$added=false;
$showerror=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $student_name = $_POST['student_name'];
    $student_id = $_POST['student_id'];
    $course = $_POST['course'];
    $sem = $_POST['sem'];
 
    $sql = "INSERT INTO `student` (`name`, `id`, `course`, `sem`) VALUES ('$student_name', '$student_id', '$course', '$sem');";
    $result = mysqli_query($conn, $sql);
    
    if($result) {
        $added=true;
        }
        else{
            $showerror=true;
        }
}
mysqli_close($conn);
echo '
<div id="addstudentcontainer"><div id="addstudentformcontainer">
<div id="title">Add Student</div>
<form action="addstudent.php" method="POST">
<input type="text" maxlength="50" placeholder="student name" name="student_name" class="formelem" required>
<input type="text" maxlength="20" placeholder="student id" name="student_id" class="formelem" required>
<label for="course" style="font-size: 1.2em;">Choose the course from the list:</label>
<select name="course" id="course" class="selectinp" required>
  <option value="Computer Engineering">Computer Engineering</option>
  <option value="Information Technology">Information Technology</option>
  <option value="Electronics">Electronics</option>
  <option value="Electronics and Telecommunications">Electronics and Telecommunications</option>
</select>
<label for="sem" style="font-size: 1.2em;">Choose the semester:</label><br>
<input type="number" id="sem" min="1" max="8" class="formelem" name="sem" required>
<input type="submit" value="Add Student" id="addstudent">
</form>
<div id="error-as" style="display:none; font-family:consolas; font-size:1em; text-align:center;"></div>
</div></div>';
if($added){
    echo '<script>
    document.getElementById("addstudentformcontainer").style.height = "75vh";
    elem = document.getElementById("error-as")
    elem.style.display = "block";
    elem.innerHTML = "Success! The student was added";
    elem.style.color = "green";
    setTimeout(() => {
        document.getElementById("addstudentformcontainer").style.height = "70vh";
        document.getElementById("error-as").innerHTML = "";
        document.getElementById("error-as").style.color = "red";
        document.getElementById("error-as").style.display = "none";
       }, 3000);
    </script>';
}
if($showerror){
    echo '<script>
    document.getElementById("addstudentformcontainer").style.height = "75vh";
    elem = document.getElementById("error-as")
    elem.style.display = "block";
    elem.innerHTML = "Error! Check that you entered unique student id";
    elem.style.color = "red";
    setTimeout(() => {
        document.getElementById("addstudentformcontainer").style.height = "70vh";
        document.getElementById("error-as").innerHTML = "";
        document.getElementById("error-as").style.display = "none";
       }, 3000);
    </script>';
}
echo '
<script>
document.getElementById("homeli").style.color="white";
document.getElementById("asli").style.color="blue";
document.getElementById("att").style.color="white";
document.getElementById("edt").style.color="white";
document.getElementById("about").style.color="white";
</script>
</body> 
</html>
';
?>
