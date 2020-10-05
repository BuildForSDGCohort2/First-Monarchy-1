@foreach(App\Community::where('communityable_id',auth('owner')->id()) as $com)
   {{$com->name}}
@endforeach
