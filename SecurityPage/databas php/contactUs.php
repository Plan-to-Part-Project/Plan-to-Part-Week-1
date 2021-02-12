<?php
include("dbconnect.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width= device-width, initial-scale = 1.0" />
    <title>PLAN TO PART</title>
    <link
      rel="shortcut icon"
      href="https://cdn.glitch.com/5a4ae6e4-c67f-4814-ae9f-42123000f196%2Ffavicon-32x32.png?v=1601518716705"
      type="image/x-icon"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/fontawesome.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.cs"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=David+Libre:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
    />
    <link rel="stylesheet" href="Style/contactUs.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="contactUs.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>
  </head>
  <body>
    <!-- This is NavBar -->
   
    <nav class="navbar">
      <div class="inner-width">
        <a href="https://plan-to-part-i.glitch.me/homepage2.html" class="logo"></a>
        <button class="menu-toggler">
        
        </button>
        <!-- Where all the nav bar will list -->

        <div class="navbar-menu">
          <a href="https://plan-to-part-i.glitch.me/homepage2.html"> Home</a>
          <a href="https://web.njit.edu/~ha382/IT491/html5up-hyperspace/#"> Plans</a>
          <a href="https://plan-to-pa.glitch.me/contact.html"> Contact</a>
          <a href="#"> About Us</a>
          <a href="#"> Security</a>
          <a href="#"> Helps</a>
          <a href="https://plan-t.glitch.me/loginpage.html" id="login"> Login </a>
        </div>
      </div>
    </nav>
    <br/>
    <br />
    <br/>
    <br/>
    <br/>
    <br/>
         <!----Contact Form ---->

      <section id="container">
         <div class="contactForm">
            <div class="logan">
                 <h2>Contact Us</h2>
              <br><hr style="margin-left: 0px"><br>
            </div>
            
          <div class="logan1">
            <h2>We'd ♡ to help</h2>
          </div>
          <div class="logan2">
            <h2>Got a question? Our team is happy to answer your question</h2>
          </div>
  
          <div class="contactForm">
           <form action="user_process.php" method="post" name="user">
             <img 
                src="https://cdn.glitch.com/c92254a9-06fa-4f90-bb6a-9076e7a595bf%2Fhappy.jpg?v=1603393587947"
                alt="Happy">
             <div class="inputBox">
               <br /><label style="color: #2196F3;"> Name </label>
    
               <input
                 type="text"
                 name="name"
                 required="required"
                 placeholder="Enter Your Name"
               />
             </div>
             <div class="inputBox">
               <br /><label style="color: #2196F3;"> Email </label>
             
               <input
                 type="text"
                 name="email"
                 required="required"
                 placeholder="Enter Your Email"
               />
               </div>
			   
              <div class="inputBox">
               <br /><label style="color: #2196F3;"> Phone </label>
             
               <input
                 type="text"
                 name="phone"
                 required="required"
                 placeholder="Enter Your Phone Number"
               />
               </div>
			   
             <div class="inputBox">
               
               <br /><label class="label" style="color: #2196F3;"> Message </label>
 
               <textarea
                 type="text"
                 name="message"
                 required="required"
               ></textarea>
             </div>
             
              <div class="inputBox">
                <br /><input
                  type="submit"
                  name="submit"
                  value="SEND"
                  style="color: white;"
                />
              </div>
            </form>
          </div>
        </div>
  </section>


 

    <!-- Footer--->

    <footer>
      <div class="inner-width">
        <div class="policy">
          <a class="bt" href="#">About Us</a>
          <a class="bt" href="#">Plans</a>
          <a class="bt" href="#">Privacy</a>
        </div>

        <div class="copyright">
          &copy; | December 06 2020, <a href="https://plan-to-part-i.glitch.me/homepage2.html" style="color: #2196F3;">Plan To Part </a>
        </div>

        <div class="sm">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </footer>
    <!--Go Back Top-->
    <button class="goTop fas fa-arrow-up"></button>
  </body>
</html>
