<div class="dataContainer">
   <img class="dataImage" data-reference = "rental{{$rental->id}}" src="{{Str::replaceFirst('public/','storage/',asset($rental->coverImage))}}">
   <div>
     <span>{{$rental->name}}</span>
     <span>{{$rental->likes->count()}}</span>
     <span>@if($rental->community()->exists()){{$rental->community->name}} @else <i>None</i>@endif</span>
     <span>{{$rental->bookings->count()}}</span>
   </div>
   <div id="rental{{$rental->id}}Options" class="btn-grp">
     <button type="button" class="close closeModal closeBtnGrp" data-id="rental{{$rental->id}}Options"><img src="../images/close1.svg"></button>
     <div class="buttonContainer">View <a class="button view" href="/rentals/{{$rental->id}}" title="View Rental"><img src="../images/view.svg"></a></div>
     <div class="buttonContainer">Bookings<button type="button" class="button show_bookings {{$rental->bookings->count() ? "" :"empty disabled"}}" data-url = "/book_rental/{{$rental->id}}" data-tab = "bookingsTab" data-tabbutton = "bookingsTabButton" data-data = "bookings"><img src="../images/group.svg"></button></div>
     <div class="buttonContainer">Community<button type="button" class="button choose_community {{$rental->community()->exists()? "InCommunity disabled" : ""}}" data-property = "{{$rental->id}}" data-type = "rentals" data-id = "modal" @if($rental->community()->exists())data-community = "{{$rental->community->name}}"@endif><img src="../images/city.svg"></button></div>
     <div class="buttonContainer">Edit<button type="button" class="button showModal edit" data-id = "rental{{$rental->id}}EditForm"><img src="../images/pen.svg"></button></div>
     <div class="buttonContainer">Delete<button type="button" class="button delete propertyDeleteButton" data-url = "/rentals/{{$rental->id}}" data-name="{{$rental->name}}"><img src="../images/delete1.svg"></button></div>
   </div>
   <button type="button" class="button more-modal showModal" data-id="rental{{$rental->id}}Options"><image src="../images/more-vert.svg"></button>
</div>
   <form id="rental{{$rental->id}}EditForm" class= "editForm rentalEditForm"  action="/rentals/{{$rental->id}}" method="post" enctype="multipart/form-data">
     @csrf
     @method('PATCH')
     <div class="formtext">
       <button type = "button" class="close closeModal" data-id = "rental{{$rental->id}}EditForm"><img src="../images/close1.svg"></button>
       <h4>Edit Rental</h4>
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
           <label for="rent">Rent</label><input id="rent" class="input" name="rent" type="number" size="25" placeholder="rent" value="{{$rental->rent}}" required>
         </div>
         <div class="inputContainer">
           <label for="units_available">Available Units</label><input id="units_available" class="input" name="units_available" type="number" size="25" placeholder="Units Available" value="{{$rental->units_available}}" required>
         </div>
         <div class="inputContainer">
             <label for="location">Location</label><input id="location" class="input" name="location" type="text" size="25" placeholder="Location" value="{{$rental->location}}"  required>
         </div>
         <div class="textfieldContainer">
              <label for="Description">Description</label><textarea id="Description" class="textarea" name="description" rows="5" cols="25" value="" placeholder="Enter description here"  required>{{$rental->description}}</textarea>
         </div>
         <div class="errorContainer">
           <ul class="errorList">

           </ul>
         </div>
         <div  class="inputContainer">
            <button  type="button" data-url = "/rentals/{{$rental->id}}" class="button editRental create">Confirm Update</button>
         </div>
         <div class="imageViewBox">
           <div class="inputContainer imageContainer">
               <img class="image" data-reference = "rental{{$rental->id}}" src="{{Str::replaceFirst('public/','storage/',asset($rental->coverImage))}}" alt="{{$rental->name}}">
               <div class="inputContainer coverImageSelect">
                   <button type="button" data-input = "rental{{$rental->id}}" class="button changeImage changeCoverImage">Change Cover Image</button>
                   <input type="file" name = "propertyCoverPhoto" class = "imageInput" data-url = "/rentals/{{$rental->id}}" data-image = "rental{{$rental->id}}" data-button = "rental{{$rental->id}}" data-errors = "rental{{$rental->id}}CoverErrors" accept="image/png,image/jpeg">
               </div>
               <div class="errorContainer">
                 <ul class="rental{{$rental->id}}CoverErrors">

                 </ul>
               </div>
           </div>
           @each('properties.owner.partials.image',$rental->images,'image')
           <div class=" additionContainer imageContainer">
               <button type="button" data-input = "rental{{$rental->id}}AddedImage" class="button addImage"><img src = "../images/add.svg">Add Image</button>
               <input type="file" name = "propertyPhoto" class = "addedImage" data-url = "/rentals/{{$rental->id}}" data-button = "rental{{$rental->id}}AddedImage" data-errors = "rental{{$rental->id}}AddedImageErrors" accept="image/png,image/jpeg">
           <div class="errorContainer">
             <ul class="rental{{$rental->id}}AddedImageErrors">

             </ul>
           </div>
         </div>
       </div>
     </div>
  </form>
