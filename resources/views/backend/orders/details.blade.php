@extends('backend.layouts.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Orders</h2>
        </div>
        <div class="col-lg-2">
            <div class="ibox-tools">
                <a href="#0" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-plus"></i> <strong>Create</strong></a>
            </div>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Customer Details</h5>

                    </div>
                    <div class="ibox-content">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $order->orderUser->name }}</td>
                                <td>{{ $order->orderUser->email }}</td>
                                <td>{{ $order->orderUser->phone }}</td>
                                <td>{{ $order->orderUser->address }}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Order Details </h5>
                    </div>
                    <div class="ibox-content">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>Products</th>
                                <th>Order Amount</th>
                                <th>Payment Method</th>
                                <th>Coupon Code</th>
                                <th>Coupon Amount</th>
                                <th>Shipping Charge</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $order->created_at->diffForHumans() }}</td>
                                <td>{{ $order->orderDetails->count() }}</td>
                                <td>{{ $order->grand_total }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ $order->coupon_code }}</td>
                                <td>{{ $order->coupon_amount }}</td>
                                <td>{{ $order->shipping_charge }}</td>
                                <td>{{ $order->status }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Shipping Details </h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email </th>
                                    <th>Phone</th>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Zipcode</th>
                                    <th>Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $order->shipping_name }}</td>
                                    <td>{{ $order->shipping_email }}</td>
                                    <td>{{ $order->shipping_phone }}</td>
                                    <td>{{ $order->shipping_country }}</td>
                                    <td>{{ $order->shipping_state }}</td>
                                    <td>{{ $order->shipping_city }}</td>
                                    <td>{{ $order->shipping_zipcode }}</td>
                                    <td>{{ $order->shipping_address }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Product Details </h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Size</th>
                                    <th>Color </th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->orderDetails as $product)
                                    <tr>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_size }}</td>
                                        <td>{{ $product->product_color }}</td>
                                        <td>{{ $product->product_price }}</td>
                                        <td>{{ $product->product_quantity }}</td>
                                        <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
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
