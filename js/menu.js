/****START CODE FOR RESPONSIVE NAV****/

  var dropdown = document.querySelector("nav .dropdown");
  var button = document.querySelector("nav .menu");


  function collapse(){
    if(dropdown.style.display==="grid"){
      dropdown.style.display="none";
      button.innerHTML = "menu";
    }else{
      dropdown.style.display="grid";
      button.innerHTML = "close";
    }
  }
  window.addEventListener("resize", function() {
  if (window.innerWidth > 768) {
      dropdown.style.display = "none";
      button.innerHTML = "menu";
  }
});
/****END CODE FOR RESPONSIVE NAV****/


//The below is for modal
document.getElementById('showmodal').addEventListener('click',function(){
  document.querySelector('#bg-modal').style.display="flex";
});
document.querySelector('.cross').addEventListener('click',function(){
  document.querySelector('#bg-modal').style.display="none";
});
