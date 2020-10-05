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
        <h2 class="propertyName">{{strtoupper($community->name)}}</h2>
        <div class="item5">
          <div class="planSummary">
            <p class="one"><span class="summaryAttributes">{{$community->name}}</span></p>
            <p class="one"><img class="attributeIcon" src="../images/house.svg"><span class="summaryAttributes">Total Acreage</span><span class="number">{{$community->acreage}}</span></p>
            <p class="one"><img class="attributeIcon" src="../images/home.svg"><span class="summaryAttributes">Types of Units</span>{{$community->rentals->count() + $community->hostels->count() + $community->standalones->count() + $community->workspaces->count()}}</p>
            <p class="one"><img class="attributeIcon" src="../images/location2.svg"><span class="summaryAttributes">{{$community->location}}</span></p>
            {{-- <p class="one"><img class="attributeIcon" src="../images/building.svg"><span class="summaryAttributes">House Typologies</span><span class="number">{{$community->rentals->count() + $community->hostels->count() + $community->standalones->count() + $community->workspaces->count()}}</span></p> --}}
          </div>
        <!-- Swiper carousel -->
        <div class="swiper-container">
         <div class="swiper-wrapper">
           <div class="swiper-slide"><img class="slide" src="{{Str::replaceFirst('public/','storage/',asset($community->coverImage))}}" alt="sunset"></div>
        @foreach($community->images as $image)
           <div class="swiper-slide"><img class="slide" src="{{Str::replaceFirst('public/','storage/',asset($image->url))}}" alt="sunset"></div>
        @endforeach
         </div>
         <!-- Add Pagination -->
         <div class="swiper-pagination"></div>
         <!-- Add Arrows -->
         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>
        </div>
          <form action="/favourites/communities/{{$community->id}}" class="wishform" method="post">
            @csrf
            @auth
              @if(auth()->user()->favourite_communities->contains($community->id))
                @method('DELETE')
              @endif
            @endauth
          <label class="label">
          <input class="checkbox @auth{{'loggedIn'}}@endauth" type="checkbox" @auth{{auth()->user()->favourite_communities->contains($community->id) ? "checked":" "}}@endauth><span class="check-toggle"></span>
        </label>
        </form>
        </div>
        <div class="item6">
          <div class="section">
            <h4 class="bioHeader">Description</h4>
          </div>
          <p class="bio">{{$community->description}}</p>
        </div>
        <div class="item7 typesOfUnitsAvailable">
          <div class="section">
            <h4 class="bioHeader">House Typologies Available</h4>
          </div>
          <div class="unitDescription">
            @foreach($community->rentals as $unit)
              <div class="unitContainer">
                 <img class="unitImage" src="{{Str::replaceFirst('public/','storage/',asset($unit->coverImage))}}" alt="{{$community->name}} {{$unit->name}}">
                 <span>{{Str::plural($unit->name)}}</span>
                 <span>{{$unit->units_available}} available</span>
                 <a class="hiddenLink" href="/rentals/{{$unit->id}}"></a>
              </div>
            @endforeach
            @foreach($community->hostels as $unit)
              <div class="unitContainer">
                 <img class="unitImage" src="{{Str::replaceFirst('public/','storage/',asset($unit->coverImage))}}" alt="{{$community->name}} {{$unit->name}}">
                 <span>{{Str::plural($unit->name)}}</span>
                 <span>{{$unit->units_available}} available</span>
                 <a class="hiddenLink" href="/hostels/{{$unit->id}}"></a>
              </div>
            @endforeach
            @foreach($community->standalones as $unit)
              <div class="unitContainer">
                 <img class="unitImage" src="{{Str::replaceFirst('public/','storage/',asset($unit->coverImage))}}" alt="{{$community->name}} {{$unit->name}}">
                 <span>{{Str::plural($unit->name)}}</span>
                 <span>{{$unit->units_available}} available</span>
                 <a class="hiddenLink" href="/standalones/{{$unit->id}}"></a>
              </div>
            @endforeach
            @foreach($community->workspaces as $unit)
              <div class="unitContainer">
                 <img class="unitImage" src="{{Str::replaceFirst('public/','storage/',asset($unit->coverImage))}}" alt="{{$community->name}} {{$unit->name}}">
                 <span>{{Str::plural($unit->name)}}</span>
                 <span>{{$unit->units_available}} available</span>
                 <a class="hiddenLink" href="/workspaces/{{$unit->id}}"></a>
              </div>
            @endforeach
         </div>
         </div>
         <div class="item7">
             <div class="section">
               <h4 class="bioHeader">Features</h4>
             </div>

          </div>
            <div class="item8">
            <div class="owner">
              <h4 class="bioHeader">Submitted By: {{$community->communityable->name}}</h4>
              <img class="OwnerAvatar" src="{{Str::replaceFirst('public/','storage/',asset($community->communityable->logo))}}">
              <p class="bio">Visit this link to contact and learn more about this Owner <a class="contentlink"  href="/owners/{{$community->communityable->id}}">{{$community->communityable->name}}</a>.</p>
            </div>
            <div class="footer">
                <a class="planNav backlink" href="">Back</a>
             </div>
            </div>
  </div>
  <script src="{{asset('js/axios.min.js')}}"></script>
  <script src="{{asset('js/notiflix-2.1.3.min.js')}}"></script>
  <script src="{{asset('js/swiper.min.js')}}"></script>
  <script src="{{asset('js/properties/communities.js')}}"></script>
  </body>
</html>
