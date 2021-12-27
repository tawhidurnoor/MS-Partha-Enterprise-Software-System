@extends('layouts.mainlayout')

@section('title')
<title>Dashboard</title>
@endsection

@section('body')


<!-- Main Body -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <!-- task, page, download counter  start -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-yellow f-w-600">৳30200</h4>
                                            <h6 class="text-muted m-b-0">Today's Sell</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-bar-chart f-28"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-green f-w-600">150</h4>
                                            <h6 class="text-muted m-b-0">Registered Clients</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-file-text f-28"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-pink f-w-600">4</h4>
                                            <h6 class="text-muted m-b-0">Types of product</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-box f-28"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-blue f-w-600">৳150200</h4>
                                            <h6 class="text-muted m-b-0">Sell This Month</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-calendar f-28"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- task, page, download counter  end -->
                    </div>
                </div>
            </div>

            <div id="styleSelector">

            </div>
        </div>
    </div>
</div>


@endsection



@section('script')
@endsection