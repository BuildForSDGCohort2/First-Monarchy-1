<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width" initial-scale="1.0">
    <meta name="description" content="Build a dream home,workspace or Public utility in a photorealistic online environment">
    <meta name="keywords" content="First Monarchy,build,dream,home">
    <title>First Monarchy-Professionals</title>
    <link rel="stylesheet" href="{{asset('css/swiper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/properties/professionals-stylesheet.css')}}"/>
    <title>Find a Home Or Workspace</title>
  </head>
  <body>
    <div class="overlay"></div>
    <div class="HeaderContainer">
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
          <h4 class="descriptor-text">BROWSE REAL ESTATE PROFESSIONAL PROFILES</h4>
        </div>
      <div class="callsToAction">
        <div class="item5">
          <p class="note">Get professional help</p>
          <a href="#explore" class="CallToAction">EXPLORE</a>
        </div>
        <div class="item6">
          <p class="note">List your company</p>
          <a href="/register/companies" class="CallToAction">REGISTER</a>
        </div>
      </div>
  		<div class="item7">
        <button class="menuOpen">&#10060;</button>
        <a class="navigationlink" title="Homepage" href="/">Home</a>
        <a class="navigationlink" title="About page" href="/about">About</a>
        <a class="navigationlink" title="Contact page" href="/contact">Contact</a>
  	    </div>
        <div class="item8">
        </div>
    </div>
    <div class="mainContainer">
      <h3 id="explore">Explore First Monarchy</h3>
      <div class="categoryContainer">
        @foreach($categories as $category)
          <button class = "category">
      	     <img class ="categoriesIcon" src="{{Str::replaceFirst('public/','storage/',asset($category->coverImage))}}">
      			 <div class="description">
      			     <p>{{$category->name}}</p>
      			     <!-- <p>Apartments</p> -->
                 <a class="hiddenLink" href="/categories/{{$category->id}}"></a>
      			</div>
          </button>
        @endforeach
      </div>
        <div class="footer">
          First Monarchy.All Rights Reserved.Terms and Conditions.
        </div>
  </div>
    <script src="{{asset('js/swiper.min.js')}}"></script>
    <script src="{{asset('js/properties/professionals.js')}}"></script>
  </body>
</html>
