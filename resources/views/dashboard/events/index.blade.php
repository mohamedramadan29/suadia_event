@extends('dashboard.layouts.app')
@section('title', '  الفعاليات  ')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                    <h3 class="mb-0 content-header-title d-inline-block">     الفعاليات </h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active">    الفعاليات
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">

                </div>
            </div>
            <div class="content-body">

                <!-- Bordered striped start -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('dashboard.events.create') }}" class="btn btn-primary"> اضافة فعالية </a>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th> الكلية  </th>
                                                    <th> الاسم  </th>
                                                    <th> الموقع  </th>
                                                    <th> الشهر  </th>
                                                    <th> التاريخ  </th>
                                                    <th> التوقيت  </th>
                                                    <th> شهر الانتهاء </th>
                                                    <th>  تاريخ  الانتهاء </th>
                                                    <th> وقت الانتهاء </th>
                                                    <th> نوع الفعالية  </th>
                                                    <th> حالة الفعالية </th>
                                                    <th> العمليات </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($events as $event )
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td> {{ $event->colage->name }} </td>
                                                        <td> {{ $event->event_name }} </td>
                                                        <td> {{ $event->event_location }} </td>
                                                        <td> {{ $event->event_start_month }} </td>
                                                        <td> {{ $event->event_start_day }}  </td>
                                                        <td> {{ $event->event_start_time }} </td>
                                                        <td> {{ $event->event_end_month }} </td>
                                                        <td> {{ $event->event_end_day }} </td>
                                                        <td> {{ $event->event_end_time }}  </td>
                                                        <td> {{ $event->type->type_name }} </td>
                                                        <td> {{ $event->event_status }} </td>
                                                        <td>
                                                            <a class="btn btn-info btn-sm"
                                                                href="{{ route('dashboard.events.update', $event->id) }}"><i
                                                                    class="la la-edit"></i> تعديل </a>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#delete_event_{{ $event->id }}">
                                                                حذف <i class="la la-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @include('dashboard.events.delete')
                                                @empty
                                                    <td colspan="4"> لا يوجد بيانات </td>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        {{ $events->links() }}

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Bordered striped end -->
            </div>
        </div>
    </div>


@endsection
