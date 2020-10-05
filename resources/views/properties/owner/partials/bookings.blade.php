<div class="shortcuts"><button id="back" class="button create" data-previoustab = "@isset($rental){{'#rentalsTabButton'}}@endisset @isset($hostel){{'#hostelsTabButton'}}@endisset @isset($workspace){{'#workspacesTabButton'}}@endisset" >Back <img src = "../images/line-angle-right.svg"></button></div>
  <span><strong>Bookings</strong></span>
<div class="dataHeader">
   <span class="dataImage"></span>
     <div>
          <span>Name</span>
          <span>Number of Units</span>
          <span>Contacts</span>
      </div>
      <div class="btn-grp">
              Actions
       </div>
 </div>
@foreach($bookings as $booking)
<div class="dataContainer">
    <img class="dataImage" src="{{Str::replaceFirst('public/','storage/',asset($booking->user->avatar))}}">
    <div>
      <span>{{$booking->user->first_name}} {{$booking->user->last_name}}</span>
      <span>{{$booking->number_of_units}}</span>
      <span><a href = "tel:{{$booking->user->phone_number}}">{{$booking->user->phone_number}}</a>|<a href = "mailto:{{$booking->user->email}}">{{$booking->user->email}}</a></span>
    </div>
     <div class="btn-grp">
        {{-- <button class="button view_bookings" title="View Bookings" data-type="rentals" class="submit"><img src="../images/group.svg"></button>
        <button class="button choose_community cancel_booking"><img src="../images/city.svg"></button> --}}
  </div>
 </div>
@endforeach
