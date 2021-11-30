@extends('layouts.mainlayout')

@section('title')
<title>Edit Sell register</title>
@endsection

@section('body')


<!-- Main Body -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">

                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-c-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col">
                                            <h4 class="text-white">
                                                ৳{{$sell->total}}
                                            </h4>
                                            <h6 class="text-white m-b-0">Total Bill</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-c-yellow update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col">
                                            <h4 class="text-white">
                                                ৳{{$sell->received}}
                                            </h4>
                                            <h6 class="text-white m-b-0">Received Bill</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-c-pink update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col">
                                            <h4 class="text-white">
                                                ৳{{$sell->total - $sell->received}}
                                            </h4>
                                            <h6 class="text-white m-b-0">Due Bill</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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