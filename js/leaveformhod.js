$(document).ready(function(){
  $('#leavesdiv').show();
  $('#salarydiv').hide();
  $('#leaves').click(function(){
    $('#leavesdiv').show();
    $('#salarydiv').hide();
  });
  $('#salary').click(function(){
    $('#salarydiv').show();
    $('#leavesdiv').hide();
  });
});


function openLeaves(){
  x=document.getElementById("leavesdiv");
  x.style.display="block";
  w=document.getElementById("salarydiv");
  w.style.display="none";
}


function openSalary(){
  x=document.getElementById("leavesdiv");
  x.style.display="none";
  w=document.getElementById("salarydiv");
  w.style.display="block";
}