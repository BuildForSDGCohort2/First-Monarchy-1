          <div class="post">
            <div class="postImageContainer">
              <img class="postImage" src="{{Str::replaceFirst('public/','storage/',asset($post->images()->first()->url))}}" alt="{{$post->id}}">
              <!-- <a class="hiddenLink" href="posts/{{$post->id}}"></a> -->
            </div>
             <form class="postDeleteForm" action="/posts/{{$post->id}}" method="post">
                @csrf
                @method('DELETE')
                <label id="delete" class="submit postDelete"><input class="postDeleteButton" type="submit" value="">Delete</label>
             </form>
          </div>
