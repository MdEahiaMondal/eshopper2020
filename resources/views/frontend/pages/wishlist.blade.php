@extends('frontend.master.master')

@section('title', '')

@push('css')


@endpush


@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Wishlist</li>
                </ol>
            </div>
            @if($wishlists->count() > 0)

                <div class="table-responsive cart_info">

                    <table class="table table-condensed">
                        <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description">Description</td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td class="total"></td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        @php $subtotal = 0; @endphp
                        @foreach($wishlists as $wishlist)
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img style="width: 110px; height: 110px" src="{{ asset('backend/uploads/images/product/small/'.$wishlist->product->image) }}" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $wishlist->product_name }}</a></h4>
                                    <p>Code: {{ $wishlist->product->code }} | {{ $wishlist->size }} | {{ $wishlist->color }}</p>
                                </td>
                                <td class="cart_price">
                                    <p>TK {{ \App\Product::getProductPrice($wishlist->product_id,$wishlist->size) }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href="{{ route('cart.update.icrement',$wishlist->id) }}"> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity" value="{{ $wishlist->quantity }}" autocomplete="off" size="2">
                                        @if($wishlist->quantity > 1)
                                            <a class="cart_quantity_down" href="{{ route('cart.update.decrement',$wishlist->id) }}"> - </a>
                                        @endif
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">TK {{ (\App\Product::getProductPrice($wishlist->product_id,$wishlist->size) * $wishlist->quantity) }}</p>
                                </td>
                                <td>

                                    <form action="{{ route('wishlist.add.to.cart') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id"  value="{{ $wishlist->product_id }}">
                                        <input type="hidden" name="product_name"  value="{{ $wishlist->product_name }}">
                                        <input type="hidden" name="color"  value="{{ $wishlist->color }}">
                                        <input type="hidden" name="price"  value="{{ $wishlist->price }}">
                                        <input type="hidden" name="size"  value="{{ $wishlist->size }}">
                                        <input type="hidden" name="sku"  value="{{ $wishlist->product_sku_code }}">
                                        <button type="submit">Add To Cart</button>
                                    </form>
                                </td>
                                <td class="cart_delete">
                                    <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cart_quantity_delete"><i class="fa fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @php $subtotal += (\App\Product::getProductPrice($wishlist->product_id,$wishlist->size) * $wishlist->quantity) @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>

            @else
                <div class="alert alert-warning fade in text-center">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <strong>Warning!</strong> Your Wishlist is Empty.
                </div>
            @endif

        </div>
    </section> <!--/#wishilist item-->

@endsection



@push('script')
@endpush
