<div class="dataContainer">
<img class="dataImage" data-reference = "workspace{{$workspace->id}}" src="{{Str::replaceFirst('public/','storage/',asset($workspace->coverImage))}}">
<div>
  <span>{{$workspace->name}}</span>
  <span>{{$workspace->likes->count()}}</span>
  <span>@if($workspace->community()->exists()){{$workspace->community->name}} @else <i>None</i>@endif</span>
  <span>{{$workspace->bookings->count()}}</span>
</div>
<div id="workspace{{$workspace->id}}Options" class="btn-grp">
  <button type="button" class="close closeModal closeBtnGrp" data-id="workspace{{$workspace->id}}Options"><img src="../images/close1.svg"></button>
  <div class="buttonContainer">View<a class="button view" href="/workspaces/{{$workspace->id}}" title="View Rental"><img src="../images/view.svg"></a></div>
  <div class="buttonContainer">Bookings<button type="button" class="button show_bookings {{$workspace->bookings->count() ? "" :"empty disabled"}}" data-url = "/book_workspace/{{$workspace->id}}" data-tab = "bookingsTab" data-tabbutton = "bookingsTabButton" data-data = "bookings"><img src="../images/group.svg"></button></div>
  <div class="buttonContainer">Community<button type="button" class="button choose_community {{$workspace->community()->exists()? "InCommunity disabled" : ""}}" data-property = "{{$workspace->id}}" data-type = "workspaces" data-id = "modal" @if($workspace->community()->exists())data-community = "{{$workspace->community->name}}"@endif><img src="../images/city.svg"></button></div>
  <div class="buttonContainer">Edit<button type="button" class="button showModal edit" data-id = "workspace{{$workspace->id}}EditForm"><img src="../images/pen.svg"></button></div>
  <div class="buttonContainer">Delete<button type="button" class="button delete propertyDeleteButton" data-url = "/workspaces/{{$workspace->id}}" data-name="{{$workspace->name}}"><img src="../images/delete1.svg"></button></div>
</div>
<button type="button" class="button more-modal showModal" data-id="workspace{{$workspace->id}}Options"><image src="../images/more-vert.svg"></button>
</div>
<form id="workspace{{$workspace->id}}EditForm" class= "editForm workspaceEditForm" action="/workspaces/{{$workspace->id}}" method="post" enctype="multipart/form-data">
  @csrf
  @method('PATCH')
  <div id="workspaceEditFormContainer" class="formtext">
    <button type = "button"  data-id = "workspace{{$workspace->id}}EditForm" class="close closeModal"><img src="../images/close1.svg"></button>
    <h4>Edit Workspace</h4>
  <div class="inputContainer">
       <label for="name">Name</label><input id="name" class="input" name="name" value="{{$workspace->name}}" type="text" size="25" title="Enter your name" placeholder="Enter the title here" required>
  </div>
  <div class="inputContainer">
     <label for="location">Location</label><input id="location" class="input" name="location" value="{{$workspace->location}}" type="text" placeholder = "Location" size="25" required>
  </div>
  <div class="inputContainer">
    <label for="area">Area</label><input id="area" class="input" name="area" type="number" value="{{$workspace->area}}" size="25" placeholder="beds" required>
  </div>
  <div class="inputContainer">
      <label for="units_available">Units Available</label><input id="units_available" class="input" name="units_available" value="{{$workspace->units_available}}" type="number" size="25"  placeholder="Available Units" required>
  </div>
  <div class="inputContainer">
    <label for="rent">Rent</label><input id="rent" class="input" name="rent" value="{{$workspace->rent}}" type="number" size="25" placeholder="Rent/mo" required>
  </div>
  <div class="textfieldContainer">
       <label for="Description">Description</label><textarea id="Description" class="textarea" name="description" rows="5" cols="25" value="" placeholder="Enter description here"  required>{{$workspace->description}}</textarea>
  </div>
  <div class="errorContainer">
    <ul class="errorList">

    </ul>
  </div>
  <div  class="inputContainer">
     <button  type="button" data-url = "/workspaces/{{$workspace->id}}" class="button editWorkspace create">Confirm Update</button>
  </div>
      <div class="imageViewBox">
        <div class="inputContainer imageContainer">
            <img class="image" data-reference = "workspace{{$workspace->id}}" src="{{Str::replaceFirst('public/','storage/',asset($workspace->coverImage))}}" alt="{{$workspace->name}}">
            <div class="inputContainer coverImageSelect">
                <button type="button" data-input = "workspace{{$workspace->id}}" class="button changeImage changeCoverImage">Change Cover Image</button>
                <input type="file" name = "propertyCoverPhoto" class = "imageInput" data-url = "/workspaces/{{$workspace->id}}" data-image = "workspace{{$workspace->id}}" data-button = "workspace{{$workspace->id}}" data-errors = "workspace{{$workspace->id}}CoverErrors" accept="image/png,image/jpeg">
            </div>
            <div class="errorContainer">
              <ul class="workspace{{$workspace->id}}CoverErrors">

              </ul>
            </div>
        </div>
        @each('properties.owner.partials.image',$workspace->images,'image')
        <div class=" additionContainer imageContainer">
         <button type="button" data-input = "workspace{{$workspace->id}}AddedImage" class="button addImage"><img src = "../images/add.svg"> Add Image</button>
         <input type="file" name = "propertyPhoto" class = "addedImage" data-url = "/workspaces/{{$workspace->id}}" data-button = "workspace{{$workspace->id}}AddedImage" data-errors = "workspace{{$workspace->id}}AddedImageErrors" accept="image/png,image/jpeg">
          <div class="errorContainer">
            <ul class="workspace{{$workspace->id}}AddedImageErrors">

            </ul>
          </div>
      </div>
    </div>
  </div>
</form>
