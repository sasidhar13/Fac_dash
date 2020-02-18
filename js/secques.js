
function secquesOpen(){
  var pwd= document.getElementById("pwd").value;
  var conpwd = document.getElementById("conpwd").value;
  var pwdreal= document.getElementById("pwdreal").value;
  if (pwd===conpwd){
    if (pwdreal===pwd){   
      document.getElementById("secques").style.display="block";
    }
  }
} 