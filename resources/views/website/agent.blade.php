@extends('website.master')
@section('title',''.$title)

@section('content')

  <main class="main">
      <section class="section-box">
        <div class="banner-hero banner-breadcrums">
          <div class="container text-center">
            <h1 class="text-heading-2 color-gray-1000 mb-20">Agent List </h1>
            

            <nav aria-label="breadcrumb">
                    <ul class="breadcrumb justify-content-center bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Agent List
                        </li>
                    </ul>
                </nav>


          </div>
        </div>
      </section>
    
      


      <div class="section-box mt-70"></div>
      <div class="container">
       
        
            <div class="row ">
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="product-item-2 hover-up"><a href="{{ route('propertydetail') }}">
                    <div class="product-image1"><img src="{{ asset('wassets/assets/imgs/p1.jpg')}}" alt="agon"></div></a>
                  
                  <div class="product-info">
                    <span class="text-body-small color-gray-500 font-bold"><i class="fi fi-rr-location-alt"></i> Mumbai</span>
                    {{-- <span class="text-body-small color-gray-500 font-bold"><i class="fi fi-rr-user"></i> Agent</span> --}}
                    <a href="#"><h3 class="text-body-lead color-gray-900">3bhk Bangalow Sea facing</h3></a>
                    
                      
                      <div class="property-meta mt-2 mb-3">
                        <span>3bhk</span> |
                        <span>Andheri West</span> |
                        <span>West Direction face</span> 
                        
                    </div>

                    <div class="d-flex justify-content-between mt-20">
                      <h4 class="text-body-lead2"><i class="fi fi-rr-user"></i> Agent, lastname </h4>
                      <h4 class="text-body-lead2"><i class="fi fi-rr-phone-call"></i> xxxxxxx589 </h4>
                    </div>
                    
                    
                      {{-- <div class="box-prices">Sale</div>  --}}
                      <a class="btn btn-cart" href="#">Contact</a>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="product-item-2 hover-up"><a href="#">
                    <div class="product-image1"><img src="{{ asset('wassets/assets/imgs/p2.jpg')}}" alt="agon"></div></a>
                  
                  <div class="product-info"><span class="text-body-small color-gray-500 font-bold"><i class="fi fi-rr-location-alt"></i> Mumbai</span><a href="#">
                      <h3 class="text-body-lead color-gray-900">3bhk Bangalow Sea facing</h3></a>

                      <div class="property-meta mt-2 mb-3">
                        <span>3bhk</span> |
                        <span>Andheri West</span> |
                        <span>West Direction face</span> 
                        
                      </div>
                    
                     <div class="d-flex justify-content-between mt-20">
                      <h4 class="text-body-lead2"><i class="fi fi-rr-user"></i> Agent, lastname </h4>
                      <h4 class="text-body-lead2"><i class="fi fi-rr-phone-call"></i> xxxxxxx589 </h4>
                    </div>

                    {{-- <div class="d-flex mt-20">
                      <div class="box-prices">Sale</div> --}}
                      <a class="btn btn-cart" href="#">Contact</a>
                    {{-- </div> --}}
                  </div>
                </div>
              </div>


              
            </div>
            {{-- <div class="paginations">
              <ul class="pager">
                <li><a class="prev-page" href="#"></a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a class="page-dotted" href="#"></a></li>
                <li><a class="next-page" href="#"></a></li>
              </ul>
            </div> --}}
          
      </div>

      

  </main>


@endsection