<?php error_reporting(0); ?>
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
     <input type="submit" class="attendanceb" value="Next" name="btn1">
    </form>
</div>
<div id="attendanceform2">
    <form action="attendance.php" method="POST">
    <label for="subject" class="attendancelabel">Subject</label>
    <select name="subject" id="subject" class="attendanceinput" required>
     
    </select>
    <label for="date" class="attendancelabel">Date</label>
    <input type="date" name="date" id="date" required>
    <input type="submit" class="attendanceb" value="Next" name="btn2">
    </form>
</div>
<div id="textns"></div>
<div id="table">
<table id="myTable">
<thead id="tablehead">
<tr>
<th>Name</th>
<th>Id</th>
<th>Record</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
<button id="abutt" onclick="makechanges()">Make Changes</button>
</div>
</div>
<script src="main.js"></script>
<script src=
"https://code.jquery.com/jquery-3.3.1.min.js">
  </script>
';
if($_POST['btn1']){
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
         $_SESSION['subjects'] = $subjects;
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
}
if($_POST['btn2']){
    require "dbconn.php";
    if($_SERVER['REQUEST_METHOD']=='POST'){
      session_start();
      $course = $_SESSION['course'];
      $sem = $_SESSION['sem'];
      $subject = $_POST['subject'];
      $date = $_POST['date'];
      $_SESSION['date'] = $date;
      $_SESSION['subject'] = $subject;

      $name_id = array();
      $sql = "SELECT * FROM `student` WHERE `course`='$course' and `sem`='$sem'";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result); 
      if($num>0){
      while($row=mysqli_fetch_assoc($result)){
          $name_id[$row['name']]=$row['id'];
         }
      } 

      $all_absent = true;
      $presentids = array();
      $sql = "SELECT * FROM `attendance` WHERE `subject`='$subject' and `date`='$date'";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result); 
      if($num>0){
      while($row=mysqli_fetch_assoc($result)){
         $all_absent = false;
         array_push($presentids, $row['id']);
         }
      } 

      if($all_absent){
          foreach($name_id as $name=>$id){
            echo '
            <script>
            $("#myTable tr:last").after("<tr><td>'.$name.'</td><td>'.$id.'</td><td>absent</td></tr>");
            </script>
            ';
          }  
          echo '
          <script>
          $("td:nth-child(3)").addClass("absent");
          $("td:nth-child(3)").click(function(){
            if($(this).hasClass("absent")){
              $(this).removeClass("absent");
               $(this).addClass("present");
               $(this).html("present");
            }
            else{
              $(this).removeClass("present");
              $(this).addClass("absent");
              $(this).html("absent");
            }
          });
          if(document.getElementById("myTable").rows.length>=7){
          var height = (window.scrollY + document.querySelector("#table").getBoundingClientRect().bottom);
          document.getElementById("attendancecontainer").style.height = height+"px";
          }
          if(document.getElementById("myTable").rows.length!=1){
          document.getElementById("myTable").style.visibility = "visible";
          document.getElementById("table").style.visibility = "visible";
          document.getElementById("tablehead").style.visibility = "visible";
          }
          else{
          textns = document.getElementById("textns");
          textns.innerText="There are no students in semester '.$sem.' and department '.$course.'";
          textns.style.display = "block";
          setTimeout(() => {
            textns.style.display="none";
          }, 5000);
          }
          </script>
          ';
          $subjects = $_SESSION['subjects'];
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
          document.getElementById("subject").value="'.$_SESSION['subject'].'";
          </script>
          ';

      }
      else{
        foreach($name_id as $name=>$id){
          echo '
          <script>
          $("#myTable tr:last").after("<tr><td>'.$name.'</td><td>'.$id.'</td><td>absent</td></tr>");
          </script>
          ';
        }  
        echo '
        <script>
        $("td:nth-child(3)").addClass("absent");
        $("td:nth-child(3)").click(function(){
          if($(this).hasClass("absent")){
            $(this).removeClass("absent");
             $(this).addClass("present");
             $(this).html("present");
          }
          else{
            $(this).removeClass("present");
            $(this).addClass("absent");
            $(this).html("absent");
          }
        });
        if(document.getElementById("myTable").rows.length>=7){
        var height = (window.scrollY + document.querySelector("#table").getBoundingClientRect().bottom);
        document.getElementById("attendancecontainer").style.height = height+"px";
        }
        if(document.getElementById("myTable").rows.length!=1){
        document.getElementById("myTable").style.visibility = "visible";
        document.getElementById("table").style.visibility = "visible";
        document.getElementById("tablehead").style.visibility = "visible";
        }
        else{
          textns = document.getElementById("textns");
          textns.innerText="There are no students in semester '.$sem.' and department '.$course.'";
          textns.style.display = "block";
          setTimeout(() => {
            textns.style.display="none";
          }, 5000);
        }
        </script>
        ';
        //Change for this case
        for($x=0; $x<sizeof($presentids); $x++){
        echo '
        <script>
        $("tr").each(function(){
          if($(":nth-child(2)", this).text()=="'.$presentids[$x].'"){
             $(":nth-child(3)", this).removeClass("absent");
             $(":nth-child(3)", this).addClass("present");
             $(":nth-child(3)", this).html("present");
          }
        });
        </script>
        ';
      }

        $subjects = $_SESSION['subjects'];
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
        document.getElementById("subject").value="'.$_SESSION['subject'].'";
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
document.getElementById("att").style.color="blue";
document.getElementById("edt").style.color="white";
document.getElementById("about").style.color="white";



</script>
</body> 
</html>
';
?>

