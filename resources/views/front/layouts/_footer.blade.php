<footer class="main-footer">

    <!--Widgets Section-->

    <div class="widgets-section">

        <div class="auto-container">

            <div class="row">

                <!--Big Column-->

                <div class="big-column col-xl-6 col-lg-12 col-md-12 col-sm-12">

                    <div class="row">

                        <!--Footer Column-->

                        <div class="footer-column col-xl-7 col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget about-widget">

                                <div class="text">
                                    <p>
                                        تعريف بسيط عن الجامعة تعريف بسيط عن الجامعة تعريف بسيط عن الجامعة تعريف بسيط عن
                                        الجامعة تعريف بسيط عن الجامعة تعريف بسيط عن الجامعة تعريف بسيط عن الجامعة تعريف
                                        بسيط عن الجامعة
                                    </p>

                                </div>

                                <ul class="social-icon-one social-icon-colored">

                                    <li><a href="https://www.kau.edu.sa/Home.aspx?lng=ar"><i
                                                class="fa fab fa-globe"></i></a></li>

                                    <li><a href="https://x.com/kauedu_sa"><i class="fab fa-twitter"></i></a></li>

                                    <li><a href="https://www.youtube.com/@kauedu_sa"><i class="fab fa-youtube"></i></a>
                                    </li>


                                    <li><a href="https://www.instagram.com/kauedu_sa"><i
                                                class="fab fa-instagram"></i></a></li>

                                    <li><a href="https://www.snapchat.com/add/kauedu_sa"><i
                                                class="fab fa-snapchat"></i></a></li>

                                </ul>

                            </div>

                        </div>



                        <!--Footer Column-->

                        <div class="footer-column col-xl-5 col-lg-6 col-md-6 col-sm-12">

                            <div class="footer-widget useful-links">

                                <h2 class="widget-title">روابط </h2>

                                <ul class="user-links">

                                    <li><a href="{{ url('/') }}"> الرئيسية </a></li>

                                    <li><a href="{{ url('/contact') }}"> تواصل معنا </a></li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>



                <!--Big Column-->

                <div class="big-column col-xl-6 col-lg-12 col-md-12 col-sm-12">

                    <div class="row">

                        <!--Footer Column-->

                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">

                            <!--Footer Column-->

                            <div class="footer-widget contact-widget">

                                <h2 class="widget-title"> الفعاليات </h2>

                                <!--Footer Column-->
                                @php
                                    $types = App\Models\dashboard\Eventtype::all();
                                    $visibleTypes = $types->take(6); // أول 4 أحداث
                                    $dropdownTypes = $types->skip(6); // باقي الأحداث
                                @endphp
                                <div class="widget-content">

                                    <ul class="user-links">

                                        @foreach ($visibleTypes as $type)
                                            <li><a href="{{ url('events/' . $type->slug) }}"> {{ $type->type_name }}
                                                </a>
                                            </li>
                                        @endforeach


                                    </ul>


                                </div>

                            </div>

                        </div>
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">

                            <!--Footer Column-->

                            <div class="footer-widget contact-widget">

                                <h2 class="widget-title"> الفعاليات </h2>

                                <!--Footer Column-->

                                <div class="widget-content">

                                    <ul class="user-links">
                                        @if ($dropdownTypes->count() > 0)
                                            <li class="dropdown">
                                                <ul>
                                                    @foreach ($dropdownTypes as $type)

                                                        <li>
                                                            <a
                                                                href="{{ url('events/' . $type->slug) }}">{{ $type->type_name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif

                                    </ul>


                                </div>

                            </div>

                        </div>




                    </div>

                </div>

            </div>

        </div>

    </div>



    <!--Footer Bottom-->

    <div class="footer-bottom">

        <div class="auto-container">

            <div class="clearfix inner-container">

                <div class="copyright-text">

                    <p> جميع الحقوق محفوظة لـ جامعة الملك عبدالعزيز </p>

                </div>

            </div>

        </div>

    </div>

</footer>
