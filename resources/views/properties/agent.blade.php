<!DOCTYPE html>
<html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width" initial-scale="1.0">
   <meta name="description" content="Build a dream home,workspace or Public utility in a photorealistic online environment">
   <meta name="keywords" content="First Monarchy,build,dream,home">
   <title>First Monarchy-Build</title>
   <link rel="stylesheet" type="text/css" href="{{asset('css/properties/owner-stylesheet.css')}}"/>
 </head>
 <body>
   <div class="overlay">
   </div>
  <div class="container">
     <div class="item1">
       <div class="user">
         <img class="avatar" src="{{Str::replaceFirst('public/','storage/',asset(Auth::guard('agent')->user()->logo))}}">
         <p>{{Auth::guard('agent')->user()->name}}</p>
         <form id="logoutForm" action="/logout/agents" method="POST">
             @csrf
            <label for="submit"><input id="submit" type="submit" value="logout"><img class="logoutIcon" src="../images/logout.svg"></label>
         </form>
        </div>
        <div class="navlinks">
          <div class="categories">
            <button id="dashboardTabButton" class="tabButton">Dashboard</button>
          </div>
          <div class="categories">
            <button id="rentalsTabButton" class="tabButton">Rentals</button>
          </div>
          <div class="categories">
            <button id="standalonesTabButton" class="tabButton">Standalone</button>
          </div>
          <div class="categories">
            <button id="hostelsTabButton" class="tabButton">Student Accomodation</button>
          </div>
          <div class="categories">
            <button id="workspacesTabButton" class="tabButton">Workspaces</button>
          </div>
          <div class="categories">
            <button id="communitiesTabButton" class="tabButton">Communities</button>
          </div>
          <div class="categories">
            <button id="settingsTabButton" class="tabButton">Settings</button>
          </div>
        </div>
    </div>
    <div class="Tab">
    <div id ="dashboardTab" class="tabcontent">
    <div class="header">
      <div class="greetings">
        <p class="welcome">Welcome <strong>{{Auth::guard('agent')->user()->name}}</strong></p>
        <p class="text">How is the company today ?</p>
      </div>
      <div class="notificationGroup">
      <div class="notification">
        <p class="figure">{{$rentals->count()}}</p>
        <div class="title"><img class="notificationIcon" src="../images/whiteHomeSketch.svg"><p class="text">Properties</p></div>
      </div>
      <div class="notification">
          <p class="figure">25</p>
        <div class="title"><img class="notificationIcon" src="../images/whiteHomeSketch.svg"><p class="text">Revenue</p></div>
      </div>
      <div class="notification">
          <p class="figure">8</p>
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
  </div>
    <div id = "rentalsTab" class="tabcontent">
        <span><h2>Rentals</h2></span>
        <div class="shortcuts"><button id="createPlan" class="submit" ><img src="../images/addnew.svg"></button></div>
        <form id="planCreateForm" action="/rentals" method="post" enctype="multipart/form-data">
  	      @csrf
          <div id="planFormContainer" class="formtext">
            <button id="closePlanCreateForm" type="button" class="close"><img src="../images/close1.svg"></button>
            <h4>Add New Plan</h4>
              <div class="inputContainer">
                   <label for="name">Name</label><input id="name" class="input" name="name" type="text" size="25" title="Enter your name" placeholder="Enter the title here" required>
  			      </div>
              <div class="inputContainer">
                 <label for="location">Location</label><input id="location" class="input" name="location" type="text" placeholder = "Location" size="25" required>
              </div>
              <div class="inputContainer">
                  <label for="file">CoverImage</label><input id="file" accept="image/*" class="input" name="propertyCoverPhoto" type="file" required>
              </div>
              <div class="inputContainer">
                <label for="bedrooms">Bedrooms</label><input id="bedrooms" class="input" name="bedrooms" type="number" size="25" placeholder="bedrooms" required>
              </div>
              <div class="inputContainer">
                <label for="bathrooms">Bathrooms</label><input id="bathrooms" class="input" name="bathrooms" type="number" size="25" placeholder="bathrooms" required>
              </div>
              <div class="inputContainer">
                <label for="parking_slots">Parking</label><input id="parking_slots" class="input" name="parking_slots"  type="number" size="25" placeholder="Parking" required>
              </div>
              <div class="inputContainer">
                  <label for="units_available">Units Available</label><input id="units_available" class="input" name="units_available" type="number" size="25"  placeholder="Available Units" required>
              </div>
              <div class="inputContainer">
                <label for="rent">Rent</label><input id="rent" class="input" name="rent" type="number" size="25" placeholder="Rent/mo" required>
              </div>
              <div class="textfieldContainer">
                   <label for="Description">Description</label><textarea id="Description" class="textarea" name="description" rows="5" cols="25" value="{{ old('description') }}" placeholder="Enter description here"  required></textarea>
              </div>
              <div class="inputContainer">
                <label for="file0">Images</label><input id="file0" class="input" name="propertyPhotos[]"  type="file"  required>
              </div>
              <div class="inputContainer">
                <button type="button" id="addImageButton" class="submit">Add Photo</button>
              </div>
              <div  id = "last" class="inputContainer">
                 <input id="create" type="submit" class="submit" value="ADD">
              </div>
          </div>
        		@if($errors->any())
        		<div style="background-color:red;">
        	    <ul>
        		@foreach ($errors->all() as $error)
        			<li>{{$error}}</li>
        	     @endforeach
        		 </ul>
        		 </div>
        		 @endif
       </form>
        <div class="planHeader companyView">
           <span class="planImage"></span>
             <div>
                  <span>Name</span>
                  <!-- <span>Category</span> -->
                  <span>Date Added</span>
                  <span><img style="width:1.8rem;height:1.8rem;" src="../images/empty-heart.svg"></span>
              </div>
              <div id="btn-grp">
                      Actions
               </div>
         </div>
        @foreach($rentals as $rental)
        <div class="planContainer companyView">
            <img class="planImage" src="{{Str::replaceFirst('public/','storage/',asset($rental->coverImage))}}">
            <div>
              <span>{{$rental->name}}</span>
              <!-- <span></span> -->
              <span>{{\Carbon\Carbon::parse($rental->created_at)->diffForHumans()}}</span>
              <span></span>
            </div>
             <div id="btn-grp">
            <button type="button" id="edit" class="submit showEditForm"><img src="../images/pen.svg"></button>
            <form id = "deletePlanForm" class="planDeleteForm" action="/rentals/{{$rental->id}}" method="post">
                @csrf
                @method('DELETE')
                <label id="delete"  class="submit deleteModalOpener"><input type="button" value=""><img src="../images/delete1.svg"></label>
            </form>
            <div class="confirmationModal">
              Are You Sure?
              <p>This Action is permanent and irreversible.</p>
              This building plan will be deleted.
              <div class="">
                  <button class="submit deleteModalCloser" type="button" name="button">Cancel</button>
                  <input id="confirmDeletion" type="submit" class="submit confirmDeletionButton" name="" value="Delete This Building Plan">
              </div>
            </div>
            <a id="view" class="submit" href="/rentals/{{$rental->id}}" title="View Plan"><img src="../images/view.svg"></a>
          </div>
         </div>
            <form id="planEditForm" class= "planEditForm" action="/rentals/{{$rental->id}}" method="post" enctype="multipart/form-data">
      	      @csrf
              @method('PATCH')
              <div id="planFormContainer" class="formtext">
                <button type = "button" id="closePlanEditForm" class="close closePlanEditForm"><img src="../images/close1.svg"></button>
                <h4>Edit Plan</h4>
                  <div class="inputContainer">
                       <label for="Name">Name:</label><input id="Name" class="input" name="name" type="text" size="25" title="Enter your name" placeholder="Enter the title here" value="{{$rental->name}}" required>
      			      </div>
                  <div class="inputContainer">
                    <label for="bedrooms">Bedrooms</label><input id="bedrooms" class="input" name="bedrooms" type="number" size="25" placeholder="bedrooms" value="{{$rental->bedrooms}}" required>
                  </div>
                  <div class="inputContainer">
                    <label for="full_bathrooms">Bathrooms</label><input id="bathrooms" class="input" name="bathrooms" type="number" size="25" placeholder="bathrooms" value="{{$rental->bathrooms}}" required>
                  </div>
                  <div class="inputContainer">
                    <label for="parking_slots">Parking</label><input id="parking_slots" class="input" name="parking_slots" type="number" size="25" placeholder="Parking" value="{{$rental->parking_slots}}" required>
                  </div>
                  <div class="inputContainer">
                    <label for="rent">Rent</label><input id="rent" class="input" name="price" type="number" size="25" placeholder="rent" value="{{$rental->rent}}" required>
                  </div>
                  <div class="inputContainer">
                    <label for="units_available">Rent</label><input id="units_available" class="input" name="price" type="number" size="25" placeholder="rent" value="{{$rental->units_available}}" required>
                  </div>
                  <div class="inputContainer">
                      <label for="location">Location</label><input id="location" class="input" name="location" type="text" size="25" placeholder="Location" value="{{$rental->location}}"  required>
                  </div>
                  <div class="textfieldContainer">
                       <label for="Description">Description</label><textarea id="Description" class="textarea" name="description" rows="5" cols="25" value="{{ old('description') }}" placeholder="Enter description here"  required>{{$rental->description}}</textarea>
                  </div>
                  <div class="inputContainer">
                      <button type="button" class="submit addPlanImageButton">Add Photo</button>
                  </div>
                  <div class="imageViewBox">
                    <div class="inputContainer imageContainer">
                        <img class="image" src="{{Str::replaceFirst('public/','storage/',asset($rental->coverImage))}}" alt="">
                        <div class="inputContainer coverImageSelect">
                            <button id="changeCoverImageButton" type="button" class="submit changePlanCoverImageButton">Change Cover Image</button>
                            <button id="cancelCoverImageChangeButton" type="button" class="submit cancelPlanCoverImageChangeButton">Cancel</button>
                        </div>
                    </div>
                  @foreach($rental->images as $images)
                  <div class="inputContainer imageContainer">
                      <img class="image" src="{{Str::replaceFirst('public/','storage/',asset($images->url))}}" alt="{{$rental->name}}">
                      <div class="inputContainer coverImageSelect">
                        <button type="button" class="submit changeImage">Change Image</button>
                        <button type="button" class="submit cancelImageChange">Cancel</button>
                        <input type="hidden" name="id[]" value="{{$images->id}}" disabled>
                        <input type="submit" name="" class="submit imageDeleteButton" value="Delete Image">
                    </div>
                  </div>
                  @endforeach
                </div>
                  <div class="inputContainer">
                     <input id="create" type="submit" class="submit" value="Confirm Update">
                  </div>
              </div>
            		@if($errors->any())
            		<div style="background-color:red;">
            	    <ul>
            		@foreach ($errors->all() as $error)
            			<li>{{$error}}</li>
            	     @endforeach
            		 </ul>
            		 </div>
            		 @endif
           </form>
        @endforeach
    </div>
    <div id="standalonesTab" class="tabcontent">

    </div>
    <div id="hostelsTab" class="tabcontent">

    </div>
    <div id="workspacesTab" class="tabcontent">

    </div>
    <div id="communitiesTab" class="tabcontent">

    </div>
    <div id = "settingsTab" class="tabcontent">
      SETTINGS
      <form id="profileEditForm" action="/companies/{{Auth::guard('agent')->id()}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="formtext">
          <div class="inputContainer">
                <span><h4>Edit Company Info</h4></span>
                <img class="profileAvatar" src="{{Str::replaceFirst('public/','storage/',asset(Auth::guard('agent')->user()->logo))}}">
          </div>
          <div id="LogoSelect" class="inputContainer">
            <button type="button" id="changeLogoButton" class="submit">Change Logo</button>
            <button type="button" id="cancelLogoChange" class="submit">Cancel</button>
          </div>
          <div class="inputContainer">
              <label for="name">Name</label><input id="name" type="text" class="input @error('name') is-invalid @enderror" value="{{Auth::guard('agent')->user()->name}}" placeholder="Name" name="name" autocomplete="name" autofocus  required>
          </div>
          <div class="inputContainer">
             <label for="bio">Bio</label><textarea id="bio" type="text" class="textarea @error('bio') is-invalid @enderror" name="description"  placeholder="Description" required>{{Auth::guard('agent')->user()->bio}}</textarea>
          </div>
          <div class="inputContainer">
             <label for="email">Company Email</label><input id="email" type="email" name="email" class="input @error('email') is-invalid @enderror"  value="{{Auth::guard('agent')->user()->email }}" placeholder="Email address" autocomplete="email" required>
          </div>
           <div  class="inputContainer">
             <input type="submit" id="profile" class="submit" value="Confirm">
           </div>
       </div>
         @if($errors->any())
         <div style="background-color:red">
           <ul>
         @foreach ($errors->all() as $error)
           <li>{{$error}}</li>
            @endforeach
          </ul>
          </div>
          @endif
        </form>
    </div>
  </div>
  <div class="footer">FIRST MONARCHY 2019</div>
</div>
  <script src="{{asset('js/properties/owner.js')}}"></script>
  </body>
</html>
