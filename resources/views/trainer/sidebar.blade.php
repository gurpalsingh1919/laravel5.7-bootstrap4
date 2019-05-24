 <!--  BEGIN SIDEBAR  -->

        <div class="sidebar-wrapper sidebar-theme">
            
            <div id="dismiss" class="d-lg-none"><i class="flaticon-cancel-12"></i></div>
            
            <nav id="sidebar">

                <ul class="navbar-nav theme-brand flex-row  d-none d-lg-flex">
                    <li class="nav-item">
                        <a href="{{ route('trainerDashboard') }}" class="navbar-brand">
                            <img src="{{ asset('images/logo-1.png') }}" class="img-fluid" alt="logo">
                        </a>

                    </li>
                    <li class="nav-item theme-text d-none">
                        <a href="{{ route('trainerDashboard') }}" class="nav-link"> Neargym </a>
                    </li>
                </ul>


                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu">
                        <a href="{{ route('trainerDashboard') }}" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-computer-6 ml-3"></i>
                                <span>Dashboard</span>
                            </div>

                           <!--  <div>
                                <span class="badge badge-pill badge-secondary mr-2">7</span>
                            </div> -->
                        </a>
                        
                    </li>
                     <li class="menu">
                        <a href="#Packages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-package"></i>
                                <span>Packages</span>
                            </div>
                            <div>
                                <i class="flaticon-right-arrow"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="Packages" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('trainerpackagesList') }}"> Packages List </a>
                            </li>  
                             <li>
                                <a href="{{ route('trainerpackagesAdd') }}">Add New Package</a>
                            </li>                            
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#store" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-business"></i>
                                <span>Store</span>
                            </div>
                            <div>
                                <i class="flaticon-right-arrow"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="store" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('myStoreInfo') }}">My Store</a>
                            </li> 
                            <li>
                                <a href="{{ route('getAllProductList') }}"> Product List </a>
                            </li>  
                             <li>
                                <a href="{{ route('addNewProduct') }}">Add New Product</a>
                            </li>                            
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="{{ route('getTrainerCustomer') }}" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-user-group"></i>
                                <span>Customers</span>
                            </div>
                             
                        </a>
                        
                    </li>
                    <li class="menu">
                        <a href="{{ route('trainergetmyorder') }}" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-cart-2"></i>
                                <span>Orders</span>
                            </div>
                             
                        </a>
                        
                    </li>
                   <li class="menu">
                        <a href="{{ route('trainerWallet') }}" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-wallet"></i>
                                <span>My Wallet</span>
                            </div>
                             
                        </a>
                        
                    </li>

                     <li class="menu">
                        <a href="#nutrition" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-healthy"></i>
                                <span>Nutrition</span>
                            </div>
                            <div>
                                <i class="flaticon-right-arrow"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="nutrition" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('getAllNutrition') }}"> Nutrition Schedule List </a>
                            </li>  
                            <li>
                                <a href="{{ route('assignNutrition') }}"> Add Nutrition Schedule </a>
                            </li>                           
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#workout" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-notes-4"></i>
                                <span>Workout</span>
                            </div>
                            <div>
                                <i class="flaticon-right-arrow"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="workout" data-parent="#accordionExample">
                            <li>
                                <a href="{{route('getAllWorkouts')}}">Workout List</a>
                            </li>  
                            <li>
                                <a href="{{route('assignWorkout')}}"> Assign Workout </a>
                            </li>                          
                        </ul>
                    </li>
                   
                    <li class="menu">
                        <a href="{{ route('checkattendance') }}" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-calendar"></i>
                                <span>Attendance</span>
                            </div>
                             
                        </a>
                        
                    </li>
                     <li class="menu">
                        <a href="{{ route('generalsettings') }}" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-settings-1"></i>
                                <span>General Settings</span>
                            </div>
                             
                        </a>
                        
                    </li>
                    
                     <li class="menu">
                        <a href="{{ route('trainerchangepassword') }}" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-locked"></i>
                                <span>Change Password</span>
                            </div>
                             
                        </a>
                        
                    </li>
                    <li class="menu">
                        <a href="{{url('/logout')}}" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-power-button"></i>
                                <span>Logout</span>
                            </div>
                             
                        </a>
                        
                    </li>
                   
                </ul>
            </nav>

        </div>

        <!--  END SIDEBAR  -->