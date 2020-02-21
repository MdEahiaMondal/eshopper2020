@extends('backend.layouts.master')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Edit role_permission</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.role_permission.index') }}">role_permission</a>
                </li>
                <li class="active">
                    <strong>Edit</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.role_permission.update', $admin->id ) }}">
                           @csrf
                           @method('PUT')

                           @include('backend.role_permission.element')

                            <div class="form-group">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                     <button class="btn btn-sm btn-primary pull-left m-t-n-xs" type="submit">
                                        <strong>Update</strong>
                                     </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $().ready(function () {
            if($("#type").val() === 'admin')
            {
                $("#hideMe").hide()
            }
            $("#type").change(function () {
                var role = $(this).val();
                console.log(role);
                if(role === 'admin')
                {
                    $("#hideMe").hide();
                }else{
                    $("#hideMe").show();
                }

            })
        });
    </script>
@endpush
