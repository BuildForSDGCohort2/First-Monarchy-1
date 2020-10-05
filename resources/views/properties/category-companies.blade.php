<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width" initial-scale="1.0">
    <meta name="description" content="Find your dream home or workspace">
    <meta name="keywords" content="First Monarchy,build,dream,home">
    <link rel="stylesheet" type="text/css" href="{{asset('css/notiflix-2.1.3.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/properties/companies-stylesheet.css')}}"/>
    <title>First Monarchy - Find Your Dream Home Or Workspace</title>
  </head>
  <body>
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
           <form class="searchForm" method="post">
               @csrf
               <input class="search" type="search" placeholder="Search Company Names eg First Monarchy" name="search-term">
               <label class="submitButton" for="search"><img src="../images/search.svg"><input id="search" type="submit" value="Search"></label>
           </form>
        </div>
        <div class="item5">
          <button class="menuOpen">&#10060;</button>
          <a class="navigationlink" title="Homepage" href="/">Home</a>
          <a class="navigationlink" title="About page" href="/about">About</a>
          <a class="navigationlink" title="Contact page" href="/contact">Contact</a>
  	    </div>
        <div class="item6">
          <h2>{{$category->name}}</h2>
          <h4>{{$category->companies->count()}} found</h4>
        </div>
        <div class="item7">
          @foreach($category->companies as $company)
          <div class="listingContainer">
            <button class = "listing">
        	     <div class ="listingCoverImage">
               <img class ="logo" src="{{Str::replaceFirst('public/','storage/', asset($company->logo))}}">
             </div>
        			 <div class="description">
        			     <p>{{$company->name}}</p>
                   <p><img class="detail_icon" src="../images/location2.svg" alt="location">{{$company->address}}</p>
                   <p><img class="detail_icon" src="../images/website.svg" alt="location"><a class="website" href="{{$company->address}}">{{$company->address}}</a></p>
                   {{-- <p>
                     <a class="" href="{{$company->address}}"><img class="detail_icon" src="../images/facebook.svg" alt="location"></a>
                     <a class="" href="{{$company->address}}"><img class="detail_icon" src="../images/twitter.svg" alt="location"></a>
                     <a class="" href="{{$company->address}}"><img class="detail_icon" src="../images/pinterest.svg" alt="location"></a>
                     <a class="" href="{{$company->address}}"><img class="detail_icon" src="../images/instagram.svg" alt="location"></a>
                   </p> --}}
                   <a class="hiddenLink" href="/companies/{{$company->id}}"></a>
        			</div>
              <div class="ratings">
                @for($i = 1; $i <=$company->ratings->avg('stars'); $i++)
                <div class="ratingContainer">
                  <span class="full-rating"></span>
                </div>
                @endfor
                @for($i = 5; $i >$company->ratings->avg('stars');$i--)
                <div class="ratingContainer">
                  <span class="empty-rating"></span>
                </div>
                @endfor
                <span class="ratingsCount">{{$company->ratings->count()}} Ratings</span>
              </div>
            </button>
          </div>
            @endforeach
        </div>
        <div class="footer">
          First Monarchy
        </div>
    </div>
    <script src="{{asset('js/notiflix-2.1.3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/properties/list.js')}}"></script>
  </body>
</html>
