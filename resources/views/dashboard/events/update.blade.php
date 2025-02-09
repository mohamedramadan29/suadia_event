@extends('dashboard.layouts.app')

@section('title', ' تعديل فعالية ')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                    <h3 class="mb-0 content-header-title d-inline-block">  تعديل الفعالية </h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.admins.index') }}">     الفعاليات  </a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">  تعديل فعالية </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل فعالية </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" method="POST" action="{{ route('dashboard.events.update', $event->id) }}"
                                            autocomplete="off" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name"> حدد الكلية   </label>
                                                            <select name="collage_id" id="" class="form-control select2">
                                                                <option value="" disabled selected> -- حدد الكلية  --</option>
                                                                @foreach ($collages as $collage )
                                                                    <option {{ $event->collage_id == $collage->id ? 'selected' : '' }} value="{{ $collage->id }}">  {{ $collage->name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name"> عنوان الحدث  </label>
                                                            <input required type="text" id="event_name"
                                                                class="form-control" placeholder="" name="event_name"
                                                                value="{{ old('event_name') ?? $event->event_name }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name"> موقع  الحدث  </label>
                                                            <input required type="text" id="event_location"
                                                                class="form-control" placeholder="" name="event_location""
                                                                value="{{ old('event_location') ?? $event->event_location }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">  شهر البدء   </label>
                                                            <input required type="number" min="1" max="12" id="event_start_month"
                                                                class="form-control" placeholder="" name="event_start_month""
                                                                value="{{ old('event_start_month') ?? $event->event_start_month }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">  تاريخ ويوم البدء  </label>
                                                            <input required type="date" id="event_start_day"
                                                                class="form-control" placeholder="" name="event_start_day""
                                                                value="{{ old('event_start_day') ?? $event->event_start_day }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name"> وقت البدء  </label>
                                                            <input required type="time" id="event_start_time"
                                                                class="form-control" placeholder="" name="event_start_time""
                                                                value="{{ old('event_start_time') ?? $event->event_start_time }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">  شهر الانتهاء   </label>
                                                            <input required type="number" min="1" max="12" id="event_end_month"
                                                                class="form-control" placeholder="" name="event_end_month""
                                                                value="{{ old('event_end_month') ?? $event->event_end_month }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">  تاريخ ويوم الانتهاء  </label>
                                                            <input required type="date" id="event_end_day"
                                                                class="form-control" placeholder="" name="event_end_day"
                                                                value="{{ old('event_end_day') ?? $event->event_end_day }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name"> وقت الانتهاء  </label>
                                                            <input required type="time" id="event_end_time"
                                                                class="form-control" placeholder="" name="event_end_time"
                                                                value="{{ old('event_end_time') ?? $event->event_end_time }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="type"> نوع الحدث   </label>
                                                            <select name="event_type_id" id="" class="form-control select2">
                                                                <option value="" disabled selected> -- حدد نوع الحدث  --</option>
                                                                @foreach ($types as $type )
                                                                    <option {{ $event->event_type_id == $type->id ? 'selected' : '' }} value="{{ $type->id }}">  {{ $type->type_name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="building">  حالة الحدث    </label>
                                                            <input required type="text" id="event_status"
                                                                class="form-control" placeholder="" name="event_status" value="{{ old('event_status') ?? $event->event_status }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="building">  صورة الحدث     </label>
                                                            <input type="file" id="event_image"
                                                                class="form-control" placeholder="" name="event_image"">
                                                                <img width="80px" src="{{ asset('assets/uploads/events/' . $event->event_image ?? '')  }}" alt="">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
                                                <button type="button" class="mr-1 btn btn-warning">
                                                    <i class="ft-x"></i> رجوع
                                                </button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
@endsection
