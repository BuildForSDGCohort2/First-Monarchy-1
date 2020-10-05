<!DOCTYPE html>
<html lang="en">
  <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width" initial-scale="1.0">
   <meta name="description" content="Build your dream home in a photorealistic online environment">
   <meta name="keywords" content="First Monarchy,build,dream,home">
   <title>First Monarchy-Owners</title>
   <link rel="stylesheet" href="{{asset('css/swiper.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('css/properties/owners-stylesheet.css')}}"/>
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
    <p class="one"><img class="attributeIcon" src="../images/phone.svg"><a class="summaryAttributes navigationlink" href="tel:{{$owner->phone_number}}">{{$owner->phone_number}}</a></p>
    <p class="one"><img class="attributeIcon" src="../images/avatar.svg"><span class="summaryAttributes">{{$owner->name}}</span></p>
    <p class="one"><img class="attributeIcon" src="../images/envelope.svg"><a class="summaryAttributes navigationlink" href="mailto:{{$owner->email}}">{{$owner->email}}</a></p>
  </div>
   <img class="slide" src="../images/glass-chair.jpg" alt="cover">
   <img class="logo" src="{{Str::replaceFirst('public/','storage/',asset($owner->logo))}}" alt="$owner->name">
</div>
<div class="item6">
  <div class="section">
    <h4 class="sectionHeader">Bio</h4>
  </div>
   <p class="bio">{{$owner->bio}}</p>
</div>
<div class="item7 typesOfUnitsAvailable">
  <div class="section">
    <h4 class="sectionHeader">Properties Owned</h4>
  </div>
  <div class="unitDescription">
    @foreach($owner->rentals as $unit)
      <div class="unitContainer">
         <img class="unitImage" src="{{Str::replaceFirst('public/','storage/',asset($unit->coverImage))}}" alt="{{$unit->name}} {{$unit->name}}">
         <span>{{$unit->name}}</span>
         <span>{{$unit->units_available}} units available</span>
         <a class="hiddenLink" href="/rentals/{{$unit->id}}"></a>
      </div>
    @endforeach
    @foreach($owner->hostels as $unit)
      <div class="unitContainer">
         <img class="unitImage" src="{{Str::replaceFirst('public/','storage/',asset($unit->coverImage))}}" alt="{{$unit->name}} {{$unit->name}}">
         <span>{{$unit->name}}</span>
         <span>{{$unit->units_available}} units available</span>
         <a class="hiddenLink" href="/hostels/{{$unit->id}}"></a>
      </div>
    @endforeach
    @foreach($owner->standalones as $unit)
      <div class="unitContainer">
         <img class="unitImage" src="{{Str::replaceFirst('public/','storage/',asset($unit->coverImage))}}" alt="{{$unit->name}} {{$unit->name}}">
         <span>{{$unit->name}}</span>
         <span>{{$unit->units_available}} units available</span>
         <a class="hiddenLink" href="/standalones/{{$unit->id}}"></a>
      </div>
    @endforeach
    @foreach($owner->workspaces as $unit)
      <div class="unitContainer">
         <img class="unitImage" src="{{Str::replaceFirst('public/','storage/',asset($unit->coverImage))}}" alt="{{$unit->name}} {{$unit->name}}">
         <span>{{$unit->name}}</span>
         <span>{{$unit->units_available}} units available</span>
         <a class="hiddenLink" href="/workspaces/{{$unit->id}}"></a>
      </div>
    @endforeach
    @foreach($owner->communities as $unit)
      <div class="unitContainer">
         <img class="unitImage" src="{{Str::replaceFirst('public/','storage/',asset($unit->coverImage))}}" alt="{{$unit->name}} {{$unit->name}}">
         <span>{{$unit->name}}</span>
         <span>{{$unit->units_available}} units available</span>
         <a class="hiddenLink" href="/communities/{{$unit->id}}"></a>
      </div>
    @endforeach
 </div>
 </div>
    <div class="item8">
    <div class="footer">
        <a class="footerLink backlink" href="">Back</a>
     </div>
    </div>
  </div>
  <script src="{{asset('js/swiper.min.js')}}"></script>
  <script src="{{asset('js/notiflix-2.1.3.min.js')}}"></script>
  <script src="{{asset('js/properties/communities.js')}}"></script>
  </body>
</html>
