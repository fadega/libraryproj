

// AJAX call for autocomplete

$(document).ready(function () {
  // Send Search Text to the php script and that will fetch it from database
  $("#search").keyup(function () {
    let searchText = $(this).val();
    if (searchText != "") {
      $.ajax({
        url: "../app/search.php",
        method: "post",
        data: {
          query: searchText,
        },
        success: function (response) {
          $("#show-list").html(response);
        },
      });
    } else {
      $("#show-list").html("");
    }
  });
  // Set searched text in input field on click of search button
  $(document).on("click", "li", function () {
    $("#search").val($(this).text());
    $("#show-list").html("");
  });
});



// SRCRIPT FOR RESPONSIVE NAV
/*
 THe script below will change display and size properties of menu for small devices
*/

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
//END of auto complete and responsive menu





/*
  The script below hides and shows Dashboard sections based on user activities(clicks)
  It calls fucntion displayData 
 */

function displayData(event, btn){
  if(btn == 'user'){
    var item = document.querySelector("#middle");
    item.style.display = "block";
    document.querySelector('#middle .users').style.display='block';
    document.querySelector('#middle .authors').style.display='none';
    document.querySelector('#middle .books').style.display='none';
    document.querySelector('#middle .Categories').style.display='none';
    document.querySelector('#middle .publishers').style.display='none';
    document.querySelector('#middle .orders').style.display='none';
    document.querySelector('#middle .genre').style.display='none';
    document.querySelector('#middle .comments').style.display='none';



  }else if(btn == 'author'){
    document.querySelector("#middle").style.display = "block";
    document.querySelector('#middle .users').style.display='none';
    document.querySelector('#middle .authors').style.display='block';
    document.querySelector('#middle .books').style.display='none';
    document.querySelector('#middle .Categories').style.display='none';
    document.querySelector('#middle .publishers').style.display='none';
    document.querySelector('#middle .orders').style.display='none';
    document.querySelector('#middle .genre').style.display='none';
    document.querySelector('#middle .comments').style.display='none';

  }else if(btn == 'book'){
    document.querySelector("#middle").style.display = "block";
    document.querySelector('#middle .users').style.display='none';
    document.querySelector('#middle .authors').style.display='none';
    document.querySelector('#middle .books').style.display='block';
    document.querySelector('#middle .Categories').style.display='none';
    document.querySelector('#middle .publishers').style.display='none';
    document.querySelector('#middle .orders').style.display='none';
    document.querySelector('#middle .genre').style.display='none';
    document.querySelector('#middle .comments').style.display='none';

  }else if(btn == 'category'){
   document.querySelector("#middle").style.display = "block";
    document.querySelector('#middle .users').style.display='none';
    document.querySelector('#middle .authors').style.display='none';
    document.querySelector('#middle .books').style.display='none';
    document.querySelector('#middle .Categories').style.display='block';
    document.querySelector('#middle .publishers').style.display='none';
    document.querySelector('#middle .orders').style.display='none';
    document.querySelector('#middle .genre').style.display='none';
    document.querySelector('#middle .comments').style.display='none';
  }else if(btn == 'publisher'){
   document.querySelector("#middle").style.display = "block";
    document.querySelector('#middle .users').style.display='none';
    document.querySelector('#middle .authors').style.display='none';
    document.querySelector('#middle .books').style.display='none';
    document.querySelector('#middle .Categories').style.display='none';
    document.querySelector('#middle .publishers').style.display='block';
    document.querySelector('#middle .orders').style.display='none';
    document.querySelector('#middle .genre').style.display='none';
    document.querySelector('#middle .comments').style.display='none';
  }else if(btn == 'order'){
   document.querySelector("#middle").style.display = "block";
    document.querySelector('#middle .users').style.display='none';
    document.querySelector('#middle .authors').style.display='none';
    document.querySelector('#middle .books').style.display='none';
    document.querySelector('#middle .Categories').style.display='none';
    document.querySelector('#middle .publishers').style.display='none';
    document.querySelector('#middle .orders').style.display='block';
    document.querySelector('#middle .genre').style.display='none';
    document.querySelector('#middle .comments').style.display='none';
  }else if(btn == 'genre'){
   document.querySelector("#middle").style.display = "block";
    document.querySelector('#middle .users').style.display='none';
    document.querySelector('#middle .authors').style.display='none';
    document.querySelector('#middle .books').style.display='none';
    document.querySelector('#middle .Categories').style.display='none';
    document.querySelector('#middle .publishers').style.display='none';
    document.querySelector('#middle .orders').style.display='none';
    document.querySelector('#middle .genre').style.display='block';
    document.querySelector('#middle .comments').style.display='none';
  }else if(btn == 'comment'){
   document.querySelector("#middle").style.display = "block";
    document.querySelector('#middle .users').style.display='none';
    document.querySelector('#middle .authors').style.display='none';
    document.querySelector('#middle .books').style.display='none';
    document.querySelector('#middle .Categories').style.display='none';
    document.querySelector('#middle .publishers').style.display='none';
    document.querySelector('#middle .orders').style.display='none';
    document.querySelector('#middle .genre').style.display='none';
    document.querySelector('#middle .comments').style.display='block';
  }


  event.preventDefault();
}



//add to cart

let quantity = 0;
function updateQuantity(){
  quantity+=1;
  var cart = document.getElementsByClassName('cart');
  cart[0].textContent=quantity;
  cart[1].textContent=quantity;

  document.getElementById('checkout').style.visibility='visible';


}



function getData(e){
  var creds = "quant="+quantity;
  var xhr = new XMLHttpRequest();

  xhr.onload = function(){
    if(this.status == 200){
      console.log(this.responseText);
    }else{
      console.log('No data passed');
    }
  }
  xhr.open('POST','../templates/checkout.php',true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

  xhr.send(creds);
  e.preventDefault();
}
