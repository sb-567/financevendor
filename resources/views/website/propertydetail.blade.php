@extends('website.master')
@section('title',''.$title)

@section('customstyle')
<style>
.mySwiper{
  position:relative;
}
.swiper-pagination{
  position: absolute;
}
</style>
@endsection

@section('content')

 <main class="main">

  <section class="section-box">
        <div class="banner-hero banner-breadcrums">
          <div class="container text-center">
            <h1 class="text-heading-2 color-gray-1000 mb-20">Properties details</h1>
            

            <nav aria-label="breadcrumb">
                    <ul class="breadcrumb justify-content-center bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page"><a href="page-portfolio-grid-1.html" >Properties</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Properties details
                        </li>
                    </ul>
                </nav>


          </div>
        </div>
      </section>






    


      <div class="section-box mt-50">
        <div class="container">
          <div class="row">
            <div class="col-lg-10 mx-auto">
              
             <div class="swiper mySwiper">
  <div class="swiper-wrapper">
    
   
    
    <div class="swiper-slide">
      <img src="{{ asset('wassets/assets/imgs/p2.jpg')}}" />
    </div>
    
    <div class="swiper-slide">
      <img src="{{ asset('wassets/assets/imgs/p1.jpg')}}" />
    </div>

  </div>

  <!-- Pagination -->
  <div class="swiper-pagination"></div>

 
</div>

                {{-- <div id="carouselExampleFade" class="carousel slide carousel-fade">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-details.png')}}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-details.png')}}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-details.png')}}" class="d-block w-100" alt="...">
                    </div>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div> --}}

              {{-- <div class="box-image"><a class="popup-youtube btn-play-video btn-play-middle" href="https://www.youtube.com/watch?v=oRI37cOPBQQ"></a><img class="img-responsive bdrd-16" src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-details.png')}}" alt="Agon"></div> --}}
            </div>
          </div>
        </div>
      </div>

        <section class="section-box">
        <div class="banner-hero banner-breadcrums bg-white">
          <div class="container text-center">
            <div class="row">
              <div class="col-lg-12">
                <h1 class="text-display-3 color-gray-900 ">Real Estate UI/UX kit</h1>
                {{-- <p class="text-heading-6 color-gray-600 ">Streamlined, Modern, and User-Friendly<br class="d-lg-block d-none"> Design for Real Estate Platforms.</p> --}}
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="section-box ">
        <div class="container">
          <div class="row">
            <div class="col-lg-10 mx-auto">
              <div class="row mb-50">
                <div class="line-bd-green "></div>

                <div class="col-lg-3 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf"> <i class="fi fi-rr-info"></i> Agent</h4>
                  <p class="text-body-excerpt color-gray-600 mt-15">AliThemes Coporation</p>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf"> <i class="fi fi-rr-info"></i> City</h4>
                  <p class="text-body-excerpt color-gray-600 mt-15">January 2025</p>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf"><i class="fi fi-rr-info"></i> Area</h4>
                  <p class="text-body-excerpt color-gray-600 mt-15">UI/UX design, Branding</p>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf"><i class="fi fi-rr-info"></i> Property Type</h4>
                  <p class="text-body-excerpt color-gray-600 mt-15"><a href="https://alithemes.com">https://alithemes.com</a></p>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf"><i class="fi fi-rr-info"></i> Apartment Type</h4>
                  <p class="text-body-excerpt color-gray-600 mt-15"><a href="https://alithemes.com">https://alithemes.com</a></p>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf"><i class="fi fi-rr-info"></i> Facing Direction</h4>
                  <p class="text-body-excerpt color-gray-600 mt-15"><a href="https://alithemes.com">https://alithemes.com</a></p>
                </div>

                <div class="col-lg-3 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf"><i class="fi fi-rr-info"></i> Parking Availablity</h4>
                  <p class="text-body-excerpt color-gray-600 mt-15"><a href="https://alithemes.com">https://alithemes.com</a></p>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf"><i class="fi fi-rr-info"></i> No of Bathroom</h4>
                  <p class="text-body-excerpt color-gray-600 mt-15"><a href="https://alithemes.com">https://alithemes.com</a></p>
                </div>
              </div>
              
              <div class="col-lg-10 mx-auto mt-50">
                <div class="content-detail">
                  {{-- <h2 class="text-heading-4">Overview</h2>
                  <p class="text-body-text">The Real Estate UI/UX Kit is a comprehensive design solution crafted for real estate businesses, agencies, and property marketplaces. It offers a clean and intuitive interface with all the necessary features to enhance the home-buying and rental experience. </p>
                  <p class="text-body-text">This kit ensures seamless navigation, engaging property showcases, and a smooth user journey from discovery to transaction.</p>
                  <p></p>
                  <h2 class="text-heading-4">Key Features</h2>
                  <ul>
                    <li>Modern and Clean UI – Aesthetically pleasing, responsive layouts for web and mobile.</li>
                    <li>Property Listings and Details – High-quality visuals, interactive maps, and detailed descriptions.</li>
                    <li>Advanced Search and Filters – Location, price range, property type, amenities, and more.</li>
                    <li>User Dashboards – Separate dashboards for buyers, sellers, and agents.</li>
                    <li>Appointment Scheduling – Easy booking system for property viewings.</li>
                    <li>Mortgage Calculator – Helps users estimate loan payments.</li>
                    <li>Favorites and Saved Listings – Allow users to bookmark properties.</li>
                    <li>Light and Dark Mode Support – Enhancing accessibility and user preference.</li>
                    <li>Fully Customizable Components – Designed to be adaptable to various real estate needs.</li>
                  </ul>
                  <p></p>
                  <h2 class="text-heading-4">Tools and Technologies Used</h2>
                  <ul>
                    <li>Design Tools: Figma, Adobe XD, Sketch</li>
                    <li>Prototyping: InVision, Framer</li>
                    <li>Development-Ready Assets: HTML, CSS, Bootstrap</li>
                  </ul>
                  <p></p>
                  <h2 class="text-heading-4">Design Approach</h2>
                  <p>The UI/UX was designed with a minimalist yet functional approach, ensuring that users can browse properties effortlessly.</p>
                  <p>The color scheme, typography, and layout were chosen to evoke professionalism, trust, and ease of use. The goal was to create a visually appealing interface while keeping usability and performance in mind.</p>
                  <div class="border-bottom mt-50 mb-50"></div> --}}
                  <div class="media-block text-center mb-50">
                    {{-- <a class="btn btn-green-900 color-white text-heading-6 icon-arrow-right-white mr-20" href="page-signup.html">Get a Quote</a> --}}
                    <a class="btn btn-default icon-arrow-right" href="">Contact Us</a>
                    <!-- <div class="float-start float-lg-end mt-30"><a class="btn btn-media mr-10" href="#"><img src="assets/imgs/template/icons/facebook-share.svg" alt="Agon"> Share</a><a class="btn btn-media mr-10" href="#"><img src="assets/imgs/template/icons/twitter-share.svg" alt="Agon"> Tweet</a><a class="btn btn-media" href="#"><img src="assets/imgs/template/icons/pinterest-share.svg" alt="Agon"> Pin</a></div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
     
    
    </main>

@endsection


@section('customscript')

<script>

document.addEventListener("DOMContentLoaded", function () {
  var swiper = new Swiper(".mySwiper", {
    loop: true,
    speed: 800,
    
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },

    effect: "fade", // same like bootstrap fade

    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },

    // navigation: {
    //   nextEl: ".swiper-button-next",
    //   prevEl: ".swiper-button-prev",
    // },
  });
});

</script>

@endsection
