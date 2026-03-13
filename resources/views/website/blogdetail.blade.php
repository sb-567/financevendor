@extends('website.master')
@section('title',''.$title)

@section('content')

<main class="main">
      <section class="section-box">
        <div class="banner-hero banner-breadcrums">
          <div class="container text-center">
            <h1 class="text-heading-2 color-gray-1000 mb-20">Blog details</h1>
            
          </div>
        </div>
      </section>

 <section class="section-box mt-50 mb-50">
        <div class="container">
          <div class="row">
            <div class="col-lg-1 col-md-12"></div>
            <div class="col-lg-1 col-md-2 col-sm-2 col-3 text-center">
              <div class="social-sticky"> 
                <h3 class="text-heading-6 color-gray-400 mb-20 mt-5">Share</h3><a class="share-social share-fb" href="https://facebook.com" target="_blank"></a><br><a class="share-social share-tw" href="https://twitter.com" target="_blank"></a><br><a class="share-social share-pi" href="https://www.pinterest.com" target="_blank"></a>
              </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-10 col-9">
              <div class="text-summary">The fancy moon going in little artist painting. Thirty days of lavender in the dreamy light inside. Other perfect oh plants, for and again. I&rsquo;ve honey feeling. Caring dreamland projects noteworthy than minimal, their it oh pretty feeling may. Include pink be.</div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
              <div class="row">
                <div class="col-lg-6 col-md-7 col-sm-7 col-7">
                  <div class="blog-img-user">
                    <div class="img-user img-user-round"><img src="{{ asset('wassets/assets/imgs/page/blog/2/user-3.png')}}" alt="Agon"></div>
                    <h4 class="text-body-lead color-gray-900">Jane Cooper</h4>
                    <p class="text-body-small color-gray-500">August 25, 2025</p>
                  </div>
                </div>
                <div class="col-lg-6 col-md-5 col-sm-5 col-5 tag-mb text-end"><span class="tag-1 bg-6 color-green-900 mt-40">18 comments</span></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
              <div class="single-detail mt-50"><img class="img-responsive bdr-16" src="{{ asset('wassets/assets/imgs/page/blog/single/img-1.png')}}" alt="Agon">
                <p></p>
                <p>Tortor placerat bibendum consequat sapien, facilisi facilisi pellentesque morbi. Id conse ctetur ut vitae a massa a. Lacus ut bibendum sollicitudin fusce sociis mi. Dictum volutpat praesent ornare accumsan elit venenatis. Congue sodales nunc quis ultricies odio porta. Egestas mauris placerat leo phasellu s ut sit.</p>
                <h2 class="text-heading-3">Use your headings</h2>
                <p>Thirty there &amp; time wear across days, make inside on these you. Can young a really, roses blog small of song their dreamy life pretty? Because really duo living to noteworthy bloom bell. Transform clean daydreaming cute twenty process rooms cool. White white dreamy dramatically place everything although. Place out apartment afternoon whimsical kinder, little romantic joy we flowers handmade. Thirty she a studio of she whimsical projects, afternoon effect going an floated maybe.</p>
                <p></p>
                <div class="box-quote">
                  <div class="text-quote">Blandit consequat feugiat sed dapibus lorem diam nibh venenatis sodales pulvinar augue adipiscing turpis nulla sit tincidunt non lacus sit amet et white dreamy dramatically place.</div>
                  <div class="box-user">
                    <div class="img-user"><img src="{{asset('wassets/assets/imgs/page/blog/single/user-4.png')}}" alt="Agon"></div><span class="text-heading-5 color-white">Ronald Richards</span>
                  </div>
                </div>
                <p></p>
                <h3 class="text-heading-4">Smaller heading</h3>
                <div class="row">
                  <div class="col-lg-8">
                    <p>Thirty there &amp; time wear across days, make inside on these you. Can young a really, roses blog small of song their dreamy life pretty? Because really duo living to noteworthy bloom bell. Transform clean daydreaming cute twenty process rooms cool. White white dreamy dramatically place everything although.</p>
                    <p>White white dreamy dramatically place everything although. Place out apartment afternoon whimsical kinder, little romantic joy we flowers handmade. Thirty she a studio of she whimsical projects, afternoon effect going an floated maybe.</p>
                  </div>
                  <div class="col-lg-4"><img class="img-responsive bdr-10 mt-10" src="{{asset('wassets/assets/imgs/page/blog/single/img-2.png')}}" alt="Agon"></div>
                </div>
                <p></p>
                <p>Tortor placerat bibendum consequat sapien, facilisi facilisi pellentesque morbi. Id consectetur ut vitae a massa a. Lacus ut bibendum sollicitudin fusce sociis mi. Dictum volutpat praesent ornare accumsan elit venenatis. Congue sodales nunc quis ultricies odio porta. Egestas mauris placerat leo phasellus ut sit.</p>
                <p></p>
                <div class="row mt-45 mb-30">
                  <div class="col-lg-6"><img class="img-responsive" src="{{asset('wassets/assets/imgs/page/blog/single/img-3.png')}}" alt="Agon"></div>
                  <div class="col-lg-6"><img class="img-responsive mb-20" src="{{asset('wassets/assets/imgs/page/blog/single/img-4.png')}}" alt="Agon"><img class="img-responsive" src="{{asset('wassets/assets/imgs/page/blog/single/img-5.png')}}" alt="Agon"></div>
                  <div class="caption-img mt-10 text-center color-gray-400">furniture in your house</div>
                </div>
                <p></p>
                <h3 class="text-heading-3">Use your headings</h3>
                <p>Thirty there &amp; time wear across days, make inside on these you. Can young a really, roses blog small of song their dreamy life pretty? Because really duo living to noteworthy bloom bell. Transform clean daydreaming cute twenty process rooms cool. White white dreamy dramatically place everything although. Place out apartment afternoon whimsical kinder, little romantic joy we flowers handmade. Thirty she a studio of she whimsical projects, afternoon effect going an floated maybe.</p>
                <div class="border-bottom mt-50 mb-50"></div>
                <div><a class="btn btn-tag mr-10" href="blog-1.html">Nature</a><a class="btn btn-tag mr-10" href="blog-2.html">Beauty</a><a class="btn btn-tag mr-10" href="blog-1.html">Travel tips</a><a class="btn btn-tag" href="blog-2.html">Houes</a></div>
              </div>
            
            </div>
          </div>
        </div>
      </section>


@endsection