  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
      <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
          <h1 class="m-0">{{ env('APP_NAME') }}</h1>
      </a>
      <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse align-items-center" id="navbarCollapse">
          <div class="navbar-nav ms-auto p-4 p-lg-0">
              <a href="{{ route('index') }}" class="nav-item nav-link active">Home</a>
              <a href="{{ route('about') }}" class="nav-item nav-link">About</a>
              <a href="{{ route('service') }}" class="nav-item nav-link">Services</a>
              <a href="{{ route('shop') }}" class="nav-item nav-link">Shop</a>

              <div class="dropdown">
                  <button class="btn btn-link text-dark dropdown-toggle shadow-none nav-link" type="button"
                      id="educational" data-bs-toggle="dropdown" aria-expanded="false">
                      Learn
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="educational">
                      <li><a class="dropdown-item" href="{{ route('blog') }}">Blog & Vlog</a></li>
                      <li><a class="dropdown-item" href="{{ route('plant') }}">Plant Care</a></li>
                      <li><a class="dropdown-item" href="{{ route('webinar') }}">Webinar</a></li>
                      <li><a class="dropdown-item" href="{{ route('community') }}">Community</a></li>
                  </ul>
              </div>
              <div class="d-flex align-items-center me-3">
                  @auth
                      <div class="dropdown">
                          <button class="btn btn-link text-dark profile_btn" type="button"
                              id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                              Profile
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                              <li><a class="dropdown-item" href="{{ route('details') }}">Profile</a>
                              </li>
                              <li><a class="dropdown-item" href="{{ route('cart') }}">Cart</a></li>
                              <li><a class="dropdown-item" href="{{ route('Order') }}">Order</a></li>
                              <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                          </ul>
                      </div>
                      <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="Profile Image" class="rounded-circle"
                      style="object-fit: cover" width="40" height="40">
                  @else
                      <a class="border py-2 px-5 text-dark" href="{{ route('login') }}">Login</a>
                  @endauth
              </div>
          </div>
      </div>
      </div>
      </div>
  </nav>
  <!-- Navbar End -->
