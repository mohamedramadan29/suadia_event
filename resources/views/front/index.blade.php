@extends('front.layouts.app')

@section('title', '  الرئيسية - تقويم فعاليات جامعة الملك عبد العزيز')

@section('content')
    <!-- Banner Section -->

    <section class="banner-section">

        <div class="banner-carousel owl-carousel owl-theme">

            <!-- Slide Item -->

            <div class="slide-item" style="background-image: url({{ asset('assets/front/images/banners/1.jpg') }});">
            </div>
            <!-- Slide Item -->
            @foreach ($event_types as $type)
                <div class="slide-item"
                    style="background-image: url({{ asset('assets/uploads/event_banners/' . $type->banner ?? '') }});">
                </div>
            @endforeach
        </div>

    </section>

    <!--End Banner Section -->

    <!--Clients Section-->

    <section class="clients-section">

        <div class="anim-icons">

            <span class="icon icon-dots-3 wow zoomIn"></span>

            <span class="icon icon-circle-blue wow zoomIn"></span>

        </div>

        <div class="auto-container">

            <div class="sec-title" style="flex-direction: column;justify-content: start;align-items: inherit;">

                <span class="title"> الفعاليات </span>

                <h2> انواع الفعاليات </h2>

            </div>



            <div class="sponsors-outer">

                <div class="row">

                    <!-- Client Block -->

                    @foreach ($event_types as $type)
                        <div class="client-block col-lg-2 col-md-6 col-6">
                            <figure class="image-box">
                                <a href="{{ url('events/' . $type->slug) }}">
                                    <img src="{{ asset('assets/uploads/event_icons/' . $type->image ?? '') }}"
                                        alt="">
                                    <h4> {{ $type->type_name }} </h4>
                                </a>
                            </figure>

                        </div>
                    @endforeach

                </div>

            </div>
        </div>

    </section>

    <!--End Clients Section-->
    @foreach ($event_types as $type)
        @php
            //use Carbon\Carbon;

            $events = App\Models\dashboard\Event::where('event_type_id', $type['id'])
                ->orderBy('event_start_month', 'asc')
                ->orderBy('event_start_day', 'asc')
                ->limit(3)
                ->get()
                ->map(function ($event) {
                    // تنظيف الوقت من المسافات الزائدة
                    $start_time = trim($event->event_start_time);
                    $end_time = trim($event->event_end_time);

                    // تحويل الوقت إلى صيغة 12 ساعة مع صباحًا/مساءً
                    try {
                        $event->formatted_start_time =
                            Carbon\Carbon::createFromFormat('h:iA', $start_time)
                                ->locale('ar')
                                ->translatedFormat('h:i') .
                            (strpos($start_time, 'AM') !== false ? ' صباحًا' : ' مساءً');
                    } catch (\Exception $e) {
                        $event->formatted_start_time = 'وقت غير صحيح';
                    }

                    try {
                        $event->formatted_end_time =
                            Carbon\Carbon::createFromFormat('h:iA', $end_time)->locale('ar')->translatedFormat('h:i') .
                            (strpos($end_time, 'AM') !== false ? ' صباحًا' : ' مساءً');
                    } catch (\Exception $e) {
                        $event->formatted_end_time = 'وقت غير صحيح';
                    }

                    return $event;
                });
        @endphp
        <!-- News Section -->
        <section class="news-section events">
            <div class="auto-container">
                <div class="sec-title">
                    <h2> {{ $type->type_name }} </h2>
                    <a href="{{ url('events/' . $type->slug) }}" class="btn btn-primary btn-sm"
                        style="background-color: {{ $type->color }}; border-color: {{ $type->color }}"> مشاهدة الكل <i
                            class="bi bi-arrow-left"></i> </a>
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
                                    {{-- <img src="{{ asset('assets/front/images/uploads/event.jpg') }}" alt="{{ $event->event_name }}"> --}}
                                    <div class="overlay"
                                        style="background:linear-gradient(to left, {{ $type->color }}, rgb(199 204 236 / 57%))">
                                    </div>
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
                                        <p> <strong> <i class="bi bi-geo-alt-fill"></i> </strong>
                                            {{ $event->event_location }}
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
    @endforeach

@endsection
