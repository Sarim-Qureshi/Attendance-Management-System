<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: index.php');
}
require "navbar.php";
echo '
<div id="attendancecontainer">
<div id="attendanceform1">
    <form action="attendance.php" method="POST">
    <label for="course" class="attendancelabel">Course</label>
    <select name="course" id="course" class="attendanceinput" required>
      <option value="Computer Engineering">Computer Engineering</option>
      <option value="Information Technology">Information Technology</option>
      <option value="Electronics">Electronics</option>
      <option value="Electronics and Telecommunications">Electronics and Telecommunications</option>
    </select>
     <label for="sem" class="attendancelabel">Semester</label>
     <input type="number" id="sem" min="1" max="8" class="attendanceinput" name="sem" required>
     <input type="submit" class="attendanceb" value="Next">
    </form>
</div>
<div id="attendanceform2">
    <form action="attendance.php" method="POST">
    <label for="subject" class="attendancelabel">Subject</label>
    <select name="subject" id="subject" class="attendanceinput" required>
     
    </select>
    <label for="date" class="attendancelabel">Date</label>
    <input type="date" name="date" id="date" required>
    <input type="submit" class="attendanceb" value="Next">
    </form>
</div>




<div id="table">
<table>
<thead>
<tr>
<th>Name</th>
<th>Id</th>
<th>Record</th>
</tr>
</thead>
<tbody>
<tr>
<td>Mike Tyson</td>
<td>s9</td>
<td>present/absent</td>
</tr>
<tr>
<td>Mike Tyson</td>
<td>s9</td>
<td>present/absent</td>
</tr>
<tr>
<td>Mike Tyson</td>
<td>s9</td>
<td>present/absent</td>
</tr>
<tr>
<td>Mike Tyson</td>
<td>s9</td>
<td>present/absent</td>
</tr>
<tr>
<td>Mike Tyson</td>
<td>s9</td>
<td>present/absent</td>
</tr>
<tr>
<td>Mike Tyson</td>
<td>s9</td>
<td>present/absent</td>
</tr>
<tr>
<td>Mike Tyson</td>
<td>s9</td>
<td>present/absent</td>
</tr>
<tr>
<td>Mike Tyson</td>
<td>s9</td>
<td>present/absent</td>
</tr>
</tbody>
</table>
</div>





</div>
<script src=
"https://code.jquery.com/jquery-3.3.1.min.js">
  </script>
';
include "dbconn.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $course = $_POST['course'];
    $sem = $_POST['sem'];
    
    if($sem==1 or $sem==2){
        $sql = "SELECT * FROM `sem{$sem}_subjects`";
    }
    else{
        $sql = "SELECT * FROM `subjects`  WHERE `department`='$course'";
    }
    $result = mysqli_query($conn, $sql);    
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        $subjects = array($row['subject1'],$row['subject2'],$row['subject3'],$row['subject4'],$row['subject5']);
        echo '
        <script>
        var subjects = ["'.$subjects[0].'","'.$subjects[1].'","'.$subjects[2].'","'.$subjects[3].'","'.$subjects[4].'"];
        subjects.forEach((val)=>{
            optionText = val;
            optionValue = val;
            $("#subject").append(`<option value="${optionValue}">
            ${optionText}
            </option>`);
        });
        document.getElementById("attendanceform2").style.visibility = "visible";
        </script>
        ';
    }
}
mysqli_close($conn);
echo '
<script>
var height = (window.scrollY + document.querySelector("#table").getBoundingClientRect().bottom);
console.log(height);
document.getElementById("attendancecontainer").style.height = height+"px";
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
