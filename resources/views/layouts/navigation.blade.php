<header>
  <div class="top_bar">
    <div class="container">
      <div class="top_header_content">
        <div class="menu_logo">
          <a href="#" title="" class="menu">
            <i class="icon-menu"></i>
          </a>
          <a href="/" title="" class="logo">
            <img src="{{ themeUrl('v2/images/nd-ytscam-logo-mr.png') }}" alt="" style="width: 140px;">
          </a>
        </div><!--menu_logo end-->
        {{-- <div class="search_form">
          <form>
            <input type="text" name="search" placeholder="Search Videos">
            <button type="submit">
              <i class="icon-search"></i>
            </button>
          </form>
        </div><!--search_form end--> --}}
        <ul class="controls-lv">
          <li>
            <a href="#" title=""><i class="icon-message"></i></a>
          </li>
          <li>
            <a href="#" title=""><i class="icon-notification"></i></a>
          </li>
          <li class="user-log">
            <div class="user-ac-img">
              <img src="{{ themeUrl('v2/images/resources/user-img.png') }}" alt="">
            </div>
            <div class="account-menu">
              <h4>
                {{ Auth::user()->name }} <span class="usr-status">{{ session()->get('subscription_plan') }}</span></h4>
              <div class="sd_menu">
                <ul class="mm_menu">
                  <li>
                    <span>
                      <i class="icon-user"></i>
                    </span>
                    <a href="https://studio.youtube.com/channel/" target="_blank" title="">My Channel</a>
                  </li>
                  <li>
                    <span>
                      <i class="icon-paid_sub"></i>
                    </span>
                    <a href="{{route('dashboard')}}" title="">Paid subscriptions</a>
                  </li>
                  {{-- <li>
                    <span>
                      <i class="icon-settings"></i>
                    </span>
                    <a href="#" title="">Settings</a>
                  </li> --}}
                  <li>
                    <span>
                      <i class="icon-logout"></i>
                    </span>
                    <a href="{{route('log_out')}}" title="">Sign out</a>
                  </li>
                </ul>
              </div><!--sd_menu end-->
              {{-- <div class="sd_menu scnd">
                <ul class="mm_menu">
                  <li>
                    <span>
                      <i class="icon-light"></i>
                    </span>
                    <a href="#" title="">Dark Theme</a>
                    <label class="switch">
                      <input type="checkbox">
                        <b class="slider round"></b>
                    </label>
                  </li>
                  <li>
                    <span>
                      <i class="icon-language"></i>
                    </span>
                    <a href="#" title="">Language</a>
                  </li>
                  <li>
                    <span>
                      <i class="icon-feedback"></i>
                    </span>
                    <a href="#" title="">Send feedback</a>
                  </li>
                  <li>
                    <span>
                      <i class="icon-location"></i>
                    </span>
                    <a href="#" title="">India</a>
                    <i class="icon-arrow_below"></i>
                  </li>
                </ul>
              </div><!--sd_menu end-->
              <div class="restricted-mode">
                <h4>Restricted Mode</h4>
                <label class="switch">
                  <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
                <div class="clearfix"></div>
              </div><!--restricted-more end--> --}}
            </div>
          </li>
          <li>
            {{-- <a href="Upload_Video.html" title="" class="btn-default">Upload</a> --}}
            <a class="btn-default">{{ session()->get('subscription_plan') }} </a>
          </li>
        </ul><!--controls-lv end-->
        <div class="clearfix"></div>
      </div><!--top_header_content end-->
    </div>
  </div><!--header_content end-->
  <div class="btm_bar">
    <div class="container">
      <div class="btm_bar_content">
        <nav>
          <ul>
            <li>
              <x-nav-link :href="route('video')" class="{{ request()->routeIs('video') ? 'active' : '' }}">                       
                  Dashboard
              </x-nav-link>
            </li>
            <li>
              <x-nav-link :href="route('dashboard')" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                  {{ __('Subscription') }}
              </x-nav-link>
          </li> 
          <li>
            <x-nav-link :href="route('spamwords.list')" class="{{ request()->routeIs('spamwords.list') ? 'active' : '' }}">
              {{ __('Custom Words') }}
            </x-nav-link>
          </li>
          <li>
            <x-nav-link :href="route('no-spam-words.index')" class="{{ request()->routeIs('no-spam-words.index') ? 'active' : '' }}">
             {{ __('Not Spam Words') }}
            </x-nav-link>
          </li>
          {{-- 
            <li><a href="#" title="">Pages</a>
              <div class="mega-menu">
                <ul>
                  <li><a href="index.html" title="">Homepage</a></li>
                  <li><a href="single_video_page.html" title="">Single Video Page</a></li>
                  <li><a href="Single_Video_Simplified_Page.html" title="">Single Video Simplified Page</a></li>
                  <li><a href="single_video_fullwidth_page.html" title="">Singel Video Full Width Page</a></li>
                  <li><a href="single_video_playlist.html" title="">Single Video Playlist Page</a></li>
                  <li><a href="Upload_Video.html" title="">Upload Video Page</a></li>
                  <li><a href="Upload_Edit.html" title="">Upload Video Edit Page</a></li>
                  <li><a href="Browse_Channels.html" title="">Browse channels page</a></li>
                  <li><a href="Searched_Videos_Page.html" title="">Searched videos page</a></li>
                </ul>
                <ul>
                  <li><a href="#" title="">Single channel <span class="icon-arrow_below"></span></a>
                    <ul>
                      <li><a href="Single_Channel_Home.html" title="">Single Channel Home page</a></li>
                      <li><a href="Single_Channel_Videos.html" title="">Single Channel videos page</a></li>
                      <li><a href="Single_Channel_Playlist.html" title="">single channel playlist page</a></li>
                      <li><a href="Single_Channel_Channels.html" title="">single channel channels page</a></li>
                      <li><a href="Single_Channel_About.html" title="">single channel about page</a></li>
                      <li><a href="Single_Channel_Products.html" title="">single channel products page</a></li>	
                    </ul>
                  </li>
                  <li><a href="History_Page.html" title="">History page</a></li>
                  <li><a href="Browse_Categories.html" title="">Browse Categories Page</a></li>
                  <li><a href="Updates_From_Subs.html" title="">Updates from subscription page</a></li>
                  <li><a href="login.html" title="">login page</a></li>
                  <li><a href="signup.html" title="">signup page</a></li>
                  <li><a href="User_Account_Page.html" title="">User account page</a></li>
                </ul>
              </div>
              <div class="clearfix"></div>
            </li>
            <li><a href="Browse_Categories.html" title="">Categories</a></li>
            <li><a href="Browse_Channels.html" title="">Channels</a></li>
            <li><a href="#" title="">Trending</a></li>
            <li><a href="Single_Channel_Home.html" title="">LIVE</a></li>
            <li><a href="#" title="">Movies</a></li> --}}
            @if(session()->get('subscription_plan') == 'Gold') 
            <li>
              <x-nav-link :href="route('reports')" class="{{ request()->routeIs('reports') ? 'active' : '' }}">               
              {{ __('Report') }}
              </x-nav-link>
            </li>
            @endIf

            <li><x-nav-link :href="route('log_out')"> Sign out</x-nav-link> </li>           

          </ul>
        </nav><!--navigation end-->
        {{-- <ul class="shr_links">
          <li>
            <h3>Go to : </h3>
          </li>
          <li>
            <button data-toggle="tooltip" data-placement="top" title="Like">
              <i class="icon-like"></i>
            </button>
          </li>
          <li>
            <button data-toggle="tooltip" data-placement="top" title="Watch later">
              <i class="icon-watch_later"></i>
            </button>
          </li>
          <li>
            <button data-toggle="tooltip" data-placement="top" title="Playlist">
              <i class="icon-playlist"></i>
            </button>
          </li>
          <li>
            <button data-toggle="tooltip" data-placement="top" title="Purchased">
              <i class="icon-purchased"></i>
            </button>
          </li>
          <li>
            <button data-toggle="tooltip" data-placement="top" title="History">
              <i class="icon-history"></i>
            </button>
          </li>
        </ul><!--shr_links end--> --}}
        <ul class="vid_thums">
          <li>
            <a class="active" href="#" title=""><i class="icon-grid"></i></a>
          </li>
          {{-- <li>
            <a href="#" title="">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 108 108" xml:space="preserve">
                <rect width="63" height="45"/>
                <rect x="81" width="27" height="45"/>
                <rect x="45" y="63" width="63" height="45"/>
                <rect y="63" width="27" height="45"/>
              </svg>
            </a>
          </li> --}}
        </ul><!--vid_status end-->
        <div class="clearfix"></div>
      </div><!--btm_bar_content end-->
    </div>
  </div><!--btm_bar end-->

