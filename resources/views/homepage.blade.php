<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width"  initial-scale = "1.0">
  <link type= "text/css" rel="stylesheet" href="{{ asset('css/homepage-stylesheet.css') }}"/>
  <title>First Monarchy-Homepage</title>
 </head>
 <body>
 <div class="overlay">
 </div>
 <div class="container">
   <div class="item1">
    <h1>FIRST MONARCHY</h1>
   </div>
   <div class="item2">
     <h3>VALLEY OF KINGS</h3>
   </div>
   <div class="item3">
    <button class="menuClosed">Menu &#9776;</button>
   </div>
   <div class="item4">
     <p class="descriptor-text">YOUR DREAM,OUR PASSION</p>
   </div>
   <div class="item5">
     <div class="linkContainer">
         <!-- <div class="mainlinks"><a class="contentlink" title="Build a home or workspace" href="/ideas">HOME DESIGN IDEAS</a></div> -->
         <div class="mainlinks3"><a class="contentlink" title="Continue your build" href="/professionals">MEET A PROFESSIONAL</a></div>
         <div class="mainlinks4"><a class="contentlink" title="Buy a home or workspace" href="/properties">FIND A HOME OR WORKSPACE</a></div>
         <div class="mainlinks2"><a class="contentlink" title="Visit our online store" href="/login/admins">MONARCHY STORE</a></div>
          <div class="mainlinks2"><a class="contentlink" title="Browse our collection of designs" href="/Ideas">DESIGN IDEAS</a></div>
	  </div>
   </div>
   <div class="item6">
    <button class="menuOpen">&#10060;</button>
    <div class="footernav3"><a class="navigationlink" title="About" href="/about">About</a></div>
    @guest
    <div class="footernav1"><a class="navigationlink login" title="Log in to your account" href="/login">Log In</a></div>
    <div class="footernav2"><a class="navigationlink register" title="Create an account" href="/register">Register</a></div>
    @else
      <div class="footernav6"><a id ="logoutLink" class="navigationlink" href="{{ route('logout') }}">Logout</a>
         <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
           @csrf
         </form>
      </div>
      <div class="footernav7"><a class="navigationlink" href="/lounge">Lounge</a></div>
      @endauth
    <div class="footernav4"><a class="navigationlink" title="Contact" href="/agents">Contact</a></div>
    <div class="footernav5"><a class="navigationlink" title="Privacy&Legal" href="/privacy&legal">Privacy & Legal </a></div>
   </div>
  </div>
  <script src="{{ asset('js/homepagescript.js') }}"></script>
 </body>
</html>
