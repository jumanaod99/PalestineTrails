<?php
session_start();

// جمع الأخطاء من الجلسة
$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];

// تحديد الفورم النشط
$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset();


function showError($error)
{
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

// دالة لتحديد الفورم النشط
function isActiveForm($formName, $activeForm)
{
    return $formName === $activeForm ? 'active' : '';
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Palestine Trails</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    />

    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <header>
      <div id="menu-bar" class="fas fa-bars"></div>

      <a href="#" class="logo"><span>Palestine</span>Trails</a>

      <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#book">Book</a>
        <a href="#packages">Packages</a>
        <a href="#services">Sevices</a>
        <a href="#gallery">Gallery</a>
        <a href="#review">Review</a>
        <a href="#contact">Contact</a>
      </nav>

      <div class="icons">
        <i class="fas fa-search" id="search-btn"></i>
        <i class="fas fa-user" id="login-btn"></i>
      </div>

      <form action="" class="search-bar-container">
        <input type="search" id="search-bar" placeholder="search here..." />
        <label for="search-bar" class="search-label"></label>
      </form>
    </header>


   
<!-- Login Form -->
<div class="login-form-container <?= isActiveForm('login', $activeForm);?>" id="login-form">

    <i class="fas fa-times" id="form-close"></i>
    <form action="login_register.php" method="post"> 
        <h3>Login</h3> 
        <?= showError($errors['login']) ?>
        <input type="email" class="box" name="email" placeholder="Email"> 
        <input type="password" class="box" name="password" placeholder="Enter your password" required /> 
        <input type="submit" value="Login now" class="btn" name="login" /> 
        <input type="checkbox" id="remember" />
        <label for="remember">Remember me</label> 
        <p>Forget password? <a href="#">Click here</a></p>
        <p>Don't have an account? <a href="#" onclick="showForm('register-form')" id="register-link">Register now</a></p>
    </form>
</div>

<!-- Register Form -->
<div id="register-form" class="login-form-container <?= isActiveForm('register', $activeForm);?>">
    <form action="login_register.php" method="post" class="register-box">
        <h3>Create Account</h3>
        <?= showError($errors['register']) ?>
        <input type="text" name="name" class="box" placeholder="Full Name" required />
        <input type="email" class="box" name="email" placeholder="Email" required />
        <input type="password" class="box" name="password" placeholder="Password" required />
        <select name="role" required>
            <option value="">--Select Role--</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <br>
        <label style="font-size: 1.5rem" enctype="multipart/form-data">Upload Profile Photo</label>
        <input type="file" name="photo" class="box" required />
        <input type="submit" name="register" value="Register Now" class="btn" />
        <p>Already have an account? <a href="#" onclick="showForm('login-form')">Login here</a></p>
    </form>
</div>





    <section class="home" id="home">
      <div class="content">
        <h3>adventure is worthwhile</h3>
        <p>dicover new places with us, adventure awaits</p>
        <a href="#" class="btn">discover more</a>
      </div>

      <div class="controls">
        <span class="vid-btn active" data-src="images/vid-1.mp4"></span>
        <span class="vid-btn" data-src="images/vid-2.mp4"></span>
        <span class="vid-btn" data-src="images/vid-3.mp4"></span>
        <span class="vid-btn" data-src="images/vid-4.mp4"></span>
        <span class="vid-btn" data-src="images/vid-5.mp4"></span>
      </div>

        <div class="video-container">
          <video src="images/vid-1.mp4" id="video-slider" loop autoplay muted></video>
        </div>

    </section>

    <section class="book" id="book">
      <h1 class="heading">
        <span>b</span>
        <span>o</span>
        <span>o</span>
        <span>k</span>
        <span class ="space"></span>
        <span>n</span>
        <span>o</span>
        <span>w</span>
      </h1>

      <div class="row">

        <div class="image">
          <img src="images/book-img.jpg" alt="">
        </div>

        <form action="#">
          <div class="inputBox">
            <h3>where to</h3>
            <input type="text" placeholder="place name">
          </div>
          <div class="inputBox">
            <h3>how many</h3>
            <input type="number" placeholder="number of guests">
          </div>
          <div class="inputBox">
            <h3>arrivales</h3>
            <input type="date">
          </div>
          <div class="inputBox">
            <h3>leaving</h3>
            <input type="text" placeholder="place name">
          </div>
          <input type="submit" class="btn" value="book now">
        </form>
      </div>

    </section>


    <section class="packages" id="packages">
      <h1 class="heading">
          <span>p</span>
          <span>a</span>
          <span>c</span>
          <span>k</span>
          <span>a</span>
          <span>g</span>
          <span>e</span>
          <span>s</span>
      </h1>

      <div class="box-container">
       
        <div class="box">
          <img src="images/img1.jpg" alt="">
          <div class="content">
            <h3><i class="fas fa-map-marker-alt"></i> Akka</h3>
            <p>Discover the charm of Akka ancient walls and beautiful harbor</p>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>

            </div>
          <div class="price"> ₪90 <span>₪120</span> </div>
          <a href="#" class="btn"> book now</a>
        </div>
       </div>

       <div class="box">
          <img src="images/img2.jpg" alt="">
          <div class="content">
            <h3><i class="fas fa-map-marker-alt"></i> Jaffa</h3>
            <p>Experience Jaffa’s old city vibes, vibrant markets, and stunning seaside views</p>
           <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>

            </div>
          <div class="price">  ₪90 <span>₪120</span></div>
          <a href="#" class="btn"> book now</a>
        </div>
        </div>

        <div class="box">
          <img src="images/img3.jpg" alt="">
          <div class="content">
            <h3><i class="fas fa-map-marker-alt"></i> Jerusalem</h3>
            <p>Explore Jerusalem’s rich history, sacred sites, and timeless streets</p>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>

            </div>
          <div class="price">  ₪90 <span>₪120</span> </div>
          <a href="#" class="btn"> book now</a>
        </div>
        </div>


         <div class="box">
          <img src="images/img4.jpg" alt="">
          <div class="content">
            <h3><i class="fas fa-map-marker-alt"></i> Haifa</h3>
            <p>Enjoy Haifa’s breathtaking Bahá’í Gardens and panoramic city views</p>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>

            </div>
          <div class="price">  ₪90 <span>₪120</span> </div>
          <a href="#" class="btn"> book now</a>
        </div>
        </div>


         <div class="box">
          <img src="images/img5.jpg" alt="">
          <div class="content">
            <h3><i class="fas fa-map-marker-alt"></i> Nablus</h3>
            <p>Visit Nablus, the city of mountains, heritage markets, and famous olive soap</p>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>

            </div>
          <div class="price">  ₪90 <span>₪120</span> </div>
          <a href="#" class="btn"> book now</a>
        </div>
        </div>



         <div class="box">
          <img src="images/img6.jpg" alt="">
          <div class="content">
            <h3><i class="fas fa-map-marker-alt"></i> Jericho</h3>
            <p>Experience Jericho, one of the world’s oldest cities, and enjoy the iconic cable car ride</p>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>

            </div>
          <div class="price">  ₪90 <span>₪120</span> </div>
          <a href="#" class="btn"> book now</a>
        </div>
       </div>

    </section>


  <section class="services" id="services">
    <h1 class="heading">
        <span>s</span>
        <span>e</span>
        <span>r</span>
        <span>v</span>
        <span>i</span>
        <span>c</span>
        <span>e</span>
        <span>s</span>
    </h1>

    <div class="box-container">
        <div class="box">
            <i class="fas fa-hotel"></i>
            <h3>affordable hotels</h3>
            <p>We offer budget-friendly hotels with great comfort and excellent service, ensuring you enjoy your stay without overspending</p>
        </div>

        <div class="box">
            <i class="fas fa-utensils"></i>
            <h3>food and drinks</h3>
            <p>Taste delicious local and international dishes, with carefully selected restaurants and cafés to make your trip unforgettable.</p>
        </div>

        <div class="box">
            <i class="fas fa-bullhorn"></i>
            <h3>safety guide</h3>
            <p>Your safety is our priority. Our professional guides ensure a secure, smooth, and well-organized travel experience</p>
        </div>

        <div class="box">
            <i class="fas fa-globe-asia"></i>
            <h3>around the world</h3>
            <p>Explore top destinations worldwide with customized travel packages designed to match your interests and budget</p>
        </div>

        <div class="box">
            <i class="fas fa-plane"></i>
            <h3>fastest travel</h3>
            <p>Enjoy quick and hassle-free travel options, from transportation arrangements to fast booking services</p>
        </div>

        <div class="box">
            <i class="fas fa-hiking"></i>
            <h3>adventures</h3>
            <p>Experience exciting adventures, from hiking and sightseeing to unique cultural activities tailored for thrill-seekers</p>
        </div>
    </div>
</section>


    <section class="gallery" id="gallery">

      <h1 class="heading">
        <span>g</span>
        <span>a</span>
        <span>l</span>
        <span>l</span>
        <span>e</span>
        <span>r</span>
        <span>y</span>
      </h1>

      <div class="box-container">
        <div class="box">
          <img src="images/g-1.jpg" alt="">
          <div class="content">
            <h3>Bahá’í Gardens</h3>
            <p>The Bahá’í Gardens are among the most beautiful gardens in the world, featuring stunning terraces and a breathtaking view of Haifa Bay</p>
          </div>
        </div>


        <div class="box">
          <img src="images/g-2.jpg" alt="">
          <div class="content">
            <h3>Hisham’s Palace</h3>
            <p>Hisham’s Palace is a remarkable archaeological site from the Umayyad era, known for its stunning mosaics and rich history</p>
          </div>
        </div>


        <div class="box">
          <img src="images/g-3.jpg" alt="">
          <div class="content">
            <h3>Mount of Precipice</h3>
            <p>Mount of Precipice offers a breathtaking panoramic view of Nazareth and the surrounding valleys</p>
          </div>
        </div>


        <div class="box">
          <img src="images/g-4.jpg" alt="">
          <div class="content">
            <h3>Wadi Qelt</h3>
            <p>Wadi Qelt is a stunning natural valley featuring scenic landscapes, hiking trails, and an ancient monastery nestled between the cliffs</p>
          </div>
        </div>


        <div class="box">
          <img src="images/g-5.jpg" alt="">
          <div class="content">
            <h3>Jericho Cable Car</h3>
            <p>The Jericho Cable Car offers a unique ride from the base of the mountain to the Monastery of Temptation with a stunning view.</p>
        
          </div>
        </div>


        <div class="box">
          <img src="images/g-6.webp" alt="">
          <div class="content">
            <h3>Jerusalem Old City</h3>
            <p>Narrow streets and traditional markets full of history and culture</p>
          </div>
        </div>


        <div class="box">
          <img src="images/g-7.jpg" alt="">
          <div class="content">
            <h3>Sea of Galilee</h3>
            <p>A scenic lake surrounded by mountains and resorts</p>
          </div>
        </div>


        <div class="box">
          <img src="images/g-8.jpg" alt="">
          <div class="content">
            <h3>Tell es-Sultan</h3>
            <p>An ancient archaeological site considered one of the world’s oldest cities</p>
          </div>
        </div>


        <div class="box">
          <img src="images/g-9.jpg" alt="">
          <div class="content">
            <h3>Al-Aqsa Mosque</h3>
            <p>One of the most significant religious landmarks with iconic architecture</p>
          </div>
        </div>

      </div>
    </section>

<section class="review" id="review">
  <h1 class="heading">
        <span>r</span>
        <span>e</span>
        <span>v</span>
        <span>i</span>
        <span>e</span>
        <span>w</span>
      </h1>
      <div class="swiper-container review-slider">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="box">
              <img src="images/pic1.png" alt="">
              <h3>Laila Hassan</h3>
              <p>I liked how simple the website is. It helped me choose nice places to visit. The trip was fun and memorable.</p>
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
              </div>
            </div>
          </div>
           <div class="swiper-slide">
            <div class="box">
              <img src="images/pic2.png" alt="">
              <h3>Omar Youssef</h3>
              <p>The website helped me discover new places in Palestine. Everything was clear and easy. I enjoyed the experience.</p>
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
              </div>
            </div>
          </div>
           <div class="swiper-slide">
            <div class="box">
              <img src="images/pic3.png" alt="">
              <h3>sara ali</h3>
              <p>The website was easy to use and helped me find beautiful places in Palestine. I really enjoyed the trip and the experience. I recommend this site for anyone who loves travel.</p>
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
              </div>
            </div>
          </div>
           <div class="swiper-slide">
            <div class="box">
              <img src="images/pic4.png" alt="">
              <h3>John Smith</h3>
              <p>This website made it easy to plan my trip. I found many beautiful places in Palestine. I had a great time.</p>
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>

<section class="contact">
  <h1 class="heading">
        <span>c</span>
        <span>o</span>
        <span>n</span>
        <span>t</span>
        <span>a</span>
        <span>c</span>
        <span>t</span>
      </h1>
      <div class="row">
        <div class="image">
          <img src="images/contact-img.jpg" alt="">
        </div>
        <form action="">
          <div class="inputBox">
            <input type="text" placeholder="name">
            <input type="email" placeholder="email">
          </div>
           <div class="inputBox">
            <input type="number" placeholder="number">
            <input type="text" placeholder="subject">
          </div>
          <textarea placeholder="massage" name="" id="" cols="30" row="10"></textarea>
          <input type="submit" class="btn" value="send massege">
        </form>
      </div>
</section>

<section class="footer">
  <div class="box-container">
    <div class="box">
      <h3>about us</h3>
      <p>We are a travel company dedicated to creating unforgettable journeys across Palestine, offering unique tours, professional guidance, and exceptional service to help visitors discover the beauty, culture, and history of our homeland.</p>
    </div>
       <div class="box">
      <h3>branch locations</h3>
      <a href="#">Jerusalem</a>
      <a href="#">Ramallah</a>
      <a href="#">Gaza</a>
      <a href="#">Bethlehem</a>
      <a href="#">Nablus</a>
    </div>
     <div class="box">
      <h3>quick links</h3>
      <a href="#">home</a>
      <a href="#">book</a>
      <a href="#">package</a>
      <a href="#">services</a>
      <a href="#">gallery</a>
      <a href="#">review</a>
      <a href="#">contact</a>
    </div>
    <div class="box">
      <h3>follow us</h3>
      <a href="https://www.facebook.com/palestinetrail">facebook</a>
      <a href="https://www.instagram.com/palestinetrail">instagram</a>
      <a href="https://twitter.com/palestinetrail">twitter</a>
      <a href="https://www.linkedin.com/in/palestinetrail">linkedin</a>
    </div>
  </div>

  <h1 class="credit"> <span>Created by: Sewar, Aya, and Jumana.</span></h1>
</section>

  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>