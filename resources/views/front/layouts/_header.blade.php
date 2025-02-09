        <!-- Preloader -->

        {{-- <div class="preloader"></div> --}}

        <!-- Header span -->

        <!-- Main Header-->

        <header class="main-header fixed-header">

            <div class="main-box">

                <div class="clearfix auto-container">

                    <div class="logo-box">

                        <div class="logo"><a href="{{ url('/') }}"><img
                                    src="{{ asset('assets/front/') }}/images/logo.png" alt="" title=""></a>
                        </div>

                    </div>



                    <!--Nav Box-->

                    <div class="clearfix nav-outer">

                        <!--Mobile Navigation Toggler-->

                        <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>

                        <!-- Main Menu -->

                        <nav class="main-menu navbar-expand-md navbar-light">

                            <div class="navbar-header">

                                <!-- Togg le Button -->

                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">

                                    <span class="icon flaticon-menu-button"></span>

                                </button>

                            </div>

                            @php
                                $types = App\Models\dashboard\Eventtype::all();
                                $visibleTypes = $types->take(4); // أول 4 أحداث
                                $dropdownTypes = $types->skip(4); // باقي الأحداث
                            @endphp

                            <div class="clearfix collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="clearfix navigation">
                                    <li class="current"><a href="{{ url('/') }}"> الرئيسية </a></li>

                                    {{-- عرض أول 4 أنواع فقط --}}
                                    @foreach ($visibleTypes as $type)
                                        <li><a href="{{ url('events/' . $type->slug) }}"> {{ $type->type_name }} </a>
                                        </li>
                                    @endforeach

                                    {{-- إضافة قائمة منسدلة إذا كان هناك أحداث إضافية --}}
                                    @if ($dropdownTypes->count() > 0)
                                        <li class="dropdown">
                                            <a href="#">المزيد <i class="bi bi-arrow-down d-none d-sm-inline"></i>  </a>
                                            <ul>
                                                @foreach ($dropdownTypes as $type)
                                                    <li><a
                                                            href="{{ url('events/' . $type->slug) }}">{{ $type->type_name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif

                                    {{-- <li class="dropdown">
                                        <a href="schedule.html">Schedule</a>
                                        <ul>
                                            <li><a href="schedule.html">Schedule</a></li>
                                            <li><a href="event-detail.html">Event Detail</a></li>
                                            <li><a href="buy-ticket.html">Buy Ticket</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="{{ url('contact') }}"> تواصل معنا </a></li> --}}
                                </ul>
                            </div>


                        </nav>

                        <!-- Main Menu End-->



                        <!-- Outer box -->

                        <div class="outer-box">

                            <!--Search Box-->

                            {{-- <div class="search-box-outer">

                                <div class="search-box-btn"><span class="flaticon-search"></span></div>

                            </div>
 --}}


                            <!-- Button Box -->

                            {{-- <div class="btn-box">

                                <a href="buy-ticket.html" class="theme-btn btn-style-one"><span class="btn-title">Get
                                        Tickets</span></a>

                            </div> --}}

                        </div>

                    </div>

                </div>

            </div>



            <!-- Mobile Menu  -->

            <div class="mobile-menu">

                <div class="menu-backdrop"></div>

                <div class="close-btn"><span class="icon flaticon-cancel-1"></span></div>



                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->

                <nav class="menu-box">

                    <div class="nav-logo"><a href="{{ url('/') }}"><img src="images/logo-2.png" alt=""
                                title=""></a></div>



                    <ul class="clearfix navigation"><!--Keep This Empty / Menu will come through Javascript--></ul>

                </nav>

            </div><!-- End Mobile Menu -->



        </header>

        <!--End Main Header -->
