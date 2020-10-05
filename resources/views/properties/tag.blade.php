<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width" initial-scale="1.0">
    <meta name="description" content="Find your dream home or workspace">
    <meta name="keywords" content="First Monarchy,build,dream,home">
    <link rel="stylesheet" href="{{asset('css/swiper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/notiflix-2.1.3.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/properties/tag-stylesheet.css')}}"/>
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
               <input class="search" type="search" placeholder="Try logCabins" name="search-term">
               <label class="submitButton" for="search"><img src="../images/search.svg"><input id="search" type="submit" value="Search"></label>
           </form>
        </div>
        <div class="item5">
            <button class="menuOpen">&#10060;</button>
            <a class="navigationlink" title="Homepage" href="/">Home</a>
            <a class="navigationlink" title="About page" href="/about">About</a>
            <a class="navigationlink" title="Contact page" href="/contact">Contact</a>
            <a class="navigationlink" title="Contact page" href="/lounge">Lounge</a>
  	    </div>
        <div class="recommendationsContainer">
            <div class="swiper-container">
              <div class="swiper-wrapper">
                @auth
                    <div class="swiper-slide" data-hash = "slide0.1">
                        <button class = "recommended">
                    	     <img class ="swiper-lazy recommendationImage @isset($diary){{'selected'}}@endisset" data-src="../images/notepad.jpg">
                           <a class="hiddenLink" href="/diary#slide0.1"></a>
                        </button>
                        <p>Diary</p>
                        <div class="swiper-lazy-preloader"></div>
                    </div>
                    @endauth
                <div class="swiper-slide">
                    <button class = "recommended">
                	     <img class ="swiper-lazy recommendationImage @isset($feed){{'selected'}} @endisset" data-src="../images/FM.jpg">
                       <a class="hiddenLink" href="/Ideas"></a>
                    </button>
                    <p>All</p>
                    <div class="swiper-lazy-preloader"></div>
                </div>
                @foreach(App\Tag::all()->where('origin','admin') as $t)
                @if($t->posts->count())
                <div class="swiper-slide" data-hash = "slide{{$loop->iteration}}">
                    <button class = "recommended">
                	     <img class ="swiper-lazy recommendationImage @isset($tag) @if($t->id == $tag->id){{'selected'}}@endif @endisset" data-src="{{Str::replaceFirst('public/','storage/',asset($t->posts()->first()->images()->first()->url))}}">
                       <a class="hiddenLink" href="/tags/{{$t->id}}#slide{{$loop->iteration}}"></a>
                    </button>
                    <p>{{$t->name}}</p>
                    <div class="swiper-lazy-preloader"></div>
                </div>
                @endif
                @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-navigation"></div>
                <!-- Add Arrows -->
                <!-- <div class="swiper-button-next"></div> -->
                <!-- <div class="swiper-button-prev"></div> -->
              </div>
              <div class="swiper-button-next"></div>
        </div>
        <div class="item6">
          @isset($tag)
          <h2>{{$tag->name}}</h2>
          @endisset
          @auth
          @isset($diary)
          <h2>Diary</h2>
          <h4>{{auth()->user()->diaryEntries->count()}} items</h4>
          @endisset
          @endauth
          @isset($posts)
          <h4>{{$posts->count()}} found</h4>
          @endisset
        </div>
        <div class="item7">
          @isset($posts)
          @foreach($posts as $post)
          <div class="listingContainer">
            <button class = "listing">
        	     <img class ="listingCoverImage" src="{{Str::replaceFirst('public/','storage/',asset($post->images()->first()->url))}}">
        			 <div class="description">
                  <form class="wishform" action="/diary/{{$post->id}}" method="post">
                    @csrf
                    @auth
                    @if(auth()->user()->diaryEntries->contains($post->id))
                    @method('DELETE')
                    @endif
                    @endauth
                    <label class="diarylabel">
                      <input class="checkbox @auth{{'loggedIn'}}@endauth" type="checkbox" @auth @if(auth()->user()->diaryEntries->contains($post->id)){{'checked'}}@endif @endauth><span class="diary-check-toggle"></span>
                    </label>
                  </form>
                   <a class="hiddenLink" href="/posts/{{$post->id}}"></a>
        			</div>
            </button>
            <!-- <form class="wishform" action="/diaries/{{$post->id}}" method="post">
              @csrf
              <label class="label">
                <input class="checkbox" type="checkbox"><span class="check-toggle"></span>
              </label>
            </form> -->
          </div>
            @endforeach
          @endisset
          @isset($feed)
          @foreach($feed as $p)
          <div class="listingContainer">
            <button class = "listing">
        	     <img class ="listingCoverImage" src="{{Str::replaceFirst('public/','storage/',asset($p->images()->first()->url))}}">
        			 <div class="description">
                   <form class="wishform" action="/diary/{{$p->id}}" method="post">
                       @csrf
                       @auth
                       @if(auth()->user()->diaryEntries->contains($p->id))
                       @method('DELETE')
                       @endif
                       @endauth
                     <label class="diarylabel">
                       <input class="checkbox @auth{{'loggedIn'}}@endauth" type="checkbox" @auth @if(auth()->user()->diaryEntries->contains($p->id)){{'checked'}}@endif @endauth><span class="diary-check-toggle"></span>
                     </label>
                   </form>
                   <a class="hiddenLink" href="/posts/{{$p->id}}"></a>
        			</div>
            </button>
            <!-- <form class="wishform" action="/diaries/{{$p->id}}" method="post">
              @csrf
              <label class="label">
                <input class="checkbox" type="checkbox"><span class="check-toggle"></span>
              </label>
            </form> -->
          </div>
            @endforeach
          @endisset
          @isset($diary)
          @foreach($diary as $po)
          <div class="listingContainer">
            <button class = "listing">
        	     <img class ="listingCoverImage" src="{{Str::replaceFirst('public/','storage/',asset($po->images()->first()->url))}}">
        			 <div class="description">
                   <form class="wishform" action="/diary/{{$po->id}}" method="post">
                     @csrf
                     @auth
                     @if(auth()->user()->diaryEntries->contains($po->id))
                     @method('DELETE')
                     @endif
                     @endauth
                     <label class="diarylabel">
                       <input class="checkbox @auth{{'loggedIn'}}@endauth" type="checkbox" @if(auth()->user()->diaryEntries->contains($po->id)){{'checked'}}@endif><span class="diary-check-toggle"></span>
                     </label>
                   </form>
                   <a class="hiddenLink" href="/posts/{{$po->id}}"></a>
        			</div>
            </button>
            <!-- <form class="wishform" action="/diaries/{{$po->id}}" method="post">
              @csrf
              <label class="label">
                <input class="checkbox" type="checkbox"><span class="check-toggle"></span>
              </label>
            </form> -->
          </div>
            @endforeach
          @endisset
        </div>
        <div class="footer">
          First Monarchy
        </div>
    </div>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/notiflix-2.1.3.min.js')}}"></script>
    <script src="{{asset('js/swiper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/properties/tag.js')}}"></script>
  </body>
</html>
