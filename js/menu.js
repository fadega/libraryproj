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

// /**** Autocomplet feature **/
// $(document).ready(function () {
//   // Send Search Text to the server
//   $("#search").keyup(function () {
//     let searchText = $(this).val();
//     if (searchText != "") {
//       $.ajax({
//         url: "../app/search.php",
//         method: "post",
//         data: {
//           query: searchText,
//         },
//         success: function (response) {
//           $("#show-list").html(response);
//         },
//       });
//     } else {
//       $("#show-list").html("");
//     }
//   });
//   // Set searched text in input field on click of search button
//   $(document).on("click", "li", function () {
//     $("#search").val($(this).text());
//     $("#show-list").html("");
//   });
// });
