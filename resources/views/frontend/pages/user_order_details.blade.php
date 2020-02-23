@extends('frontend.master.master')

@section('title', 'Thanks')

@push('css')

@endpush


@section('content')
    <section id="form" style="margin-top: 27px;"><!--form-->
        <div class="container">
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">SI</th>
                        <th  class="text-center" scope="col">Product Name</th>
                        <th  class="text-center" scope="col">Product Size</th>
                        <th  class="text-center" scope="col">Product Color</th>
                        <th  class="text-center" scope="col">(Per) Product Price </th>
                        <th  class="text-center" scope="col">Product Quantity</th>
                        <th  class="text-center" scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @if($order_details->orderDetails->count() > 0)
                    @foreach($order_details->orderDetails as $order_detail)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $order_detail->product_name }}</td>
                            <td>{{ $order_detail->product_size }}</td>
                            <td>{{ $order_detail->product_color }}</td>
                            <td>{{ \App\Product::getProductPrice($order_detail->product_id,$order_detail->product_size)}}</td>
                            <td>{{ $order_detail->product_quantity }}</td>
                            <td>{{ \App\Product::getProductPrice($order_detail->product_id,$order_detail->product_size) * $order_detail->product_quantity }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Grand Total</td>
                        <td>{{ \Illuminate\Support\Facades\Session::get('orderGrandTotal') }}</td>
                    </tr>
                        @else
                        <tr>
                            <td colspan="6" class="text-danger">There is a no details</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section><!--/form-->
@endsection



@push('script')

@endpush
