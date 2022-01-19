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


                    <div id="printableArea">


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


                        <div class="card">
                            <div class="card-header">


                                <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#add_modal">Add</button>
                                <br><br>

                                <!-- @if (Session::has('message'))
                            <div class="alert {{Session::get('alert-type')}} icons-alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled"></i>
                                </button>
                                <p>
                                    {{ Session::get('message') }}
                                </p>
                            </div>
                            @endif -->


                            </div>


                            <div class="card-block">
                                <div class="dt-responsive table-responsive">

                                    <table id="datatable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Product</th>
                                                <th>Unit Price</th>
                                                <th>Total Unit</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($selldetails as $selldetail)
                                            <tr>
                                                <td>
                                                    {{ $selldetail->date }}
                                                </td>
                                                <td>
                                                    {{ $selldetail->product_name }}
                                                </td>
                                                <td>
                                                    {{ $selldetail->unit_price }}
                                                </td>
                                                <td>
                                                    {{ $selldetail->total_unit }}
                                                </td>
                                                <td>
                                                    {{ $selldetail->total_unit*$selldetail->unit_price }}
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary waves-effect edit_button_details" data-id="{{$selldetail->id}}">Edit</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Date</th>
                                                <th>Product</th>
                                                <th>Unit Price</th>
                                                <th>Total Unit</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                        </div>

                        <center>
                            <input type="button" onclick="printDiv('printableArea')" class="btn btn-info" value="Print Invoice" />
                        </center>


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
            <form action="{{route('sell.update', $sell->id)}}" method="post">
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



<!-- Add Modal -->
<div class="modal fade" id="add_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Register a Sell</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('selldetails.store') }}" method="post">
                @csrf
                <div class="modal-body">

                    @foreach($products as $product)

                    <div class="row">

                        <input type="hidden" name="sell_id[]" value="{{$sell->id}}">

                        <div class="col">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="date[]" value="@php echo(date('Y-m-d')) @endphp" class="form-control" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label>Product</label>
                                <input type="hidden" name="product_id[]" value="{{$product->id}}" class="form-control" required>
                                <input type="text" class="form-control" value="{{$product->product_name}}" readonly>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label>Unit Price</label>
                                <input type="number" name="unit_price[]" class="form-control" step="any" value="0" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label>Total Unit</label>
                                <input type="number" name="total_unit[]" class="form-control" value="0" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label>Add This</label>
                                <div class="border-checkbox-section">
                                    <div class="border-checkbox-group border-checkbox-group-success">
                                        <input name="is_chceked[]" class="border-checkbox" type="checkbox" value="yes" id="checkbox{{$product->id}}" onclick='document.getElementById("checkbox+{{$product->id}}").checked = false;' checked>
                                        <label class="border-checkbox-label" for="checkbox{{$product->id}}">Yes</label>
                                    </div>
                                    <div class="border-checkbox-group border-checkbox-group-danger">
                                        <input name="is_chceked[]" class="border-checkbox" type="checkbox" value="no" id="checkbox+{{$product->id}}" onclick='document.getElementById("checkbox{{$product->id}}").checked = false;'>
                                        <label class="border-checkbox-label" for="checkbox+{{$product->id}}">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    @endforeach

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Edit Modal -->
<div class="modal fade" id="edit_modal_details" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Sell</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="edit_form" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    <div class="row">

                        <div class="col">
                            <div class="form-group">
                                <label>Unit Price</label>
                                <input type="number" name="unit_price" id="unit_price" class="form-control" step="any" value="0" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label>Total Unit</label>
                                <input type="number" name="total_unit" id="total_unit" class="form-control" value="0" required>
                            </div>
                        </div>

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

    $(function() {
        $(document).on('click', '.edit_button_details', function(e) {
            e.preventDefault();
            $('#edit_modal_details').modal('show');
            var id = $(this).data('id');
            getEditDetails(id);
        });

    });

    function getEditDetails(id) {
        $.ajax({
            type: 'GET',
            url: '../../selldetails/' + id,
            dataType: 'json',
            success: function(response) {
                $('#unit_price').val(response.unit_price);
                $('#total_unit').val(response.total_unit);
            }
        });

        document.getElementById("edit_form").action = "../../selldetails/" + id;
    }
</script>

<script>
    $('#datatable').DataTable({
        "paging": true,
        "ordering": false,
        "bLengthChange": true,
        "info": true,
        "searching": true
    });
</script>

<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>

@endsection