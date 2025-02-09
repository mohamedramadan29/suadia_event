@extends('dashboard.layouts.app')

@section('title', '  تعديل نوع الفعالية  ')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                    <h3 class="mb-0 content-header-title d-inline-block"> تعديل نوع الفعالية  </h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.admins.index') }}">   انواع الفعاليات  </a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">  تعديل نوع الفعالية  </a>
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
                                    <h4 class="card-title" id="basic-layout-form">  اضافة نوع فعالية جديد  </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" method="POST" action="{{ route('dashboard.events_types.update', $type->id) }}"
                                            autocomplete="off" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name"> الاسم  </label>
                                                            <input required type="text" id="type_name"
                                                                class="form-control" placeholder="" name="type_name"
                                                                value="{{ $type->type_name ?? old('type_name') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="type"> اللون   </label>
                                                            <input required type="color" id="color"
                                                                class="form-control" placeholder="" name="color"
                                                                value="{{ $type->color ?? old('color') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="building">  صورة الايقون   </label>
                                                            <input type="file" id="image"
                                                                class="form-control" placeholder="" name="image">
                                                                <img width="80px" src="{{ asset('assets/uploads/event_icons/' . $type->image ?? '') }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="building">  صورة البانر    </label>
                                                            <input type="file" id="banner"
                                                                class="form-control" placeholder="" name="banner">
                                                                <img width="80px" src="{{ asset('assets/uploads/event_banners/' . $type->banner ?? '') }}" alt="">
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
