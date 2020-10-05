<div class="shortcuts"><button id="createRental" data-id = "rentalCreateForm" class="button showModal" >New Rental</button></div>
<form id="rentalCreateForm" action="/rentals" method="post" enctype="multipart/form-data">
  @csrf
   <div id="rentalCreateFormContainer" class="formtext">
    <button id="closeRentalCreateForm" type="button" class="close closeModal" data-id = "rentalCreateForm"><img src="../images/close1.svg"></button>
    <h4>Add New Rental</h4>
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
           <label for="Description">Description</label><textarea id="Description" class="textarea" name="description" rows="5" cols="25" placeholder="Enter description here"  required></textarea>
      </div>
      <div class="errorContainer">
        <ul class="errorList">

        </ul>
      </div>
      Submit additional images.(Do not re-upload the cover image)
      <div id="rentalDropzone" class="dropzone">
      </div>
      <div class="inputContainer">
         <button type="button" class="button create createRentalButton">Submit Rental</button>
      </div>
  </div>
</form>
<div class="dataHeader">
   <span class="dataImage"></span>
     <div>
          <span>Name</span>
          <span><img style="width:1.8rem;height:1.8rem;" src="../images/full-heart.svg"></span>
          <span>Community</span>
          <span>Bookings</span>
      </div>
      <div class="btn-grp">
       </div>
       <button style ="visibility:hidden;width:3rem;height:2.5rem;"  type="button" class="button"></button>
 </div>
 @each('properties.owner.partials.rentals',$rentals,'rental')
 {{$rentals->links()}}
<strong>Page {{$rentals->CurrentPage()}} of {{$rentals->lastPage()}}</strong>
