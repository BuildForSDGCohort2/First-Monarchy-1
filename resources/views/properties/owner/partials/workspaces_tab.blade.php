<div class="shortcuts"><button id="createWorkspace" data-id = "workspaceCreateForm" class="button showModal" >New Workspace</button></div>
<form id="workspaceCreateForm" action="/workspaces" method="post" enctype="multipart/form-data">
  @csrf
  <div id="workspaceCreateFormContainer" class="formtext">
    <button id="closeWorkspaceCreateForm" type="button" class="close closeModal" data-id = "workspaceCreateForm"><img src="../images/close1.svg"></button>
    <h4>Add New Workspace</h4>
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
        <label for="area">Area</label><input id="area" class="input" name="area" type="number" size="25" placeholder="Area" required>
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
      <div id="workspaceDropzone" class="dropzone">

      </div>
      <div class="inputContainer">
         <button type="button" class="button createWorkspaceButton create">Submit Workspace</button>
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
 @each('properties.owner.partials.workspaces',$workspaces,'workspace')
