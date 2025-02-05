@extends('dashboard.layouts.public_app')
@section('title', ' طباعة الفاتورة ')
@section('content')
    <div class="app-content content" style="margin-right:0px">
        <div class="content-wrapper">
            <div class="content-body">
                <input type="hidden" value="{{ $invoice->name }}" id="customername">
                <section class="card">
                    <div id="invoice-template" class="card-body">
                        <!-- Invoice Company Details -->
                        <div id="invoice-company-details d-flex" class="row">
                            <div class="text-left col-md-6 col-sm-6">
                                <div class="media">
                                    <img width="200px" src="{{ asset('assets/admin/') }}/images/logo.png"
                                        alt="company logo" class="" />
                                </div>
                            </div>
                            <div class="text-right col-md-6 col-sm-6">
                                <h2> رقم الفاتورة </h2>
                                <p class="pb-3"> INV-{{ $invoice->id }}</p>
                                <ul class="px-0 list-unstyled">
                                    <li> المبلغ </li>
                                    <li class="lead text-bold-800"> {{ number_format($invoice->price, 2) }} ريال </li>
                                </ul>
                            </div>
                        </div>
                        <!--/ Invoice Company Details -->
                        <!-- Invoice Customer Details -->
                        <div id="invoice-customer-details" class="pt-2 row">
                            <div class="text-left col-md-6 col-sm-6">
                                <p class="text-muted"> الي السيد / ة </p>
                                <ul class="px-0 list-unstyled">
                                    <li class="text-bold-800"> {{ $invoice->name }}</li>
                                    <li> {{ $invoice->phone }} </li>
                                </ul>
                            </div>
                            <div class="text-right col-md-6 col-sm-6">
                                <p>
                                    <span class="text-muted"> تاريخ الفاتورة :</span> {{ $invoice->created_at }}
                                </p>
                                <p>
                                    <span class="text-muted"> تاريخ ووقت التسليم :</span> {{ $invoice->date_delivery }} -
                                    {{ $invoice->time_delivery }}
                                </p>
                            </div>
                        </div>
                        <!--/ Invoice Customer Details -->
                        <!-- Invoice Items Details -->
                        <div id="invoice-items-details" class="pt-2">
                            <div class="row">
                                <div class="table-responsive col-sm-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> الجهاز </th>
                                                <th class="text-right">العطل </th>
                                                <th class="text-right">ملاحظات </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>
                                                    <p>{{ $invoice->title }}</p>
                                                </td>
                                                <td class="text-right">
                                                    @foreach (json_decode($invoice->problems) as $problem)
                                                        <span class=""> {{ $problem }}
                                                        </span> -
                                                    @endforeach
                                                </td>
                                                <td class="text-right">{{ $invoice->description }}</td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-center col-md-7 col-sm-12 text-md-left">
                                    <p class="lead"> للاستفسارات :</p>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <table class="table table-borderless table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td> قسم الصيانة :</td>
                                                        <td class="text-right"> 0507170175 </td>
                                                    </tr>
                                                    <tr>
                                                        <td> الإدارة :</td>
                                                        <td class="text-right"> 0577894369 </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-12">
                                    <p class="lead"> المبلغ الكلي المستحق </p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td> السعر الاولي </td>
                                                    <td class="text-right"> {{ number_format($invoice->price, 2) }} ريال
                                                    </td>
                                                </tr>
                                                @php
                                                    $sub_total = 0;
                                                @endphp
                                                @if ($invoice->files->count() > 0)
                                                    @foreach ($invoice->files as $file)
                                                        @php
                                                            $sub_total += $file->price;
                                                        @endphp
                                                        <tr>
                                                            <td> {{ $file->title }} </td>
                                                            <td class="text-right"> {{ number_format($file->price, 2) }}
                                                                ريال
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif

                                                @php
                                                    $total_price = $invoice->price + $sub_total;
                                                @endphp
                                                <tr>
                                                    <td class="text-bold-800">المجموع الكلي </td>
                                                    <td class="text-right text-bold-800">
                                                        {{ number_format($total_price, 2) }} ريال </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection


<style>
    @media print {
        footer {
            display: none;
        }

        .header-navbar .navbar-wrapper,
        body.vertical-layout.vertical-menu.menu-expanded .main-menu,
        .content-wrapper .content-header {
            display: none;
            width: 0
        }

        body.vertical-layout.vertical-menu.menu-expanded .content {
            margin-right: 0 !important;
        }

        @page {
            margin: 0;
            padding: 0;
            background-color: #fff
        }

        html body .content .content-wrapper {
            background-color: #fff;
        }

        .print_button {
            display: none !important;
        }
    }
</style>

<script>
    function setPrintTitle() {
        // تعيين عنوان مخصص للصفحة ليتم طباعته
        document.title = document.getElementById('customername').value;

        // التأكد من أن العنوان الجديد قد تم تعيينه بشكل صحيح
        console.log("تم تعيين عنوان مخصص للطباعة: " + document.title);

        // إضافة استماع لحدث اكتمال الطباعة لاستعادة العنوان الأصلي بعد الطباعة
        window.onafterprint = function() {
            document.title = document.getElementById('customername').value;
            console.log("استعادة عنوان الصفحة الأصلي: " + document.title);
        };
    }
</script>
