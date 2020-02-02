@extends('backend.layouts.master')
@push('css')
    <link href="{{ asset('backend/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Create Coupon</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.coupon.index') }}">Product</a>
                </li>
                <li class="active">
                    <strong>Create</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-4">
            <div class="ibox-tools">
                <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"> <strong>Back</strong></a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">

                    <div class="ibox-content">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.coupon.store') }}" enctype="multipart/form-data">
                           @csrf

                           @include('backend.coupons.element')

                            <div class="form-group">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                     <button class="btn btn-sm btn-primary pull-left m-t-n-xs" type="submit">
                                        <strong>Submit</strong>
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
    <!-- Data picker -->
    <script src="{{ asset('backend/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

    <script>
        $('#data_3 .input-group.date').datepicker({
            startView: 2,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: 'yy/mm/dd',
        });
    </script>

@endpush
