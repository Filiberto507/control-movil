<div class="header-container fixed-top" >
    <header class="header navbar navbar-expand-sm" style="background: #3867d6">
        <ul class="navbar-item flex-row" >
            <li class="nav-item theme-logo">
                <a href="{{url('/home')}}">
                    <img src="assets/img/escudo.png" class="navbar-logo" alt="logo">
                </a>
            </li>
        </ul>
        
        <a href="javascript:void(0);" class="sidebarCollapse"  data-placement="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 50 50"
            style="fill:#FFFFFF;">
            <path d="M 0 7.5 L 0 12.5 L 50 12.5 L 50 7.5 Z M 0 22.5 L 0 27.5 L 50 27.5 L 50 22.5 Z M 0 37.5 L 0 42.5 L 50 42.5 L 50 37.5 Z"></path>
            </svg>
        </a>

       
        <ul class="navbar-item flex-row search-ul">
                <!-- <li class="nav-item align-self-center search-animated">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <form class="form-inline search-full form-inline search" role="search">
                        <div class="search-bar">
                            <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
                        </div>
                    </form>
                </li> -->
            </ul>
        <ul class="navbar-item flex-row navbar-dropdown">

            <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="assets/img/user1.png" alt="admin-profile" class="img-fluid">
                </a>
                <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            
                            <div class="media-body">
                                <!-- integracion de los nombres en el perfil  -->
                                @if(Auth::user()=='')
                                    
                                    <h5>Alan Green</h5>
                                    <p>Project Leader</p>
                                 @else 
                                  <h5> {{Auth::user()->name}} </h5>
                                  <p>{{Auth::user()->profile}}</p>
                                
                                @endif
                                
                                
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        @if(Auth::user()=='')
                            
                        @else
                           
                        @endif
                    </div>
                 
                    <div class="dropdown-item">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span>Salir</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" id="logout-form" >
                            @csrf
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>

