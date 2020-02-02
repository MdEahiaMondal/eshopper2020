@extends('backend.layouts.master')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Add Product Images</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.product.index') }}">Alternate Images</a>
                </li>
                <li class="active">
                    <strong>Add</strong>
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
                        <form class="form-horizontal" method="POST" action="{{ route('admin.product.images.store', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group control-group after-add-more">
                                <div class="wrapper_field">
                                    <div class="col-lg-2">
                                        <input type="file"  multiple name="img[]" placeholder="Sku" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div id="dynamic_form_attribute">

                            </div>
                            <div class="form-group" style="margin-top: 20px">
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


       <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Images</th>
                </tr>
                </thead>

                <tbody>

                <tr>
                    <td>{{ ucfirst($product->name) }}</td>
                </tr>
                @foreach($product->ProductImages as $image)
                    <tr>
                        <td>
                            <img src="{{ asset('backend/uploads/images/product/small/'.$image->image) }}" alt="">
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection

@push('script')

@endpush
