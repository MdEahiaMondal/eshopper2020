<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2>Invoice</h2><h3 class="pull-right">Order # 12345</h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Billed To:</strong><br>
                        <div>{{ $order->orderUser->name }}</div>
                        <div>{{ $order->orderUser->email }}</div>
                        <div>{{ $order->orderUser->phone }}</div>
                        <div>{{ $order->orderUser->address }}</div>
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Shipped To:</strong><br>
                        <div>{{ $order->shipping_name }}</div>
                        <div>{{ $order->shipping_email }}</div>
                        <div>{{ $order->shipping_phone }}</div>
                        <div>{{ $order->shipping_country }}</div>
                        <div>{{ $order->shipping_state }}</div>
                        <div>{{ $order->shipping_city }}</div>
                        <div>{{ $order->shipping_zipcode }}</div>
                        <div>{{ $order->shipping_address }}</div>
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Payment Method:</strong><br>
                        <div>{{ $order->payment_method }}</div>
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Order Date:</strong><br>
                        <div>{{ $order->created_at->diffForHumans() }}</div>
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th >Name</th>
                                <th >Size</th>
                                <th >Color </th>
                                <th >Price</th>
                                <th >Quantity</th>
                                <th class="text-right">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $grand_total = 0;
                                @endphp
                            @foreach($order->orderDetails as $product)
                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_size }}</td>
                                <td>{{ $product->product_color }}</td>
                                <td>{{ $product->product_price }}</td>
                                <td>{{ $product->product_quantity }}</td>
                                <td class="text-right">{{ $product->product_price }}</td>
                            </tr>
                                @php
                                    $grand_total += ($product->product_quantity * $product->product_price)
                                @endphp
                            @endforeach

                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                <td class="thick-line text-right"><b>{{ $grand_total }}</b></td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Shipping Charge (+)</strong></td>
                                <td class="no-line text-right">{{ $order->shipping_charge }}</td>
                            </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Coupon Amount (-)</strong></td>
                                    <td class="no-line text-right">{{ $order->coupon_amount }}</td>
                                </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Total</strong></td>
                                <td class="no-line text-right">{{ $order->grand_total }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
