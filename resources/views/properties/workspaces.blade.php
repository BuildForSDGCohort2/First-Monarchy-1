<!DOCTYPE html>
<html lang="en">
  <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width" initial-scale="1.0">
   <meta name="description" content="Build your dream home in a photorealistic online environment">
   <meta name="keywords" content="First Monarchy,build,dream,home">
   <title>First Monarchy- Workspaces</title>
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
        <h2 class="propertyName">{{strtoupper($workspace->name)}}</h2>
        <div class="item5">
          <div class="planSummary">
            <p class="one"><img class="attributeIcon" src="../images/bed.svg"><span class="summaryAttributes">Rooms</span><span class="number">{{$workspace->rooms}}</span></p>
            <p class="one"><img class="attributeIcon" src="../images/house.svg"><span class="summaryAttributes">Area</span>{{$workspace->area}} sq Metres</p>
            <p class="one"><img class="attributeIcon" src="../images/location2.svg"><span class="summaryAttributes">{{$workspace->location}}</span></p>
            <p class="one"><img class="attributeIcon" src="../images/building.svg"><span class="summaryAttributes">Available Units</span><span class="number">{{$workspace->units_available}}</span></p>
            <p class="one">From:<span class="price">{{$workspace->rent}}</span>/month</p>
          </div>
        <!-- Swiper carousel -->
        <div class="swiper-container">
         <div class="swiper-wrapper">
           <div class="swiper-slide"><img class="slide" src="{{Str::replaceFirst('public/','storage/',asset($workspace->coverImage))}}" alt="sunset"></div>
        @foreach($workspace->images as $image)
           <div class="swiper-slide"><img class="slide" src="{{Str::replaceFirst('public/','storage/',asset($image->url))}}" alt="sunset"></div>
        @endforeach
         </div>
         <!-- Add Pagination -->
         <div class="swiper-pagination"></div>
         <!-- Add Arrows -->
         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>
        </div>
          <form action="/favourites/workspaces/{{$workspace->id}}" class="wishform" method="post">
            @csrf
            @auth
              @if(auth()->user()->favourite_workspaces->contains($workspace->id))
                @method('DELETE')
              @endif
            @endauth
          <label class="label">
          <input class="checkbox @auth{{'loggedIn'}}@endauth" type="checkbox" @auth{{auth()->user()->favourite_workspaces->contains($workspace->id) ? "checked":" "}}@endauth><span class="check-toggle"></span>
        </label>
        </form>
        </div>
        <div class="item6">
            <div class="section">
              <h4 class="bioHeader">Description</h4>
            </div>
           <p class="bio">{{$workspace->description}}</p>
        </div>
        <div class="item7">
          <div class="section">
            <h4 class="bioHeader">Features</h4>
          </div>
          <div class="description">
            <ul class="feature_list">
              <li><p>Area:<span>{{$workspace->area}}m<sup>2</sup></span></p></li>
            </ul>
         </div>
         </div>
         @if ($workspace->community()->exists())
           <div class="item7">
             <div class="section">
               <h4 class="bioHeader">Community</h4>
             </div>
             <div class="bio">
               This property is part of <strong>{{$workspace->community->name}}</strong> community.Click on this link to <a href="/communities/{{$workspace->community->id}}">Learn more</a>.
             </div>
           </div>
         @endif
        <div class="item8">
            <div class="owner">
              <h4 class="bioHeader">Submitted By: {{$workspace->workspaceable->name}}</h4>
              <img class="OwnerAvatar" src="{{Str::replaceFirst('public/','storage/',asset($workspace->workspaceable->logo))}}">
              <p class="bio">Visit this link to contact and learn more about this Owner <a class="contentlink"  href="/owners/{{$workspace->workspaceable->id}}">{{$workspace->workspaceable->name}}</a>.</p>
            </div>
            <div class="footer">
                <a class="planNav backlink" href="">Back</a>
                <form class="" action="/book_workspace/{{$workspace->id}}" method="post">
                  @csrf
                  <button class="planNav book_button {{auth()->check() ? "loggedIn" : ""}} {{$workspace->has_available_units() ? "" : "noUnitsAvailable"}} @auth{{$workspace->is_booked() ? "booked" : ""}}@endauth" data-url ="/book_workspace/{{$workspace->id}}" {{$workspace->has_available_units() ? "" : "disabled"}}  type="submit">
                    @if($workspace->is_booked())
                      Already booked
                    @elseif(!$workspace->has_available_units())
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
