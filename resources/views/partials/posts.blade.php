<div id="allPostsContainer">
  @foreach ($posts as $post)
    <div class="media" id="postWithComments{{$post->id}}">
      <img class="mr-3" width="45" height="45" style="border-radius:50%;" src="{{ asset('images/profile-images/pratik propic1.jpg') }}" alt="Profile Pic">
      <div class="media-body">
        <h5 class="mt-0"><strong>{{ Auth::user()->name }}</strong> gives review on <strong>{{ $post->item }}</strong> <strong>{{ $post->subCategory->name }}</strong></h5>
        <div class="row">
          {{-- info of posts with icon --}}
          <div class="col-md-3" class="post-icon-container">
            <p><i style="font-weight: bold;color: #000033;" class="fa fa-shopping-cart" aria-hidden="true"></i> {{ $post->shop_name }}</p>
            <p><i style="font-weight: bold;color: #000033;" class="fa fa-map-marker"></i> {{ $post->shop_location }}</p>
            <p><i style="font-weight: bold;color: #000033;" class="fa fa-usd" aria-hidden="true"></i> {{ $post->price }}/-</p>
            <p><i style="font-weight: bold;color: #000033;" class="fa fa-star" aria-hidden="true"></i> {{ $post->rating }}/10</p>
          </div>
          {{-- post image and the 200 words description --}}
          <div class="col-md-6">
            <img src="{{ asset('images/food-images/slider/' . $post->postImages->first()->image) }}" alt="" width="100%">
            <p>{{ (strlen($post->post) > 200) ? substr($post->post, 0, 200) : $post->post }}<a href="{{ route('posts.show', $post->id) }}" target="_blank"> see more...</a></p>
          </div>
        </div>
        {{-- Buttons under post --}}
        <p class="row">
          <span class="btn-container-under-post">
            @if (count($post->comments) > 1)
            <a id="toggleCommentBtn{{ $post->id }}" href="" onclick="toggleComments(event, {{ $post->id }});">view previous comments</a>
            @endif
            <button class="btn btn-link" data-toggle="modal" data-target="#editReviewModal">Edit</button>
            <a href="#">Delete</a>
          </span>
        </p>
        {{-- Comments --}}
        @if (count($post->comments) > 0)
        {{-- Comments --}}
        <div id="togglableComments{{ $post->id }}" class="togglable-comments">
        @foreach ($post->comments as $comment)
            @if (!$loop->last)
            <div class="media mt-3">
              <a class="pr-3" href="#">
                <img width="45" height="45" style="border-radius:50%;" src="{{ asset('images/profile-images/pratik propic1.jpg') }}" alt="Profile Pic">
              </a>
              <div class="media-body">
                <h5 class="mt-0">{{ $comment->user->name }}</h5>
                {{ $comment->comment }}
                @if (Auth::user()->id == $comment->user->id)
                <p style="margin:0px;">
                  <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editCommentModal">Edit</button>
                  <a href="#">Delete</a>
                </p>
                @endif
              </div> {{-- media body for last comment --}}
            </div> {{-- media for last comment --}}
          @endif {{-- @if (!$loop->last) --}}
          {{-- last visible comment --}}
          @if ($loop->last)
          </div> {{-- toggable comments div --}}
            <div class="media mt-3">
              <a class="pr-3" href="#">
                <img width="45" height="45" style="border-radius:50%;" src="{{ asset('images/profile-images/pratik propic1.jpg') }}" alt="Profile Pic">
              </a>
              <div class="media-body">
                <h5 class="mt-0">{{ $comment->user->name }}</h5>
                {{ $comment->comment }}
                @if (Auth::user()->id == $comment->user->id)
                <p style="margin:0px;">
                  <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editCommentModal">Edit</button>
                  <a href="#">Delete</a>
                </p>
                @else
                <br><br>
                @endif
              </div> {{-- media body for last comment --}}
            </div> {{-- media for last comment --}}
          @endif {{-- @if ($loop->last) --}}
        @endforeach {{-- loop for comments for each post --}}
        @endif
        {{-- Comment input box --}}
        <form autocomplete="off" id="commentFormId{{$post->id}}" class="row" onsubmit="storeComment(event, {{$post->id}})">
          {{ csrf_field() }}
          <input class="col-md-12" type="text" name="comment" placeholder="comment on this review...">
          <p class="error-message-comment" id="errorMessageComment{{$post->id}}"></p>
        </form>
      </div> {{-- media body for post --}}
    </div><hr> {{-- media for post --}}
  @endforeach {{-- loop for all posts --}}
</div>
