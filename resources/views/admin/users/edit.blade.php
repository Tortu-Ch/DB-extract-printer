@extends('layouts.vertical', ['title' => 'Add New User'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/multiselect/multiselect.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/selectize/selectize.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">User Management</a></li>
                            <li class="breadcrumb-item active"><a href="{{url('users')}}">Users</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit User</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row justify-content-center">
            <div class="col-lg-6 ">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('users.update', $user->id)}}" method="POST" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="fullname">Full Name<span class="text-danger">*</span></label>
                                <input class="form-control @if($errors->has('name')) is-invalid @endif" name="name" type="text"
                                id="fullname" placeholder="Enter your name" required
                                value="{{ $user->name }}"/>
                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="emailaddress">Email address<span class="text-danger">*</span></label>
                                <input class="form-control @if($errors->has('email')) is-invalid @endif" name="email" type="email"
                                       id="emailaddress" required placeholder="Enter your email"
                                       value="{{ $user->email }}"/>

                                @if($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="selectize-select" >Select User Role<span class="text-danger">*</span></label> <br/>
                                <select id="selectize-select" class="form-control" name="roles" required>
                                    @foreach($roles as $role)
                                        @if($role->id == 1)
                                            <option value="{{$role->name}}" disabled>{{$role->name}}</option>
                                        @elseif($role->id == $user->roles[0]->id)
                                            <option value="{{$role->name}}" selected>{{$role->name}}</option>
                                        @else
                                            <option value="{{$role->name}}" >{{$role->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password<span class="text-danger">*</span></label>
                                <input class="form-control @if($errors->has('password')) is-invalid @endif" name="password" type="password" required id="password" placeholder="Enter your password" value="{{old('password')}}" />
                                @if($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm password<span class="text-danger">*</span></label>
                                <input class="form-control @if($errors->has('confirm_password')) is-invalid @endif"
                                       name="confirm_password" type="password" required id="confirm_password" placeholder="Enter your password" />

                                @if($errors->has('confirm_password'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('confirm_password') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group text-right m-b-0">
                                <button id="btn_submit" class="btn btn-primary waves-effect waves-light" type="submit">
                                    Submit form
                                </button>
                                <a href="{{url('users')}}">
                                    <button type="button" class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>
                                </a>
                            </div>

                        </form>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
    </div>
    <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/selectize/selectize.min.js')}}"></script>
    <script src="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js')}}"></script>
    <script src="{{asset('assets/libs/multiselect/multiselect.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('assets/libs/devbridge-autocomplete/devbridge-autocomplete.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-mockjax/jquery-mockjax.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#btn_submit').click(function () {
                if (!$('#selectize-select').find(':selected').text()){
                    $('#select_invalid').show();
                }
            });
            $('#selectize-select').change(function(){
                $('#select_invalid').hide();
            });
            $('#pass1, #pass2').focusout(function(){
                let pass1 = $('#pass1').val();
                let pass2 = $('#pass2').val();
                if(pass1 != pass2){
                    $('#pass_invalid').show();
                    $('#btn_submit').disable();
                } else
                    $('#pass_invalid').hide();
            })
        });
    </script>
@endsection
