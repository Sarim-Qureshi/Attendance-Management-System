<?php error_reporting(0); ?>
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
<div id="editstudentcont1">
<form action="edit.php" method="POST">
<input type="text" placeholder="Enter student id" required class="formelem" name="enter_student_id">
<input type="submit" value="Enter" name="esb1" id="esb1">
</form>
</div>
<div id="studdet">STUDENT DETAILS:</div>
<div id="editstudentcont2">
<form action="edit.php" method="POST">
<label for="sname" style="font-size: 1.2em;">Student name:</label>
<input type="text" maxlength="50" placeholder="student name" name="student_name" id="sname" class="formelem" required>
<label for="sid" style="font-size: 1.2em;">Student Id:</label>
<input type="text" maxlength="20" placeholder="student id" name="student_id" id="sid" class="formelem" required readonly><br>
<label for="course" style="font-size: 1.2em;">Course:</label>
<select name="course" id="course" class="selectinp" required>
  <option value="Computer Engineering">Computer Engineering</option>
  <option value="Information Technology">Information Technology</option>
  <option value="Electronics">Electronics</option>
  <option value="Electronics and Telecommunications">Electronics and Telecommunications</option>
</select>
<label for="sem" style="font-size: 1.2em;">Semester:</label>
<input type="number" id="sem" min="1" max="8" class="formelem" name="sem" required>
</div>
<div id="deledtbts">
<span>
<input type="submit" value="Remove Student" name="esb2" id="remstud">
</span>
<span>
<input type="submit" value="Edit Student Details" name="esb3" id="editstud">
</span>
</form>
</div>
<div id="editstudenttext">A long dummy text on completion of operations on student details</div>
</div>
<script src="main.js"></script>
';

if($_POST['esb1']){
    require "dbconn.php";
    if($_SERVER['REQUEST_METHOD']=='POST'){

        $esid = $_POST['enter_student_id'];
        $sql = "SELECT * FROM `student`  WHERE `id`='$esid'";
        $result = mysqli_query($conn, $sql);  
        $num = mysqli_num_rows($result);
        if($num>0){
            $row=mysqli_fetch_assoc($result);


         echo '
         <script>
         document.getElementById("sname").value = "'.$row['name'].'";
         document.getElementById("sid").value = "'.$row['id'].'";         
         document.getElementById("course").value = "'.$row['course'].'";         
         document.getElementById("sem").value = "'.$row['sem'].'";         



         document.getElementById("editstudentcont1").style.display = "flex";
         document.getElementById("editstudentcont1").style.justifyContent = "center";
         document.getElementById("studdet").style.display = "block";
         document.getElementById("editstudentcont2").style.display = "flex";
         document.getElementById("editstudentcont2").style.justifyContent = "center";
         document.getElementById("editstudentcont2").style.alignItems = "center";
         document.getElementById("deledtbts").style.display = "flex";
         document.getElementById("deledtbts").style.justifyContent = "center";
         document.getElementById("deledtbts").style.alignItems = "center";
         </script>
        ';
        }
        else{
            echo '
            <script>
            document.getElementById("editstudentcont1").style.display = "flex";
            document.getElementById("editstudentcont1").style.justifyContent = "center";
            let elem = document.getElementById("editstudenttext");
            elem.style.display = "block";
            elem.innerText = "Enter a correct student Id";
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
if($_POST['esb2']){
    require "dbconn.php";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name = $_POST['student_name'];
        $id = $_POST['student_id'];
        $course = $_POST['course'];
        $sem = $_POSt['sem'];

        $sql = "DELETE FROM `student` WHERE `id`='$id'";
        $result1 = mysqli_query($conn, $sql);
        $sql = "DELETE FROM `attendance` WHERE `id`='$id'";
        $result2 = mysqli_query($conn, $sql);
        if($result1 and $result2){
        echo '
        <script>
        document.getElementById("editstudentcont1").style.display = "flex";
        document.getElementById("editstudentcont1").style.justifyContent = "center";
        let elem = document.getElementById("editstudenttext");
        elem.style.display = "block";
        elem.innerText = "The student was removed successfully";
        elem.style.color = "green";
        setTimeout(()=>{
            elem.style.display = "none";
        }, 3000)
        </script>
        ';
       }
       else{
        echo '
        <script>
        document.getElementById("editstudentcont1").style.display = "flex";
        document.getElementById("editstudentcont1").style.justifyContent = "center";
        let elem = document.getElementById("editstudenttext");
        elem.style.display = "block";
        elem.innerText = "Error! The student was not removed";
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
if($_POST['esb3']){
    require "dbconn.php";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name = $_POST['student_name'];
        $id = $_POST['student_id'];
        $course = $_POST['course'];
        $sem = $_POST['sem'];

        $sql = "UPDATE `student` SET `name` = '$name', `sem` = '$sem', `course` = '$course' WHERE `student`.`id` = '$id'";
        $result1 = mysqli_query($conn, $sql);
        $sql = "UPDATE `attendance` SET `name` = '$name' WHERE `attendance`.`id` = '$id'";
        $result2 = mysqli_query($conn, $sql);

        if($result1 and $result2){
        echo '
        <script>
        document.getElementById("editstudentcont1").style.display = "flex";
        document.getElementById("editstudentcont1").style.justifyContent = "center";
        let elem = document.getElementById("editstudenttext");
        elem.style.display = "block";
        elem.innerText = "The student details were successfully updated";
        elem.style.color = "green";
        setTimeout(()=>{
            elem.style.display = "none";
        }, 3000)
        </script>
        ';
    }
    else{
        echo '
        <script>
        document.getElementById("editstudentcont1").style.display = "flex";
        document.getElementById("editstudentcont1").style.justifyContent = "center";
        let elem = document.getElementById("editstudenttext");
        elem.style.display = "block";
        elem.innerText = "Error! Student details were not updated";
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
