@extends('dashboard.layouts.app')
@section('title', 'جميع الكليات ')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="mb-2 content-header-left col-md-6 col-12 breadcrumb-new">
                    <h3 class="mb-0 content-header-title d-inline-block">  جميع الكليات  </h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active">  ادارة الكليات
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
                                <a href="#" class="btn btn-primary"> اضافة كلية </a>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th> الاسم </th>
                                                    <th> النوع  </th>
                                                    <th>  المبني  </th>
                                                    <th> العمليات </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($collages as $colage)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td> {{ $colage->name }} </td>
                                                        <td>
                                                            {{ $colage->type }}
                                                        </td>
                                                        <td>
                                                            {{ $colage->building }}
                                                        </td>

                                                        <td>
                                                            {{-- <a class="btn btn-info btn-sm"
                                                                href="{{ route('dashboard.admins.update', $admin->id) }}"><i
                                                                    class="la la-edit"></i> تعديل </a>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#delete_admin_{{ $admin->id }}">
                                                                حذف <i class="la la-trash"></i>
                                                            </button> --}}
                                                        </td>
                                                    </tr>
                                                    <div class="form-group">



                                                    </div>
                                                    {{-- @include('dashboard.admins.delete') --}}
                                                @empty
                                                    <td colspan="4"> لا يوجد بيانات </td>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        {{ $collages->links() }}
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
