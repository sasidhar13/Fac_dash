
function openLeaves(){
  x=document.getElementById("leavesdiv");
  x.style.display="block";
  y=document.getElementById("applydiv");
  y.style.display="none";
  z=document.getElementById("remainingdiv");
  z.style.display="none";
  w=document.getElementById("salarydiv");
  w.style.display="none";
}

function openApply(){
  x=document.getElementById("leavesdiv");
  x.style.display="none";
  y=document.getElementById("applydiv");
  y.style.display="block";
  z=document.getElementById("remainingdiv");
  z.style.display="none";
  w=document.getElementById("salarydiv");
  w.style.display="none";
}

function openRemaining(){
  x=document.getElementById("leavesdiv");
  x.style.display="none";
  y=document.getElementById("applydiv");
  y.style.display="none";
  z=document.getElementById("remainingdiv");
  z.style.display="block";
  w=document.getElementById("salarydiv");
  w.style.display="none";
}

function openSalary(){
  x=document.getElementById("leavesdiv");
  x.style.display="none";
  y=document.getElementById("applydiv");
  y.style.display="none";
  z=document.getElementById("remainingdiv");
  z.style.display="none";
  w=document.getElementById("salarydiv");
  w.style.display="block";
}