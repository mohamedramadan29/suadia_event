@extends('dashboard.layouts.app')
@section('title')
    الرئيسية
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- eCommerce statistic -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="text-left media-body">
                                            <h3 class="info"> @php echo App\Models\dashboard\Collage::count();  @endphp </h3>
                                            <h6> الكليات  </h6>
                                        </div>
                                        <div>
                                            <i class="float-right icon-basket-loaded info font-large-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @can('admins')
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="text-left media-body">
                                                <h3 class="warning"> @php echo App\Models\dashboard\Eventtype::count();  @endphp  </h3>
                                                <h6> انواع الفعاليات  </h6>
                                            </div>
                                            <div>
                                                <i class="float-right icon-pie-chart warning font-large-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="text-left media-body">
                                                <h3 class="success"> @php echo App\Models\dashboard\Event::count();  @endphp  </h3>
                                                <h6> الفعاليات </h6>
                                            </div>
                                            <div>
                                                <i class="float-right icon-user-follow success font-large-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan

                </div>

            </div>
        </div>
    </div>
@endsection
