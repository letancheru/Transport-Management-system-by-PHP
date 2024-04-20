  function reciverF (){
    field=mssg.reciever.value;
    if (field=="Reciever is required") {
      document.getElementById("reciever").value="";
      document.getElementById("reciever").style.color = "black";
      document.getElementById("reciever").style.fontWeight="normal";
    }
  }
  function reciverB ()  {
    x=mssg.reciever.value;
    if(x==""||x==null){
      document.getElementById("reciever").style.color="brown";
      document.getElementById("reciever").style.fontWeight="bold";
      document.getElementById("reciever").value="Reciever is required";
    }
  }

  function SubjectF (){
    field=mssg.Subject.value;
    if (field=="Subject is required") {
      document.getElementById("Subject").value="";
      document.getElementById("Subject").style.color = "black";
      document.getElementById("Subject").style.fontWeight="normal";
    }
  }
  function SubjectB ()  {
    x=mssg.Subject.value;
    if(x==""||x==null){
      document.getElementById("Subject").style.color="brown";
      document.getElementById("Subject").style.fontWeight="bold";
      document.getElementById("Subject").value="Subject is required";
    }
  }