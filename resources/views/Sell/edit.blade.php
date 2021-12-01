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

                    @if (Session::has('message'))
                    <div class="alert {{Session::get('alert-type')}} icons-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled"></i>
                        </button>
                        <p>
                            {{ Session::get('message') }}
                        </p>
                    </div>
                    @endif

                    <div class="row">

                        <div class="col-xl-6 col-md-6">
                            <div class="card user-card-full" style="height: 150px;">
                                <div class="row m-l-0 m-r-0">
                                    <div class="col-sm-4 bg-c-lite-green user-profile" style="height: 150px;">
                                        <div class="card-block text-center text-white">
                                            <h6 class="f-w-600">
                                                {{$client->client_name}}
                                            </h6>
                                            <button class="btn edit_button" style="color: white;">
                                                <i class="feather icon-edit m-t-10 f-16"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="card-block">
                                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information
                                            </h6>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p class="m-b-10 f-w-600">Company</p>
                                                    <h6 class="text-muted f-w-400">
                                                        {{$client->client_company}}
                                                    </h6>
                                                </div>
                                                <div class="col-sm-4">
                                                    <p class="m-b-10 f-w-600">Phone</p>
                                                    <h6 class="text-muted f-w-400">
                                                        {{$client->client_phone}}
                                                    </h6>
                                                </div>
                                                <div class="col-sm-4">
                                                    <p class="m-b-10 f-w-600">Address</p>
                                                    <h6 class="text-muted f-w-400">
                                                        {{$client->client_address}}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-md-6">
                            <div class="card bg-c-green update-card" style="height: 150px;">
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

                        <div class="col-xl-2 col-md-6">
                            <div class="card bg-c-yellow update-card" style="height: 150px;">
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

                        <div class="col-xl-2 col-md-6">
                            <div class="card bg-c-pink update-card" style="height: 150px;">
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



                    <div class="row">

                    </div>


                </div>

            </div>

            <div id="styleSelector">

            </div>
        </div>
    </div>
</div>



<!-- Edit Modal -->
<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Client Info</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('sell.update', $sell->id)}}" id="edit_form" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-body">
                    <div class="form-group">
                        <label>Client Name</label>
                        <select name="client_id" class="form-control" required>
                            <option value="">Select a Client </option>
                            @foreach($clients as $client)
                            <option value="{{$client->id}}" {{$sell->client_id == $client->id ? "selected" : "" }}>
                                {{$client->client_name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection



@section('script')

<script>
    $(function() {
        $(document).on('click', '.edit_button', function(e) {
            e.preventDefault();
            $('#edit_modal').modal('show');
            var id = $(this).data('id');
        });

    });
</script>

@endsection