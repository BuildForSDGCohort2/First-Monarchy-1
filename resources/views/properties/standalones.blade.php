<!DOCTYPE html>
<html lang="en">
  <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width" initial-scale="1.0">
   <meta name="description" content="Build your dream home in a photorealistic online environment">
   <meta name="keywords" content="First Monarchy,build,dream,home">
   <title>First Monarchy-Build your dream home</title>
   <link rel="stylesheet" type="text/css" href="{{asset('css/notiflix-2.1.3.min.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('css/properties/rentals-stylesheet.css')}}"/>
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
        <h2 class="propertyName">{{strtoupper($standalone->name)}}</h2>
        <div class="item5">
          <div class="planSummary">
            <p class="one"><img class="attributeIcon" src="../images/bed.svg"><span class="summaryAttributes">Bedrooms</span><span class="number">{{$standalone->bedrooms}}</span></p>
            <p class="one"><img class="attributeIcon" src="../images/bathtub.svg"><span class="summaryAttributes">Bathrooms</span>{{$standalone->bathrooms}}</p>
            <p class="one"><img class="attributeIcon" src="../images/location2.svg"><span class="summaryAttributes">{{$standalone->location}}</span></p>
            <p class="one"><img class="attributeIcon" src="../images/house.svg"><span class="summaryAttributes">Available Units</span><span class="number">{{$standalone->units_available}}</span></p>
            <p class="one">Price:<span class="price">{{$standalone->selling_price}}</span></p>
          </div>
        <!-- Swiper carousel -->
        <div class="swiper-container">
         <div class="swiper-wrapper">
           <div class="swiper-slide"><img class="slide" src="{{Str::replaceFirst('public/','storage/',asset($standalone->coverImage))}}" alt="sunset"></div>
        @foreach($standalone->images as $image)
           <div class="swiper-slide"><img class="slide" src="{{Str::replaceFirst('public/','storage/',asset($image->url))}}" alt="sunset"></div>
        @endforeach
         </div>
         <!-- Add Pagination -->
         <div class="swiper-pagination"></div>
         <!-- Add Arrows -->
         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>
        </div>
          <form action="/favourites/standalones/{{$standalone->id}}" class="wishform" method="post">
            @csrf
            @auth
            @if(auth()->user()->favourite_standalones->contains($standalone->id))
            @method('DELETE')
            @endif
          @endauth
          <label class="label">
          <input class="checkbox @auth{{'loggedIn'}}@endauth" type="checkbox" @auth{{auth()->user()->favourite_standalones->contains($standalone->id) ? "checked":" "}}@endauth><span class="check-toggle"></span>
        </label>
        </form>
        </div>
        <div class="item6">
          <div class="section">
            <h4 class="bioHeader">Description</h4>
          </div>
          <p class="bio">{{$standalone->description}}</p>
        </div>
        <div class="item7">
          <div class="section">
            <h4 class="bioHeader">Features</h4>
          </div>
          <div class="description">
            <ul class="feature_list">
              <li><p>Bathrooms:<span>{{$standalone->bathrooms}}</span></p></li>
              <li><p>bedrooms:<span>{{$standalone->bedrooms}}</span></p></li>
              <li><p>Garage size (cars):<span>{{$standalone->parking_slots}}</span></p></li>
              <li><p>Area:<span>{{$standalone->area}}m<sup>2</sup></span></p></li>
              <li><p>Plot Size the Property Occupies:<span>{{$standalone->plot_size}}</span></p></li>
              <li><p>Year Built:<span>{{\Carbon\Carbon::parse($standalone->year_built)->year}}</span></p></li>
            </ul>
         </div>
         </div>
         @if ($standalone->community()->exists())
           <div class="item7">
             <div class="section">
               <h4 class="bioHeader">Community</h4>
             </div>
             <div class="bio">
               This property is part of <strong>{{$standalone->community->name}}</strong> community.Click on this link to <a href="/communities/{{$standalone->community->id}}">Learn more</a>.
             </div>
           </div>
         @endif
        <div class="item8">
          <div class="owner">
            <h4 class="bioHeader">Submitted By: {{$standalone->standaloneable->name}}</h4>
            <img class="OwnerAvatar" src="{{Str::replaceFirst('public/','storage/',asset($standalone->standaloneable->logo))}}">
            <p class="bio">Visit this link to contact and learn more about this Owner <a class="contentlink"  href="architect.html">{{$standalone->standaloneable->name}}</a>.</p>
          </div>
          <div class="footer">
              <a class="planNav backlink" href="">Back</a>
           </div>
        </div>
  </div>
  <script src="{{asset('js/axios.min.js')}}"></script>
  <script src="{{asset('js/notiflix-2.1.3.min.js')}}"></script>
  <script src="{{asset('js/swiper.min.js')}}"></script>
  <script src="{{asset('js/properties/rentals.js')}}"></script>
  </body>
</html>
