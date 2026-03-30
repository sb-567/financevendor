@extends('website.master')
@section('title',''.$title)

@section('content')

<main class="main">
      <section class="section-box">
        <div class="banner-hero banner-breadcrums">
          <div class="container text-center">
            <h1 class="text-heading-2 color-gray-1000 mb-20">{{$title}}</h1>
            
            <nav aria-label="breadcrumb">
                    <ul class="breadcrumb justify-content-center bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$title}}
                        </li>
                    </ul>
                </nav>


          </div>
        </div>
      </section>

 <section class="section-box mt-50 mb-50">
        <div class="container">
          <div class="row">
            {{-- <div class="col-lg-1 col-md-12"></div>
            <div class="col-lg-1 col-md-2 col-sm-2 col-3 text-center">
              <div class="social-sticky"> 
                <h3 class="text-heading-6 color-gray-400 mb-20 mt-5">Share</h3><a class="share-social share-fb" href="https://facebook.com" target="_blank"></a><br><a class="share-social share-tw" href="https://twitter.com" target="_blank"></a><br><a class="share-social share-pi" href="https://www.pinterest.com" target="_blank"></a>
              </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-10 col-9">
              <div class="text-summary">The fancy moon going in little artist painting. Thirty days of lavender in the dreamy light inside. Other perfect oh plants, for and again. I&rsquo;ve honey feeling. Caring dreamland projects noteworthy than minimal, their it oh pretty feeling may. Include pink be.</div>
            </div> --}}
          </div>
          {{-- <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
              <div class="row">
                <div class="col-lg-6 col-md-7 col-sm-7 col-7">
                  <div class="blog-img-user">
                    <div class="img-user img-user-round"><img src="{{ asset('w{{ asset('wassets/assets/{{ asset('wassets/assets/imgs/page/blog/2/user-3.png')}}" alt="Agon"></div>
                    <h4 class="text-body-lead color-gray-900">Jane Cooper</h4>
                    <p class="text-body-small color-gray-500">August 25, 2025</p>
                  </div>
                </div>
                <div class="col-lg-6 col-md-5 col-sm-5 col-5 tag-mb text-end"><span class="tag-1 bg-6 color-green-900 mt-40">18 comments</span></div>
              </div>
            </div>
          </div> --}}
          <div class="row">
            {{-- <div class="col-lg-2"></div> --}}
            <div class="col-lg-9">
              <div class="single-detail ">
                <img class="img-responsive bdr-16 mb-3" src="{{ asset('public/uploads/blog/' . $blog->image) }}" alt="Agon">
               {!! $blog->description !!}
              </div>
            
            </div>


            <div class="col-lg-3 col-sm-12 pr-30 mb-50">
              
              @if(!empty($relatedBlogs))
                @foreach ($relatedBlogs as $item)
                    
                <div class="card-list-style-1"><a class="text-heading-7" href="{{ route('blogdetail', ['slug' => $item->slug]) }}">{{$item->blog_title}}</a>
                  <div class="">
                    {{-- <div class="img-user img-user-round"><img src="{{ asset('wassets/assets/imgs/page/blog/2/user-3.png')}}" alt="Agon"></div> --}}
                    {{-- <h4 class="text-body-lead color-gray-500">Jane Cooper</h4> --}}
                    <p class="text-body-small color-gray-500 mt-2">{{ date('M d, Y', strtotime($item->created_at)) }}</p>
                  </div>
                  <div class="style-1-img color-bg-10"><a href="{{ route('blogdetail', ['slug' => $item->slug]) }}"><img src="{{ asset('public/uploads/blog/' . $item->image) }}" alt="Agon"></a></div>
                </div>

                @endforeach

              @endif


           
            

            </div>
          </div>
        </div>
      </section>


@endsection