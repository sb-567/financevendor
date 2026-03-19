
<!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
          <img src="{{ asset('wassets/img/Logo.svg') }}" alt="Logo" class="me-2" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasExample"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
          <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('aboutus')  }}">About</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('propertieslist') }}">Property</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('bloglist') }}">Blog</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('contactus') }}">Contact</a></li>
          </ul>
          <a href="{{ route('vendors.login') }}" class="btn btn-success btn-shadow ms-lg-3">Agent Sign-up</a>
          {{-- <img
            src="{{ asset('wassets/img/user_profile.png') }}"
            class="rounded-circle ms-5"
            width="55"
            height="55"
            alt="Profile"
          /> --}}
        </div>
      </div>
    </nav>






    <div
      class="offcanvas offcanvas-start"
      tabindex="-1"
      id="offcanvasExample"
      aria-labelledby="offcanvasExampleLabel"
    >
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <div>
          Some text as placeholder. In real life you can have the elements you
          have chosen. Like, text, images, lists, etc.
        </div>
        <div class="dropdown mt-3">
          <button
            class="btn btn-secondary dropdown-toggle"
            type="button"
            id="dropdownMenuButton"
            data-bs-toggle="dropdown"
          >
            Dropdown button
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </div>
      </div>
    </div>

 