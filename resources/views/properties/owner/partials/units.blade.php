<div class="shortcuts"><button id="back" class="button create" data-previoustab = "#communitiesTabButton">Back<img src = "../images/line-angle-right.svg"></button></div>
<span><strong>Bookings</strong></span>
<div class="dataHeader">
   <span class="dataImage"></span>
     <div>
          <span>Name</span>
          <span>Available Units</span>
          <span>Category</span>
      </div>
      <div class="btn-grp">
        <span>Remove from community</span>
       </div>
 </div>
@foreach($rentals as $property)
<div class="dataContainer">
    <img class="dataImage" src="{{Str::replaceFirst('public/','storage/',asset($property->coverImage))}}">
    <div>
      <span>{{$property->name}}</span>
      <span>{{$property->units_available}}</span>
      <span>Rental</span>
    </div>
     <div class="btn-grp">
        <button class="button delete remove_from_community" data-url = "/community/{{$property->community->id}}/rentals/{{$property->id}}"><img src="../images/delete1.svg"></button>
  </div>
 </div>
@endforeach
@foreach($hostels as $property)
<div class="dataContainer">
    <img class="dataImage" src="{{Str::replaceFirst('public/','storage/',asset($property->coverImage))}}">
    <div>
      <span>{{$property->name}}</span>
      <span>{{$property->units_available}}</span>
      <span>Hostel</span>
    </div>
     <div class="btn-grp">
        <button class="button delete remove_from_community" data-url = "/community/{{$property->community->id}}/hostels/{{$property->id}}"><img src="../images/delete1.svg"></button>
  </div>
 </div>
@endforeach
@foreach($standalones as $property)
<div class="dataContainer">
    <img class="dataImage" src="{{Str::replaceFirst('public/','storage/',asset($property->coverImage))}}">
    <div>
      <span>{{$property->name}}</span>
      <span>{{$property->units_available}}</span>
      <span>For Sale (standalone)</span>
    </div>
     <div class="btn-grp">
        <button class="button delete remove_from_community" data-url = "/community/{{$property->community->id}}/standalones/{{$property->id}}"><img src="../images/delete1.svg"></button>
  </div>
 </div>
@endforeach
@foreach($workspaces as $property)
<div class="dataContainer">
    <img class="dataImage" src="{{Str::replaceFirst('public/','storage/',asset($property->coverImage))}}">
    <div>
      <span>{{$property->name}}</span>
      <span>{{$property->units_available}}</span>
      <span>workspace</span>
    </div>
     <div class="btn-grp">
        <button class="button delete remove_from_community" data-url = "/community/{{$property->community->id}}/workspaces/{{$property->id}}"><img src="../images/delete1.svg"></button>
  </div>
 </div>
@endforeach
