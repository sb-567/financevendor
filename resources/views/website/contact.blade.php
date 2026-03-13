@extends('website.master')
@section('title',''.$title)

@section('content')

  <main class="main">
      <section class="section-box">
        <div class="banner-hero banner-breadcrums">
          <div class="container text-center">
            <h1 class="text-heading-2 color-gray-1000 mb-20">Contact Us</h1>
            
          </div>
        </div>
      </section>
    
      


      <section class="contact-section">
    <div class="container">
        <div class="row align-items-center g-4">

            <!-- LEFT CONTENT -->
            <div class="col-lg-6">
                <span class="badge badge-custom mb-3">Get In Touch</span>
                <h2 class="fw-bold mt-3">We Are Here To<br>Answer Your Queries</h2>


                     
              <div class="list-icons hover-up mt-50">
                <div class="item-icon"><span class="icon-left"><img src="{{ asset('wassets/assets/imgs/page/homepage2/icon-acquis.svg')}}" alt="Agon"></span>
                  <h4 class="text-heading-4">Ofice</h4>
                  <p class="text-body-text color-gray-1100 mt-15">205 North Michigan Avenue, Suite 810<br>                                    Chicago, 60601, USA<br>                                    Phone: (123) 456-7890<br>                                    Email: contact@Evara.com</p>
                </div>
              </div>
            
            </div>

            <!-- RIGHT FORM -->
            <div class="col-lg-6">
                <div class="form-card shadow">

                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Last Name">
                            </div>

                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Email Address">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Phone Number">
                            </div>

                            

                            <div class="col-12">
                                <textarea class="form-control" rows="4" placeholder="Input Message Here..."></textarea>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="consent">
                                    <label class="form-check-label small" for="consent">
                                        I consent to receive communication and agree to its Terms & Conditions.
                                    </label>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-custom w-100">
                                    Contact Us
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>


@endsection