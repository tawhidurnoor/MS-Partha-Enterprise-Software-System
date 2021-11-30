@extends('layouts.mainlayout')

@section('title')
<title>Clients</title>
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
                                    <h4>CLIENTS</h4>
                                    <span>HERE IS THE LIST OF ALL CLIENTS.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item" style="float: left;">
                                        <a href="/"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item" style="float: left;"><a href="{{ route('clients.index') }}">Clients</a>
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
                                                    <th>Client's Name</th>
                                                    <th>Client's Company</th>
                                                    <th>Client's Phone</th>
                                                    <th>Client's Address</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($clients as $client)
                                                <tr>
                                                    <td>
                                                        {{ $client->client_name }}
                                                    </td>
                                                    <td>
                                                        {{ $client->client_company }}
                                                    </td>
                                                    <td>
                                                        {{ $client->client_phone }}
                                                    </td>
                                                    <td>
                                                        {{ $client->client_address }}
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary waves-effect edit_button" data-id="{{ $client->id }}">Edit</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Client's Name</th>
                                                    <th>Client's Company</th>
                                                    <th>Client's Phone</th>
                                                    <th>Client's Address</th>
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
                <h4 class="modal-title">Add a Client</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('clients.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Client's Name</label>
                        <input type="text" name="client_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Client's Company</label>
                        <input type="text" name="client_company" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Client's Phone</label>
                        <input type="text" name="client_phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Client's Address</label>
                        <input type="text" name="client_address" class="form-control" required>
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
                <h4 class="modal-title">Edit Client Info</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="edit_form" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-body">
                    <div class="form-group">
                        <label>Client's Name</label>
                        <input type="text" name="client_name" id="client_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Client's Company</label>
                        <input type="text" name="client_company" id="client_company" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Client's Phone</label>
                        <input type="text" name="client_phone" id="client_phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Client's Address</label>
                        <input type="text" name="client_address" id="client_address" class="form-control" required>
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
            url: 'clients/' + id,
            dataType: 'json',
            success: function(response) {
                $('#client_name').val(response.client_name);
                $('#client_company').val(response.client_company);
                $('#client_phone').val(response.client_phone);
                $('#client_address').val(response.client_address);
            }
        });

        document.getElementById("edit_form").action = "clients/" + id;
    }
</script>

<script>
    $('#datatable').DataTable({
        "paging": true,
        "ordering": true,
        "bLengthChange": true,
        "info": true,
        "searching": true
    });
</script>
@endsection