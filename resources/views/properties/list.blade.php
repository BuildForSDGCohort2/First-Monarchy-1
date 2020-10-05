<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width" initial-scale="1.0">
    <meta name="description" content="Find your dream home or workspace">
    <meta name="keywords" content="First Monarchy,build,dream,home">
    <link rel="stylesheet" type="text/css" href="{{asset('css/notiflix-2.1.3.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/properties/list-stylesheet.css')}}"/>
    <title>First Monarchy - Find Your Dream Home Or Workspace</title>
  </head>
  <body>
    <div class="container">
      <div class="overlay">
      </div>
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
           <form class="searchForm" method="post" action="/">
               @csrf
               <input class="search" type="search" placeholder="Search by name eg Sunrise Apartments" name="search-term">
               <label class="submitButton" for="search"><img src="../images/search.svg"><input id="search" type="submit" value="Search"></label>
           </form>
        </div>
        <div class="item5">
          <button class="menuOpen">&#10060;</button>
          <a class="navigationlink" title="Homepage" href="/">Home</a>
          <a class="navigationlink" title="About page" href="/about">About</a>
          <a class="navigationlink" title="Contact page" href="/contact">Contact</a>
  	    </div>
        @isset($rentals)
        <div class="controls">
          <button class="showModal showControl" type="button" data-id="filters">Filters <img class="controlIcon" src="../images/filters.svg"></button>
          <button class="showModal showControl" type="button" data-id="sortOptions">Sort By <img class="controlIcon" src="../images/line-angle-down.svg"></button>
        </div>
        <div class="item6">
          <h2>Rentals</h2>
          <h4>{{$rentals->count()}} found</h4>
        </div>
        <div class="item7">
          @foreach($rentals as $rental)
          <div class="listingContainer">
            <div class="badge @auth{{$rental->is_booked() ? "booked":""}}@endauth">
              @if($rental->units_available == 1)
                <span>1 Unit Left</span>
              @elseif(auth()->check())
                @if ($rental->is_booked())
                  <span>booked</span>
                @endif
             @else
              @endif
            </div>
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
                @if(auth()->user()->favourite_rentals->contains($rental->id))
                  @method('DELETE')
                @endif
              @endauth
              <label class="label">
                <input class="checkbox @auth{{'loggedIn'}}@endauth" data-url = "/favourites/rentals/{{$rental->id}}" type="checkbox" @auth{{auth()->user()->favourite_rentals->contains($rental->id) ? "checked":" "}}@endauth><span class="check-toggle"></span>
              </label>
            </form>
          </div>
            @endforeach
        </div>
        <div id="filters" class="modal">
          <div class="modalContent">
          <h3>Filters</h3>
          <button class="close closeModal" type="button" data-id="filters"><img src="../images/close1.svg"></button>
           <form class="filterForm" method="get" action="/rentals">
               @csrf
               <div class="inputContainer">
                 <label for="beds">No' of bedrooms</label><input id="beds" type="number" name="bedrooms" value="{{Request()->bedrooms}}" class="filter"  placeholder="Bedrooms">
               </div>
               @error ('bedrooms')
                 {{$message}}
               @enderror
               <div class="inputContainer">
                 <label for="baths">No' of bathrooms</label><input id="baths" type="number" name="bathrooms" value="{{Request()->bathrooms}}" class="filter" placeholder="Bathrooms">
               </div>
               @error ('bathrooms')
                 {{$message}}
               @enderror
               <div class="inputContainer">
                 <label for="parking">No' of parking slots</label><input id="parking" type="number" name="parking_slots" value="{{Request()->parking_slots}}" class="filter" placeholder="Parking Slots">
               </div>
               @error ('parking_slots')
                 {{$message}}
               @enderror
               <div class="inputContainer">
                 <label for="location">Location</label><input id="location" type="text" name="location" value="{{Request()->location}}" class="filter" placeholder="Location">
               </div>
               @error ('location')
                 {{$message}}
               @enderror
               <div class="inputContainer">
                 <label for="min_rent">Rent</label><input id="min_rent"  type="number" name="min_rent" value="{{Request()->min_rent}}" class="filter" placeholder="Min rent">
                 <input id="max_rent"  type="number" name="max_rent" value="{{Request()->max_rent}}" class="filter" placeholder="Max rent">
               </div>
               @error ('min_rent')
                 {{$message}}
               @enderror
               @error ('max_rent')
                 {{$message}}
               @enderror
               <!-- <input type="text" name="Location" value="all" class="filter" placeholder="Location"> -->
               <div class="inputContainer">
                 <input id="filter" type="submit" class="submitFilterButton" value="Apply Filters">
                 <input id="reset" type="submit" name="clearFilters" class="submitFilterButton" value="Reset Filters">
               </div>
           </form>
           </div>
        </div>
        <div id="sortOptions" class="modal">
          <h3>Sort By</h3>
          <button class="closeModal close" type="button" data-id="sortOptions"><img src="../images/close1.svg"></button>
          <form class="sortingForm" action="/rentals" method="get">

          </form>
        </div>
        @endisset
  @isset($hostels)
  <div class="item6">
    <h2>Hostels</h2>
    <h4>{{$hostels->count()}} found</h4>
  </div>
  <div class="item7">
    @foreach($hostels as $hostel)
    <div class="listingContainer">
      <div class="badge @auth{{$hostel->is_booked() ? "booked":""}}@endauth">
        @if($hostel->units_available == 1)
          <span>1 Unit Left</span>
        @elseif(auth()->check())
          @if ($hostel->is_booked())
            <span>booked</span>
          @endif
       @else
        @endif
      </div>
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
          @if(auth()->user()->favourite_hostels->contains($hostel->id))
            @method('DELETE')
          @endif
       @endauth
        <label class="label">
          <input class="checkbox @auth{{'loggedIn'}}@endauth" data-url="/favourites/hostels/{{$hostel->id}}" type="checkbox" @auth{{auth()->user()->favourite_hostels->contains($hostel->id) ? "checked":" "}}@endauth><span class="check-toggle"></span>
        </label>
      </form>
    </div>
      @endforeach
  </div>
  @endisset
    @isset($standalones)
    <div class="item6">
      <h2>Standalone Listings</h2>
      <h4>{{$standalones->count()}} found</h4>
    </div>
    <div class="item7">
      @foreach($standalones as $standalone)
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
            @if(auth()->user()->favourite_standalones->contains($standalone->id))
              @method('DELETE')
            @endif
          @endauth
          <label class="label">
            <input class="checkbox @auth{{'loggedIn'}}@endauth" data-url = "/favourites/standalones/{{$standalone->id}}" type="checkbox" @auth{{auth()->user()->favourite_standalones->contains($standalone->id) ? "checked":" "}}@endauth><span class="check-toggle"></span>
          </label>
        </form>
      </div>
        @endforeach
    </div>
    @endisset
    @isset($workspaces)
    <div class="item6">
      <h2>Workspace Listings</h2>
      <h4>{{$workspaces->count()}} found</h4>
    </div>
    <div class="item7">
      @foreach($workspaces as $workspace)
      <div class="listingContainer">
        <div class="badge @auth{{$workspace->is_booked() ? "booked":""}}@endauth">
          @if($workspace->units_available == 1)
            <span>1 Unit Left</span>
          @elseif(auth()->check())
            @if ($workspace->is_booked())
              <span>booked</span>
            @endif
         @else
          @endif
        </div>
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
            @if(auth()->user()->favourite_workspaces->contains($workspace->id))
              @method('DELETE')
            @endif
          @endauth
          <label class="label">
            <input class="checkbox @auth{{'loggedIn'}}@endauth" data-url = "/favourites/workspaces/{{$workspace->id}}" type="checkbox" @auth{{auth()->user()->favourite_workspaces->contains($workspace->id) ? "checked":" "}}@endauth><span class="check-toggle"></span>
          </label>
        </form>
      </div>
        @endforeach
    </div>
    @endisset
    @isset($communities)
        <div class="item6">
          <h2>Communities</h2>
          <h4>{{$communities->count()}} found</h4>
        </div>
        <div class="item7">
          @foreach($communities as $community)
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
                  @if(auth()->user()->favourite_communities->contains($community->id))
                    @method('DELETE')
                  @endif
                @endauth
                <label class="label">
                  <input class="checkbox  @auth{{'loggedIn'}}@endauth" data-url="/favourites/communities/{{$community->id}}" type="checkbox" @auth{{auth()->user()->favourite_communities->contains($community->id) ? "checked":" "}}@endauth><span class="check-toggle"></span>
                </label>
              </form>
          </div>
            @endforeach
        </div>
        @endisset
        <div class="footer">
          First Monarchy
        </div>
    </div>
    <script src="{{asset('js/infinite-scroll.pkgd.min.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/notiflix-2.1.3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/properties/list.js')}}"></script>
  </body>
</html>
