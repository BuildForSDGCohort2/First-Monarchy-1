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
   <link rel="stylesheet" type="text/css" href="{{asset('css/company-stylesheet.css')}}"/>
 </head>
 <body>
   <div class="overlay">
   </div>
  <div class="container">
     <div class="item1">
       <h1>FIRST  MONARCHY</h1>
       <div class="user">
         <img class="avatar" data-reference = "logo" src="{{Str::replaceFirst('public/','storage/',asset(Auth::guard('company')->user()->logo))}}">
         <p>{{Auth::guard('company')->user()->name}}</p>
        </div>
    </div>
    <div class="Tab">
    <div id ="dashboardTab" class="tabcontent">
    <div class="header">
      <div class="greetings">
        <p class="welcome">Welcome <strong>{{Auth::guard('company')->user()->name}}</strong></p>
        <p class="text">How is the company today ?</p>
      </div>
      <div class="notificationGroup">
      <div class="notification">
        <p class="figure">{{Auth::guard('company')->user()->posts()->count()}}</p>
        <div class="title"><img class="notificationIcon" src="../images/clipboard.svg"><p class="text">Posts</p></div>
      </div>
      <div class="notification">
          <p class="figure">125</p>
        <div class="title"><img class="notificationIcon" src="../images/whiteHomeSketch.svg"><p class="text">Revenue</p></div>
      </div>
      <div class="notification">
          <p class="figure">78</p>
        <div class="title"><img class="notificationIcon" src="../images/whiteHomeSketch.svg"><p class="text">Appointments</p></div>
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
        <p class="banner">Plans</p>
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
  </div>
  <div id ="postsTab" class="tabcontent">
      <div class="shortcuts"><button id="createPost" class="button create showCreateForm" data-id = "createPostForm">New Post</button></div>
      <form id="createPostForm" class="createPostForm" action="/posts" method="post" enctype="multipart/form-data">
 	     @csrf
         <div class="formtext">
           <button class="close closeCreateForm closePostCreateForm" type="button" data-id="createPostForm"><img src="../images/close1.svg"></button>
             <h4>CREATE NEW POST</h4>
              <div id="postDropzone" class="inputContainer dropzone">
 		        	</div>
              <fieldset class="tags">
                <legend><strong>Tags </strong>(check all that apply)</legend>
                @foreach(App\Tag::all()->where('origin','admin')->sortBy('name') as $tag)
                <div class="input remember">
                     <label for="{{$tag->name}}">{{$tag->name}}<input id="{{$tag->name}}" class="companytypecheckbox" type="checkbox" name="tags[]"  value="{{$tag->id}}"><span class="new-checkbox"></span></label>
                </div>
                @endforeach
              </fieldset>
              <div class="errorContainer">
                <ul class = "errorList">

                </ul>
              </div>
              <div class="inputContainer">
                  <button type="button" class="button create createPostButton">Submit Post</button>
            </div>
        </div>
      </form>
      <div class="postContainer">
        @foreach($posts as $post)
          <div class="post">
            <div class="postImageContainer">
              <img class="postImage" src="{{Str::replaceFirst('public/','storage/',$post->images()->first()->url)}}" alt="{{$post->id}}">
               {{-- <a class="hiddenLink" href="posts/{{$post->id}}"></a>  --}}
            </div>
                <button type="button" class ="button postDelete" data-url = "posts/{{$post->id}}">Delete</button>
          </div>
        @endforeach
      </div>
  </div>
    <div id = "settingsTab" class="tabcontent">
      <form id="profileEditForm" class="profileEditForm" action="/companies/{{Auth::guard('company')->id()}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="formtext">
            <div class="logoContainer">
                  <img class="profileAvatar" data-reference = "logo" src="{{Str::replaceFirst('public/','storage/',asset(Auth::guard('company')->user()->logo))}}">
                  <div class="inputContainer">
                    <button type="button" data-input = "logoButton" class="button create changeLogoButton">Change Logo</button>
                    <input type="file" name = "logo" class = "imageInput" data-url = "/companies/{{auth('company')->id()}}" data-image = "logo" data-button = "logoButton" data-errors = "logoErrors" accept="image/png,image/jpeg">
                  </div>
                  <div class="errorContainer">
                    <ul class="logoErrors">

                    </ul>
                  </div>
            </div>
          <div class="inputContainer">
              <label for="name">Company Name</label><input id="name" type="text" class="input" value="{{auth('company')->user()->name}}" placeholder="Name" name="name" autocomplete="name" autofocus  required>
          </div>
          <div class="inputContainer">
             <label for="bio">Company Bio</label><textarea id="bio" type="text" class="textarea" name="bio"  placeholder="Description" required>{{auth('company')->user()->bio}}</textarea>
          </div>
          <div class="inputContainer">
             <label for="email">Company Email</label><input id="email" type="email" name="email" class="input"  value="{{auth('company')->user()->email}}" placeholder="Email address" autocomplete="email" required readonly disabled>
          </div>
          <div class="inputContainer">
  				     <label for="phone">Company Phone</label><input id="phone" type="text" class="input"  value="{{auth('company')->user()->phone}}" name="phone" placeholder="Phone Number" autocomplete="phone" required>
  				</div>
          <div class="inputContainer">
  				     <label for="address">Company Address</label><input id="address" type="text" class="input"  value="{{auth('company')->user()->address}}" name="address" placeholder="address" required>
  				</div>
          <div class="errorContainer">
            <ul class="errorList">

            </ul>
          </div>
           <div  class="inputContainer">
             <button type="button" class="button create editProfile" data-url = "/companies/{{auth('company')->id()}}">Update Profile</button>
           </div>
       </div>
        </form>
        <form id="logoutForm" action="/logout/companies" method="POST">
            @csrf
           <input type="submit" class=" create logout button" value="logout">
        </form>
    </div>
  </div>
  </div>
  <div class="navlinks">
    <div class="categories">
      <button id="dashboardTabButton" class="tabButton" data-tab = "dashboardTab">Dashboard</button>
    </div>
    <div class="categories">
      <button id="postsTabButton" class="tabButton" data-tab = "postsTab">Posts</button>
    </div>
    <div class="categories">
      <button id="settingsTabButton" class="tabButton" data-tab = "settingsTab">Settings</button>
    </div>
  </div>
  <script src="{{asset('js/axios.min.js')}}"></script>
   <script src="{{asset('js/notiflix-2.1.3.min.js')}}"></script>
   <script src="{{asset('js/dropzone.min.js')}}"></script>
  <script src="{{asset('js/company.js')}}"></script>
  </body>
</html>
