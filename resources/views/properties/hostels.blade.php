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
        <h2 class="propertyName">{{strtoupper($hostel->name)}}</h2>
        <div class="item5">
          <div class="planSummary">
            <p class="one"><img class="attributeIcon" src="../images/bed.svg"><span class="summaryAttributes">Beds</span><span class="number">{{$hostel->beds}}</span></p>
            <p class="one"><img class="attributeIcon" src="../images/gender.svg">{{$hostel->gender}}</p>
            <p class="one"><img class="attributeIcon" src="../images/location2.svg"><span class="summaryAttributes">{{$hostel->location}}</span></p>
            <p class="one"><img class="attributeIcon" src="../images/house.svg"><span class="summaryAttributes">Available Units</span><span class="number">{{$hostel->units_available}}</span></p>
            <p class="one">Rent:<span class="price">{{$hostel->rent}}</span>/month</p>
          </div>
        <!-- Swiper carousel -->
        <div class="swiper-container">
         <div class="swiper-wrapper">
           <div class="swiper-slide"><img class="slide" src="{{Str::replaceFirst('public/','storage/',asset($hostel->coverImage))}}" alt="sunset"></div>
        @foreach($hostel->images as $image)
           <div class="swiper-slide"><img class="slide" src="{{Str::replaceFirst('public/','storage/',asset($image->url))}}" alt="sunset"></div>
        @endforeach
         </div>
         <!-- Add Pagination -->
         <div class="swiper-pagination"></div>
         <!-- Add Arrows -->
         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>
        </div>
          <form action="/favourites/hostels/{{$hostel->id}}" class="wishform" method="post">
              @csrf
              @auth
                @if(auth()->user()->favourite_hostels->contains($hostel->id))
                  @method('DELETE')
                @endif
              @endauth
            <label class="label">
            <input class="checkbox @auth{{'loggedIn'}}@endauth" type="checkbox" @auth{{auth()->user()->favourite_hostels->contains($hostel->id) ? "checked":" "}}@endauth><span class="check-toggle"></span>
          </label>
        </form>
        </div>
        <div class="item6">
          <div class="section">
            <h4 class="bioHeader">Description</h4>
          </div>
         <p class="bio">{{$hostel->description}}</p>
        </div>
         <div class="item7">
           <div class="section">
             <h4 class="bioHeader">Features</h4>
           </div>
           <div class="description">
             <ul class="feature_list">
               <li><p>Gender:<span>{{$hostel->gender}}</span></p></li>
               <li><p>Location:<span>{{$hostel->location}}</span></p></li>
             </ul>
          </div>
          </div>
          @if ($hostel->community()->exists())
            <div class="item7">
              <div class="section">
                <h4 class="bioHeader">Community</h4>
              </div>
              <div class="bio">
                This hostel is part of <strong>{{$hostel->community->name}}</strong> community.Click on this link to <a href="/communities/{{$hostel->community->id}}">Learn more</a>.
              </div>
            </div>
          @endif
        <div class="item8">
          <div class="owner">
            <h4 class="bioHeader">Submitted By: {{$hostel->hostelable->name}}</h4>
            <img class="OwnerAvatar" src="{{Str::replaceFirst('public/','storage/',asset($hostel->hostelable->logo))}}">
            <p class="bio">Visit this link to contact and learn more about this Owner <a class="contentlink"  href="/owners/{{$hostel->hostelable->id}}">{{$hostel->hostelable->name}}</a>.</p>
          </div>
          <div class="footer">
              <a class="planNav backlink" href="">Back</a>
              <form class="" action="/book_hostel/{{$hostel->id}}" method="post">
                @csrf
                <button class="planNav book_button {{auth()->check() ? "loggedIn" : ""}} {{$hostel->has_available_units() ? "" : "noUnitsAvailable"}} @auth{{$hostel->is_booked() ? "booked" : ""}}@endauth" data-url ="/book_hostel/{{$hostel->id}}" {{$hostel->has_available_units() ? "" : "disabled"}}  type="submit">
                  @if($hostel->is_booked())
                    Already booked
                  @elseif(!$hostel->has_available_units())
                    No Units available
                  @else
                    Book
                  @endif
                  </button>
              </form>
           </div>
        </div>
  </div>
  <script src="{{asset('js/axios.min.js')}}"></script>
  <script src="{{asset('js/notiflix-2.1.3.min.js')}}"></script>
  <script src="{{asset('js/swiper.min.js')}}"></script>
  <script src="{{asset('js/properties/rentals.js')}}"></script>
  </body>
</html>
