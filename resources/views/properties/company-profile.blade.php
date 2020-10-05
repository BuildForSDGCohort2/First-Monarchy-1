<!DOCTYPE html>
<html lang="en">
  <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width" initial-scale="1.0">
   <meta name="description" content="Build your dream home in a photorealistic online environment">
   <meta name="keywords" content="First Monarchy,build,dream,home">
   <title>First Monarchy-Owners</title>
   <link rel="stylesheet" type="text/css" href="{{asset('css/properties/company-stylesheet.css')}}"/>
   <link rel="stylesheet" href="{{asset('css/swiper.min.css')}}">
  </head>
    <body>
      <div class="overlay"></div>
     <div class="container">
        <div class="item1">
          <h1>FIRST MONARCHY</h1>
        </div>
        <div class="item2">
          <h3 class="tagline">VALLEY OF KINGS</h3>
        </div>
        <div class="item3">
          <button class="menuClosed">Menu &#9776;</button>
        </div>
        <div class="item4">
          <button class="menuOpen">&#10060;</button>
          <a class="navigationlink" href="/">Home</a>
          <a class="navigationlink" href="/contact">Contact</a>
          <a class="navigationlink" href="/about">About</a>
        </div>
<div class="item5">
  <div class="planSummary">
    <p class="one"><span class="summaryAttributes">{{$company->name}}</span></p>
    <p class="one"><img class="attributeIcon" src="../images/website.svg"><a class="summaryAttributes navigationlink" href="{{$company->website}}">Visit Website</a></p>
    <p class="one"><img class="attributeIcon" src="../images/envelope.svg"><a class="summaryAttributes navigationlink" href="mailto:{{$company->email}}">{{$company->email}}</a></p>
    <p class="one"><img class="attributeIcon" src="../images/location2.svg"><span class="summaryAttributes">{{$company->address}}</span></p>
  </div>
   <img class="slide" src="../images/glass-chair.jpg" alt="cover">
   <img class="logo" src="{{Str::replaceFirst('public/','storage/',asset($company->logo))}}" alt="$company->name">
</div>
<div class="item6">
  <div class="section">
    <h4 class="sectionHeader">Bio</h4>
  </div>
   <p class="bio">{{$company->bio}}</p>
   <div class="section">
     <h4 class="sectionHeader">Projects</h4>
   </div>
  <div class="section">
    <h4 class="sectionHeader">Contact Us</h4>
  </div>
  We are located at {{$company->address}}.
  <p class="contacts">
    <a class="contact" href="tel:{{$company->email}}"><img class="contact_icon" src="../images/envelope-white.svg" alt="">Email Us</a>
    <a class="contact" href="tel:{{$company->phone}}"><img class="contact_icon" src="../images/phone-white.svg" alt="">Call Us</a>
  </p>
  <p>
    <a class="" href="{{$company->address}}"><img class="social_icon" src="../images/facebook.svg" alt="location"></a>
    <a class="" href="{{$company->address}}"><img class="social_icon" src="../images/twitter.svg" alt="location"></a>
    <a class="" href="{{$company->address}}"><img class="social_icon" src="../images/pinterest.svg" alt="location"></a>
    <a class="" href="{{$company->address}}"><img class="social_icon" src="../images/instagram.svg" alt="location"></a>
  </p>
</div>
    <div class="item8">
    <div class="footer">
        <a class="footerLink backlink" href="">Back</a>
     </div>
    </div>
  </div>
  <script src="{{asset('js/swiper.min.js')}}"></script>
  <script src="{{asset('js/properties/profile.js')}}"></script>
  </body>
</html>
