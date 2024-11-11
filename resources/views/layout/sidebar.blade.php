 <div id="layoutSidenav_nav">
          <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
              <div class="sb-sidenav-menu">
                  <div class="nav">
                      <div class="sb-sidenav-menu-heading">Core</div>
                      <a class="nav-link @if(Request::is('home')) active @endif" href="{{url('/')}}">
                          <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                          Dashboard
                      </a>


                      {{-- only administration can access --}}
                      @if(Auth::user()->role_as=='administration')
                            <a class="nav-link @if(Request::is('register')) active @endif" href="{{url('/register')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-registered"></i></div>
                                Register User
                            </a>
                            <a class="nav-link @if(Request::is('all-user')) active @endif" href="{{url('/all-user')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                All User
                            </a>

                            <a class="nav-link collapsed @if(Request::is('patients') || Request::is('patient-form')) active @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Patients
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{url('/patients')}}">Find Patient</a>
                                    <a class="nav-link" href="{{url('/patient-form')}}">Patient Registration</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed @if(Request::is('doctors') || Request::is('doctor-form')) active @endif" href="#" data-bs-toggle="collapse" data-bs-target="#doctor" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Doctor
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="doctor" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{url('/doctors')}}">Find Doctor</a>
                                    <a class="nav-link" href="{{url('/doctor-form')}}">Doctor Registration</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed @if(Request::is('departments') || Request::is('department-form')) active @endif" href="#" data-bs-toggle="collapse" data-bs-target="#department" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Department Section
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="department" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{url('/departments')}}">Department List</a>
                                    <a class="nav-link" href="{{url('/department-form')}}">Add Department</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed @if(Request::is('tests') || Request::is('test-form')) active @endif" href="#" data-bs-toggle="collapse" data-bs-target="#test" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Test Section
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="test" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{url('/tests')}}">Available Test</a>
                                    <a class="nav-link" href="{{url('/test-form')}}">Add Test</a>
                                </nav>
                            </div>
                            <a class="nav-link @if(Request::is('export')) active @endif" href="{{url('/export')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Export Table
                            </a>
                      @endif
                     

                      {{-- only doctor can access --}}
                      @if(Auth::user()->role_as=='doctor')
                            <a class="nav-link @if(Request::is('consultations')) active @endif" href="{{url('consultations')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                My Consultation
                            </a>
                            <a class="nav-link 
                            @if(Request::is('consultations-on-lab')) active @endif" href="{{url('consultations-on-lab')}}"
                            >
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                 Patient on Laboratory
                            </a>
                            <a class="nav-link @if(Request::is('consultations-others')) active @endif" href="{{url('consultations-others')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Other's Consultation
                            </a>
                            <a class="nav-link @if(Request::is('consultation-history')) active @endif" href="{{url('consultation-history')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Consultation History
                            </a>
                            <a class="nav-link @if(Request::is('all-doctors')) active @endif" href="{{url('all-doctors')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                All Dotcor's Information
                            </a>
                      @endif


                      {{-- only lab tecknician can access --}}
                      @if(Auth::user()->role_as=='lab_tecknician')
                            <a class="nav-link @if(Request::is('lab')) active @endif" href="{{url('/lab')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Laboratory
                            </a>
                      @endif
                  </div>
              </div>
          </nav>
      </div>


