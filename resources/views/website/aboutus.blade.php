@extends('website.master')
@section('title',''.$title)

@section('content')


  <main class="main">

       <section class="section-box">
        <div class="banner-hero banner-breadcrums">
            <div class="container text-center">
                
                <!-- Page Title -->
                <h1 class="text-heading-2 color-gray-1000 mb-10">About Us</h1>

                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb justify-content-center bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            About Us
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </section>


     <section class="section-box mt-100 pt-30">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-sm-12 col-12 block-gallery-1">
              <div class="row">
                <div class="col-lg-6"><img class="img-responsive mb-10" src="{{ asset('wassets/assets/imgs/page/about/2/img-2.png')}}" alt="Agon"><img class="img-responsive" src="{{ asset('wassets/assets/imgs/page/about/2/img-3.png')}}" alt="Agon"></div>
                <div class="col-lg-6"><img class="img-responsive" src="{{ asset('wassets/assets/imgs/page/about/2/img-1.png')}}" alt="Agon"></div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12 block-pl">
              <h2 class="text-heading-1  mb-30 mt-20">Our game-changing approach to working together</h2>
              <p class="text-inter-lg">Check out stories from companies like Leroy Merlin and Decathlon to get inspired by how much you can gain.</p>
              <div class="mt-30"><a class="btn btn-black text-body-text" href="page-service-2.html">Keep Reading</a></div>
            </div>
          </div>
        </div>
      </section>
      <section class="section-box mt-100 pt-50">
        <div class="container">
          <div class="row">
            <div class="col-lg-1 col-sm-1 col-12"></div>
            <div class="col-lg-10 col-sm-10 col-12 text-center">
              <h2 class="text-heading-1 color-gray-900 mb-10">Providing solutions of every kind</h2>
              <p class="text-body-lead-large color-gray-600 mt-20">In a professional context it often happens that private or<br class="d-lg-block d-none"> corporate clients order a publication to publish news.</p>
            </div>
            <div class="col-lg-1 col-sm-1 col-12"></div>
          </div>
        </div>
        <div class="container mt-40">
          <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
              <div class="list-icons mt-50">
                <div class="item-icon none-bd"><span class="icon-left"><img src="{{ asset('wassets/assets/imgs/page/homepage2/icon-acquis.svg')}}" alt="Agon"></span>
                  <h4 class="text-heading-4">1. Acquisition</h4>
                  <p class="text-body-text color-gray-600 mt-15">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit laborum &mdash; semper quis lectus nulla.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
              <div class="list-icons mt-50">
                <div class="item-icon none-bd"><span class="icon-left"><img src="{{ asset('wassets/assets/imgs/page/homepage2/icon-active.svg')}}" alt="Agon"></span>
                  <h4 class="text-heading-4">2. Activation</h4>
                  <p class="text-body-text color-gray-600 mt-15">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit laborum &mdash; semper quis lectus nulla.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
              <div class="list-icons mt-50">
                <div class="item-icon none-bd"><span class="icon-left"><img src="{{ asset('wassets/assets/imgs/page/homepage2/icon-retent.svg')}}" alt="Agon"></span>
                  <h4 class="text-heading-4">3. Retention</h4>
                  <p class="text-body-text color-gray-600 mt-15">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit laborum &mdash; semper quis lectus nulla.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section-box pt-100 pb-100 mt-100 bg-6">
        <div class="container">
          <div class="row">
            <div class="col-lg-5 mb-30"><span class="tag-1 color-gray-900">Built Exclusively For You</span>
              <h3 class="text-heading-1 color-white mt-30">Don&rsquo;t take our word for it. See what our clients say.</h3>
              <p class="text-body-lead-large color-white mt-30">Aliquam a augue suscipit, luctus neque purus ipsum neque at dolor primis libero tempus, blandit</p>
              <div class="mt-40"><a class="btn btn-default btn-white icon-arrow-right" href="page-service-2.html">Learn More</a></div>
            </div>
            <div class="col-lg-7">
              <div class="row" data-masonry="{&quot;percentPosition&quot;: true }">
                <div class="col-lg-6 col-md-12 col-sm-12">
                  <div class="card-grid-style-2 card-square hover-up mb-20">
                    <p class="text-body-text color-gray-600 text-comment">&quot;No matter where you go, It&apos;s is the coolest, most happening thing around! Not able to tell you how happy I am with it. &quot;</p>
                    <div class="box-img-user">
                      <div class="img-user img-user-round"><img src="{{ asset('wassets/assets/imgs/page/homepage2/user-1.png')}}" alt="Agon"></div>
                      <h4 class="text-body-lead color-gray-900 mb-5">Jane Cooper</h4>
                      <p class="text-body-text-md">Biffco Enterprises Ltd.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                  <div class="card-grid-style-2 card-square hover-up mb-20">
                    <p class="text-body-text color-gray-600 text-comment">&quot;Wow what great service, I love it! It&apos;s is the most valuable business resource we have EVER purchased. We can&apos;t understand how we&apos;ve been living without it. I couldn&apos;t have asked for more than this.&quot;</p>
                    <div class="box-img-user">
                      <div class="img-user img-user-round"><img src="{{ asset('wassets/assets/imgs/page/homepage2/user-2.png')}}" alt="Agon"></div>
                      <h4 class="text-body-lead color-gray-900 mb-5">Wade Warren</h4>
                      <p class="text-body-text-md">Krusty Krab</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                  <div class="card-grid-style-2 card-square hover-up mb-20">
                    <p class="text-body-text color-gray-600 text-comment">&quot;Your company is truly upstanding and is behind its product 100%. It&apos;s the perfect solution for our business. It has really helped our business. Needless to say we are extremely satisfied with the results. &quot;</p>
                    <div class="box-img-user">
                      <div class="img-user img-user-round"><img src="{{ asset('wassets/assets/imgs/page/homepage2/user-3.png')}}" alt="Agon"></div>
                      <h4 class="text-body-lead color-gray-900 mb-5">Leslie Alexander</h4>
                      <p class="text-body-text-md">Biffco Enterprises Ltd.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                  <div class="card-grid-style-2 card-square hover-up mb-20">
                    <p class="text-body-text color-gray-600 text-comment">&quot;It&apos;s is both attractive and highly adaptable. It&apos;s exactly what I&apos;ve been looking for. Definitely worth the investment.&quot;</p>
                    <div class="box-img-user">
                      <div class="img-user img-user-round"><img src="{{ asset('wassets/assets/imgs/page/homepage2/user-4.png')}}" alt="Agon"></div>
                      <h4 class="text-body-lead color-gray-900 mb-5">Jenny Wilson</h4>
                      <p class="text-body-text-md">Soylent Corp</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section-box">
        <div class="container mt-120">
          <div class="row">
            <div class="col-lg-6 col-sm-12 block-img-we-do"><img class="bdrd-16 img-responsive" src="{{ asset('wassets/assets/imgs/page/about/3/img-2.png')}}" alt="Agon"></div>
            <div class="col-lg-6 col-sm-12 block-we-do"><span class="tag-1 text-black">What We Do, What You Get</span>
              <h3 class="text-heading-1 mt-30">An Exceptionally unique experience Tailored to you</h3>
              <p class="text-body-lead-large color-gray-600 mt-30">In a professional context it often happens that private or corporate clients order a publication news while still not being ready. Business advisory service advises current and future businesses prospects of a client</p>
              <div class="line-bd-green mt-50"></div>
              <div class="row">
                <div class="col-lg-6 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf">Boost your sale</h4>
                  <p class="text-body-excerpt color-gray-600 mt-15">The latest design trends meet hand-crafted templates.</p>
                </div>
                <div class="col-lg-6 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf">Smart Installation Tools</h4>
                  <p class="text-body-excerpt color-gray-600 mt-15">The latest design trends meet hand-crafted templates.</p>
                </div>
                <div class="col-lg-6 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf">Introducing New Features</h4>
                  <p class="text-body-excerpt color-gray-600 mt-15">The latest design trends meet hand-crafted templates.</p>
                </div>
                <div class="col-lg-6 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf">Dynamic Boosting</h4>
                  <p class="text-body-excerpt color-gray-600 mt-15">The latest design trends meet hand-crafted templates.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="section-box mt-100">
        <div class="container">
          <div class="bd-bottom pb-70">
            <ul class="list-5-col">
              <li><span class="text-display-3 color-green-900">+<span class="count">6</span>k</span>
                <p class="text-body-text color-gray-500 pl-40">Years in<br>Business</p>
              </li>
              <li><span class="text-display-3 color-green-900">+<span class="count">12</span>k</span>
                <p class="text-body-text color-gray-500 pl-40">Projects<br>Done</p>
              </li>
              <li><span class="text-display-3 color-green-900">+<span class="count">14</span>k</span>
                <p class="text-body-text color-gray-500 pl-40">Countries<br>/ Offices</p>
              </li>
              <li><span class="text-display-3 color-green-900">+<span class="count">16</span>k</span>
                <p class="text-body-text color-gray-500 pl-40">Constant<br>Clients</p>
              </li>
              <li><span class="text-display-3 color-green-900">+<span class="count">27</span>k</span>
                <p class="text-body-text color-gray-500 pl-40">Paid Customers</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    
      <section class="section-box">
        <div class="container mt-30">
          <div class="row">
            <div class="col-lg-8">
              <h3 class="text-heading-1 mb-10">From Our Blog</h3>
              <p class="text-body-lead-large color-gray-600">From Our blog and Event fanpage</p>
            </div>
            <div class="col-lg-4 text-lg-end text-start pt-30"><a class="btn btn-black icon-arrow-right-white" href="blog-2.html">View More</a></div>
          </div>
        </div>
        <div class="container mt-90 pb-50">
          <div class="row">
            <div class="col-lg-4 col-sm-12 pr-30">
              <div class="card-grid-style-4"><span class="tag-dot">Company</span><a class="text-heading-4" href="blog-single.html">We can blend colors multiple ways, the most common</a>
                <div class="grid-4-img"><a href="blog-single.html"><img src="{{ asset('wassets/assets/imgs/page/homepage1/img-news-1.png')}}" alt="Agon"></a></div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-12 pr-30">
              <div class="card-grid-style-4"><span class="tag-dot">Marketing Event</span><a class="text-heading-4" href="blog-single.html">How To Blow Through Capital At An Incredible Rate</a>
                <div class="grid-4-img"><a href="blog-single.html"><img src="{{ asset('wassets/assets/imgs/page/homepage1/img-news-2.png')}}" alt="Agon"></a></div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-12 pr-30">
              <div class="card-grid-style-4"><span class="tag-dot">Customer Services</span><a class="text-heading-4" href="blog-single.html">Design Studios That Everyone Should Know About?</a>
                <div class="grid-4-img color-bg-4"><a href="blog-single.html"><img src="{{ asset('wassets/assets/imgs/page/homepage1/img-news-3.png')}}" alt="Agon"></a></div>
              </div>
            </div>
          </div>
        </div>
      </section>


@endsection