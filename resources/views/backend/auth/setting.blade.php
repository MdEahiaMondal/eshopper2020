@extends('backend.layouts.master')

@section('title', '')

@push('css')

@endpush


@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Setting</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Home</a>
                </li>
                <li>
                    <a>Forms</a>
                </li>
                <li class="active">
                    <strong>Profile</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Basic form <small>Simple login form example</small></h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Change Password</h3>
                                <form role="form" action="{{ route('admin.password.update') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" id="current_password">
                                            @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        <small class="curtPass"></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="password" class="form-control" name="password" id="new_password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Change Password</strong></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6"><h4>Not a member?</h4>
                                <p>You can create an account:</p>
                                <p class="text-center">
                                    <a href=""><i class="fa fa-sign-in big-icon"></i></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $("#new_password").click(function () {
                var currentPassword = $("#current_password").val();
                $.ajax({
                    url: "{{ route('admin.check.password') }}",
                    type: "get",
                    data:{currentPassword:currentPassword},
                    success: function (feedBackResult) {
                        if (feedBackResult == 'true')
                        {
                            $("#current_password").css({
                                color:'green',
                                border:"1px solid green"
                            });
                            $(".curtPass").html("<font color='#006400'>Current Password is Incorrect</font>")

                        }else if(feedBackResult == 'false'){

                            $(".curtPass").html("<font color='red'>Current Password is not Correct</font>")
                            $("#current_password").css({
                                color:'red',
                                border:"1px solid red"
                            });
                        }
                    },
                    error:function () {
                        alert('error')
                    }
                })
            });
        });
    </script>
@endpush
