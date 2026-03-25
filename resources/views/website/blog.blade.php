@extends('website.master')
@section('title',''.$title)

@section('content')

  <main class="main">
      <section class="section-box">
        <div class="banner-hero banner-breadcrums">
          <div class="container text-center">
            <h1 class="text-heading-2 color-gray-1000 mb-20">Blogs</h1>
            
          </div>
        </div>
      </section>
    
      
       <section class="section-box">
       
        <div class="container mt-90">
          <div class="row">

            @if(!empty($blogs))
              @foreach ($blogs as $item)
                  
                <div class="col-lg-4 col-sm-12 pr-30 mb-50">
                  <div class="grid-4-img color-bg-9"><a href="{{ route('blogdetail', ['slug' => $item->slug]) }}"><img src="{{  asset('public/uploads/blog/'.$item->image) }}" alt="Agon"></a></div>
                  <div class="card-grid-style-4 mt-3">
                    <span class="tag-dot mb-2">{{ $item->category }}</span>
                    <a class="text-heading-5" href="{{ route('blogdetail', ['slug' => $item->slug]) }}">{{ $item->blog_title }}</a>
                  </div>
                </div>
              @endforeach
            @endif

           
          </div>


          <div class="mt-20 mb-30 text-center"><a class="btn btn-black icon-arrow-right-white" href="blog-1.html">Load more posts</a></div>
        </div>
      </section>


   

@endsection