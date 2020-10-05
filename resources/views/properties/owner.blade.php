<!DOCTYPE html>
<html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width" initial-scale="1.0">
   <meta name="description" content="Build a dream home,workspace or Public utility in a photorealistic online environment">
   <meta name="keywords" content="First Monarchy,build,dream,home">
   <title>First Monarchy-Build</title>
   <link rel="stylesheet" type="text/css" href="{{asset('css/notiflix-2.1.3.min.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('css/dropzone.min.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar/core/main.min.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar/daygrid/main.min.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar/timegrid/main.min.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar/list/main.min.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('css/properties/owner-stylesheet.css')}}"/>
</head>
 <body>
   <div class="overlay">
   </div>
  <div class="container">
     <div class="item1">
       <h1>FIRST MONARCHY</h1>
       <div class="user">
         <img class="avatar" data-reference = "logo" src="{{Str::replaceFirst('public/','storage/',asset(Auth::guard('owner')->user()->logo))}}">
         <p>{{Auth::guard('owner')->user()->name}}</p>
        </div>
        <div id="modal" class="modal">
          <div class="modalContent">

          </div>
        </div>
    </div>
    <div class="Tab">
    <div id ="dashboardTab" class="tabcontent">
    <div class="header">
      <div class="greetings">
        <p class="welcome">Welcome <strong>{{Auth::guard('owner')->user()->name}}</strong></p>
      </div>
      <div class="notificationGroup">
      <div class="notification">
        <p class="figure">{{$rentals->count() + $hostels->count() + $standalones->count() + $workspaces->count()}}</p>
        <div class="title"><img class="notificationIcon" src="../images/buildingWhite.svg"><p class="text">Properties</p></div>
      </div>
      <div class="notification">
          <p class="figure">25</p>
        <div class="title"><img class="notificationIcon" src="../images/whiteHomeSketch.svg"><p class="text">Revenue</p></div>
      </div>
      <div class="notification">
          <p class="figure">10</p>
        <div class="title"><img class="notificationIcon" src="../images/white-heart.svg"><p class="text">likes</p></div>
      </div>
    </div>
    </div>
    <div class="cardHolder">
      <div class="card">
        <img class="cardIcon" src="../images/homenew.svg">
        <p class="banner">Profile</p>
      </div>
      <div class="card">
        <img class="cardIcon" src="../images/building.svg">
        <p class="banner">Properties</p>
      </div>
      <div class="card">
        <img class="cardIcon" src="../images/cameranew.svg">
        <p class="banner">Statistics</p>
      </div>
    </div>
    <div class="tileContainer">
      <div class="tile">
        <span class="headline">
          Revenue
        </span>
      </div>
      <div class="tile">
        <span class="headline">
          Likes
        </span>
      </div>
    </div>
    <div class="footer">FIRST MONARCHY 2019</div>
  </div>
  <div id="propertiesTab" class="tabcontent">
      <div class="shortcuts">
        <button id="rentalsTabButton" data-tab="rentalsTab" class=" innerTabButton">Rentals</button>
        <button id="standalonesTabButton" data-tab="standalonesTab" class="innerTabButton">For sale</button>
        <button id="hostelsTabButton" data-tab="hostelsTab" class="innerTabButton">Hostels</button>
        <button id="workspacesTabButton" data-tab="workspacesTab" class="innerTabButton">Workspaces</button>
        <button id="communitiesTabButton" data-tab="communitiesTab" class="innerTabButton">Communities</button>
        <button id="bookingsTabButton" style = "display:none;" data-tab="bookingsTab" class="innerTabButton">Bookings</button>
        <button id="unitsTabButton" style = "display:none;" data-tab="unitsTab" class="innerTabButton">Units</button>
      </div>
      <div id = "rentalsTab" class="innertabcontent">
        @include('properties.owner.partials.rentals_tab')
      </div>
      <div id="standalonesTab" class=" innertabcontent">
          @include('properties.owner.partials.standalones_tab')
      </div>
      <div id="hostelsTab" class="innertabcontent">
        @include('properties.owner.partials.hostels_tab')
      </div>
      <div id="workspacesTab" class="innertabcontent">
        @include('properties.owner.partials.workspaces_tab')
      </div>
      <div id="communitiesTab" class="innertabcontent">
        @include('properties.owner.partials.communities_tab')
      </div>
      <div id="bookingsTab" class="innertabcontent">
      </div>
      <div id="unitsTab" class="innertabcontent">
      </div>
    </div>
    <div id = "scheduleTab" class="tabcontent">
      <div id="calendar-container" class="">
        <div id="calendar" class="">

        </div>
      </div>
    </div>
    <div id = "settingsTab" class="tabcontent">
      <form class="profileEditForm" action="/owners/1" method="post" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
        <div class="formtext">
          <div class="logoContainer">
                <img class="profileAvatar" data-reference = "logo" src="{{Str::replaceFirst('public/','storage/',asset(Auth::guard('owner')->user()->logo))}}">
                <div class="inputContainer">
                  <button type="button" data-input = "logoButton" class="button create changeImage changeLogoButton">Change Logo</button>
                  <input type="file" name = "logo" class = "imageInput" data-url = "/owners/{{auth('owner')->id()}}" data-image = "logo" data-button = "logoButton" data-errors = "logoErrors" accept="image/png,image/jpeg">
                </div>
                <div class="errorContainer">
                  <ul class="logoErrors">

                  </ul>
                </div>
          </div>
          <span><h4>Edit Company Info</h4></span>
          <div class="inputContainer">
              <label for="name">Name</label><input id="name" type="text" class="input" value="{{auth('owner')->user()->name}}" placeholder="Name" name="name" autocomplete="name" autofocus  required>
          </div>
          <div class="inputContainer">
             <label for="bio">Bio</label><textarea id="bio" type="text" class="textarea" name="bio"  placeholder="Description" required>{{auth('owner')->user()->bio}}</textarea>
          </div>
          <div class="inputContainer">
             <label for="email">Company Email</label><input id="email" type="email" name="email" class="input"  value="owner@1.com" readonly disabled>
          </div>
          <div class="errorContainer">
            <ul class="errorList">

            </ul>
          </div>
           <div  class="inputContainer">
             <input type="button"  class="button create editProfile" data-url = "/owners/{{auth('owner')->id()}}" value="Confirm Profile update">
           </div>
       </div>
      </form>
      <form id="logoutForm" action="/logout/owners" method="POST">
          @csrf
           <label for="submit"><input class = "button logout" type="submit" value="logout"></label>
      </form>
    </div>
    <div class="navlinks">
      <div class="categories">
        <button id="dashboardTabButton" data-tab="dashboardTab" class="tabButton"><img class = "tab_icon" src="../images/statistics-dark.svg">Dashboard</button>
      </div>
      <div class="categories">
        <button id="propertiesTabButton" data-tab="propertiesTab" class="tabButton"><img class = "tab_icon" src="../images/city-dark.svg">Properties</button>
      </div>
      <div class="categories">
        <button id="scheduleTabButton" data-tab="scheduleTab" type="button" class="tabButton"><img class = "tab_icon" src="../images/calendar-dark.svg">Schedule</button>
      </div>
      <div class="categories">
        <button id="settingsTabButton" data-tab="settingsTab" class="tabButton"><img class = "tab_icon" src="../images/settings-dark.svg">Settings</button>
      </div>
    </div>
  </div>
</div>
  {{-- <script src="{{asset('js/lozad.min.js')}}"></script> --}}
  <script src="{{asset('js/axios.min.js')}}"></script>
  <script src="{{asset('js/dropzone.min.js')}}"></script>
  <script src="{{asset('js/notiflix-2.1.3.min.js')}}"></script>
  <script src = "{{asset('js/fullcalendar/core/main.min.js')}}"></script>
  <script src = "{{asset('js/fullcalendar/daygrid/main.min.js')}}"></script>
  <script src = "{{asset('js/fullcalendar/timegrid/main.min.js')}}"></script>
  <script src = "{{asset('js/fullcalendar/list/main.min.js')}}"></script>
  <script src = "{{asset('js/fullcalendar/interaction/main.min.js')}}"></script>
  <script src="{{asset('js/properties/owner.js')}}"></script>
  </body>
</html>
                                                                                                             
