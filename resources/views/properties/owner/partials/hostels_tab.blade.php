<div class="shortcuts"><button id="createHostel" data-id = "hostelCreateForm" class="button showModal" >New Hostel</button></div>
<form id="hostelCreateForm" action="/hostels" method="post" enctype="multipart/form-data">
  @csrf
   <div id="hostelCreateFormContainer" class="formtext">
    <button id="closeHostelCreateForm" type="button" class="close closeModal" data-id = "hostelCreateForm"><img src="../images/close1.svg"></button>
    <h4>Add New Hostel</h4>
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
        <label for="beds">Beds</label><input id="beds" class="input" name="beds" type="number" size="25" placeholder="beds" required>
      </div>
      <div class="inputContainer">
        <label for="gender">Gender</label>
        <select id = "gender" class="input" name="gender">
          <option value="Not Chosen" selected>Choose Gender</option>
          <option value="all">All Genders</option>
          <option value="male">Males Only</option>
          <option value="female">Females Only</option>
        </select>
      </div>
      <div class="inputContainer">
          <label for="units_available">Units Available</label><input id="units_available" class="input" name="units_available" type="number" size="25"  placeholder="Available Units" required>
      </div>
      <div class="inputContainer">
        <label for="rent">Rent</label><input id="rent" class="input" name="rent" type="number" size="25" placeholder="Rent/mo" required>
      </div>
      <div class="textfieldContainer">
           <label for="Description">Description</label><textarea id="Description" class="textarea" name="description" rows="5" cols="25" value="" placeholder="Enter description here"  required></textarea>
      </div>
      <div class="errorContainer">
        <ul class="errorList">

        </ul>
      </div>
      Submit additional images.(Do not re-upload the cover image)
      <div id="hostelDropzone" class="dropzone">
      </div>
      <div class="inputContainer">
         <button type="button" class="button createHostelButton create">Submit Hostel</button>
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
 @each('properties.owner.partials.hostels',$hostels,'hostel')