</header>

<div class="side_menu">
  {{-- <div class="form_dvv">
    <a href="#" title="" class="login_form_show">Sign in</a>
  </div> --}}
  {{-- <div class="sd_menu">
    <ul class="mm_menu">
      <li>
        <span>
          <i class="icon-home"></i>
        </span>
        <a href="#" title="">Home</a>
      </li>
      <li>
        <span>
          <i class="icon-fire"></i>
        </span>
        <a href="#" title="">Trending</a>
      </li>
      <li>
        <span>
          <i class="icon-subscriptions"></i>
        </span>
        <a href="#" title="">Subscriptions</a>
      </li>
    </ul>
  </div><!--sd_menu end--> --}}
  <div class="sd_menu">
    <h3>Dashboard</h3>
    <ul class="mm_menu">
      <li>
        <span>
          <i class="icon-history"></i>
        </span>
        <a href="{{route('video')}}" title="">Videos</a>
      </li>
      <li>
        <span>
          <i class="icon-watch_later"></i>
        </span>
        <a href="{{route('dashboard')}}" title="">Subscription</a>
      </li>
      <li>
        <span>
          <i class="icon-purchased"></i>
        </span>
        <a href="{{route('spamwords.list')}}" title="">Custom Words      </a>
      </li>
      <li>
        <span>
          <i class="icon-like"></i>
        </span>
        <a href="{{ route('no-spam-words.index') }}" title="">Not Spam Words        </a>
      </li>
      @if(session()->get('subscription_plan') == 'Gold') 
      <li>
        <span>
          <i class="icon-play_list"></i>
        </span>
        <a href="{{ route('reports') }}" title="">Report</a>
      </li>
      @endif
    </ul>
  </div><!--sd_menu end-->
  
  {{-- <div class="sd_menu">
    <ul class="mm_menu">
      <li>
        <span>
          <i class="icon-settings"></i>
        </span>
        <a href="#" title="">Settings</a>
      </li>
      <li>
        <span>
          <i class="icon-flag"></i>
        </span>
        <a href="#" title="">Report history</a>
      </li>
      <li>
        <span>
          <i class="icon-logout"></i>
        </span>
        <a href="#" title="">Sign out</a>
      </li>
    </ul>
  </div> <!--sd_menu end--> --}}
  <div class="sd_menu m_linkz">
    <ul class="mm_menu">
      <li><a href="{{ route('home') }}">Home</a></li>
      <li><a href="{{ route('home') }}/#about">About </a></li>      
      <li><a href="{{ route('home') }}/#features">Features</a></li>
      <li><a href="{{ route('home') }}/#contact">Contact</a></li>
      <li><a href="{{ route('privacy') }}">Privacy</a></li>
    </ul>
  </div><!--sd_menu end-->
  <div class="sd_menu bb-0">
    <ul class="social_links">
      <li>
        <a href="https://www.facebook.com/people/Ndytscam-Nospam/100069688635217/" target="_blank" title="">
          <i class="icon-facebook-official"></i>
        </a>
      </li>
      <li>
        <a href="https://www.instagram.com/ndytscam/" title="" target="_blank">
          <i class="icon-instagram"></i>
        </a>
      </li>
      <li>
        <a href="https://www.linkedin.com/in/nd-ytscam-application-983819215/" title=""  target="_blank">
          <i class="icon-twitter"></i>
        </a>
      </li>
    </ul><!--social_links end-->
  </div><!--sd_menu end-->
  <div class="dd_menu"></div>
