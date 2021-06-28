<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: index.php');
}
require "navbar.php";
echo '
<div id="coursecontainer">
<div id="courseform1">
    <form action="edit2.php" method="POST">
    <label for="course" class="attendancelabel">Course</label>
    <select name="course" id="course" class="attendanceinput" required>
      <option value="Computer Engineering">Computer Engineering</option>
      <option value="Information Technology">Information Technology</option>
      <option value="Electronics">Electronics</option>
      <option value="Electronics and Telecommunications">Electronics and Telecommunications</option>
    </select>
     <label for="sem" class="attendancelabel">Semester</label>
     <input type="number" id="sem" min="1" max="8" class="attendanceinput" name="sem" required>
     <input type="submit" class="attendanceb" value="Next" name="courseb1">
    </form>
</div>
<div id="courseform2">
<h2>Subjects:</h2>
<form action="edit2.php" method="POST">
<label for="subject1">Subject 1</label>
<input type="text" id="subject1" name="subject1" required max="50"><br>
<label for="subject2">Subject 2</label>
<input type="text" id="subject2" name="subject2" required max="50"><br>
<label for="subject3">Subject 3</label>
<input type="text" id="subject3" name="subject3" required max="50"><br>
<label for="subject4">Subject 4</label>
<input type="text" id="subject4" name="subject4" required max="50"><br>
<label for="subject5">Subject 5</label>
<input type="text" id="subject5" name="subject5" required max="50"><br>
<input type="submit" value="Update subjects" name="courseb2" id="courseb2">
</form>
</div>
<div id="editsubjecttext">A long dummy text on completion of operations on subject details</div>
</div>
';

if($_POST['courseb1']){
    require "dbconn.php";
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $course = $_POST['course'];
      $sem = $_POST['sem'];
      session_start();
      $_SESSION['course'] = $course;
      $_SESSION['sem'] = $sem;
    
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
        //  $_SESSION['subjects'] = $subjects;
         echo '
         <script>
         document.getElementById("courseform2").style.display="block";
         document.getElementById("subject1").value="'.$subjects[0].'";
         document.getElementById("subject2").value="'.$subjects[1].'";
         document.getElementById("subject3").value="'.$subjects[2].'";
         document.getElementById("subject4").value="'.$subjects[3].'";
         document.getElementById("subject5").value="'.$subjects[4].'";
         
         </script>
         ';
        }
    }
    mysqli_close($conn);
}
if($_POST['courseb2']){
    require "dbconn.php";
    if($_SERVER['REQUEST_METHOD']=='POST'){
      session_start();
      $course = $_SESSION['course'];
      $sem = $_SESSION['sem'];
      $subject1 = $_POST['subject1'];
      $subject2 = $_POST['subject2'];
      $subject3 = $_POST['subject3'];
      $subject4 = $_POST['subject4'];
      $subject5 = $_POST['subject5'];
    
      if($sem==1 or $sem==2){
        $sql = "UPDATE `sem{$sem}_subjects` SET `subject1` = '$subject1', `subject2` = '$subject2', `subject3` = '$subject3', `subject4` = '$subject4', `subject5` = '$subject5'";
       }
       else{
        $sql = "UPDATE `subjects` SET `subject1` = '$subject1', `subject2` = '$subject2', `subject3` = '$subject3', `subject4` = '$subject4', `subject5` = '$subject5' WHERE `sem` = '$sem' AND `department` = '$course'";
       }
       $result = mysqli_query($conn, $sql);    
       if($result){
         echo '
         <script>
         elem = document.getElementById("editsubjecttext");
         elem.style.display="block";
         elem.innerText = "Subjects updated successfully";
         elem.style.color = "lightgreen";
         setTimeout(()=>{
            elem.style.display = "none";
         }, 3000)
         </script>
         ';
        }
        else{
            echo '
            <script>
            elem = document.getElementById("editsubjecttext");
            elem.style.display="block";
            elem.innerText = "Error! Subjects were not updated";
            elem.style.color = "red";
            setTimeout(()=>{
               elem.style.display = "none";
            }, 3000)
            </script>
            ';
        }
    }
    mysqli_close($conn);
}

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