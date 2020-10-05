<!DOCTYPE html>
<html lang="en">
  <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width" initial-scale="1.0">
   <meta name="description" content="Build your dream home in a photorealistic online environment">
   <meta name="keywords" content="First Monarchy,build,dream,home">
   <title>First Monarchy-Build your dream home</title>
   <link rel="stylesheet" type="text/css" href="{{asset('css/notiflix-2.1.3.min.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar/core/main.min.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar/daygrid/main.min.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar/timegrid/main.min.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar/list/main.min.css')}}"/>
   <link rel="stylesheet" href="{{asset('css/swiper.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('css/properties/rentals-stylesheet.css')}}"/>
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
        <h2 class="propertyName">{{strtoupper($rental->name)}}</h2>
        <div class="item5">
          <div class="planSummary">
            <p class="one"><img class="attributeIcon" src="../images/bed.svg"><span class="summaryAttributes">Bedrooms</span><span class="number">{{$rental->bedrooms}}</span></p>
            <p class="one"><img class="attributeIcon" src="../images/bathtub.svg"><span class="summaryAttributes">Bathrooms</span>{{$rental->bathrooms}}</p>
            <p class="one"><img class="attributeIcon" src="../images/location2.svg"><span class="summaryAttributes">{{$rental->location}}</span></p>
            <p class="one"><img class="attributeIcon" src="../images/house.svg"><span class="summaryAttributes">Available Units</span><span class="number">{{$rental->units_available}}</span></p>
            <p class="one">Rent:<span class="price">{{$rental->rent}}</span>/month</p>
          </div>
        <!-- Swiper carousel -->
        <div class="swiper-container">
         <div class="swiper-wrapper">
           <div class="swiper-slide"><img class="slide" src="{{Str::replaceFirst('public/','storage/',asset($rental->coverImage))}}" alt="sunset"></div>
        @foreach($rental->images as $image)
           <div class="swiper-slide">
             <img class="swiper-lazy slide" data-src="{{Str::replaceFirst('public/','storage/',asset($image->url))}}" alt="sunset">
             <div class="swiper-lazy-preloader"></div>
           </div>
        @endforeach
         </div>
         <!-- Add Pagination -->
         <div class="swiper-pagination"></div>
         <!-- Add Arrows -->
         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>
        </div>
          <form action="/favourites/rentals/{{$rental->id}}" class="wishform" method="post">
            @csrf
            @auth
              @if(auth()->user()->favourite_rentals->contains($rental->id))
                @method('DELETE')
              @endif
            @endauth
          <label class="label">
          <input class="checkbox @auth{{'loggedIn'}}@endauth" data-url = "/favourites/rentals/{{$rental->id}}" type="checkbox" @auth{{auth()->user()->favourite_rentals->contains($rental->id) ? "checked":" "}}@endauth><span class="check-toggle"></span>
        </label>
        </form>
        </div>
        <div class="item6">
          <div class="section">
            <h4 class="bioHeader">Description</h4>
          </div>
         <p class="bio">{{$rental->description}}</p>
        </div>
        <div class="item7">
          <div class="section">
            <h4 class="bioHeader">Features</h4>
          </div>
          <div class="description">
            <ul class="feature_list">
              <li><p>Bathrooms:<span>{{$rental->bathrooms}}</span></p></li>
              <li><p>bedrooms:<span>{{$rental->bedrooms}}</span></p></li>
              <li><p>Parking(cars per unit):<span>{{$rental->parking_slots}}</span></p></li>
            </ul>
         </div>
         </div>
         @if ($rental->community()->exists())
           <div class="item7">
             <div class="section">
               <h4 class="bioHeader">Community</h4>
             </div>
             <div class="bio">
               This property is part of <strong>{{$rental->community->name}}</strong> community.Click on this link to <a href="/communities/{{$rental->community->id}}">Learn more</a>.
             </div>
           </div>
         @endif
          <div class="item8">
              <div class="owner">
                <h4 class="bioHeader">Submitted By: {{$rental->rentalable->name}}</h4>
                <img class="OwnerAvatar" src="{{Str::replaceFirst('public/','storage/',asset($rental->rentalable->logo))}}">
                <p class="bio">Visit this link to contact and learn more about this Owner <a class="contentlink"  href="/owners/{{$rental->rentalable->id}}">{{$rental->rentalable->name}}</a>.</p>
              </div>
              <div id = "schedule" class="modal">
                <div class="modalContent">
                  <h3>Select date and time</h3>
                  <button class="close closeModal" type="button" data-id="schedule"><img src="../images/close1.svg"></button>
                  <div id = "calendar-container" class="">
                    <div id="calendar" class="">

                    </div>
                  </div>
                  <p style = "color:#2c3e50; font-size:0.9em;"><strong>
                    *Click or Touch and hold to select.<br>
                  *All time windows are 2 hours long<br>
                  </strong></p>
                </div>
              </div>
              <div class="footer">
                <button type="button" class="scheduleButton planNav showModal @auth loggedIn @endauth" data-id = "schedule" data-url = "/visits/rentals/{{$rental->id}}" @auth
                  @if ($rental->visits()->where('user_id',auth()->id())->exists())
                    disabled
                  @endif
                @endauth>
                @auth
                  @if ($rental->visits()->where('user_id',auth()->id())->exists())
                    Scheduled visit on {{$rental->visits()->where('user_id',auth()->id())->first()->human_date}}
                  @else
                    Schedule Viewing
                  @endif
                @endauth
                @guest
                  Schedule Viewing
                @endguest
              </button>
                  <form class="bookform dummyForm" action="/book_rental/{{$rental->id}}" method="post">
                    @csrf
                    <button class="planNav book_button {{auth()->check() ? "loggedIn" : ""}} {{$rental->has_available_units() ? "" : "noUnitsAvailable"}} @auth{{$rental->is_booked() ? "booked" : ""}}@endauth" data-url ="/book_rental/{{$rental->id}}" {{$rental->has_available_units() ? "" : "disabled"}}  type="submit">
                      @if($rental->is_booked())
                        Already booked
                      @elseif(!$rental->has_available_units())
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
  <script src = "{{asset('js/fullcalendar/core/main.min.js')}}"></script>
  <script src = "{{asset('js/fullcalendar/daygrid/main.min.js')}}"></script>
  <script src = "{{asset('js/fullcalendar/timegrid/main.min.js')}}"></script>
  <script src = "{{asset('js/fullcalendar/list/main.min.js')}}"></script>
  <script src = "{{asset('js/fullcalendar/interaction/main.min.js')}}"></script>
  <script src="{{asset('js/properties/rentals.js')}}"></script>
  </body>
</html>
