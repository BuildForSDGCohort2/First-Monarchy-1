<div class="shortcuts"><button id="createCommunity" data-id = "communityCreateForm"  class="button showModal" >New Community</button></div>
<form id="communityCreateForm" action="/communities" method="post" enctype="multipart/form-data">
  @csrf
  <div id="communityCreateFormContainer" class="formtext">
    <button id="closeCommunityCreateForm" type="button" data-id = "communityCreateForm" class="close closeModal"><img src="../images/close1.svg"></button>
    <h4>Add New Community</h4>
      <div class="inputContainer">
           <label for="name">Name</label><input id="name" class="input" name="name" type="text" size="25" title="Enter your name" placeholder="Enter the title here" required>
      </div>
      <div class="inputContainer">
         <label for="location">Location</label><input id="location" class="input" name="location" type="text" placeholder = "Location" size="25" required>
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
      <div id="communityDropzone" class="dropzone">

      </div>
      <div class="inputContainer">
         <button type="button" class="button createCommunityButton create">Submit Community</button>
      </div>
  </div>
</form>
<div class="dataHeader">
  <span class="dataImage"></span>
    <div>
         <span>Name</span>
         <span>Date Added</span>
         <span>House Typologies Available</span>
     </div>
     <div class="btn-grp">
     </div>
     <button style ="visibility:hidden;width:3rem;height:2.5rem;"  type="button" class="button"></button>
</div>
@each('properties.owner.partials.communities',$communities,'community')
