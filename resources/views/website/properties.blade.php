@extends('website.master')
@section('title',''.$title)

@section('content')

  <main class="main">
      <section class="section-box">
        <div class="banner-hero banner-breadcrums">
          <div class="container text-center">
            <h1 class="text-heading-2 color-gray-1000 mb-20">Properties List</h1>
            
          </div>
        </div>
      </section>
    
      


     <div class="container mt-60">
      
        <div class="filter-gallery">
          <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="product-item-2 portfolio-card hover-up" data-category="website">
                <div class="item-content"><a href="{{ route('propertydetail') }}">
                    <div class="product-image"><img src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-1.png')}}" alt="agon"><a class="text-body-small color-gray-500 font-bold cat" href="page-portfolio-grid-1.html">Branding</a><a class="view-details" href="{{ route('propertydetail') }}"></a></div></a>
                  <div class="product-info"><span class="color-gray-500">August 25, 2025</span><a href="{{ route('propertydetail') }}">
                      <h3 class="text-body-lead color-gray-900">Global JSC Branding</h3></a></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="product-item-2 portfolio-card hover-up" data-category="logos">
                <div class="item-content"><a href="{{ route('propertydetail') }}">
                    <div class="product-image"><img src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-2.png')}}" alt="agon"><a class="text-body-small color-gray-500 font-bold cat" href="page-portfolio-grid-1.html">Branding</a><a class="view-details" href="{{ route('propertydetail') }}"></a></div></a>
                  <div class="product-info"><span class="color-gray-500">August 25, 2025</span><a href="{{ route('propertydetail') }}">
                      <h3 class="text-body-lead color-gray-900">Real Estate UI/UX kit</h3></a></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="product-item-2 portfolio-card hover-up" data-category="branding">
                <div class="item-content"><a href="{{ route('propertydetail') }}">
                    <div class="product-image"><img src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-3.png')}}" alt="agon"><a class="text-body-small color-gray-500 font-bold cat" href="page-portfolio-grid-1.html">Branding</a><a class="view-details" href="{{ route('propertydetail') }}"></a></div></a>
                  <div class="product-info"><span class="color-gray-500">August 25, 2025</span><a href="{{ route('propertydetail') }}">
                      <h3 class="text-body-lead color-gray-900">TrendyMart UI/UX</h3></a></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="product-item-2 portfolio-card hover-up" data-category="media">
                <div class="item-content"><a href="{{ route('propertydetail') }}">
                    <div class="product-image"><img src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-4.png')}}" alt="agon"><a class="text-body-small color-gray-500 font-bold cat" href="page-portfolio-grid-1.html">Branding</a><a class="view-details" href="{{ route('propertydetail') }}"></a></div></a>
                  <div class="product-info"><span class="color-gray-500">August 25, 2025</span><a href="{{ route('propertydetail') }}">
                      <h3 class="text-body-lead color-gray-900">FitTrack App Design</h3></a></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="product-item-2 portfolio-card hover-up" data-category="social">
                <div class="item-content"><a href="{{ route('propertydetail') }}">
                    <div class="product-image"><img src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-5.png')}}" alt="agon"><a class="text-body-small color-gray-500 font-bold cat" href="page-portfolio-grid-1.html">Branding</a><a class="view-details" href="{{ route('propertydetail') }}"></a></div></a>
                  <div class="product-info"><span class="color-gray-500">August 25, 2025</span><a href="{{ route('propertydetail') }}">
                      <h3 class="text-body-lead color-gray-900">NovaTech Identity</h3></a></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="product-item-2 portfolio-card hover-up" data-category="branding">
                <div class="item-content"><a href="{{ route('propertydetail') }}">
                    <div class="product-image"><img src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-6.png')}}" alt="agon"><a class="text-body-small color-gray-500 font-bold cat" href="page-portfolio-grid-1.html">Branding</a><a class="view-details" href="{{ route('propertydetail') }}"></a></div></a>
                  <div class="product-info"><span class="color-gray-500">August 25, 2025</span><a href="{{ route('propertydetail') }}">
                      <h3 class="text-body-lead color-gray-900">FinTrust Dashboard</h3></a></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="product-item-2 portfolio-card hover-up" data-category="website">
                <div class="item-content"><a href="{{ route('propertydetail') }}">
                    <div class="product-image"><img src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-7.png')}}" alt="agon"><a class="text-body-small color-gray-500 font-bold cat" href="page-portfolio-grid-1.html">Branding</a><a class="view-details" href="{{ route('propertydetail') }}"></a></div></a>
                  <div class="product-info"><span class="color-gray-500">August 25, 2025</span><a href="{{ route('propertydetail') }}">
                      <h3 class="text-body-lead color-gray-900">EventSphere Landing</h3></a></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="product-item-2 portfolio-card hover-up" data-category="media">
                <div class="item-content"><a href="{{ route('propertydetail') }}">
                    <div class="product-image"><img src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-8.png')}}" alt="agon"><a class="text-body-small color-gray-500 font-bold cat" href="page-portfolio-grid-1.html">Branding</a><a class="view-details" href="{{ route('propertydetail') }}"></a></div></a>
                  <div class="product-info"><span class="color-gray-500">August 25, 2025</span><a href="{{ route('propertydetail') }}">
                      <h3 class="text-body-lead color-gray-900">Meisa Rosie Portfolio</h3></a></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="product-item-2 portfolio-card hover-up" data-category="website">
                <div class="item-content"><a href="{{ route('propertydetail') }}">
                    <div class="product-image"><img src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-9.png')}}" alt="agon"><a class="text-body-small color-gray-500 font-bold cat" href="page-portfolio-grid-1.html">Branding</a><a class="view-details" href="{{ route('propertydetail') }}"></a></div></a>
                  <div class="product-info"><span class="color-gray-500">August 25, 2025</span><a href="{{ route('propertydetail') }}">
                      <h3 class="text-body-lead color-gray-900">HomeNest Real Estate</h3></a></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="product-item-2 portfolio-card hover-up" data-category="logos">
                <div class="item-content"><a href="{{ route('propertydetail') }}">
                    <div class="product-image"><img src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-10.png')}}" alt="agon"><a class="text-body-small color-gray-500 font-bold cat" href="page-portfolio-grid-1.html">Branding</a><a class="view-details" href="{{ route('propertydetail') }}"></a></div></a>
                  <div class="product-info"><span class="color-gray-500">August 25, 2025</span><a href="{{ route('propertydetail') }}">
                      <h3 class="text-body-lead color-gray-900">CloudSync SaaS</h3></a></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="product-item-2 portfolio-card hover-up" data-category="media">
                <div class="item-content"><a href="{{ route('propertydetail') }}">
                    <div class="product-image"><img src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-11.png')}}" alt="agon"><a class="text-body-small color-gray-500 font-bold cat" href="page-portfolio-grid-1.html">Branding</a><a class="view-details" href="{{ route('propertydetail') }}"></a></div></a>
                  <div class="product-info"><span class="color-gray-500">August 25, 2025</span><a href="{{ route('propertydetail') }}">
                      <h3 class="text-body-lead color-gray-900">Muzilla Game UI</h3></a></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="product-item-2 portfolio-card hover-up" data-category="social">
                <div class="item-content"><a href="{{ route('propertydetail') }}">
                    <div class="product-image"><img src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-12.png')}}" alt="agon"><a class="text-body-small color-gray-500 font-bold cat" href="page-portfolio-grid-1.html">Branding</a><a class="view-details" href="{{ route('propertydetail') }}"></a></div></a>
                  <div class="product-info"><span class="color-gray-500">August 25, 2025</span><a href="{{ route('propertydetail') }}">
                      <h3 class="text-body-lead color-gray-900">Carento Rental UI</h3></a></div>
                </div>
              </div>
            </div>
          </div>
          <div class="paginations">
            <ul class="pager">
              <li><a class="prev-page" href="#"></a></li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a class="page-dotted" href="#"></a></li>
              <li><a class="next-page" href="#"></a></li>
            </ul>
          </div>
        </div>
      </div>


@endsection