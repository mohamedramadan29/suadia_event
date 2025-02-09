@extends('front.layouts.app')

@section('title')
{{ $event_type->type_name }}
@endsection
@section('content')
    <!-- Banner Section -->

    <section class="banner-section">

        <div class="banner-carousel owl-carousel owl-theme">

            <div class="slide-item"
                style="background-image: url({{ asset('assets/uploads/event_banners/' . $event_type->banner) }});">
            </div>

        </div>

    </section>

    <!--End Banner Section -->
    <!-- News Section -->
    <section class="news-section events">
        <div class="auto-container">
            <div class="sec-title">
                <h2> {{ $event_type->type_name }} </h2>
            </div>
            <div class="row">
                @foreach ($events as $event)
                    <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInRight event">
                        <div class="event-box">
                            <div class="event-card">
                                <!-- صورة الحدث مع التدرج -->
                                @if ($event->event_image != null)
                                <img src="{{ asset('assets/uploads/events/' . $event->event_image) }}"
                                    alt="{{ $event->event_name }}">
                            @else
                                <img src="{{ asset('assets/front/images/uploads/event.jpg') }}"
                                    alt="{{ $event->event_name }}">
                            @endif
                                <div class="overlay" style="background:linear-gradient(to left, {{ $event_type->color }}, rgb(199 204 236 / 57%))"></div>
                                <div class="event-info">
                                    <h3> {{ $event->event_name }} </h3>
                                    <p> {{ $event->event_start_day }} </p>
                                </div>
                            </div>
                            <!-- التفاصيل الإضافية -->
                            <div class="event-details ">
                                <h4> {{ $event->event_name }} </h4>
                                <div style="display: flex">
                                    <p dir="rtl"><strong> <i class="bi bi-calendar-event"></i> من :</strong>
                                    <p style="display: flex"> <span> {{ $event->event_start_day }} </span> | <span>
                                            {{ $event->formatted_start_time }} </span> </p>
                                    </p>
                                </div>

                                <div style="display: flex">
                                    <p><strong> <i class="bi bi-calendar-event"></i> إلى : </strong>
                                    <p style="display: flex"> <span> {{ $event->event_end_day }} </span> | <span>
                                            {{ $event->formatted_end_time }}</span> </p>
                                </div>

                                <div class="d-flex justify-content-start ">

                                    <p style="margin-left: 10px"><strong> <i class="bi bi-building-fill"></i> </strong>
                                        {{ $event->colage->name }}
                                    </p>
                                    <p> <strong> <i class="bi bi-geo-alt-fill"></i> </strong> {{ $event->event_location }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </section>
    <!--End News Section -->
@endsection
