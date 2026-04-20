@extends('website.master')
@section('title',''.$title)

@section('customstyle')
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
<style>
     :root {
    --y: #fcc534; --yl: #fff8e6; --yd: #7a5500;
    --g: #198754; --gl: #e6f4ed; --gd: #0d5c39;
    --r: #fd7b66; --rl: #fff1ee; --rd: #b83a26;
  }
  * { box-sizing: border-box; }
  .pill {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 11px; font-weight: 500; padding: 4px 12px;
    border-radius: 100px; letter-spacing: 0.03em;
  }
  .pill-y { background: var(--yl); color: var(--yd); border: 1px solid #fcc53455; }
  .pill-r { background: var(--rl); color: var(--rd); border: 1px solid #fd7b6644; }

  .step-wrap { position: relative; }
  .step-card {
    background: var(--color-background-primary);
    border: 1px solid var(--color-border-tertiary);
    border-radius: 12px; padding: 11px 14px;
    display: flex; align-items: center; gap: 12px;
    position: relative;
  }
  .step-card.final { border: 2px solid var(--g); }
  .s-icon {
    width: 42px; height: 42px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; flex-shrink: 0;
  }
  .iy { background: var(--yl); color: var(--yd); }
  .ig { background: var(--gl); color: var(--gd); }
  .s-num {
    width: 20px; height: 20px; border-radius: 50%;
    background: var(--y); color: var(--yd);
    font-size: 10px; font-weight: 500;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; margin-left: auto;
  }
  .s-num.gn { background: var(--g); color: #fff; }
  .s-title { font-size: 13px; font-weight: 500; color: var(--color-text-primary); margin: 0; }
  .s-sub   { font-size: 11px; color: var(--color-text-secondary); margin: 0; }
  .arrow-down {
    display: flex; justify-content: center;
    color: var(--y); font-size: 18px; line-height: 1; margin: 1px 0;
  }

  .out-card {
    background: var(--color-background-primary);
    border: 1px solid var(--color-border-tertiary);
    border-left: 3px solid var(--r);
    border-radius: 12px; padding: 12px 14px;
    display: flex; align-items: flex-start; gap: 10px; height: 100%;
  }
  .o-icon {
    width: 34px; height: 34px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; flex-shrink: 0;
    background: var(--rl); color: var(--rd);
  }

  .cta {
    border-radius: 14px; background: var(--g);
    padding: 18px 22px;
    display: flex; align-items: center; gap: 14px;
    margin-top: 2rem;
  }
  .cta-ic {
    width: 46px; height: 46px; border-radius: 50%;
    background: rgba(255,255,255,0.18);
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; color: #fff; flex-shrink: 0;
  }
  .cta-btn {
    background: rgba(255,255,255,0.15); border: none; border-radius: 100px;
    padding: 7px 16px; color: #fff; font-size: 12px; font-weight: 500;
    cursor: pointer; white-space: nowrap; display: flex; align-items: center; gap: 6px;
  }
  .divider-line {
    width: 1px; background: var(--color-border-tertiary);
    align-self: stretch; margin: 0 8px;
    display: none;
  }
  @media(min-width: 768px) { .divider-line { display: block; } }
</style>
@endsection

@section('content')


  <main class="main">

       <section class="section-box">
        <div class="banner-hero banner-breadcrums">
            <div class="container text-center">
                
                <!-- Page Title -->
                <h1 class="text-heading-2 color-gray-1000 mb-10">{{ $page_title}}</h1>

                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb justify-content-center bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $page_title }}
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </section>


     <section class="section-box">
        <div class="container mt-120">
          <div class="row">
            <div class="col-lg-6 col-sm-12 block-img-we-do"><img class="bdrd-16 img-responsive" src="{{ asset('wassets/assets/imgs/page/about/3/img-2.png')}}" alt="Agon"></div>
            <div class="col-lg-6 col-sm-12 block-we-do">
              <span class="tag-1 text-black">What You Get</span>
              <h3 class="text-heading-1 mt-30">Connect Directly With Verified Property Professionals</h3>
              <p class="text-body-lead-large color-gray-600 mt-30">At LocalAgent, we make property discovery simple by helping you connect directly with verified real estate agents.</p>
              <div class="line-bd-green mt-50"></div>
              <div class="row">
                <div class="col-lg-6 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf">No middlemen.</h4>
                  
                </div>
                <div class="col-lg-6 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf">No unnecessary layers.</h4>
                  
                </div>
                <div class="col-lg-6 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf">No confusing referral chains.</h4>
                  
                </div>
                <div class="col-lg-6 col-sm-6 col-12 mt-50">
                  <h4 class="text-heading-6 icon-leaf">Just direct access to real local property experts.</h4>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


     <section class="section-box directcontact mt-150">
  <div class="container">
    <div class="row">

      <!-- TOP TITLE -->
      <div class="col-12 text-center mb-40">
        <h2 class="fw-bold">Why Direct Contact Matters</h2>
      </div>

      <div class="d-flex justify-content-center">

      <!-- COLUMN 1 -->
      <div class="col-lg-3 ">
        <h5 class="mb-25">This may include:</h5>

        <div class="dbox p-25  rounded-3 mb-20">
          <i class="bi bi-diagram-3-fill text-theme-green me-2"></i>
          Lead Aggregators
        </div>

        <div class="dbox p-25  rounded-3 mb-20">
          <i class="bi bi-people-fill text-theme-green me-2"></i>
          Sub-Brokers
        </div>

        <div class="dbox p-25  rounded-3 mb-20">
          <i class="bi bi-share-fill text-theme-green me-2"></i>
          Referral Partners
        </div>

        <div class="dbox p-25  rounded-3 mb-20">
          <i class="bi bi-telephone-fill text-theme-green me-2"></i>
          Call Centers
        </div>

        <div class="dbox p-25  rounded-3">
          <i class="bi bi-person-x-fill text-theme-green me-2"></i>
          Unverified Middlemen
        </div>
      </div>

      <div class="col-lg-6">
        <div class="mt-100 ms-5 me-5">
        <img class="bdrd-16 img-responsive" src="{{ asset('wassets/assets/imgs/page/homepage1/img-news-1.png')}}" alt="Agon">
        </div>
      </div>

      <!-- COLUMN 2 -->
      <div class="col-lg-3 ">
        <h5 class="mb-25 text-danger">This often creates:</h5>

        <div class="dbox p-25  rounded-3 mb-20">
          <i class="bi bi-clock-fill text-theme-red me-2"></i>
          Delayed Responses
        </div>

        <div class="dbox p-25  rounded-3 mb-20">
          <i class="bi bi-exclamation-circle-fill text-theme-red me-2"></i>
          Wrong Information
        </div>

        <div class="dbox p-25  rounded-3 mb-20">
          <i class="bi bi-telephone-x-fill text-theme-red me-2"></i>
          Multiple Spam Calls
        </div>

        <div class="dbox p-25  rounded-3 mb-20">
          <i class="bi bi-question-circle-fill text-theme-red me-2"></i>
          Buyer Confusion
        </div>

        <div class="dbox p-25  rounded-3">
          <i class="bi bi-eye-slash-fill text-theme-red me-2"></i>
          Poor Transparency
        </div>
      </div>

      </div>

    </div>
  </div>
</section>


     
      {{-- <section class="section-box mt-100 pt-30">
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
      </section> --}}


        <section class="section-box mt-150">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-sm-12 col-12">
              {{-- <div class="text-start mb-25"><span class="tag-1 bg-6 color-green-900">What We Do</span></div> --}}
              <h2 class="text-heading-2 color-gray-900 mb-50">Benefits of Direct Agent Contact</h2>
            </div>
          </div>
        </div>
        <div class="container mt-20">
          <div class="row">
        
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="list-icons">
              <div class="item-icon none-bd">
                <span class="icon-left">
                    <i class="fa-solid fa-comments fa-2x text-info"></i>  
                </span>
                <h4 class="text-heading-6">Faster Communication</h4>
                <p class="text-body-text color-gray-600 mt-15">
                  Speak directly with the actual area expert.
                </p>
              </div>
            </div>
          </div>

           <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="list-icons">
              <div class="item-icon none-bd">
                <span class="icon-left">
                    <i class="fa-solid fa-bullseye fa-2x text-primary"></i>
                </span>
                <h4 class="text-heading-6">Better Information Accuracy</h4>
                <p class="text-body-text color-gray-600 mt-15">
                  Get details directly from the professional handling the property.
                </p>
              </div>
            </div>
          </div>
            
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="list-icons">
              <div class="item-icon none-bd">
                <span class="icon-left">
                    <i class="fa-solid fa-handshake fa-2x text-success"></i>
                </span>
                <h4 class="text-heading-6">Clear Negotiation</h4>
                <p class="text-body-text color-gray-600 mt-15">
                  Discuss pricing and terms directly without middle layers.
                </p>
              </div>
            </div>
          </div>
            
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="list-icons">
              <div class="item-icon none-bd">
                <span class="icon-left">
                    <i class="fa-solid fa-comments fa-2x text-warning"></i>
                </span>
                <h4 class="text-heading-6">Less Miscommunication</h4>
                <p class="text-body-text color-gray-600 mt-15">
                  Avoid messages being passed through multiple people.
                </p>
              </div>
            </div>
          </div>
      
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="list-icons">
              <div class="item-icon none-bd">
                <span class="icon-left">
                    <i class="fa-solid fa-shield-halved fa-2x text-danger"></i>
                </span>
                <h4 class="text-heading-6">More Trust</h4>
                <p class="text-body-text color-gray-600 mt-15">
                  Know exactly who you are dealing with for better confidence.
                </p>
              </div>
            </div>
          </div>
            


          </div>
        </div>
      </section>


      {{-- <section class="section-box mt-100 pt-50">
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
      </section> --}}
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
     
    
  <section class="section-box mt-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-2"></div>
      <div class="col-lg-8 text-center">
        <h2 class="text-heading-1 color-gray-900">Frequently asked questions</h2>
      </div>
      <div class="col-lg-2"></div>
    </div>
  </div>

  <div class="container">
    <div class="row mt-50">

      <!-- LEFT COLUMN -->
      <div class="col-lg-6">
        <div class="accordion" id="accordionLeft">

          <!-- 1 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#l1">
                What does direct real estate agent contact mean?
              </button>
            </h2>
            <div id="l1" class="accordion-collapse collapse show" data-bs-parent="#accordionLeft">
              <div class="accordion-body">
                It means you connect directly with the listed real estate professional without unnecessary intermediaries.
              </div>
            </div>
          </div>

          <!-- 2 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#l2">
                Does LocalAgent involve middlemen?
              </button>
            </h2>
            <div id="l2" class="accordion-collapse collapse" data-bs-parent="#accordionLeft">
              <div class="accordion-body">
                No. LocalAgent is built to connect users directly with verified agents.
              </div>
            </div>
          </div>

          <!-- 3 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#l3">
                Why is direct contact better in real estate?
              </button>
            </h2>
            <div id="l3" class="accordion-collapse collapse" data-bs-parent="#accordionLeft">
              <div class="accordion-body">
                Direct contact improves speed, clarity, and transparency.
              </div>
            </div>
          </div>

          <!-- 4 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#l4">
                Can I negotiate directly with agents?
              </button>
            </h2>
            <div id="l4" class="accordion-collapse collapse" data-bs-parent="#accordionLeft">
              <div class="accordion-body">
                Yes. You communicate directly with the listed professional.
              </div>
            </div>
          </div>

          <!-- 5 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#l5">
                Are agent contact details verified?
              </button>
            </h2>
            <div id="l5" class="accordion-collapse collapse" data-bs-parent="#accordionLeft">
              <div class="accordion-body">
                Yes. All listed agents are verified before listing.
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- RIGHT COLUMN -->
      <div class="col-lg-6">
        <div class="accordion" id="accordionRight">

          <!-- 6 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#r1">
                Why do some platforms involve middlemen?
              </button>
            </h2>
            <div id="r1" class="accordion-collapse collapse" data-bs-parent="#accordionRight">
              <div class="accordion-body">
                Many platforms use lead routing or referral systems.
              </div>
            </div>
          </div>

          <!-- 7 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#r2">
                Does direct contact reduce spam calls?
              </button>
            </h2>
            <div id="r2" class="accordion-collapse collapse" data-bs-parent="#accordionRight">
              <div class="accordion-body">
                Yes. It reduces unnecessary contact from intermediaries.
              </div>
            </div>
          </div>

          <!-- 8 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#r3">
                Is direct contact faster than traditional brokerage systems?
              </button>
            </h2>
            <div id="r3" class="accordion-collapse collapse" data-bs-parent="#accordionRight">
              <div class="accordion-body">
                Usually yes, because there are fewer communication layers.
              </div>
            </div>
          </div>

          <!-- 9 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#r4">
                Does LocalAgent charge for direct contact?
              </button>
            </h2>
            <div id="r4" class="accordion-collapse collapse" data-bs-parent="#accordionRight">
              <div class="accordion-body">
                Property seekers can browse and connect based on platform policy.
              </div>
            </div>
          </div>

          <!-- 10 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#r5">
                How can I contact agents directly on LocalAgent?
              </button>
            </h2>
            <div id="r5" class="accordion-collapse collapse" data-bs-parent="#accordionRight">
              <div class="accordion-body">
                Browse listings and connect via agent profiles.
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

@endsection