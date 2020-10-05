<div class="dataContainer">
  <img class="dataImage" data-reference = "community{{$community->id}}" src="{{Str::replaceFirst('public/','storage/',asset($community->coverImage))}}">
  <div>
    <span>{{$community->name}}</span>
    <span>{{\Carbon\Carbon::parse($community->created_at)->diffForHumans()}}</span>
    <span>{{$community->rentals->count() + $community->hostels->count() + $community->standalones->count() +$community->workspaces->count()}}</span>
  </div>
  <div id="community{{$community->id}}Options" class="btn-grp">
    <button type="button" class="close closeModal closeBtnGrp" data-id="community{{$community->id}}Options"><img src="../images/close1.svg"></button>
    <div class="buttonContainer">View<a class="button view" href="/communities/{{$community->id}}" title="View Listing"><img src="../images/view.svg"></a></div>
    <div class="buttonContainer">Units<button type="button" class="button show_units {{$community->rentals->count() + $community->hostels->count()  + $community->standalones->count() + $community->workspaces->count()? "" :"empty disabled"}}" data-url = "/communities/{{$community->id}}/units" data-tab = "unitsTab" data-tabbutton = "unitsTabButton" data-data = "units"><img src="../images/city.svg"></button></div>
    <div class="buttonContainer">Edit<button type="button"  class="button showModal edit" data-id = "community{{$community->id}}EditForm"><img src="../images/pen.svg"></button></div>
    <div class="buttonContainer">Delete<button type="button" class="button delete propertyDeleteButton" data-url = "/communities/{{$community->id}}" data-name="{{$community->name}}"><img src="../images/delete1.svg"></button></div>
</div>
 <button type="button" class="button more-modal showModal" data-id="community{{$community->id}}Options"><image src="../images/more-vert.svg"></button>
</div>
<form id="community{{$community->id}}EditForm" class= "editForm communityEditForm" action="/communities/{{$community->id}}" method="post" enctype="multipart/form-data">
  @csrf
  @method('PATCH')
   <div class="formtext">
    <button type = "button" data-id = "community{{$community->id}}EditForm" class="close closeModal"><img src="../images/close1.svg"></button>
    <h4>Edit Community</h4>
  <div class="inputContainer">
       <label for="name">Name</label><input id="name" class="input" name="name" value="{{$community->name}}" type="text" size="25" title="Enter your name" placeholder="Enter the title here" required>
  </div>
  <div class="inputContainer">
     <label for="location">Location</label><input id="location" class="input" name="location" value="{{$community->location}}" type="text" placeholder = "Location" size="25" required>
  </div>
  <div class="textfieldContainer">
       <label for="Description">Description</label><textarea id="Description" class="textarea" name="description" rows="5" cols="25"  placeholder="Enter description here"  required>{{$community->description}}</textarea>
  </div>
  <div class="errorContainer">
    <ul class="errorList">

    </ul>
  </div>
  <div  class="inputContainer">
     <button  type="button" data-url = "/communities/{{$community->id}}" class="button editCommunity create">Confirm Update</button>
  </div>
      <div class="imageViewBox">
        <div class="inputContainer imageContainer">
            <img class="image" data-reference = "community{{$community->id}}" src="{{Str::replaceFirst('public/','storage/',asset($community->coverImage))}}" alt="{{$community->name}}">
            <div class="inputContainer coverImageSelect">
              <button type="button" data-input = "community{{$community->id}}" class="button changeImage changeCoverImage">Change Cover Image</button>
              <input type="file" name = "propertyCoverPhoto" class = "imageInput" data-url = "/communities/{{$community->id}}" data-image = "community{{$community->id}}" data-button = "community{{$community->id}}" data-errors = "community{{$community->id}}CoverErrors" accept="image/png,image/jpeg">
            </div>
            <div class="errorContainer">
              <ul class="community{{$community->id}}CoverErrors">

              </ul>
            </div>
        </div>
        @each('properties.owner.partials.image',$community->images,'image')
        <div class=" additionContainer imageContainer">
            <button type="button" data-input = "community{{$community->id}}AddedImage" class="button addImage"><img src = "../images/add.svg"> Add Image</button>
            <input type="file" name = "propertyPhoto" class = "addedImage" data-url = "/communities/{{$community->id}}" data-button = "community{{$community->id}}AddedImage" data-errors = "community{{$community->id}}AddedImageErrors" accept="image/png,image/jpeg">
        <div class="errorContainer">
          <ul class="community{{$community->id}}AddedImageErrors">

          </ul>
        </div>
      </div>
    </div>
  </div>
</form>
