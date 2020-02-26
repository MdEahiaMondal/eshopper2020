 @extends('backend.layouts.master')

@section('content')
    @php
        use Illuminate\Support\Facades\Session;
        $adminDeatil = Session::get('adminDetails');
    @endphp
     <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Products</h2>
        </div>
        <div class="col-lg-2">
            <div class="ibox-tools">
                @if($adminDeatil->product_all_access == 1 || $adminDeatil->product_create_access == 1)
                    <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-plus"></i> <strong>Create</strong></a>
                @endif
            </div>
        </div>
    </div>


 <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">

                        <div class="row" style="margin-bottom: 10px">

                            <div class="col-sm-8">
                                <form action="{{ route('admin.product.index') }}" method="get" class="form-inline" role="form">

                                    <div class="form-group">
                                        <div>Records Per Page</div>
                                        <select name="perPage" id="perPage" onchange="submit()" class="input-sm form-control" style="width: 115px;">
                                            <option value="10"{{ request('perPage') == 10 ? ' selected' : '' }}>10</option>
                                            <option value="25"{{ request('perPage') == 25 ? ' selected' : '' }}>25</option>
                                            <option value="50"{{ request('perPage') == 50 ? ' selected' : '' }}>50</option>
                                            <option value="100"{{ request('perPage') == 100 ? ' selected' : '' }}>100</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <br>
                                        <div class="input-group">
                                            <input name="keyword" type="text" value="{{ request('keyword') }}" class="input-sm form-control" placeholder="Search Here">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-sm btn-primary"> Go!</button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-sm-2 pull-right">
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.get.products.excel') }}">Excel</a>
                            </div>

                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Si</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Weight (g)</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Create At</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($products as $product)

                                        <tr>
                                            <td>{{$loop->index + 1 }}</td>
                                            <td>{{ ucfirst($product->name) }}</td>
                                            <td>{{ isset($product->productCategory) ? $product->productCategory->name : 'N/A' }}</td>
                                             <td>{{ $product->weight }}</td>
                                             <td>{{ $product->price }}</td>
                                             <td>{{ $product->status }}</td>
                                            <td>{{ $product->created_at->diffForhumans() }}</td>
                                            <td class="text-center">
                                                @if($adminDeatil->product_all_access == 1 || $adminDeatil->product_edit_access == 1)
                                                <a href="{{ route('admin.product.edit', $product->id) }}" title="Edit" class="btn btn-info cus_btn">
                                                    <i class="fa fa-pencil-square-o"></i> <strong>Edit</strong>
                                                </a>
                                                @endif

                                                <a href="{{ route('admin.add.product.attribute', $product->id) }}" title="Add Product Attribute" class="btn btn-info cus_btn">
                                                    <i class="fa fa-plus"></i> <strong>Attr</strong>
                                                </a>

                                                <a href="{{ route('admin.product.images.form', $product->id) }}" title="Add Product Alternate Images" class="btn btn-info cus_btn">
                                                    <i class="fa fa-plus"></i> <strong>Images</strong>
                                                </a>

                                              @if($adminDeatil->product_all_access == 1 || $adminDeatil->product_delete_access == 1)
                                                <a onclick="deleteRow({{ $product->id }})" href="JavaScript:void(0)" title="Delete" class="btn btn-danger cus_btn">
                                                    <i class="fa fa-trash"></i> <strong>Delete</strong>
                                                </a>

                                                <form id="row-delete-form{{ $product->id }}" method="POST" action="{{ route('admin.product.destroy', $product->id) }}" style="display: none" >
                                                    @method('DELETE')
                                                    @csrf()
                                                </form>
                                               @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