</div><!--side_menu end-->

{{-- <!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
     <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>  -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown" style="display: none">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ themeAsset('dist/img/avatar5.png') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ themeAsset('dist/img/avatar5.png') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ themeAsset('dist/img/avatar5.png') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" title="Logout" href="{{ route('log_out') }}" role="button">
          <i class="nav-icon far fa fas fa-sign-out" aria-hidden="true"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ themeAsset('/') }}/assets/img/nd-ytscam-logo.png" alt="Logo" class="brand-image img-circle-elevation-3">
      <span class="brand-text font-weight-light"> <!-- A Product of CABC'S <br>Group India --> &nbsp; </span> 
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ themeAsset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> {{ Auth::user()->name }}         
        @if(session()->get('subscription_plan') == 'Silver')
           <span class="right badge badge-danger"> {{ session()->get('subscription_plan') }} </span>
        @elseif(session()->get('subscription_plan') == 'Gold')          
          <span class="right badge badge-warning"> {{ session()->get('subscription_plan') }}</span>
        @else
          <span class="right badge badge-primary">{{ session()->get('subscription_plan') }}</span>
        @endif </a>
        </div>

      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <x-nav-link :href="route('video')" :active="request()->routeIs('video')" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </x-nav-link>   
          </li>
       <li class="nav-item">
            <x-nav-link :href="route('dashboard')" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-suitcase"></i>
                <p>{{ __('Subscription') }}</p>
            </x-nav-link>
        </li> 
        <li class="nav-item">
          <x-nav-link :href="route('spamwords.list')" class="nav-link {{ request()->routeIs('spamwords.list') ? 'active' : '' }}">
            <i class="nav-icon fas fa-trash"></i>
           <p> {{ __('Custom Words') }} </p>
          </x-nav-link>
        </li>
        <li class="nav-item">
          <x-nav-link :href="route('no-spam-words.index')" class="nav-link {{ request()->routeIs('no-spam-words.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-thumbs-up"></i>
           <p> {{ __('Not Spam Words') }}</p>
          </x-nav-link>
        </li>
        <!--
        <li class="nav-item">
          <x-nav-link :href="route('sentiment-analysis')" class="nav-link {{ request()->routeIs('sentiment-analysis') ? 'active' : '' }}">
            <i class="nav-icon fa fa-comments"></i>
           <p> {{ __('Sentiment Analysis') }}</p>
          </x-nav-link>
        </li>
      -->
        @if(session()->get('subscription_plan') == 'Gold') 
        <li class="nav-item">
          <x-nav-link :href="route('reports')" class="nav-link {{ request()->routeIs('reports') ? 'active' : '' }}">
            <i class="nav-icon fa fa-file"></i>
           <p> {{ __('Report') }}</p>
          </x-nav-link>
        </li>
        @endIf

        <li class="nav-item">
            <x-nav-link :href="route('log_out')" class="nav-link">
              <i class="nav-icon far fa fa-sign-out" aria-hidden="true"></i>
              <p> Sign out </p>
            </x-nav-link>
        </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  --}}