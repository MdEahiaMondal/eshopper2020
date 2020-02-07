@extends('frontend.master.master')

@section('title', 'Home')

@push('css')


@endpush

@section('sidebar')

@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">


                @include('frontend.component.sidebar')


                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->

                        @if(isset($cms))
                            <h2 class="title text-center">{{$cms->title }}</h2>
                        @endif
                        <div class="col-sm-12">
                            <div class="product-image-wrapper">
                                <p>{{ $cms->description }}</p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('script')

@endpush
