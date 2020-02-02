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
                        <th  class="text-center" scope="col">Ordered Product</th>
                        <th  class="text-center" scope="col">Payment Method</th>
                        <th  class="text-center" scope="col">Grand Total</th>
                        <th  class="text-center" scope="col">Created At</th>
                        <th  class="text-center" scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($orders as $order)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>
                                @foreach($order->orderDetails as $details)
                                    <span class="badge">{{ $details->product_size }}</span>
                                @endforeach
                            </td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $order->grand_total }}</td>
                            <td>{{ $order->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('user.order.details',$order->id) }}">View Details</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section><!--/form-->
@endsection



@push('script')

@endpush
