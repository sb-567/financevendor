@extends('website.master')
@section('title',''.$title)

@section('content')

<main class="main">
      <section class="section-box">
        <div class="banner-hero banner-breadcrums">
          <div class="container text-center">
            <h1 class="text-heading-2 color-gray-1000 mb-20">{{$title}}</h1>
            
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
            <div class="col-lg-8">
              <div class="single-detail "><img class="img-responsive bdr-16" src="{{ asset('public/uploads/blog/' . $blog->image) }}" alt="Agon">
               {{ $blog->description }}
              </div>
            
            </div>


            <div class="col-lg-4 col-sm-12 pr-30 mb-50">
              <div class="card-list-style-1"><a class="text-heading-6" href="blog-single.html">Design Studios That Everyone Should Know About?</a>
                <div class="blog-img-user">
                  <div class="img-user img-user-round"><img src="{{ asset('wassets/assets/imgs/page/blog/2/user-3.png')}}" alt="Agon"></div>
                  <h4 class="text-body-lead color-gray-500">Jane Cooper</h4>
                  <p class="text-body-small color-gray-500">August 25, 2025</p>
                </div>
                <div class="style-1-img color-bg-10"><a href="blog-single.html"><img src="{{ asset('wassets/assets/imgs/page/blog/2/img-news-1.png')}}" alt="Agon"></a></div>
              </div>
              <div class="card-list-style-1"><a class="text-heading-6" href="blog-single.html">Design Studios That Everyone Should Know About?</a>
                <div class="blog-img-user">
                  <div class="img-user img-user-round"><img src="{{ asset('wassets/assets/imgs/page/blog/2/user-4.png')}}" alt="Agon"></div>
                  <h4 class="text-body-lead color-gray-500">Wade Warren</h4>
                  <p class="text-body-small color-gray-500">August 25, 2025</p>
                </div>
                <div class="style-1-img color-bg-2"><a href="blog-single.html"><img src="{{ asset('wassets/assets/imgs/page/blog/2/img-news-1.png')}}" alt="Agon"></a></div>
              </div>
              <div class="card-list-style-1"><a class="text-heading-6" href="blog-single.html">Design Studios That Everyone Should Know About?</a>
                <div class="blog-img-user">
                  <div class="img-user img-user-round"><img src="{{ asset('wassets/assets/imgs/page/blog/2/user-5.png')}}" alt="Agon"></div>
                  <h4 class="text-body-lead color-gray-500">Jenny Wilson</h4>
                  <p class="text-body-small color-gray-500">August 25, 2025</p>
                </div>
                <div class="style-1-img color-bg-5"><a href="blog-single.html"><img src="{{ asset('wassets/assets/imgs/page/blog/2/img-news-1.png')}}" alt="Agon"></a></div>
              </div>
              <div class="card-list-style-1"><a class="text-heading-6" href="blog-single.html">Design Studios That Everyone Should Know About?</a>
                <div class="blog-img-user">
                  <div class="img-user img-user-round"><img src="{{ asset('wassets/assets/imgs/page/blog/2/user-6.png')}}" alt="Agon"></div>
                  <h4 class="text-body-lead color-gray-500">Robert Fox</h4>
                  <p class="text-body-small color-gray-500">August 25, 2025</p>
                </div>
                <div class="style-1-img color-bg-9"><a href="blog-single.html"><img src="{{ asset('wassets/assets/imgs/page/blog/2/img-news-1.png')}}" alt="Agon"></a></div>
              </div>
            </div>
          </div>
        </div>
      </section>


@endsection