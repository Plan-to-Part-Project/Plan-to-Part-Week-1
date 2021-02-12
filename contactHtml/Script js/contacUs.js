$(document).ready(function(){
  $(window).scroll(function(){
    if(this.scrollY > 20){
      $(".navbar").addClass("sticky");
      $(".goTop").fadeIn();
    }
      
    else{
      $(".navbar").removeClass("sticky");
      $(".goTop").fadeOut();
    }
      
  });
  
  $(".goTop").click(function(){scroll(0,0)})
  
  $('.menu-toggler').click(function(){
    $(this).toggleClass("active");
    $(".navbar-menu").toggleClass("active");
  });
  
  $(".works").magnificPopup({
    delegate: 'a',
    type: 'image',
    gallery: {enabled:true}
  });


  
});

function sendContact(){
  var name = document.getElementById("name").value;
  var email = document.getElementById("email").value;
  var phone = document.getElementById("phone").value;
  var message = document.getElementById("message").value;
  var error_message = document.getElementById("error_message");
  var text; 

  error_message.style.padding = "15px";

  if(email.indexOf("@") == -1 || email.length < 6){
    text = "Please Enter Valid Email"; 
    error_message.innerHTML = text;
    return false;
  }

  if (isNaN(phone) || phone.length != 10){
    text = "Please Enter Valid Phone Number"; 
    error_message.innerHTML = text;
    return false;
  }

  alert("Form Submitted Successfully!");
  return true; 
}