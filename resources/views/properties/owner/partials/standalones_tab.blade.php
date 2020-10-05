<div class="shortcuts"><button id="createStandalone" data-id = "standaloneCreateForm" class="button showModal" >New Standalone</button></div>
<form id="standaloneCreateForm" action="/standalones" method="post" enctype="multipart/form-data">
  @csrf
   <div id="standaloneCreateFormContainer" class="formtext">
    <button id="closeStandaloneCreateForm" type="button" class="close closeModal" data-id = "standaloneCreateForm"><img src="../images/close1.svg"></button>
    <h4>Add New Standalone</h4>
      <div class="inputContainer">
           <label for="name">Name</label><input id="name" class="input" name="name" type="text" size="25" title="Enter your name" placeholder="Enter the title here" required>
      </div>
      <div class="inputContainer">
         <label for="location">Location</label><input id="location" class="input" name="location" type="text" placeholder = "Location" size="25" required>
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
          <label for="area">Area</label><input id="area" class="input" name="area" type="number" size="25"  placeholder="Area" required>
      </div>
      <div class="inputContainer">
          <label for="plot_size">Plot Size</label><input id="plot_size" class="input" name="plot_size" type="text" size="25"  placeholder="Plot Size The Propery Occupies" required>
      </div>
      <div class="inputContainer">
        <label for="selling_price">Selling Price</label><input id="selling_price" class="input" name="selling_price" type="number" size="25" placeholder="Selling Price" required>
      </div>
      <div class="inputContainer">
        <label for="year_built">Year Built</label><input id="year_built" class="input" name="year_built" type="date" placeholder="year built" required>
      </div>
      <div class="textfieldContainer">
           <label for="Description">Description</label><textarea id="Description" class="textarea" name="description" rows="5" cols="25" value="" placeholder="Enter description here"  required></textarea>
      </div>
      <div class="inputContainer">
          <label for="file">CoverImage</label><input id="file" accept="image/*" class="input" name="propertyCoverPhoto" type="file" required>
      </div>
      <div class="errorContainer">
        <ul class="errorList">

        </ul>
      </div>
      Submit additional images.(Do not re-upload the cover image)
      <div id="standaloneDropzone" class="dropzone">
      </div>
      <div  class="inputContainer">
         <button type="button" class="button createStandaloneButton create">Submit Standalone</button>
      </div>
  </div>
</form>
<div class="dataHeader">
 <span class="dataImage"></span>
   <div>
        <span>Name</span>
        {{-- <span>Date Added</span> --}}
        <span>Community</span>
        <span><img style="width:1.8rem;height:1.8rem;" src="../images/full-heart.svg"></span>
    </div>
    <div class="btn-grp">
     </div>
     <button style ="visibility:hidden;width:3rem;height:2.5rem;"  type="button" class="button"></button>
</div>
@each('properties.owner.partials.standalones',$standalones,'standalone')
