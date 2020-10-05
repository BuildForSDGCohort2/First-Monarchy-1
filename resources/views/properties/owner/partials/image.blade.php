<div class="inputContainer imageContainer">
  <img class="image" data-reference = "image{{$image->id}}" src="{{Str::replaceFirst('public/','storage/',asset($image->url))}}" alt="{{$image->id}}">
  <div class="inputContainer coverImageSelect">
    <button type="button" data-input = "image{{$image->id}}" class="button changeImage">Change Image</button>
    <input type="file" name = "propertyPhoto" class = "imageInput" data-url = "/images/{{$image->id}}" data-image = "image{{$image->id}}" data-button = "image{{$image->id}}" data-errors = "image{{$image->id}}Errors" accept="image/png,image/jpeg">
    <button type="button" class="button imageDeleteButton" data-url = "images/{{$image->id}}">Delete Image</button>
</div>
<div class="errorContainer">
  <ul class="image{{$image->id}}Errors">

  </ul>
</div>
</div>
