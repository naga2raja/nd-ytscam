<div class="header" style="background: #fff;">
  <center><a href="/" class="logo" style="float: none;font-size: 14px;font-weight: normal;font-style: italic;"><img src="/images/cabcs-group-india_logo.png" alt="CABCS"> <br> A Product of CABC'S Group India </a>
    </center>
  <!-- <div class="header-right1" style="padding-top: 35px;text-align: center;">
    <h1> ND-YTSCAM</h1>
  </div> -->
</div>

<!-- Responsive Navigation Menu -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <!-- <a class="navbar-brand" href="#">Navbar</a> -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse col-md-9" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">  
        <li class="nav-item {{ request()->routeIs('video') ? 'active' : '' }}">
            <x-nav-link :href="route('video')" :active="request()->routeIs('video')" class="nav-link">
                {{ __('Dashboard') }}
            </x-nav-link>
        </li>
        <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-link">
                {{ __('Subscription') }}
            </x-nav-link>
        </li>
        <li class="nav-item {{ request()->routeIs('spamwords.list') ? 'active' : '' }}">
          <x-nav-link :href="route('spamwords.list')" :active="request()->routeIs('spamwords.list')" class="nav-link">
            {{ __('Custom Words') }}
          </x-nav-link>
        </li>
      
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">          
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')" class="dropdown-item"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log out') }}
                </x-dropdown-link>
            </form>

        </div>
      </li> -->

      

    </ul>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
  </div>
  <div class="col-md-3">
      <div class="dropdown pull-right">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           {{ Auth::user()->name }}  
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <div class="dropdown-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')" class="dropdown-item"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log out') }}
                </x-dropdown-link>
            </form>
          </div> 
        </div>
      </div>
      <div class="pull-right" style="margin-right: 5px;">
        @if(session()->get('subscription_plan') == 'Silver')
          <a class="nav-link btn btn-sm btn-warning" style="background: #c0c0c0;border-color: #c0c0c0;">
            <i class="fa fa-money"></i> {{ session()->get('subscription_plan') }}
          </a>
        @elseif(session()->get('subscription_plan') == 'Gold')
          <a class="nav-link btn btn-sm btn-warning">
          <i class="fa fa-money"></i> {{ session()->get('subscription_plan') }}
        </a>
        @else
          <a class="nav-link btn btn-sm btn-primary">
          <i class="fa fa-money"></i> {{ session()->get('subscription_plan') }}
        </a>
        @endif
      </div>
  </div>
</nav>