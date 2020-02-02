@extends('backend.layouts.master')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Add Product Attribute</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.product.index') }}">Attribute</a>
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
                        <form class="form-horizontal" method="POST" action="{{ route('admin.product.attribute.store', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group control-group after-add-more">
                                <div class="wrapper_field">
                                    <div class="col-lg-2">
                                        <input type="text"  name="sku[]" id="sku" placeholder="Sku" class="form-control">
                                    </div>

                                    <div class="col-lg-2">
                                        <input type="text"  name="size[]" id="size" placeholder="Size" class="form-control">
                                    </div>

                                    <div class="col-lg-2">
                                        <input type="text"  name="price[]" id="price" placeholder="Price" class="form-control">
                                    </div>

                                    <div class="col-lg-2">
                                        <input type="text"  name="stock[]" id="stock" placeholder="Stock" class="form-control">
                                    </div>
                                </div>

                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
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

            <form action="{{ route('admin.add.product.attribute.update',$product->id) }}" method="post">
                @csrf
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Si</th>
                        <th>SKU</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($product->attributes as $attr)

                        <tr>
                            <td><input type="hidden" name="idAttr[]" value="{{ $attr->id }}">{{$loop->index + 1 }}</td>
                            <td>{{ ucfirst($attr->sku) }}</td>
                            <td>{{ $attr->size }}</td>
                            <td><input type="text" name="price[]" value="{{ $attr->price }}"></td>
                            <td><input type="text" name="stock[]" value="{{ $attr->stock }}"></td>
                            <td class="text-center">
                                <input type="submit" class="btn btn-info cus_btn" value="Update">
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </form>


        </div>

    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".add-more").click(function(){
                var html = $(".wrapper_field");
                var makeHtmlInput = '<div class="form-group control-group remove_field">' +
                    '<div class="wrapper_field">' +
                         '<div class="col-lg-2">\n' +
                                '<input type="text"  name="sku[]" id="sku" placeholder="Sku" class="form-control">\n' +
                        '</div>\n' +
                        '\n' +
                        '<div class="col-lg-2">\n' +
                        '     <input type="text"  name="size[]" id="size" placeholder="Size" class="form-control">\n' +
                        '</div>\n' +
                        '\n' +
                        ' <div class="col-lg-2">\n' +
                        '     <input type="text"  name="price[]" id="price" placeholder="Price" class="form-control">\n' +
                        ' </div>\n' +
                        '\n' +
                        '<div class="col-lg-2">\n' +
                        '     <input type="text"  name="stock[]" id="stock" placeholder="Stock" class="form-control">\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '\n' +
                        '<div class="input-group-btn">\n' +
                        '     <button class="btn btn-sm btn-danger removeBtn" type="button"><i class="glyphicon glyphicon-minus"></i> Remove</button>\n' +
                        '</div>\n' +
                    '</div>';

                $("#dynamic_form_attribute").append(makeHtmlInput);
            });

            $("body").on("click",".removeBtn",function(){
                $(this).parents(".remove_field").remove();
            });
        });


    </script>
@endpush
