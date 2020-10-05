<!DOCTYPE html>
<html lang="en">
  <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width" initial-scale="1.0">
   <meta name="description" content="Build your dream home in a photorealistic online environment">
   <meta name="keywords" content="First Monarchy,build,dream,home">
   <title>First Monarchy-Build your dream home</title>
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
        <h2 class="propertyName">{{strtoupper($communityUnit->community->name)}} {{strtoupper($communityUnit->name)}}</h2>
        <div class="item5">
          <div class="planSummary">
            <p class="one"><span class="summaryAttributes">{{$communityUnit->community->name}} {{$communityUnit->name}}</span></p>
            <p class="one"><img class="attributeIcon" src="../images/bed.svg"><span class="summaryAttributes">Bedrooms</span><span class="number">{{$communityUnit->bedrooms}}</span></p>
            <p class="one"><img class="attributeIcon" src="../images/bathtub.svg"><span class="summaryAttributes">Bathrooms</span>{{$communityUnit->bathrooms}}</p>
            <p class="one"><img class="attributeIcon" src="../images/house.svg"><span class="summaryAttributes">Available Units</span><span class="number">{{$communityUnit->units_available}}</span></p>
            <p class="one">Rent:<span class="currency">Kshs</span><span class="price">{{$communityUnit->rent}}/mo</span></p>
          </div>
        <!-- Swiper carousel -->
        <div class="swiper-container">
         <div class="swiper-wrapper">
           <div class="swiper-slide"><img class="slide" src="{{Str::replaceFirst('public/','storage/',asset($communityUnit->coverImage))}}" alt="sunset"></div>
        @foreach($communityUnit->images as $image)
           <div class="swiper-slide"><img class="slide" src="{{Str::replaceFirst('public/','storage/',asset($image->url))}}" alt="sunset"></div>
        @endforeach
         </div>
         <!-- Add Pagination -->
         <div class="swiper-pagination"></div>
         <!-- Add Arrows -->
         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>
        </div>
        </div>
        <div class="item6">
            <div class="section">
              <h4 class="bioHeader">Description</h4>
            </div>
           <p class="bio">{{$communityUnit->description}}</p>
        </div>
        <div class="item7">
          <div class="section">
            <h4 class="bioHeader">Amenities</h4>
          </div>
         </div>
          <div class="item8">
            <div class="architect">
              <h4 class="bioHeader">Part of the {{$communityUnit->community->name}} Community</h4>
              <img class="OwnerAvatar" src="{{Str::replaceFirst('public/','storage/',asset($communityUnit->community->coverImage))}}">
              <p class="bio">Visit this link to learn more about this Community <a class="contentlink"  href="/communities/{{$communityUnit->community_id}}">{{$communityUnit->community->name}}</a>.</p>
            </div>
            <div class="footer">
                <a class="planNav" href="#">Back</a>
             </div>
          </div>
  </div>
  <script src="{{asset('js/swiper.min.js')}}"></script>
  <script src="{{asset('js/properties/rentals.js')}}"></script>
  </body>
</html>
