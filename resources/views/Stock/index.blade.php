@extends('layouts.mainlayout')

@section('title')
<title>Stock Register</title>
@endsection

@section('body')


<!-- Main Body -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Stock Register</h4>
                                    <span>THIS IS THE REGISTER OF ALL THE STOCK.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item" style="float: left;">
                                        <a href="/"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item" style="float: left;"><a href="{{ route('stocks.index') }}">Stock Register</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">
                                    <!--
                                                                                                                <h5>Zero Configuration</h5>
                                                                                                                <span>DataTables has most features enabled by default, so all
                                                                                                                    you need to do to use it with your own ables is to call the
                                                                                                                    construction function: $().DataTable();.</span>
                                                                                                                -->
                                    <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#add_modal">Add</button>

                                    <br><br>
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


                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Product</th>
                                                    <th>Previous Day Balance</th>
                                                    <th>Receipts</th>
                                                    <th>Sell</th>
                                                    <th>Balance</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($stocks as $stock)
                                                <tr>
                                                    <td>
                                                        {!! htmlspecialchars_decode(date('j-m-Y', strtotime($stock->date))) !!}
                                                    </td>
                                                    <td>
                                                        {{ $stock->product_name }}
                                                    </td>

                                                    <td>
                                                        {{ $stock->previous_day_balance }}
                                                        <label class="badge badge-inverse-success">{!! htmlspecialchars_decode(date('j-m-Y', strtotime($stock->previous_day))) !!}</label>
                                                    </td>
                                                    <td>
                                                        {{ $stock->receipts }}
                                                    </td>
                                                    <td>
                                                        {{ $stock->sell }}
                                                    </td>
                                                    <td>
                                                        {{ $stock->previous_day_balance  +  $stock->receipts  - $stock->sell }}
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary waves-effect edit_button" data-id="{{ $stock->id }}">Edit</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Product</th>
                                                    <th>Previous Day Balance</th>
                                                    <th>Receipts</th>
                                                    <th>Sell</th>
                                                    <th>Balance</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Zero config.table end -->
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
        <!-- Main-body end -->
        <div id="styleSelector">

        </div>
    </div>
</div>


<!-- Add Modal -->
<div class="modal fade" id="add_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Register a Stock</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('stocks.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Product</label>
                        <select name="product_id" class="form-control" required>
                            <option value="">Select a product </option>
                            @foreach($products as $product)
                            <option value="{{$product->id}}">
                                {{$product->product_name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Receipts</label>
                        <input type="number" name="receipts" class="form-control" required>
                    </div>
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
<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Stock Register</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="edit_form" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-body">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" id="date" class="form-control" required disabled>
                    </div>
                    <div class="form-group">
                        <label>Product</label>
                        <select name="product_id" id="product_id" class="form-control" required disabled>
                            <option value="">Select a product </option>
                            @foreach($products as $product)
                            <option value="{{$product->id}}">
                                {{$product->product_name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Receipts</label>
                        <input type="number" name="receipts" id="receipts" class="form-control" required>
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
            getEditDetails(id);
        });

        $(document).on('click', '.delete_button', function(e) {
            e.preventDefault();
            $('#delete_modal').modal('show');
            var id = $(this).data('id');

            //$('#del_id').val(id);
            document.getElementById("delete_form").action = "employee/" + id;
        });

    });


    function getEditDetails(id) {
        $.ajax({
            type: 'GET',
            url: 'stocks/' + id,
            dataType: 'json',
            success: function(response) {
                $('#date').val(response.date);
                $('#product_id').val(response.product_id);
                $('#receipts').val(response.receipts);
            }
        });

        document.getElementById("edit_form").action = "stocks/" + id;
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
@endsection