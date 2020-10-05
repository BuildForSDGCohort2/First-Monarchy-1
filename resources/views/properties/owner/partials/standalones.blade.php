<div class="dataContainer">
  <img class="dataImage" data-reference = "standalone{{$standalone->id}}" src="{{Str::replaceFirst('public/','storage/',asset($standalone->coverImage))}}">
  <div>
    <span>{{$standalone->name}}</span>
    {{-- <span>{{\Carbon\Carbon::parse($standalone->created_at)->diffForHumans()}}</span> --}}
    <span>@if($standalone->community()->exists()){{$standalone->community->name}} @else <i>None</i>@endif</span>
    <span>{{$standalone->likes->count()}}</span>
  </div>
  <div id="standalone{{$standalone->id}}Options" class="btn-grp">
    <button type="button" class="close closeModal closeBtnGrp" data-id="standalone{{$standalone->id}}Options"><img src="../images/close1.svg"></button>
     <div class="buttonContainer">View<a class="button view" href="/standalones/{{$standalone->id}}" title="View Listing"><img src="../images/view.svg"></a></div>
     <div class="buttonContainer">Community<button type="button" class="button choose_community {{$standalone->community()->exists()? "InCommunity disabled" : ""}}" data-property = "{{$standalone->id}}" data-type = "standalones" data-id = "modal" @if($standalone->community()->exists())data-community = "{{$standalone->community->name}}"@endif><img src="../images/city.svg"></button></div>
     <div class="buttonContainer">Edit<button type="button"  class="button showModal edit" data-id = "standalone{{$standalone->id}}EditForm"><img src="../images/pen.svg"></button></div>
     <div class="buttonContainer">Delete<button type="button" class="button delete propertyDeleteButton" data-url = "/standalones/{{$standalone->id}}" data-name="{{$standalone->name}}"><img src="../images/delete1.svg"></button></div>
</div>
<button type="button" class="button more-modal showModal" data-id="standalone{{$standalone->id}}Options"><image src="../images/more-vert.svg"></button>
</div>
    <form id="standalone{{$standalone->id}}EditForm" class= "editForm standaloneEditForm" action="/standalones/{{$standalone->id}}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="formtext">
        <button type = "button"  class="close closeModal" data-id = "standalone{{$standalone->id}}EditForm"><img src="../images/close1.svg"></button>
        <h4>Edit Standalone</h4>
      <div class="inputContainer">
           <label for="name">Name</label><input id="name" class="input" name="name" value="{{$standalone->name}}" type="text" size="25" title="Enter your name" placeholder="Enter the title here" required>
      </div>
      <div class="inputContainer">
         <label for="location">Location</label><input id="location" class="input" name="location" value="{{$standalone->location}}" type="text" placeholder = "Location" size="25" required>
      </div>
      <div class="inputContainer">
        <label for="bedrooms">Bedrooms</label><input id="bedrooms" class="input" name="bedrooms" value="{{$standalone->bedrooms}}" type="number" size="25" placeholder="bedrooms" required>
      </div>
      <div class="inputContainer">
        <label for="bathrooms">Bathrooms</label><input id="bathrooms" class="input" name="bathrooms" value="{{$standalone->bathrooms}}" type="number" size="25" placeholder="bathrooms" required>
      </div>
      <div class="inputContainer">
        <label for="parking_slots">Parking</label><input id="parking_slots" class="input" name="parking_slots" value="{{$standalone->parking_slots}}"  type="number" size="25" placeholder="Parking" required>
      </div>
      <div class="inputContainer">
          <label for="area">Area(sq ft)</label><input id="area" class="input" name="area" value="{{$standalone->area}}" type="number" size="25"  placeholder="Area" required>
      </div>
      <div class="inputContainer">
          <label for="plot_size">Plot Size</label><input id="plot_size" class="input" name="plot_size" value="{{$standalone->plot_size}}" type="text" size="25"  placeholder="Plot Size The Propery Occupies" required>
      </div>
      <div class="inputContainer">
        <label for="selling_price">Selling Price</label><input id="sale" class="input" name="selling_price" value="{{$standalone->selling_price}}" type="number" size="25" placeholder="Selling Price" required>
      </div>
      <div class="inputContainer">
        <label for="year_built">Year Built</label><input id="year_built" class="input" name="year_built" value="{{$standalone->year_built}}" type="date" placeholder="year built" required>
      </div>
      <div class="textfieldContainer">
           <label for="Description">Description</label><textarea id="Description" class="textarea" name="description" rows="5" cols="25"  value="" placeholder="Describe your property" required>{{$standalone->description}}</textarea>
      </div>
      <div class="errorContainer">
        <ul class="errorList">

        </ul>
      </div>
      <div  class="inputContainer">
         <button  type="button" data-url = "/standalones/{{$standalone->id}}" class="button editStandalone create">Confirm Update</button>
      </div>
          <div class="imageViewBox">
            <div class="inputContainer imageContainer">
                <img class="image" data-reference = "standalone{{$standalone->id}}" src="{{Str::replaceFirst('public/','storage/',asset($standalone->coverImage))}}" alt="{{$standalone->name}}">
                <div class="inputContainer coverImageSelect">
                  <button type="button" data-input = "standalone{{$standalone->id}}" class="button changeImage changeCoverImage">Change Cover Image</button>
                  <input type="file" name = "propertyCoverPhoto" class = "imageInput" data-url = "/standalones/{{$standalone->id}}" data-image = "standalone{{$standalone->id}}" data-button = "standalone{{$standalone->id}}" data-errors = "standalone{{$standalone->id}}CoverErrors" accept="image/png,image/jpeg">
                </div>
                <div class="errorContainer">
                  <ul class="standalone{{$standalone->id}}CoverErrors">

                  </ul>
                </div>
            </div>
            @each('properties.owner.partials.image',$standalone->images,'image')
          <div class=" additionContainer imageContainer">
            <button type="button" data-input = "standalone{{$standalone->id}}AddedImage" class="button addImage"><img src = "../images/add.svg"> Add Image</button>
            <input type="file" name = "propertyPhoto" class = "addedImage" data-url = "/standalones/{{$standalone->id}}" data-button = "standalone{{$standalone->id}}AddedImage" data-errors = "standalone{{$standalone->id}}AddedImageErrors" accept="image/png,image/jpeg">
            <div class="errorContainer">
              <ul class="standalone{{$standalone->id}}AddedImageErrors">

              </ul>
            </div>
          </div>
        </div>
      </div>
   </form>
