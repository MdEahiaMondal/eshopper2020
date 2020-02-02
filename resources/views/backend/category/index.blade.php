 @extends('backend.layouts.master')

 @push('css')
     <link href="{{ asset('backend/css/plugins/jsTree/style.min.css') }}" rel="stylesheet">
@endpush

@section('content')
     <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Category</h2>
        </div>
        <div class="col-lg-2">
            <div class="ibox-tools">
                <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-plus"></i> <strong>Create</strong></a>
            </div>
        </div>
    </div>


 <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">

                        <div class="row" style="margin-bottom: 10px">

                            <div class="col-sm-12">
                                <form action="{{ route('admin.category.index') }}" method="get" class="form-inline" role="form">

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
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Name</th>
                                        <th>Parent Category</th>
                                        <th>Slug</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Products</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($categories as $category)

                                        <tr>
                                            <td>{{$loop->index + 1 }}</td>
                                            <td>{{ ucfirst($category->name) }}</td>
                                            <td>{{ ($category->parent_id != null)?$category->parent->name:'--' }}</td>
                                            <td>{{ $category->slug }}</td>

                                            <?php
                                            if (isset($category->image)){
                                                $image_url = URL::to('backend/uploads/images/category/'.$category->image);
                                            }else{
                                                $image_url = URL::to('admin/img/no-image.png');
                                            }
                                            ?>

                                            <td><img src="{{ $image_url }}" class="cus_thumbnail" alt=""></td>
                                            <td> {{ ucfirst($category->description) }}</td>
                                            <td> {{ $category->products_count }}</td>

                                            <td>
                                                <a href="#0" title="Change publication status">
                                                    @if($category->status)
                                                        <span class="badge badge-primary">Active</span>
                                                    @else
                                                        <span class="badge badge-warning">Disable</span>
                                                    @endif
                                                </a>
                                            </td>

                                            <td> {{ date("M-d-Y", strtotime($category->created_at)) }}</td>

                                            <td class="text-center">

                                                <a href="{{ route('admin.category.edit', $category->id) }}" title="Edit" class="btn btn-info cus_btn">
                                                    <i class="fa fa-pencil-square-o"></i> <strong>Edit</strong>
                                                </a>

                                                <a onclick="deleteRow({{ $category->id }})" href="JavaScript:void(0)" title="Delete" class="btn btn-danger cus_btn">
                                                    <i class="fa fa-trash"></i> <strong>Delete</strong>
                                                </a>

                                                <form id="row-delete-form{{ $category->id }}" method="POST" action="{{ route('admin.category.destroy', $category->id) }}" style="display: none" >
                                                    @method('DELETE')
                                                    @csrf()
                                                </form>

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
