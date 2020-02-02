@extends('frontend.master.master')

@section('title', 'Thanks')

@push('css')

@endpush


@section('content')
    <section id="form" style="margin-top: 27px;"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-2 col-sm-offset-1">

                </div>
                <div class="col-sm-6">
                    <h2 class="" style="color: #ffac40">Thanks For Your Order</h2>
                    <p>We will contact with you as soon as prosible</p>
                        <a class="btn btn-sm" href="{{ route('user.order.view') }}">View Order</a>
                </div>
                <div class="col-sm-2">

                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection



@push('script')

@endpush
