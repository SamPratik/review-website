@extends('main')

@section('content')
  <div class="all-reviews-container" style="padding:70px 0px;">
    <div class="container">
      <h4 style="margin-left:-15px;"><img width="45" height="45" style="border-radius:50%;margin-right:15px;" src="{{ asset('images/profile-images/pratik propic1.jpg') }}" alt="">{{ $post->user->name }}</h4>
      <div class="row">
        <div class="col-md-9">
          {{-- Post with comments --}}
          <div class="media">
            <div class="media-body">
              <div class="row">
                {{-- Single Image --}}
                @if (count($post->postImages) == 1)
                <div class="col-md-12" style="margin-bottom:10px;">
                  <img src="{{ asset('images/food-images/slider/rsz_burger.jpg') }}" alt="" width="100%">
                </div>
                @endif
                {{-- Carousel Slide for multiple images --}}
                @if (count($post->postImages) > 1)
                <div style="margin-bottom:10px;" id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                    @foreach ($post->postImages as $postImage)
                    <div class="carousel-item{{ ($loop->first) ? ' active' : '' }}">
                      <img class="d-block w-100" width="100%" src="{{ asset('images/food-images/slider/' . $postImage->image) }}" alt="Second slide">
                    </div>
                    @endforeach
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                @endif
                <div class="col-md-12" style="margin-bottom:10px;">
                  <p><i style="font-weight: bold;color: #000033;" class="fa fa-shopping-cart" aria-hidden="true"></i> <strong>Shop:</strong> {{ $post->shop_name }}</p>
                  <p><i style="font-weight: bold;color: #000033;" class="fa fa-map-marker"></i> <strong>Location:</strong> {{ $post->shop_location }}</p>
                  <p><i style="font-weight: bold;color: #000033;" class="fa fa-usd" aria-hidden="true"></i> <strong>Price:</strong> {{ $post->price }}/-</p>
                  <p><i style="font-weight: bold;color: #000033;" class="fa fa-star" aria-hidden="true"></i> <strong>Rating:</strong> {{ $post->rating }}/10</p>
                </div>
                <div class="col-md-12">
                  <p>{{ $post->post }}</p>
                </div>
              </div>
              {{-- Buttons under post --}}
              @if ($post->user->id == Auth::user()->id)
              <p class="row">
                <span class="btn-container-under-post">
                  <a href="#" style="margin-right:10px;">Edit</a>
                  <a href="#">Delete</a>
                </span>
              </p>
              @endif
              {{-- Comments --}}
              @foreach ($post->comments as $comment)
                <div class="media mt-3">
                  <a class="pr-3" href="#">
                    <img width="45" height="45" style="border-radius:50%;" src="{{ asset('images/profile-images/pratik propic1.jpg') }}" alt="Profile Pic">
                  </a>
                  <div class="media-body">
                    <h5 class="mt-0">{{ $comment->user->name }}</h5>
                    {{ $comment->comment }}
                    @if ($post->user->id == Auth::user()->id)
                    <p>
                      <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editReviewModal">Edit</button>
                      <a href="#">Delete</a>
                    </p>
                    @endif
                  </div>
                </div>
              @endforeach
              <br><br>
              {{-- Comment input box --}}
              <form method="post">
                <div class="form-group">
                  <textarea style="width:100%;" class="form-control" rows="4" name="" value="" placeholder="comment on this review..."></textarea>
                </div>
                <div class="form-group text-center">
                  <input type="button" class="btn btn-primary" name="" value="Submit">
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="row">
            {{-- Ad images will be here... --}}
          </div>
          <div class="row">
            <h3 class="col-md-12">Category</h3><br>
            <strong class="col-md-12"> - Food</strong>
          </div><br><br>
          <div class="row">
            <h3 class="col-md-12">Sub Category</h3><br>
            <strong class="col-md-12"> - Burger</strong>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
