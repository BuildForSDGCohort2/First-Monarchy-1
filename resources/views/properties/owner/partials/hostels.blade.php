<div class="dataContainer">
   <img class="dataImage" data-reference = "hostel{{$hostel->id}}"  src="{{Str::replaceFirst('public/','storage/',asset($hostel->coverImage))}}">
   <div>
     <span>{{$hostel->name}}</span>
     <span>{{$hostel->likes->count()}}</span>
     <span>@if($hostel->community()->exists()){{$hostel->community->name}} @else <i>None</i>@endif</span>
     <span>{{$hostel->bookings->count()}}</span>
   </div>
   <div id="hostel{{$hostel->id}}Options" class="btn-grp">
     <button type="button" class="close closeModal closeBtnGrp" data-id="hostel{{$hostel->id}}Options"><img src="../images/close1.svg"></button>
     <div class="buttonContainer">View<a class="button view" href="/hostels/{{$hostel->id}}" title="View Hostel"><img src="../images/view.svg"></a></div>
     <div class="buttonContainer">Bookings<button type="button" class="button show_bookings {{$hostel->bookings->count() ? "" :"empty disabled"}}" data-url = "/book_hostel/{{$hostel->id}}" data-tab = "bookingsTab" data-tabbutton = "bookingsTabButton" data-data = "bookings"><img src="../images/group.svg"></button></div>
     <div class="buttonContainer">Community<button type="button" class="button choose_community {{$hostel->community()->exists()? "InCommunity disabled" : ""}}" data-property = "{{$hostel->id}}" data-type = "hostels" data-id = "modal" @if($hostel->community()->exists())data-community = "{{$hostel->community->name}}"@endif><img src="../images/city.svg"></button></div>
    <div class="buttonContainer">Edit<button type="button" class="button showModal edit" data-id = "hostel{{$hostel->id}}EditForm"><img src="../images/pen.svg"></button></div>
     <div class="buttonContainer">Delete<button type="button" class="button delete propertyDeleteButton" data-url = "/hostels/{{$hostel->id}}" data-name="{{$hostel->name}}"><img src="../images/delete1.svg"></button></div>
 </div>
 <button type="button" class="button more-modal showModal" data-id="hostel{{$hostel->id}}Options"><image src="../images/more-vert.svg"></button>
</div>
   <form id="hostel{{$hostel->id}}EditForm" class= "editForm hostelEditForm" action="/hostels/{{$hostel->id}}" method="post" enctype="multipart/form-data">
     @csrf
     @method('PATCH')
      <div id="hostelEditFormContainer" class="formtext">
       <button type = "button" class="close closeModal" data-id = "hostel{{$hostel->id}}EditForm"><img src="../images/close1.svg"></button>
       <h4>Edit Hostel</h4>
     <div class="inputContainer">
          <label for="name">Name</label><input id="name" class="input" name="name" value="{{$hostel->name}}" type="text" size="25" title="Enter your name" placeholder="Enter the title here" required>
     </div>
     <div class="inputContainer">
        <label for="location">Location</label><input id="location" class="input" name="location" value="{{$hostel->location}}" type="text" placeholder = "Location" size="25" required>
     </div>
     <div class="inputContainer">
       <label for="beds">Beds</label><input id="beds" class="input" name="beds" type="number" value="{{$hostel->beds}}" size="25" placeholder="beds" required>
     </div>
     <div class="inputContainer">
       <label for="gender">Gender</label>
       <select id = "gender" class="input" name="gender">
         <option value="all" {{$hostel->gender == 'all' ? "selected" :""}}>All Genders</option>
         <option value="male" {{$hostel->gender == 'male' ? "selected" :""}}>Males Only</option>
         <option value="female" {{$hostel->gender == 'female' ? "selected" :""}}>Females Only</option>
       </select>
     </div>
     <div class="inputContainer">
         <label for="units_available">Units Available</label><input id="units_available" class="input" name="units_available" value="{{$hostel->units_available}}" type="number" size="25"  placeholder="Available Units" required>
     </div>
     <div class="inputContainer">
       <label for="rent">Rent</label><input id="rent" class="input" name="rent" value="{{$hostel->rent}}" type="number" size="25" placeholder="Rent/mo" required>
     </div>
     <div class="textfieldContainer">
          <label for="Description">Description</label><textarea id="Description" class="textarea" name="description" rows="5" cols="25" value="" placeholder="Enter description here"  required>{{$hostel->description}}</textarea>
     </div>
     <div class="errorContainer">
       <ul class="errorList">

       </ul>
     </div>
     <div  class="inputContainer">
        <button  type="button" data-url = "/hostels/{{$hostel->id}}" class="button editHostel create">Confirm Update</button>
     </div>
         <div class="imageViewBox">
           <div class="inputContainer imageContainer">
               <img class="image" data-reference = "hostel{{$hostel->id}}" src="{{Str::replaceFirst('public/','storage/',asset($hostel->coverImage))}}" alt="{{$hostel->name}}">
               <div class="inputContainer coverImageSelect">
                   <button type="button" data-input = "hostel{{$hostel->id}}" class="button changeImage changeCoverImage">Change Cover Image</button>
                   <input type="file" name = "propertyCoverPhoto" class = "imageInput" data-url = "/hostels/{{$hostel->id}}" data-image = "hostel{{$hostel->id}}" data-button = "hostel{{$hostel->id}}" data-errors = "hostel{{$hostel->id}}CoverErrors" accept="image/png,image/jpeg">
               </div>
               <div class="errorContainer">
                 <ul class="hostel{{$hostel->id}}CoverErrors">

                 </ul>
               </div>
           </div>
           @each('properties.owner.partials.image',$hostel->images,'image')
           <div class=" additionContainer imageContainer">
               <button type="button" data-input = "hostel{{$hostel->id}}AddedImage" class="button addImage"><img src = "../images/add.svg"> Add Image</button>
               <input type="file" name = "propertyPhoto" class = "addedImage" data-url = "/hostels/{{$hostel->id}}" data-button = "hostel{{$hostel->id}}AddedImage" data-errors = "hostel{{$hostel->id}}AddedImageErrors" accept="image/png,image/jpeg">
           <div class="errorContainer">
             <ul class="hostel{{$hostel->id}}AddedImageErrors">

             </ul>
           </div>
         </div>
       </div>
     </div>
  </form>
