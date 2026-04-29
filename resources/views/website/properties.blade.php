@extends('website.master')
@section('title',''.$title)

@section('content')

  <main class="main">
      <section class="section-box">
        <div class="banner-hero banner-breadcrums">
          <div class="container text-center">
            <h1 class="text-heading-2 color-gray-1000 mb-20">Properties </h1>
            

            <nav aria-label="breadcrumb">
                    <ul class="breadcrumb justify-content-center bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Properties
                        </li>
                    </ul>
                </nav>


          </div>
        </div>
      </section>
    
      


      <div class="section-box mt-70"></div>
      <div class="container">
        <div class="row dr-rtl">
          <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12 dr-ltr">
      
            {{-- <div class="filters-products d-flex">
              <div class="number-info"><strong class="text-body-lead color-gray-500">There are <span class="color-green-900">1853</span> products in this category</strong></div>
              <div class="fitler-info">
                <div class="icon-layout mr-10 text-body-text color-gray-500">Show: 
                  <div class="color-green-900 d-inline">
                    <div class="dropdown dropdown-sort">
                      <button class="btn dropdown-toggle" id="dropdownPage" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><span>50</span><i class="fi-rr-angle-small-down"></i></button>
                      <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownPage">
                        <li><a class="dropdown-item active" href="#">50</a></li>
                        <li><a class="dropdown-item" href="#">100</a></li>
                        <li><a class="dropdown-item" href="#">150</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="icon-sort text-body-text color-gray-500">Sort by: 
                  <div class="color-green-900 d-inline">
                    <div class="dropdown dropdown-sort">
                      <button class="btn dropdown-toggle" id="dropdownSort" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><span>Featured</span><i class="fi-rr-angle-small-down"></i></button>
                      <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort">
                        <li><a class="dropdown-item active" href="#">Featured</a></li>
                        <li><a class="dropdown-item" href="#">Rating</a></li>
                        <li><a class="dropdown-item" href="#">Low Price</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}
            <div class="row ">
             @foreach($propertiesdata as $property)
<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
    <div class="product-item-2 hover-up">

        <a href="{{ route('propertydetail', $property->property_slug) }}">

          @php
              $images = json_decode($property->property_images, true);
          @endphp
            <div class="product-image1">
                @if (!empty($images) && is_array($images) && count($images) > 0)
                    <img src="{{ asset('public/uploads/vendors/properties/' . $images[0]) }}" alt="{{ $property->property_name }}">
                @else
                    <img src="https://placehold.co/400x300?text=Property+Image" alt="Default Image">
                @endif
            </div>
        </a>

        <div class="product-info">

            <span>
                <i class="fi fi-rr-location-alt"></i> {{ $property->city }}
            </span>

            <h3 class="text-body-lead color-gray-900">{{ $property->property_name }}</h3>

            <div class="property-meta">
                <span>{{ $data['apartment_type'][$property->apartment_type] ?? $property->apartment_type }}</span> |
                <span>{{ $property->area }}</span> |
                <span>{{ $property->facing_direction }}</span>
            </div>

            <div class="d-flex justify-content-between mt-2">
                <span class="text-body-lead2"><i class="fi fi-rr-user"></i> {{ $property->vendor_name }}</span>
                {{-- <span><i class="fi fi-rr-phone-call"></i> {{ $property->vendor_mobile }}</span> --}}
            </div>

            <a class="btn btn-cart mt-2" href="#">Contact</a>

        </div>
    </div>
</div>
@endforeach

              {{-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
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

                    
                      <a class="btn btn-cart" href="#">Contact</a>
                    
                  </div>
                </div>
              </div> --}}


              
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

            <div class="paginations mt-4">
              <ul class="pager">

                  {{-- Previous --}}
                  @if ($propertiesdata->onFirstPage())
                      <li><a class="prev-page disabled"></a></li>
                  @else
                      <li>
                          <a class="prev-page" href="{{ $propertiesdata->previousPageUrl() }}"></a>
                      </li>
                  @endif

                  {{-- Pages --}}
                  @foreach ($propertiesdata->getUrlRange(1, $propertiesdata->lastPage()) as $page => $url)
                      <li>
                          <a href="{{ $url }}" class="{{ $page == $propertiesdata->currentPage() ? 'active' : '' }}">
                              {{ $page }}
                          </a>
                      </li>
                  @endforeach

                  {{-- Next --}}
                  @if ($propertiesdata->hasMorePages())
                      <li>
                          <a class="next-page" href="{{ $propertiesdata->nextPageUrl() }}"></a>
                      </li>
                  @else
                      <li><a class="next-page disabled"></a></li>
                  @endif

              </ul>
          </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 dr-ltr">

            <form method="GET" action="{{ route('propertieslist') }}">

            <div class="sidebar">
              <div class="widget-title">
                <h3 class="text-heading-5 color-gray-900">Filter items</h3>
              </div>
              <div class="widget-content">
                
                
                <h4 class="text-heading-6 color-green-900 mt-30">Price Type</h4>
                <ul class="list-type">
                  <li>
                    <label class="cb-container text-body-text color-gray-500">
                      <input type="checkbox" name="price_type[]" value="1" 
                      {{ in_array('1', request()->price_type ?? []) ? 'checked' : '' }}
                      ><span class="text-lbl">Rent</span><span class="checkmark"></span>
                    </label>
                  </li>
                  <li>
                    <label class="cb-container text-body-text color-gray-500">
                      <input type="checkbox" name="price_type[]" value="2"
                      {{ in_array('2', request()->price_type ?? []) ? 'checked' : '' }}
                      ><span class="text-lbl">Sale</span><span class="checkmark"></span>
                    </label>
                  </li>
                  <li>
                    <label class="cb-container text-body-text color-gray-500">
                      <input type="checkbox" name="price_type[]" value="3"
                      {{ in_array('3', request()->price_type ?? []) ? 'checked' : '' }}
                      ><span class="text-lbl">Lease</span><span class="checkmark"></span>
                    </label>
                  </li>

                </ul>
                <h4 class="text-heading-6 color-green-900">Apartment Type</h4>
                <ul class="list-type">
                  <li>
                    <label class="cb-container text-body-text color-gray-500">
                      <input type="checkbox" name="apartment_type[]" value="1"
                      {{ in_array('1', request()->apartment_type ?? []) ? 'checked' : '' }}
                      ><span class="text-lbl">1Rk</span><span class="checkmark"></span>
                    </label>
                  </li>
                  <li>
                    <label class="cb-container text-body-text color-gray-500">
                      <input type="checkbox" name="apartment_type[]" value="2"
                      {{ in_array('2', request()->apartment_type ?? []) ? 'checked' : '' }}
                      ><span class="text-lbl">1Bhk</span><span class="checkmark"></span>
                    </label>
                  </li>
                  <li>
                    <label class="cb-container text-body-text color-gray-500">
                      <input type="checkbox" name="apartment_type[]" value="3"
                      {{ in_array('3', request()->apartment_type ?? []) ? 'checked' : '' }}
                      ><span class="text-lbl">2Bhk</span><span class="checkmark"></span>
                    </label>
                  </li>
                  <li>
                    <label class="cb-container text-body-text color-gray-500">
                      <input type="checkbox" name="apartment_type[]" value="4"
                      {{ in_array('4', request()->apartment_type ?? []) ? 'checked' : '' }}
                      ><span class="text-lbl">3Bhk</span><span class="checkmark"></span>
                    </label>
                  </li>
                  
                </ul>
               
                <h4 class="text-heading-6 color-green-900">Parking Avaliable</h4>
                <ul class="list-type">
                  <li>
                    <label class="cb-container">
                      <input type="radio" name="parking_avalible[]" value="1"
                      {{ in_array('1', request()->parking_avalible ?? []) ? 'checked' : '' }}
                      >
                      <span class="text-lbl">Yes</span>
                      <span class="checkmark"></span>
                    </label>
                  </li>
                  <li>
                   <label class="cb-container">
                    <input type="radio" name="parking_avalible[]" value="0"
                    
                    {{ in_array('0', request()->parking_avalible ?? []) ? 'checked' : '' }}
                    >
                    <span class="text-lbl">No</span>
                    <span class="checkmark"></span>
                    </label>
                  </li>
                
                  
                </ul>
               
              </div>
            </div>
            </form>
         
          
          </div>
        </div>
      </div>

      

  </main>


@endsection



@section('customscript')

<script>
document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("form");

    // all inputs inside sidebar
    const inputs = form.querySelectorAll("input");

    inputs.forEach(input => {
        input.addEventListener("change", function () {
            form.submit();
        });
    });

});
</script>
    
@endsection