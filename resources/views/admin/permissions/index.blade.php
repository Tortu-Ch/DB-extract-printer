@extends('layouts.vertical', ['title' => 'Permissions'])

@section('css')
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Permissions</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
{{--                    <h4 class="header-title"></h4>--}}
{{--                    <p class="sub-header">--}}
{{--                        Example of basic columns.--}}
{{--                    </p>--}}
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->
    </div> <!-- container -->
@endsection

@section('script')
    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script>
        $('#dataTable').DataTable({
            'processing': true,
            'serverSide': true,
            'ajax': {
                'url': "{{ url('permissions') }}",
                'type': 'GET'
            },
            'columns': [
                {'data': 'id'},
                {'data': 'name'},
                {'data': 'action', orderable: false, searchable: false},
            ],
        });
    </script>
@endsection
