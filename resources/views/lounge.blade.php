<!DOCTYPE html>
<html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width" initial-scale="1.0">
   <meta name="description" content="Build a dream home,workspace or Public utility in a photorealistic online environment">
   <meta name="keywords" content="First Monarchy,build,dream,home">
   <title>First Monarchy-Lounge</title>
   <link rel="stylesheet" type="text/css" href="{{asset('css/notiflix-2.1.3.min.css')}}"/>
   <link rel="stylesheet" href="{{asset('css/swiper.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('css/lounge-stylesheet.css')}}"/>
 </head>
 <body>
   <div class="overlay"></div>
  <div class="container">
    <h1>FIRST MONARCHY</h1>
    <h3 class="tagline">VALLEY OF KINGS</h3>
    <div class="navigation">
      <button class="menuOpen">&#10060;</button>
      <a class="navigationlink" title="Homepage" href="/">Home</a>
      <a class="navigationlink" title="About page" href="/about">About</a>
      <a class="navigationlink" title="Contact page" href="/contact">Contact</a>
    </div>
    <div class="menu">
      <button class="menuClosed">Menu &#9776;</button>
    </div>
    <div class="item1">
      <div class="">
        <p><span>Welcome</span> <span>{{$user->first_name}}</span></p>
        <p>Member since <span>{{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</span></p>
        <p>Kiambu</p>
      </div>
     <div class="">
       <img class="avatar" data-reference = "avatar" src="{{Str::replaceFirst('public/' ,'storage/',asset($user->avatar))}}" alt="image">
     </div>
     <div class="">
       <div class="">
         <img class="likes" src="../images/empty-heart-white.svg" alt="image">
         <span>Favourites</span>
         <span>{{$favourites}}</span>
       </div>
       <div class="">
         <img class="likes" src="../images/calendarWhite.svg" alt="image">
         <span>Bookings</span>
         <span>{{$user->bookings->count()}}</span>
       </div>
     </div>
    </div>
    <div class="item2">
      <button id="bookingsTabButton" class="tabButton" data-tab="bookingsTab" type="button"><img class="tab_icon" src="../images/grey_calendar.svg" alt="image">Bookings</button>
      <button id="scheduleTabButton" class="tabButton" data-tab="scheduleTab" type="button"><img class="tab_icon" src="../images/grey_calendar.svg" alt="image">Scheduled Visits</button>
      <button id="diaryTabButton" class="tabButton" data-tab="diaryTab" type="button"><img class="tab_icon" src="../images/grey_book.svg" alt="image">Diary</button>
      <button id="settingsTabButton" class="tabButton" data-tab="settingsTab"  type="button"><img class="tab_icon" src="../images/grey_settings.svg" alt="image">Settings</button>
    </div>
    <div class="item3">
      <div id="bookingsTab" class="tabcontent">
        <div class="favouriteContainer">
          <h3 class = "summary expand" data-content = "booked_rentals"><span>Booked Rentals ({{$rental_bookings->count()}})</span><span>&#43;</span></h3>
          <div id ="bookedRentals" class="favourite_group" data-summary = "booked_rentals">
            @if($rental_bookings->count())
              @foreach ($rental_bookings as $rental)
               <div class="listingContainer">
                  <button class = "listing">
              	     <img class ="listingCoverImage" src="{{Str::replaceFirst('public/','storage/',asset($rental->coverImage))}}">
              			 <div class="description">
              			     <p>{{$rental->name}}</p>
              			     <p>{{$rental->bedrooms}} Beds.{{$rental->bathrooms}} Baths</p>
                         <p>kshs {{$rental->rent}}/month</p>
                         <p>{{$rental->location}}</p>
                         <a class="hiddenLink" href="/rentals/{{$rental->id}}"></a>
              			</div>
                    <div class="ratings">
                      @for($i = 1; $i <=$rental->ratings->avg('stars'); $i++)
                      <div class="ratingContainer">
                        <span class="full-rating"></span>
                      </div>
                      @endfor
                      @for($i = 5; $i >$rental->ratings->avg('stars');$i--)
                      <div class="ratingContainer">
                        <span class="empty-rating"></span>
                      </div>
                      @endfor
                      <span class="ratingsCount">{{$rental->ratings->count()}} Ratings</span>
                    </div>
                  </button>
                  <form class="wishform" action="/favourites/rentals/{{$rental->id}}" method="post">
                    @csrf
                    @auth
                      @if($user->favourite_rentals->contains($rental->id))
                        @method('DELETE')
                      @endif
                    @endauth
                    <label class="label">
                      <input class="checkbox" data-url = "/favourites/rentals/{{$rental->id}}" type="checkbox" @if(auth()->check()){{$user->favourite_rentals->contains($rental->id) ? "checked":" "}}@endif><span class="check-toggle"></span>
                    </label>
                  </form>
                  <button class="cancel_booking"  data-url = "/book_rental/{{$rental->id}}" type="button">Cancel Booking</button>
                </div>
              @endforeach
            @else
            <p class="nothingToShow">YOU HAVE NOT BOOKED ANY RENTALS YET</p>
            @endif
          </div>
          <h3 class="summary expand" data-content ="booked_hostels"><span>Booked Hostels ({{$hostel_bookings->count()}})</span><span>&#43;</span></h3>
          <div class="favourite_group" data-summary = "booked_hostels">
              @if ($hostel_bookings->count())
                @foreach($hostel_bookings as $hostel)
                    <div class="listingContainer">
                      <button class = "listing">
                         <img class ="listingCoverImage" src="{{Str::replaceFirst('public/','storage/',asset($hostel->coverImage))}}">
                         <div class="description">
                             <p>{{$hostel->name}}</p>
                             <p>{{$hostel->beds}} Beds. For {{$hostel->gender}}</p>
                             <p>kshs {{$hostel->rent}}/month</p>
                             <p>{{$hostel->location}}</p>
                             <a class="hiddenLink" href="/hostels/{{$hostel->id}}"></a>
                        </div>
                        <div class="ratings">
                          @for($i = 1; $i <=$hostel->ratings->avg('stars'); $i++)
                          <div class="ratingContainer">
                            <span class="full-rating"></span>
                          </div>
                          @endfor
                          @for($i = 5; $i >$hostel->ratings->avg('stars');$i--)
                          <div class="ratingContainer">
                            <span class="empty-rating"></span>
                          </div>
                          @endfor
                          <span class="ratingsCount">{{$hostel->ratings->count()}} Ratings</span>
                        </div>
                      </button>
                      <form class="wishform" action="/favourites/hostels/{{$hostel->id}}" method="post">
                        @csrf
                        @auth
                          @if($user->favourite_hostels->contains($hostel->id))
                            @method('DELETE')
                          @endif
                        @endauth
                        <label class="label">
                          <input class="checkbox" data-url = "/favourites/hostels/{{$hostel->id}}" type="checkbox" @if(auth()->check()){{$user->favourite_hostels->contains($hostel->id) ? "checked":" "}}@endif><span class="check-toggle"></span>
                        </label>
                      </form>
                      <button class="cancel_booking"  data-url = "/book_hostel/{{$hostel->id}}" type="button">Cancel Booking</button>
                    </div>
                @endforeach
              @else
                <p class="nothingToShow">YOU HAVE NOT BOOKED ANY WORKSPACES YET</p>
              @endif
          </div>
            <h3 class="summary expand" data-content = "booked_workspaces"><span>Booked Workspaces ({{$workspace_bookings->count()}})</span><span>&#43;</span></h3>
            <div class="favourite_group" data-summary = "booked_workspaces">
              @if(!$workspace_bookings->count())
              <p class="nothingToShow">YOU HAVE NOT BOOKED ANY WORKSPACES YET</p>
              @endif
                @foreach($workspace_bookings as $workspace)
                   <div class="listingContainer">
                     <button class = "listing">
                        <img class ="listingCoverImage" src="{{Str::replaceFirst('public/','storage/',asset($workspace->coverImage))}}">
                        <div class="description">
                            <p>{{$workspace->name}}</p>
                            <p>{{$workspace->area}} sq Metres. {{$workspace->units_available}} Units Available</p>
                            <p>kshs {{$workspace->rent}}</p>
                            <p>{{$workspace->location}}</p>
                            <a class="hiddenLink" href="/workspaces/{{$workspace->id}}"></a>
                       </div>
                       <div class="ratings">
                         @for($i = 1; $i <=$workspace->ratings->avg('stars'); $i++)
                         <div class="ratingContainer">
                           <span class="full-rating"></span>
                         </div>
                         @endfor
                         @for($i = 5; $i >$workspace->ratings->avg('stars');$i--)
                         <div class="ratingContainer">
                           <span class="empty-rating"></span>
                         </div>
                         @endfor
                         <span class="ratingsCount">{{$workspace->ratings->count()}} Ratings</span>
                       </div>
                     </button>
                     <form class="wishform" action="/favourites/workspaces/{{$workspace->id}}" method="post">
                       @csrf
                       @auth
                         @if($user->favourite_workspaces->contains($workspace->id))
                           @method('DELETE')
                         @endif
                       @endauth
                       <label class="label">
                         <input class="checkbox" data-url = "/favourites/workspaces/{{$workspace->id}}" type="checkbox" @if(auth()->check()){{$user->favourite_workspaces->contains($workspace->id) ? "checked":" "}}@endif><span class="check-toggle"></span>
                       </label>
                     </form>
                     <button class="cancel_booking"  data-url = "/book_workspace/{{$workspace->id}}" type="button">Cancel Booking</button>
                   </div>
              @endforeach
            </div>
          </div>
        </div>
        <div id="scheduleTab" class="tabcontent">
          @if (false)
            <div id="calendar" class="">

            </div>
          @else
            <p class="nothingToShow">YOU HAVE NOT SCHEDULED ANY VISITS YET</p>
            <a class="button callToAction" href="/properties">Schedule a Visit</a>
          @endif
        </div>
      <div id="diaryTab" class="tabcontent">
        <div class="favouriteContainer">
          <h3 class="summary expand" data-content = "favourite_rentals"><span>Favourite Rentals ({{$user->favourite_rentals->count()}})</span><span>&#43;</span></h3>
          <div class="favourite_group" data-summary = "favourite_rentals">
            @if(!$user->favourite_rentals->count())
            <p class="nothingToShow">YOU HAVE NO FAVOURITE RENTALS YET</p>
            @endif
            @foreach($user->favourite_rentals as $rental)
               <div class="listingContainer" data->
                  <button class = "listing">
              	     <img class ="listingCoverImage" src="{{Str::replaceFirst('public/','storage/',asset($rental->coverImage))}}">
              			 <div class="description">
              			     <p>{{$rental->name}}</p>
              			     <p>{{$rental->bedrooms}} Beds.{{$rental->bathrooms}} Baths</p>
                         <p>kshs {{$rental->rent}}/month</p>
                         <p>{{$rental->location}}</p>
                         <a class="hiddenLink" href="/rentals/{{$rental->id}}"></a>
              			</div>
                    <div class="ratings">
                      @for($i = 1; $i <=$rental->ratings->avg('stars'); $i++)
                      <div class="ratingContainer">
                        <span class="full-rating"></span>
                      </div>
                      @endfor
                      @for($i = 5; $i >$rental->ratings->avg('stars');$i--)
                      <div class="ratingContainer">
                        <span class="empty-rating"></span>
                      </div>
                      @endfor
                      <span class="ratingsCount">{{$rental->ratings->count()}} Ratings</span>
                    </div>
                  </button>
                  <form class="wishform" action="/favourites/rentals/{{$rental->id}}" method="post">
                    @csrf
                    @if(auth()->check())
                    @if($user->favourite_rentals->contains($rental->id))
                    @method('DELETE')
                    @endif
                    @endif
                    <label class="label">
                      <input class="checkbox" data-url = "/favourites/rentals/{{$rental->id}}" type="checkbox" @auth{{$user->favourite_rentals->contains($rental->id) ? "checked":" "}}@endauth><span class="check-toggle"></span>
                    </label>
                  </form>
                </div>
            @endforeach
          </div>
          <h3 class="summary expand" data-content = "favourite_hostels"><span>Favourite Hostels ({{$user->favourite_hostels->count()}})</span><span>&#43;</span></h3>
          <div class="favourite_group" data-summary = "favourite_hostels">
            @if(!$user->favourite_hostels->count())
            <p class="nothingToShow">YOU HAVE NO FAVOURITE HOSTELS YET</p>
            @endif
            @foreach($user->favourite_hostels as $hostel)
                <div class="listingContainer">
                  <button class = "listing">
                     <img class ="listingCoverImage" src="{{Str::replaceFirst('public/','storage/',asset($hostel->coverImage))}}">
                     <div class="description">
                         <p>{{$hostel->name}}</p>
                         <p>{{$hostel->beds}} Beds. For {{$hostel->gender}}</p>
                         <p>kshs {{$hostel->rent}}/month</p>
                         <p>{{$hostel->location}}</p>
                         <a class="hiddenLink" href="/hostels/{{$hostel->id}}"></a>
                    </div>
                    <div class="ratings">
                      @for($i = 1; $i <=$hostel->ratings->avg('stars'); $i++)
                      <div class="ratingContainer">
                        <span class="full-rating"></span>
                      </div>
                      @endfor
                      @for($i = 5; $i >$hostel->ratings->avg('stars');$i--)
                      <div class="ratingContainer">
                        <span class="empty-rating"></span>
                      </div>
                      @endfor
                      <span class="ratingsCount">{{$hostel->ratings->count()}} Ratings</span>
                    </div>
                  </button>
                  <form class="wishform" action="/favourites/hostels/{{$hostel->id}}" method="post">
                    @csrf
                    @if(auth()->check())
                    @if($user->favourite_hostels->contains($hostel->id))
                    @method('DELETE')
                    @endif
                    @endif
                    <label class="label">
                      <input class="checkbox" data-url = "/favourites/hostels/{{$hostel->id}}" type="checkbox" @if(auth()->check()){{$user->favourite_hostels->contains($hostel->id) ? "checked":" "}}@endif><span class="check-toggle"></span>
                    </label>
                  </form>
                </div>
            @endforeach
          </div>
            <h3 class="summary expand" data-content = "favourite_standalones"><span>Favourite Standalones ({{$user->favourite_standalones->count()}})</span><span>&#43;</span></h3>
            <div class="favourite_group" data-summary="favourite_standalones">
              @if(!$user->favourite_standalones->count())
              <p class="nothingToShow">YOU HAVE NO FAVOURITE STANDALONES YET</p>
              @endif
              @foreach($user->favourite_standalones as $standalone)
                 <div class="listingContainer">
                   <button class = "listing">
                      <img class ="listingCoverImage" src="{{Str::replaceFirst('public/','storage/',asset($standalone->coverImage))}}">
                      <div class="description">
                          <p>{{$standalone->name}}</p>
                          <p>{{$standalone->bedrooms}} Beds. {{$standalone->bathrooms}} Baths</p>
                          <p>kshs {{$standalone->sale}}</p>
                          <p>{{$standalone->location}}</p>
                          <a class="hiddenLink" href="/standalones/{{$standalone->id}}"></a>
                     </div>
                     <div class="ratings">
                       @for($i = 1; $i <=$standalone->ratings->avg('stars'); $i++)
                       <div class="ratingContainer">
                         <span class="full-rating"></span>
                       </div>
                       @endfor
                       @for($i = 5; $i >$standalone->ratings->avg('stars');$i--)
                       <div class="ratingContainer">
                         <span class="empty-rating"></span>
                       </div>
                       @endfor
                       <span class="ratingsCount">{{$standalone->ratings->count()}} Ratings</span>
                     </div>
                   </button>
                   <form class="wishform" action="/favourites/standalones/{{$standalone->id}}" method="post">
                     @csrf
                     @auth
                       @if($user->favourite_standalones->contains($standalone->id))
                         @method('DELETE')
                       @endif
                     @endauth
                     <label class="label">
                       <input class="checkbox" data-url = "/favourites/standalones/{{$standalone->id}}" type="checkbox" @if(auth()->check()){{$user->favourite_standalones->contains($standalone->id) ? "checked":" "}}@endif><span class="check-toggle"></span>
                     </label>
                   </form>
                 </div>
            @endforeach
            </div>
            <h3 class="summary expand" data-content="favourite_workspaces"><span>Favourite Workspaces  ({{$user->favourite_workspaces->count()}})</span><span>&#43;</span></h3>
            <div class="favourite_group" data-summary = "favourite_workspaces">
              @if(!$user->favourite_workspaces->count())
              <p class="nothingToShow">YOU HAVE NO FAVOURITE WORKSPACES YET</p>
              @endif
             @foreach($user->favourite_workspaces as $workspace)
                 <div class="listingContainer">
                   <button class = "listing">
                      <img class ="listingCoverImage" src="{{Str::replaceFirst('public/','storage/',asset($workspace->coverImage))}}">
                      <div class="description">
                          <p>{{$workspace->name}}</p>
                          <p>{{$workspace->area}} sq Metres. {{$workspace->units_available}} Units Available</p>
                          <p>kshs {{$workspace->rent}}</p>
                          <p>{{$workspace->location}}</p>
                          <a class="hiddenLink" href="/workspaces/{{$workspace->id}}"></a>
                     </div>
                     <div class="ratings">
                       @for($i = 1; $i <=$workspace->ratings->avg('stars'); $i++)
                       <div class="ratingContainer">
                         <span class="full-rating"></span>
                       </div>
                       @endfor
                       @for($i = 5; $i >$workspace->ratings->avg('stars');$i--)
                       <div class="ratingContainer">
                         <span class="empty-rating"></span>
                       </div>
                       @endfor
                       <span class="ratingsCount">{{$workspace->ratings->count()}} Ratings</span>
                     </div>
                   </button>
                   <form class="wishform" action="/favourites/workspaces/{{$workspace->id}}" method="post">
                     @csrf
                     @auth
                       @if($user->favourite_workspaces->contains($workspace->id))
                         @method('DELETE')
                       @endif
                     @endauth
                     <label class="label">
                       <input class="checkbox" data-url = "/favourites/workspaces/{{$workspace->id}}" type="checkbox" @if(auth()->check()){{$user->favourite_workspaces->contains($workspace->id) ? "checked":" "}}@endif><span class="check-toggle"></span>
                     </label>
                   </form>
                 </div>
            @endforeach
            </div>
            <h3 class="summary expand" data-content="favourite_communities"><span>Favourite Communities ({{$user->favourite_communities->count()}})</span><span>&#43;</span></h3>
            <div class="favourite_group" data-summary="favourite_communities">
              @if(!$user->favourite_communities->count())
              <p class="nothingToShow">YOU HAVE NO FAVOURITE COMMUNITIES YET</p>
              @endif
              @foreach($user->favourite_communities as $community)
                  <div class="listingContainer">
                      <button class = "listing">
                         <img class ="listingCoverImage" src="{{Str::replaceFirst('public/','storage/',asset($community->coverImage))}}">
                         <div class="description">
                             <p>{{$community->name}}</p>
                             <!-- <p>{{$community->area}} sq Metres. {{$community->units_available}} Units Available</p> -->
                             <p>{{$community->location}}</p>
                             <a class="hiddenLink" href="/communities/{{$community->id}}"></a>
                        </div>
                      </button>
                      <form class="wishform" action="/favourites/communities/{{$community->id}}" method="post">
                        @csrf
                        @auth
                          @if($user->favourite_communities->contains($community->id))
                            @method('DELETE')
                          @endif
                        @endauth
                        <label class="label">
                          <input data-url = "/favourites/communities/{{$community->id}}" class="checkbox" type="checkbox" @if(auth()->check()){{$user->favourite_communities->contains($community->id) ? "checked":" "}}@endif><span class="check-toggle"></span>
                        </label>
                      </form>
                  </div>
              @endforeach
            </div>
            <h3 class="summary expand" data-content="diary"><span>Diary ({{$user->diaryEntries->count()}})</span><span>&#43;</span></h3>
              <div class="favourite_group" data-summary="diary">
                @foreach($user->diaryEntries as $post)
                    <div class="diaryEntryContainer">
                      <div class = "entry">
                  	     <img class ="entryImage" src="{{Str::replaceFirst('public/','storage/',asset($post->images()->first()->url))}}">
                  			 <div class="entrydescription">
                            <form class="wishform" action="/diary/{{$post->id}}" method="post">
                              @csrf
                              <label class="diarylabel">
                                <input class="checkbox" type="checkbox" data-url = "/diary/{{$post->id}}" @if($user->diaryEntries->contains($post->id)){{'checked'}}@endif><span class="diary-check-toggle"></span>
                              </label>
                            </form>
                  			</div>
                      </div>
                    </div>
                 @endforeach
              </div>
          </div>
      </div>
      <div id="settingsTab"  class="tabcontent">
           <form id="profileEditForm" action="/users/{{auth()->id()}}" method="post" enctype="multipart/form-data">
               @csrf
               @method('PATCH')
               <div class ="formtext">
                   <div class="logoContainer">
                         <img class="avatar" data-reference = "avatar" src="{{Str::replaceFirst('public/','storage/',asset($user->avatar))}}">
                         <div class="inputContainer">
                           <button type="button" data-input = "avatarButton" class="button create changeImage">Change Avatar</button>
                           <input type="file" name = "avatar" class = "imageInput" data-url = "/users/{{auth()->id()}}" data-image = "avatar" data-button = "avatarButton" data-errors = "avatarErrors" accept="image/png,image/jpeg">
                         </div>
                         <div class="errorContainer">
                           <ul class="avatarErrors">

                           </ul>
                         </div>
                   </div>
                   <div class="inputContainer">
                       <label for="name">First Name</label><input id="name" type="text" class="input @error('first_name') is-invalid @enderror" value="{{$user->first_name}}" placeholder="First Name" name="first_name" autocomplete="first_name" autofocus  required>
                 </div>
                 <div class="inputContainer">
                      <label for="last_name">Last Name</label><input id="name" type="text" class="input @error('last_name') is-invalid @enderror" value="{{$user->last_name}}" placeholder="Last Name" name="last_name" autocomplete="last_name" autofocus  required>
                 </div>
                 <div class="inputContainer">
                      <label for="email">Email</label><input id="email" type="email" name="email" class="input @error('email') is-invalid @enderror"  value="{{$user->email}}" placeholder="Email address" autocomplete="email" required>
                 </div>
                 <div class="inputContainer">
                    <label for="phone_number">Phone Number</label><input id="phone_number" type="text" name="phone_number" class="input @error('phone_number') is-invalid @enderror"  value="{{$user->phone_number}}" placeholder="Email address" autocomplete="email" required>
                 </div>
                 <div class="inputContainer">
                    <label for="country_code">Country</label>
                    <select  id="country_code" type="number" name="country_code"  class="input" required>
                       <option value="+254">Kenya</option>
                    </select>
                 </div>
                 <div class="errorContainer">
                   <ul class="errorList">

                   </ul>
                 </div>
                 <div class="inputContainer">
                   <input class="button create" type="submit" value="Update Profile">
                 </div>
               </div>
           </form>
           <form class="" action="{{route('logout')}}" method="post">
             @csrf
             <input id="LogoutButton" type="submit" class="button" value="Logout">
           </form>
      </div>
     </div>
    </div>
  <script src="{{asset('js/axios.min.js')}}"></script>
  <script src="{{asset('js/notiflix-2.1.3.min.js')}}"></script>
  <script src="{{asset('js/swiper.min.js')}}"></script>
  <script src="{{asset('js/lounge.js')}}"></script>
 </body>
</html>
