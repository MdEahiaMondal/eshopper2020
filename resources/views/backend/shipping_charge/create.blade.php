@extends('backend.layouts.master')
@push('css')
@endpush
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Create shipping_charge</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.shipping_charge.index') }}">shipping_charge</a>
                </li>
                <li class="active">
                    <strong>Create</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-4">
            <div class="ibox-tools">
                <a href="{{ route('admin.shipping_charge.index') }}" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"> <strong>Back</strong></a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">

                    <div class="ibox-content">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.shipping_charge.store') }}" enctype="multipart/form-data">
                           @csrf

                           @include('backend.shipping_charge.element')

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


@endpush
