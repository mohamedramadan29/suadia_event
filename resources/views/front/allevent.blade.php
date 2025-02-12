@extends('front.layouts.app2')

@section('title', ' الرئيسية - تقويم فعاليات جامعة الملك عبد العزيز')

@section('content')
    @php
        // use Carbon\Carbon;
        \Carbon\Carbon::setLocale('ar'); // تعيين اللغة إلى العربية
    @endphp

    @foreach ($groupedEvents as $month => $events)
        @php
            //use Carbon\Carbon;

            // $events = App\Models\dashboard\Event::where('event_type_id', $type['id'])
            //     ->orderBy('event_start_month', 'asc')
            //     ->orderBy('event_start_day', 'asc')
            //     ->limit(3)
            //     ->get()
            //     ->map(function ($event) {
            //         // تنظيف الوقت من المسافات الزائدة
            //         $start_time = trim($event->event_start_time);
            //         $end_time = trim($event->event_end_time);

            //         // تحويل الوقت إلى صيغة 12 ساعة مع صباحًا/مساءً
            //         try {
            //             $event->formatted_start_time =
            //                 Carbon\Carbon::createFromFormat('h:iA', $start_time)
            //                     ->locale('ar')
            //                     ->translatedFormat('h:i') .
            //                 (strpos($start_time, 'AM') !== false ? ' صباحًا' : ' مساءً');
            //         } catch (\Exception $e) {
            //             $event->formatted_start_time = 'وقت غير صحيح';
            //         }

            //         try {
            //             $event->formatted_end_time =
            //                 Carbon\Carbon::createFromFormat('h:iA', $end_time)->locale('ar')->translatedFormat('h:i') .
            //                 (strpos($end_time, 'AM') !== false ? ' صباحًا' : ' مساءً');
            //         } catch (\Exception $e) {
            //             $event->formatted_end_time = 'وقت غير صحيح';
            //         }

            //         return $event;
            //     });
        @endphp
        <!-- News Section -->
        <section class="news-section events">
            <div class="auto-container">
                <div class="sec-title">
                    <h2> فعاليات شهر : {{ \Carbon\Carbon::createFromFormat('m', $month)->translatedFormat('F') }} </h2>
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
                                        style="background:linear-gradient(to left, {{ $event->type->color }}, rgb(199 204 236 / 57%))">
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
