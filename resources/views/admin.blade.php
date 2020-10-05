<!DOCTYPE html>
<html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width" initial-scale="1.0">
   <meta name="description" content="Build a dream home,workspace or Public utility in a photorealistic online environment">
   <meta name="keywords" content="First Monarchy,build,dream,home">
   <title>First Monarchy-Admin</title>
   <script type="text/javascript" src="{{asset('js/Chart.min.js')}}"></script>
   <link rel="stylesheet" type="text/css" href="{{asset('css/notiflix-2.1.3.min.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('css/dropzone.min.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('css/admin-stylesheet.css')}}"/>
 </head>
 <body>
   <div class="overlay">
   </div>
  <div class="container">
     <div class="item1">
       <h1>FIRST MONARCHY</h1>
       <div class="user">
         <img class="avatar" data-reference = "avatar" src="{{Str::replaceFirst('public/','storage/',asset(Auth::guard('admin')->user()->avatar))}}">
         <p>{{Auth::guard('admin')->user()->first_name}} {{Auth::guard('admin')->user()->last_name}}</p>
        </div>
    </div>
    <div class="Tab">
    <div id ="dashboardTab" class="tabcontent">
    <div class="header">
      <div class="greetings">
        <p class="welcome">Welcome <strong>{{Auth::guard('admin')->user()->first_name}}</strong></p>
        <p class="text">How are you doing today ?</p>
      </div>
      <div class="notificationGroup">
      <div class="notification">
        <p class="figure">{{$companies->count()}}</p>
        <div class="title"><img class="notificationIcon" src="../images/organizationWhite.svg"><p class="text">Companies</p></div>
      </div>
      <div class="notification">
          <p class="figure">{{$users->count()}}</p>
        <div class="title"><img class="notificationIcon" src="../images/avatarwhite.svg"><p class="text">Users</p></div>
      </div>
      <div class="notification">
          <p class="figure">{{App\Rental::count() + App\Standalone::count() + App\Community::count() + App\Workspace::count() + App\Hostel::count() }}</p>
        <div class="title"><img class="notificationIcon" src="../images/buildingWhite.svg"><p class="text">Properties</p></div>
      </div>
    </div>
    </div>
    <div class="cardHolder">
      <div class="card">
        <img class="cardIcon" src="../images/organization.svg">
        <p class="banner">Companies</p>
      </div>
      <div class="card">
        <img class="cardIcon" src="../images/homeSketch.svg">
        <p class="banner">Owners</p>
      </div>
      <div class="card">
        <img class="cardIcon" src="../images/building.svg">
        <p class="banner">Properties</p>
      </div>
      <div class="card">
        <img class="cardIcon" src="../images/avatar.svg">
        <p class="banner">Users</p>
      </div>
    </div>
    <div class="tileContainer">
      <div class="tile">
        <canvas id="UserCanvas" width="100%" height="60px"><h1>Hello Fallback</h1></canvas>
      </div>
      <div class="tile">
        <canvas id="LikesCanvas" width="100%" height="60px"><h1>Hello Fallback</h1></canvas>
      </div>
    </div>
    </div>
         <div id="groupsTab" class="tabcontent">
           <div class="shortcuts">
             <button id="categoriesTabButton" class="innerTabButton" data-tab = "categoriesTab">Categories</button>
            <button id="tagsTabButton" class="innerTabButton" data-tab = "tagsTab">Tags</button>
           </div>
           <div id = "categoriesTab" class="innertabcontent">
             <!-- <span><h2>COMPANY CATEGORIES</h2></span> -->
             <div class="shortcuts"><button id="createCategory" class="create button showModal"  data-id = "categoryCreateForm">New Category</button></div>
             <form id="categoryCreateForm" class="createForm" action="/categories" method="post" enctype="multipart/form-data">
        	     @csrf
                <div class="formtext">
                  <button id="closeCategoryCreateForm" class="close closeModal" type="button" data-id = "categoryCreateForm"><img src="../images/close1.svg"></button>
                    <h4>CREATE NEW CATEGORY</h4>
                     <div class="inputContainer name">
                         <label for="Name">Name</label><input id="Name" class="input newCategoryName" name="name" type="text" size="25" title="Enter your name" placeholder="Enter the title here" required>
                    </div>
        			        <div class="textfieldContainer description">
                         <label for="description">Description</label><textarea id="description" class="textarea categoryDescription" name="description" rows="5" cols="25" value="{{ old('description') }}" placeholder="Enter description here" required></textarea>
                     </div>
                     <div id ="categoryImageDropzone" class="inputContainer dropzone">

        		        	</div>
                     <div class="errorContainer">
                       <ul class="errorList">

                     </ul>
                   </div>
                     <div class="inputContainer">
                         <button type="button" class="button create createCategoryButton">Create Category</button>
                   </div>
               </div>
             </form>
                   <div class="dataHeader">
                         <span class="dataImage"></span>
                         <div>
                             <span>Name</span>
                             <span>No' of Companies</span>
                             <span>Created</span>
                         </div>
                         <div class="btn-grp">
                           Actions
                      </div>
                   </div>
             @foreach($categories as $category)
             <div class="dataContainer">
                   <img class="dataImage" data-reference = "category{{$category->id}}" src="{{Str::replaceFirst('public/','storage/',$category->coverImage)}}" alt="{{$category->name}}">
                   <div>
                       <span>{{$category->name}}</span>
                       <span>{{$category->companies->count()}}</span>
                       <span>{{\Carbon\Carbon::parse($category->created_at)->diffForHumans()}}</span>
                   </div>
                   <div class="btn-grp">
                     <button type="button" class="button edit showModal" data-id = "category{{$category->id}}EditForm"><img src="../images/pen.svg"></button>
                     <button type="button" class="button delete" data-url = "/categories/{{$category->id}}"><img src="../images/delete1.svg"></button>
                </div>
             </div>
             <form id = "category{{$category->id}}EditForm" class="editForm" style="display: none;" action="/categories/{{$category->id}}" method="post" enctype="multipart/form-data">
                   @csrf
                    @method('PATCH')
                       <div class="formtext">
                            <button type="button"  class="close closeModal" data-id = "category{{$category->id}}EditForm"><img src="../images/close1.svg"></button>
                            <div class="inputContainer imageContainer">
                              <img class="categoryCover" data-reference = "category{{$category->id}}"  src="{{Str::replaceFirst('public/','storage/',asset($category->coverImage))}}" alt="{{$category->name}}">
                                <div class="inputContainer coverImageSelect">
                                    <button type="button" data-input = "category{{$category->id}}" class="button changeImage changeCoverImage">Change Category Image</button>
                                    <input type="file" name = "categoryCoverPhoto" class = "imageInput" data-url = "/categories/{{$category->id}}" data-image = "category{{$category->id}}" data-button = "category{{$category->id}}" data-errors = "category{{$category->id}}CoverErrors" accept="image/png,image/jpeg">
                                </div>
                                <div class="errorContainer">
                                  <ul class="category{{$category->id}}CoverErrors">

                                  </ul>
                                </div>
                            </div>
                             <div class="inputContainer">
                                 <label for="Name">Name</label><input id="Name" class="input editedCategoryName" name="name" type="text" size="25" value="{{$category->name}}" title="Enter your name" placeholder="Enter the title here" required>
                            </div>
                              <div class="textfieldContainer">
                                 <label for="description">Description</label><textarea id="description" class="textarea editedCategoryDescription" name="description" rows="5" cols="25" value="{{ old('description') }}" placeholder="Enter description here" required>{{$category->description}}</textarea>
                             </div>
                             <div class="errorContainer">
                                <ul class="errorList">

                                </ul>
                              </div>
                             <div class="inputContainer">
                                 <button type="button" class="button create editCategoryButton" data-url = "/categories/{{$category->id}}">Edit Category</button>
                           </div>
                       </div>
                   </form>
             @endforeach
             {{$categories->links()}}
             <p><strong>Page {{$categories->currentPage()}} of {{$categories->lastPage()}}</strong></p>
             </div>
                <div id="tagsTab" class="innertabcontent">
                  <div class="shortcuts"><button id="createTag" class="button create showModal" data-id = "tagCreateForm">New Tag</button></div>
                  <form id="tagCreateForm" class="createForm" action="/tags" method="post" enctype="multipart/form-data">
             	     @csrf
                     <div class="formtext">
                       <button id="closeTagCreateForm" class="close closeModal" type="button" data-id = "tagCreateForm"><img src="../images/close1.svg"></button>
                         <h4>CREATE NEW TAG</h4>
                          <div class="inputContainer">
                              <label for="name">Name</label><input id="name" class="input" name="name" type="text" required>
             		        	</div>
                            <div class="errorContainer">
                              <ul class="errorList">

                            </ul>
                          </div>
                          <div class="inputContainer">
                              <button type="button" class="button create createTagButton" data-url = "/tags">Create Tag</button>
                        </div>
                    </div>
                  </form>
                   <div class="dataHeader">
                         <div>
                             <span>Name</span>
                             <span>created</span>
                             <span>posts</span>
                         </div>
                         <div class="btn-grp">
                           Actions
                      </div>
                    </div>
                 @foreach($tags as $tag)
                  <div class="dataContainer">
                       <div>
                           <span>{{$tag->name}}</span>
                           <span>{{\Carbon\Carbon::parse($tag->created_at)->diffForHumans()}}</span>
                           <span>{{$tag->posts->count()}}</span>
                       </div>
                     <div class="btn-grp">
                       <button type="button" id="edit" class="button edit showModal" data-id = "tag{{$tag->id}}EditForm" ><img src="../images/pen.svg"></button>
                       <button type="button" class="button delete" data-url = "/tags/{{$tag->id}}"><img src="../images/delete1.svg"></button>
                    </div>
                  </div>
                 <form id="tag{{$tag->id}}EditForm" class="editForm editTag" action="/" method="post" enctype="multipart/form-data">
            	     @csrf
                  @method('PATCH')
                    <div class="formtext">
                      <button class="close closeModal" type="button" data-id = "tag{{$tag->id}}EditForm"><img src="../images/close1.svg"></button>
                        <h4>EDIT TAG</h4>
                         <div class="inputContainer">
                             <label for="name">Name</label><input id="name" class="input" name="name" value="{{$tag->name}}" type="text" required>
            		        	</div>
                          <div class="errorContainer">
                            <ul class="errorList">

                          </ul>
                        </div>
                         <div class="inputContainer">
                             <button type="button" class="button create editTagButton" data-url = "/tags/{{$tag->id}}">Update info</button>
                       </div>
                   </div>
                 </form>
                  @endforeach
                  {{$tags->links()}}
                  <p><strong>Page {{$tags->currentPage()}} of {{$tags->lastPage()}}</strong></p>
                </div>
         </div>
      <div id = "usersTab" class="tabcontent">
        <div class="shortcuts">
          <button id="regularUsersTabButton" class="innerTabButton" type="button" data-tab = "regularUsersTab">Users</button>
          <button id="companiesTabButton" class="innerTabButton" type="button" data-tab = "companiesTab">Professionals</button>
          <button id="ownersTabButton" class="innerTabButton" type="button" data-tab = "ownersTab">Owners</button>
          <button id="adminsTabButton" class="innerTabButton" type="button" data-tab = "adminsTab">Admins</button>
        </div>
       <div id="regularUsersTab" class="innertabcontent">
         <div class="dataHeader">
            <span class="dataImage"></span>
             <div>
               <span>Name</span>
               <span>Email</span>
               <span>Phone</span>
               <span>Joined</span>
             </div>
             <div class="btn-grp">
                 Actions
             </div>
           </div>
             @foreach($users as $user)
             <div class="dataContainer">
                <img class="dataImage" src="{{Str::replaceFirst('public/' , 'storage/' , $user->avatar)}}">
                <div>
                  <span>{{$user->first_name}} {{$admin->last_name}}</span>
                  <span><a href="mailto:{{$user->email}}">{{$user->email}}</a></span>
                  <span><a href="tel:{{$user->phone_number}}">{{$user->phone_number}}</a></span>
                  <span>{{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</span>
              </div>
                 <div class="btn-grp">
                   <button type="button" class="button delete" data-url = "/users/{{$user->id}}"><img src="../images/delete1.svg"></button>
                  </div>
             </div>
             @endforeach
             {{$users->links()}}
             <p><strong>Page {{$users->currentPage()}} of {{$users->lastPage()}}</strong></p>
       </div>
       <div id = "companiesTab" class="innertabcontent">
                   <div class="dataHeader">
                         <span class="dataImage"></span>
                         <div>
                             <span>Name</span>
                             <span>Joined</span>
                             <span>Category</span>
                         </div>
                         <div class="btn-grp">
                           Actions
                      </div>
                    </div>
           @foreach($companies as $company)
            <div class="dataContainer">
              <img class="dataImage" src="{{Str::replaceFirst('public/' , 'storage/' , asset($company->logo))}}" alt="{{$company->name}}">
                 <div>
                     <span>{{$company->name}}</span>
                     <span>{{\Carbon\Carbon::parse($company->created_at)->diffForHumans()}}</span>
                     <span>@foreach($company->categories as $categ){{$categ->name}},@endforeach</span>
                 </div>
               <div class="btn-grp">
                 <button type="button" class="button delete" data-url = "/companies/{{$company->id}}"><img src="../images/delete1.svg"></button>
              </div>
            </div>
            @endforeach
            {{$companies->links()}}
            <p><strong>Page {{$companies->currentPage()}} of {{$companies->lastPage()}}</strong></p>
          </div>
       <div id="ownersTab" class="innertabcontent">
         <div class="dataHeader">
            <span class="dataImage"></span>
             <div>
               <span>Name</span>
               <span>Contacts</span>
               <span>Properties</span>
               <span>Joined</span>
             </div>
             <div class="btn-grp">
                 Actions
             </div>
           </div>
           @foreach($owners as $owner)
           <div class="dataContainer">
              <img class="dataImage" src="{{Str::replaceFirst('public/' , 'storage/' , $owner->logo)}}">
              <div>
                <span>{{$owner->name}}</span>
                <span><a href="mailto:{{$owner->email}}">{{$owner->email}}</a>|<a href="tel:{{$owner->phone_number}}">{{$owner->phone_number}}</a></span>
                <span>{{$owner->rentals_count + $owner->hostels_count + $owner->workspaces_count + $owner->communities_count + $owner->standalones_count}}</span>
                <span>{{\Carbon\Carbon::parse($owner->created_at)->diffForHumans()}}</span>
            </div>
               <div class="btn-grp">
                  <a class="button view" href="/owners/{{$owner->id}}" title="View Owner"><img src="../images/view.svg"></a>
                  <button type="button" class="button delete" data-url = "/owners/{{$owner->id}}"><img src="../images/delete1.svg"></button>
                </div>
           </div>
           @endforeach
           {{$owners->links()}}
           <p><strong>Page {{$owners->currentPage()}} of {{$owners->lastPage()}}</strong></p>
       </div>
        <div id="adminsTab" class="innertabcontent">
          <div class="shortcuts"><button id="createAdmin" class="button create showModal" data-id = "adminCreateForm" >New Admin</button></div>
          <form id="adminCreateForm" class="createForm" method="POST" action="/register/admins" enctype="multipart/form-data">
                @csrf
                <div class ="formtext">
                  <button type="button" class="close closeModal" data-id = "adminCreateForm"><img src="../images/close1.svg"></button>
                    <h4>CREATE ADMIN</h4>
                    <div class="inputContainer">
                        <label for="firstName">First Name</label><input id="first_name" type="text" class="input" placeholder="First Name" name="first_name" autocomplete="first_name" autofocus  required>
                  </div>
                  <div class="inputContainer">
                       <label for="lastName">Last Name</label><input id="last_name" type="text" class="input"  name="last_name" autocomplete="last_name" placeholder="Last Name" required>
                  </div>
                  <div class="inputContainer">
                       <label for="email">Email</label><input id="email" type="email" name="email" class="input"  placeholder="Email address" autocomplete="email" required>
                 </div>
                 <div class="inputContainer">
                      <label for="avatar">Avatar</label><input id="avatar" class="input" type="file"  name="avatar" title="avatar" required>
                 </div>
                 <div class="inputContainer">
                      <label for="password">Create password</label><input id="password" type="password" class="input" name="password" placeholder="Create password" required>
                 </div>
                 <div class="inputContainer">
                      <label for="confirmPassword">Confirm password</label><input id="confirmPassword" class="input" type="password" name="password_confirmation" placeholder="Confirm password" required>
                 </div>
                 <div class="errorContainer">
                   <ul class="errorList">

                 </ul>
               </div>
                 <div class="inputContainer">
               <button type="button" class="button create createAdminButton" data-url = "/register/admins">Create Admin</button>
             </div>
           </div>
          </form>
          <div class="dataHeader">
             <span class="dataImage"></span>
              <div>
                <span>Name</span>
                <span>Email</span>
                <span>Created</span>
              </div>
              <div class="btn-grp">
                  Actions
              </div>
        </div>
        @foreach($admins as $admin)
        <div class="dataContainer">
           <img class="dataImage {{auth()->guard('admin')->id() === $admin->id ? 'activeadmin' :''}}" src="{{Str::replaceFirst('public/' , 'storage/' , $admin->avatar)}}">
           <div>
             <span>{{$admin->first_name}} {{$admin->last_name}}</span>
             <span><a href="mailto:{{$admin->email}}">{{$admin->email}}</a></span>
             <span>{{\Carbon\Carbon::parse($admin->created_at)->diffForHumans()}}</span>
         </div>
            <div class="btn-grp">
              @if(auth('admin')->id() !== $admin->id)
                <button type="button" class="button delete" data-url = "/admins/{{$admin->id}}"><img src="../images/delete1.svg"></button>
               @endif
             </div>
        </div>
        @endforeach
        {{$admins->links()}}
        <p><strong>Page {{$admins->currentPage()}} of {{$admins->lastPage()}}</strong></p>
           </div>
      </div>
      <div id = "settingsTab" class="tabcontent">
        <h3>SETTINGS</h3>
        <form id="profileEditForm" class="profileEditForm" action="/admins/{{Auth::guard('admin')->id()}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class ="formtext">
              <div class="logoContainer">
                    <img class="profileAvatar" data-reference = "avatar" src="{{Str::replaceFirst('public/','storage/',asset(auth('admin')->user()->avatar))}}">
                    <div class="inputContainer">
                      <button type="button" data-input = "avatarButton" class="button create changeImage changeAvatarButton">Change Avatar</button>
                      <input type="file" name = "avatar" class = "imageInput" data-url = "/admins/{{auth('admin')->id()}}" data-image = "avatar" data-button = "avatarButton" data-errors = "avatarErrors" accept="image/png,image/jpeg">
                    </div>
                    <div class="errorContainer">
                      <ul class="avatarErrors">

                      </ul>
                    </div>
              </div>
                <div class="inputContainer">
                    <label for="name">First Name</label><input id="name" type="text" class="input adminFirstName" value="{{Auth::guard('admin')->user()->first_name}}" placeholder="First Name" name="first_name" autocomplete="first_name" autofocus  required>
              </div>

              <div class="inputContainer">
                   <label for="last_name">Last Name</label><input id="name" type="text" class="input adminLastName" value="{{Auth::guard('admin')->user()->last_name}}" placeholder="Last Name" name="last_name" autocomplete="last_name" autofocus  required>
              </div>
              <div class="inputContainer">
                   <label for="email">Email</label><input id="email" type="email" name="email" class="input adminEmail"  value="{{Auth::guard('admin')->user()->email}}" placeholder="Email address" autocomplete="email" required>
              </div>
              <div class="errorContainer">
                <ul class="errorList">

              </ul>
            </div>
              <div class="inputContainer">
                <button type="button" class="button create">Confirm Update</button>
              </div>
            </div>
        </form>
        <form id="logoutForm" action="/logout/admins" method="POST">
            @csrf
           <label for="submit"><input class="button create logout" type="submit" value="logout"></label>
        </form>
      </div>
    </div>
  </div>
  <div class="navlinks">
    <div class="categories">
      <button id="dashboardTabButton" class="tabButton" data-tab = "dashboardTab">Dashboard</button>
    </div>
    <div class="categories">
      <button id="groupsTabButton" class="tabButton" data-tab = "groupsTab">Groups</button>
    </div>
    <div  class="categories">
      <button id="usersTabButton" class="tabButton" data-tab = "usersTab">User Management</button>
    </div>
    <div  class="categories">
      <button id="settingsTabButton" class="tabButton" data-tab = "settingsTab">Settings</button>
    </div>
  </div>
  <script src="{{asset('js/axios.min.js')}}"></script>
  <script src="{{asset('js/notiflix-2.1.3.min.js')}}"></script>
  <script src="{{asset('js/dropzone.min.js')}}"></script>
  <script>
  Chart.defaults.global.defaultFontFamily = 'Nunito';
		var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var config = {
			type: 'bar',
			data: {
				labels: ['July','August','September','October','November','December'],
				datasets: [{
					label: 'Companies',
					backgroundColor: '#76ec23',
					borderColor: '#76ec23',
					data: [
						17254,
            30117,
            54289,
            79178,
            100568,
            206980
					],
					fill: false,
				}, {
					label: 'Users',
					fill: false,
					backgroundColor:'#4b2f96',
					borderColor:'#4b2f96',
					data: [
						22254,
            40117,
            74289,
            99178,
            144568,
            286980
					],
				},
      {
        label: 'owners',
        fill: false,
        backgroundColor:'#a22b2b',
        borderColor:'#a22b2b',
        data: [
          12254,
          20117,
          44289,
          69178,
          114568,
          236980
        ],
      }]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Users'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Month'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'No of users'
						}
					}]
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('UserCanvas').getContext('2d');
      var ctx2 = document.getElementById('LikesCanvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
      window.myLine = new Chart(ctx2, config);
		};

	</script>
  <script src="{{asset('js/admin.js')}}"></script>
  </body>
</html>
