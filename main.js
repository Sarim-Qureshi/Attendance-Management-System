document.getElementById("register").onclick = function(){
    location.href = 'register.php';
}
function makechanges(){
    document.getElementById("table").style.visibility="visible";
    var name = [];
    var id = [];
    var absid = [];
    $("tr").each(function(){
      if($(":nth-child(3)", this).hasClass("absent")){
        // console.log($(":nth-child(2)", this).text());
       absid.push($(":nth-child(2)", this).text());
        // console.log($(":nth-child(1)", this).text());
      }
      else if($(":nth-child(3)", this).hasClass("present")){
        name.push($(":nth-child(1)", this).text());
        id.push($(":nth-child(2)", this).text());
      }
    });
    // for(let i=0; i<3; i++){
    //     // name.pop();
    //     // id.pop();
    //     // absid.pop();
    // }
    var json_name = JSON.stringify(name);
    // createCookie('name', json_name);
    var json_id = JSON.stringify(id);
    // createCookie('id', json_id);
    var json_absid = JSON.stringify(absid);
    // createCookie('absid', json_absid);
    console.log(json_absid);
    document.cookie = "absid" + "=" + json_absid + "; path=/;";
    document.cookie = "name" + "=" + json_name + "; path=/;";
    document.cookie = "id" + "=" + json_id + "; path=/;";
    console.log(name);
    console.log(id);
    console.log(absid);
    location.href = 'attendance2.php';
  }

  function editstudent(){
    document.getElementById("editstudentcont").style.display = "flex";
    document.getElementById("editstudentcont").style.justifyContent = "center";
  }