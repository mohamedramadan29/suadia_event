@extends('dashboard.layouts.app')

@section('title', 'ا ضافة فاتورة جديدة ')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/') }}/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/') }}/vendors/css/forms/icheck/custom.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/') }}/css-rtl/plugins/forms/checkboxes-radios.css">
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                    <h3 class="mb-0 content-header-title d-inline-block"> اضافة فاتورة جديدة </h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.invoices.index') }}"> الوافتير </a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#"> اضافة فاتورة جديدة </a>
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
                                    <h4 class="card-title" id="basic-layout-form"> اضافة فاتورة جديدة </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" method="POST"
                                            action="{{ route('dashboard.invoices.create') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name"> اسم العميل </label>
                                                            <input required type="text" id="name"
                                                                class="form-control" placeholder="" name="name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone"> رقم الهاتف </label>
                                                            <input required type="text" id="phone"
                                                                class="form-control" placeholder="" name="phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="title"> اسم الجهاز </label>
                                                            <input required type="text" id="title"
                                                                class="form-control" placeholder="" name="title">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="title"> حدد الاعطال </label>
                                                            <div class="skin skin-square">
                                                                <div
                                                                    class="col-md-12 col-sm-12 d-flex justify-content-around">
                                                                    @foreach ($problems as $problem)
                                                                        <fieldset>
                                                                            <input type="checkbox"
                                                                                id="input-{{ $problem->id }}"
                                                                                name="problems[]"
                                                                                value="{{ $problem->name }}">
                                                                            <label for="input-{{ $problem->id }}">
                                                                                {{ $problem->name }} </label>
                                                                        </fieldset>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="title"> ملاحظات </label>
                                                            <textarea name="description" id="" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="price"> السعر الاولي </label>
                                                            <input required type="number" step="0.01" id="price"
                                                                class="form-control" placeholder="" name="price">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="price"> تاريخ ووقت التسليم </label>
                                                        <div class="justify-between d-flex">
                                                            <div class="form-group">
                                                                <div class="position-relative has-icon-left">
                                                                    <input type="date" name="date_delivery"
                                                                        id="timesheetinput3" class="form-control">
                                                                    <div class="form-control-position">
                                                                        <i class="ft-message-square"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="position-relative has-icon-left">
                                                                    <input type="time" name="time_delivery"
                                                                        id="timesheetinput6" class="form-control">
                                                                    <div class="form-control-position">
                                                                        <i class="ft-clock"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="price"> الحالة </label>
                                                            <select name="status" id="" class="form-control">
                                                                <option selected value="رف الاستلام"> رف الاستلام</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="address"> اضافة مرفقات </label>
                                                            <input type="file" name="files[]" class="form-control"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- عنصر التوقيع -->
                                                <!-- باقي الحقول الأخرى -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>توقيع العميل</label>
                                                        <div id="signature-pad" class="signature-pad">
                                                            <canvas width="400" height="200"></canvas>
                                                        </div>
                                                        <button type="button" id="clear-signature"
                                                            class="mt-2 btn btn-danger">مسح التوقيع</button>
                                                        <input type="hidden" name="signature" id="signature-input">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-check">
                                                            <input required class="form-check-input" type="checkbox"
                                                                value="" id="flexCheckDefault">
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                الموافقة علي الشروط والاحكام
                                                            </label>
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
                                        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
                                        <script>
                                            var canvas = document.querySelector("canvas");
                                            var signaturePad = new SignaturePad(canvas);

                                            // مسح التوقيع عند الضغط على الزر
                                            document.getElementById("clear-signature").addEventListener("click", function() {
                                                signaturePad.clear();
                                            });
                                            // تخزين التوقيع في الحقل المخفي
                                            document.getElementById("signature-input").value = signaturePad.toDataURL("image/png");
                                        </script>
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
@section('js')
    <script src="{{ asset('assets/admin/') }}/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/') }}/js/scripts/forms/checkbox-radio.js" type="text/javascript"></script>



@endsection
