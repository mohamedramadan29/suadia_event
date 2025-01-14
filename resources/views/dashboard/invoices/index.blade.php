@extends('dashboard.layouts.app')
@section('title', ' الفواتير ')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                    <h3 class="mb-0 content-header-title d-inline-block"> ادارة الفواتير </h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active"> ادارة الفواتير
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
                                <a href="{{ route('dashboard.invoices.create') }}" class="btn btn-primary"> اضافة فاتورة
                                </a>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th> الاسم </th>
                                                    <th> رقم الهاتف </th>
                                                    <th> العنوان </th>
                                                    <th> المشاكل </th>
                                                    <th> الحالة </th>
                                                    <th> العمليات </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($invoices as $invoice)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td> {{ $invoice->name }} </td>
                                                        <td>
                                                            {{ $invoice->phone }}
                                                        </td>
                                                        <td>
                                                            {{ $invoice->title }}
                                                        </td>
                                                        <td>
                                                            @foreach (json_decode($invoice->problems) as $problem)
                                                                <span class="badge badge-danger"> {{ $problem }}
                                                                </span>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-info">
                                                                {{ $invoice->status }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-info btn-sm"
                                                                href="{{ route('dashboard.invoices.update', $invoice->id) }}"><i
                                                                    class="la la-edit"></i> تعديل </a>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#delete_invoice_{{ $invoice->id }}">
                                                                حذف <i class="la la-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <div class="form-group">
                                                    </div>
                                                    @include('dashboard.invoices.delete')
                                                @empty
                                                    <td colspan="4"> لا يوجد بيانات </td>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        {{ $invoices->links() }}
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
