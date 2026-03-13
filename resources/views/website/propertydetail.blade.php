@extends('website.master')
@section('title',''.$title)

@section('content')

 <main class="main">
  <section class="section-box">
        <div class="banner-hero nav-breadcrums bg-gray-100">
          <div class="container">
            <div class="breadcrumb">
              <ul>
                <li class="home"><a href="index.html">Home</a></li>
                <li><a href="page-portfolio-grid-1.html">Portfolio</a></li>
                <li><span>Real Estate UI/UX kit</span></li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      <section class="section-box">
        <div class="banner-hero banner-breadcrums bg-white">
          <div class="container text-center">
            <div class="row">
              <div class="col-lg-12">
                <h1 class="text-display-3 color-gray-900 mb-20">Real Estate UI/UX kit</h1>
                <p class="text-heading-6 color-gray-600 mb-20">Streamlined, Modern, and User-Friendly<br class="d-lg-block d-none"> Design for Real Estate Platforms.</p>
              </div>
            </div>
          </div>
        </div>
      </section>


      <div class="section-box mt-50">
        <div class="container">
          <div class="row">
            <div class="col-lg-10 mx-auto">
              <div class="line-bd-green"></div>
              <div class="row mb-50">
                <div class="col-lg-3 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf">Client</h4>
                  <p class="text-body-excerpt color-gray-600 mt-15">AliThemes Coporation</p>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf">Date</h4>
                  <p class="text-body-excerpt color-gray-600 mt-15">January 2025</p>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf">Skills</h4>
                  <p class="text-body-excerpt color-gray-600 mt-15">UI/UX design, Branding</p>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf">Project URL</h4>
                  <p class="text-body-excerpt color-gray-600 mt-15"><a href="https://alithemes.com">https://alithemes.com</a></p>
                </div>
              </div>
              <div class="box-image"><a class="popup-youtube btn-play-video btn-play-middle" href="https://www.youtube.com/watch?v=oRI37cOPBQQ"></a><img class="img-responsive bdrd-16" src="{{ asset('wassets/assets/imgs/page/portfolio/portfolio-details.png')}}" alt="Agon"></div>
              <div class="col-lg-10 mx-auto mt-50">
                <div class="content-detail">
                  <h2 class="text-heading-4">Overview</h2>
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
                  <div class="border-bottom mt-50 mb-50"></div>
                  <div class="media-block mb-50"><a class="btn btn-green-900 color-white text-heading-6 icon-arrow-right-white mr-20" href="page-signup.html">Get a Quote</a><a class="btn btn-default icon-arrow-right" href="page-contact.html">Contact Us</a>
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