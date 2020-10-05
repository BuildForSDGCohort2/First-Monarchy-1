<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width" initial-scale="1.0">
    <meta name="description" content="Build a dream home,workspace or Public utility in a photorealistic online environment">
    <meta name="keywords" content="First Monarchy,build,dream,home">
    <title>First Monarchy-Properties</title>
    <link rel="stylesheet" href="{{asset('css/swiper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/properties/all-stylesheet.css')}}"/>
    <title>Find a Home Or Workspace</title>
  </head>
  <body>
    <div class="overlay"></div>
    <div class="HeaderContainer">
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
          <h4 class="descriptor-text">RENT,BUY OR SELL A HOME OR WORKSPACE</h4>
        </div>
      <div class="callsToAction">
        <div class="item5">
          <p class="note">Find your new space.</p>
          <a href="#explore" class="CallToAction">EXPLORE</a>
        </div>
        <div class="item6">
          <p class="note">Put up your building for sale or rent.</p>
          <a href="/register/owners" class="CallToAction">List Your Property</a>
        </div>
      </div>
  		<div class="item7">
        <button class="menuOpen">&#10060;</button>
        <a class="navigationlink" title="Homepage" href="/">Home</a>
        <a class="navigationlink" title="About page" href="/about">About</a>
        <a class="navigationlink" title="Contact page" href="/contact">Contact</a>
  	    </div>
        <div class="item8">
        </div>
    </div>
    <div class="mainContainer">
      <h3 id="explore">Explore First Monarchy</h3>
      <div class="categoryContainer">
        <button class = "category">
    	     <img class ="categoriesIcon" src="../images/real-estate.jpg">
    			 <div class="description">
    			     <p>Rentals</p>
    			     <p>Residential spaces for rent</p>
               <a class="hiddenLink" href="/rentals"></a>
    			</div>
        </button>
        <button class = "category">
    	     <img class ="categoriesIcon" src="../images/university.jpg">
    			 <div class="description">
    			     <p>Student Accomodation</p>
    			     <p>Hostels</p>
               <a class="hiddenLink" href="/hostels"></a>
    			</div>
        </button>
        <button class = "category">
    	     <img class ="categoriesIcon" src="../images/overhead.jpg">
    			 <div class="description">
    			     <p>Communities</p>
    			     <p>Estates,Communities & more </p>
               <a class="hiddenLink" href="/communities"></a>
    			</div>
        </button>
        <button class = "category">
    	     <img class ="categoriesIcon" src="../images/render.jpg">
    			 <div class="description">
    			     <p>For Sale</p>
    			     <p>Maisonettes,Bungalows & more</p>
               <a class="hiddenLink" href="/standalones"></a>
    			</div>
        </button>
        <button class = "category">
    	     <img class ="categoriesIcon" src="../images/glass2.jpg">
    			 <div class="description">
    			     <p>Workspaces</p>
    			     <p>Office space & business premises</p>
               <a class="hiddenLink" href="/workspaces"></a>
    			</div>
        </button>
      </div>
      <h3>Most Popular</h3>
      <div class="mostPopularContainer">
          <button class = "popular" type="button">
      	     <img class ="propertyCoverImage" src="{{Str::replaceFirst('public/','storage/',asset($mostPopularRental->coverImage))}}">
              <form class="wishform" action="/favourites/rentals" method="post">
                @csrf
                <label class="label">
                  <input class="checkbox" type="checkbox"><span class="check-toggle"></span>
                </label>
              </form>
      			 <div class="description">
      			     <p>{{$mostPopularRental->name}}</p>
      			     <p>{{$mostPopularRental->bedrooms}} Beds.{{$mostPopularRental->bathrooms}} Baths</p>
                 <p>kshs {{$mostPopularRental->rent}}/mo</p>
                 <p>{{$mostPopularRental->location}}</p>
                 <a class="hiddenLink" href="rentals/{{$mostPopularRental->id}}"></a>
      			</div>
            <div class="ratings">
              @for($i = 1; $i <=$mostPopularRental->ratings->avg('stars'); $i++)
              <div class="ratingContainer">
                <span class="full-rating"></span>
              </div>
              @endfor
              @for($i = 5; $i >$mostPopularRental->ratings->avg('stars');$i--)
              <div class="ratingContainer">
                <span class="empty-rating"></span>
              </div>
              @endfor
              <span class="ratingsCount">{{$mostPopularRental->ratings->count()}} Ratings</span>
            </div>
          </button>
          <button class="popular" type="button">
             <img class ="propertyCoverImage" src="{{Str::replaceFirst('public/','storage/',asset($mostPopularHostel->coverImage))}}">
             <div class="description">
                 <p>{{$mostPopularHostel->name}}</p>
                 <p>{{$mostPopularHostel->beds}} Beds. For {{$mostPopularHostel->gender}}</p>
                 <p>kshs {{$mostPopularHostel->rent}}/month</p>
                 <p>{{$mostPopularHostel->location}}</p>
                 <a class="hiddenLink" href="/hostels/{{$mostPopularHostel->id}}"></a>
            </div>
            <div class="ratings">
              @for($i = 1; $i <=$mostPopularHostel->ratings->avg('stars'); $i++)
              <div class="ratingContainer">
                <span class="full-rating"></span>
              </div>
              @endfor
              @for($i = 5; $i >$mostPopularHostel->ratings->avg('stars');$i--)
              <div class="ratingContainer">
                <span class="empty-rating"></span>
              </div>
              @endfor
              <span class="ratingsCount">{{$mostPopularHostel->ratings->count()}} Ratings</span>
            </div>
          </button>
          <button class="popular" type="button">
             <img class ="propertyCoverImage" src="{{Str::replaceFirst('public/','storage/',asset($mostPopularStandalone->coverImage))}}">
             <div class="description">
                 <p>{{$mostPopularStandalone->name}}</p>
                 <p>{{$mostPopularStandalone->bedrooms}} Beds. {{$mostPopularStandalone->bathrooms}} Baths</p>
                 <p>kshs {{$mostPopularStandalone->sale}}</p>
                 <p>{{$mostPopularStandalone->location}}</p>
                 <a class="hiddenLink" href="/standalones/{{$mostPopularStandalone->id}}"></a>
            </div>
            <div class="ratings">
              @for($i = 1; $i <=$mostPopularStandalone->ratings->avg('stars'); $i++)
              <div class="ratingContainer">
                <span class="full-rating"></span>
              </div>
              @endfor
              @for($i = 5; $i >$mostPopularStandalone->ratings->avg('stars');$i--)
              <div class="ratingContainer">
                <span class="empty-rating"></span>
              </div>
              @endfor
              <span class="ratingsCount">{{$mostPopularStandalone->ratings->count()}} Ratings</span>
            </div>
          </button>
          <button class="popular" type="button">
              <img class ="propertyCoverImage" src="{{Str::replaceFirst('public/','storage/',asset($mostPopularWorkspace->coverImage))}}">
              <div class="description">
                   <p>{{$mostPopularWorkspace->name}}</p>
                   <p>{{$mostPopularWorkspace->area}} sq Metres. {{$mostPopularWorkspace->units_available}} Units Available</p>
                   <p>kshs {{$mostPopularWorkspace->rent}}</p>
                   <p>{{$mostPopularWorkspace->location}}</p>
                   <a class="hiddenLink" href="/workspaces/{{$mostPopularWorkspace->id}}"></a>
              </div>
              <div class="ratings">
                @for($i = 1; $i <=$mostPopularWorkspace->ratings->avg('stars'); $i++)
                <div class="ratingContainer">
                  <span class="full-rating"></span>
                </div>
                @endfor
                @for($i = 5; $i >$mostPopularWorkspace->ratings->avg('stars');$i--)
                <div class="ratingContainer">
                  <span class="empty-rating"></span>
                </div>
                @endfor
                <span class="ratingsCount">{{$mostPopularWorkspace->ratings->count()}} Ratings</span>
              </div>
          </button>
          <button class="popular" type="button">
             <img class ="propertyCoverImage" src="{{Str::replaceFirst('public/','storage/',asset($mostPopularCommunity->coverImage))}}">
             <div class="description">
                 <p>{{$mostPopularCommunity->name}}</p>
                 <!-- <p>{{$mostPopularCommunity->area}} sq Metres. {{$mostPopularCommunity->units_available}} Units Available</p> -->
                 <p>{{$mostPopularCommunity->location}}</p>
                 <a class="hiddenLink" href="/communities/{{$mostPopularCommunity->id}}"></a>
            </div>
          </button>
      </div>
      <h3>Popular Towns</h3>
      <div class="recommendationsContainer">
          <div class="swiper-container">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                  <button class = "recommended">
              	     <img class ="recommendationImage" src="../images/glass2.jpg">
              			 <div class="description">
                         <p>UpperHill</p>
                         <p>Average Rent</p>
                         <p>kshs 32000/mo</p>
                         <a class="hiddenLink" href="/propertyCategories/1"></a>
              			</div>
                  </button>
              </div>
              <div class="swiper-slide">
                  <button class = "recommended">
              	     <img class ="recommendationImage" src="../images/real-estate.jpg">
              			 <div class="description">
                         <p>Mushroom</p>
                         <p>Average Rent</p>
                         <p>kshs 32000/mo</p>
                         <a class="hiddenLink" href="/propertyCategories/1"></a>
              			</div>
                  </button>
              </div>
              <div class="swiper-slide">
                  <button class = "recommended">
              	     <img class ="recommendationImage" src="../images/overhead.jpg">
              			 <div class="description">
                         <p>Kahawa West</p>
                         <p>Average Rent</p>
                         <p>kshs 32000/mo</p>
                         <a class="hiddenLink" href="/propertyCategories/1"></a>
              			</div>
                  </button>
              </div>
              <div class="swiper-slide">
                  <button class = "recommended">
              	     <img class ="recommendationImage" src="../images/plots.jpg">
              			 <div class="description">
                         <p>Juja</p>
                         <p>Average Rent</p>
                         <p>kshs 32000/mo</p>
                         <a class="hiddenLink" href="/propertyCategories/1"></a>
              			</div>
                  </button>
              </div>
              <div class="swiper-slide">
                  <button class = "recommended">
              	     <img class ="recommendationImage" src="../images/villa.jpg">
              			 <div class="description">
                         <p>Lamu</p>
                         <p>Average Rent</p>
                         <p>kshs 32000/mo</p>
                         <a class="hiddenLink" href="/propertyCategories/1"></a>
              			</div>
                  </button>
              </div>
              <div class="swiper-slide">
                  <button class = "recommended">
              	     <img class ="recommendationImage" src="../images/condo.jpg">
              			 <div class="description">
                         <p>Malindi</p>
                         <p>Average Rent</p>
                         <p>kshs 32000/mo</p>
                         <a class="hiddenLink" href="/propertyCategories/1"></a>
              			</div>
                  </button>
              </div>
              <div class="swiper-slide">
                  <button class = "recommended">
              	     <img class ="recommendationImage" src="../images/glass.jpg">
              			 <div class="description">
                         <p>Nairobi CBD</p>
                         <p>Average Rent</p>
                         <p>kshs 32000/mo</p>
                         <a class="hiddenLink" href="/propertyCategories/1"></a>
              			</div>
                  </button>
              </div>
              <div class="swiper-slide">
                  <button class = "recommended">
              	     <img class ="recommendationImage" src="../images/glass2.jpg">
              			 <div class="description">
                         <p>UpperHill</p>
                         <p>Average Rent</p>
                         <p>kshs 32000/mo</p>
                         <a class="hiddenLink" href="/propertyCategories/1"></a>
              			</div>
                  </button>
              </div>
              <div class="swiper-slide">
                  <button class = "recommended">
              	     <img class ="recommendationImage" src="../images/lounge.jpg">
              			 <div class="description">
                         <p>Nakuru</p>
                         <p>Average Rent</p>
                         <p>kshs 32000/mo</p>
                         <a class="hiddenLink" href="/propertyCategories/1"></a>
              			</div>
                  </button>
              </div>
              <div class="swiper-slide">
                  <button class = "recommended">
              	     <img class ="recommendationImage" src="../images/woods.jpg">
              			 <div class="description">
                         <p>Kiambu</p>
                         <p>Average Rent</p>
                         <p>kshs 32000/mo</p>
                         <a class="hiddenLink" href="/propertyCategories/1"></a>
              			</div>
                  </button>
              </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-navigation"></div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <!-- <div class="swiper-button-prev"></div> -->
          </div>
      </div>
        <div class="footer">
          First Monarchy.All Rights Reserved.Terms and Conditions.
        </div>
  </div>
    <script src="{{asset('js/swiper.min.js')}}"></script>
    <script src="{{asset('js/properties/all.js')}}"></script>
  </body>
</html>
