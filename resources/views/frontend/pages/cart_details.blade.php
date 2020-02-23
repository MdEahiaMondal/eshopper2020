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
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            @if($carts->count() > 0)

            <div class="table-responsive cart_info">

                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description">Description</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @php $subtotal = 0; @endphp
                        @foreach($carts as $cart)
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img style="width: 110px; height: 110px" src="{{ asset('backend/uploads/images/product/small/'.$cart->product->image) }}" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $cart->product_name }}</a></h4>
                                    <p>Code: {{ $cart->product->code }} | {{ $cart->size }} | {{ $cart->color }}</p>
                                </td>
                                <td class="cart_price">
                                    <p>TK {{ \App\Product::getProductPrice($cart->product_id,$cart->size) }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href="{{ route('cart.update.icrement',$cart->id) }}"> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity" value="{{ $cart->quantity }}" autocomplete="off" size="2">
                                        @if($cart->quantity > 1)
                                            <a class="cart_quantity_down" href="{{ route('cart.update.decrement',$cart->id) }}"> - </a>
                                        @endif
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">TK {{ (\App\Product::getProductPrice($cart->product_id,$cart->size) * $cart->quantity) }}</p>
                                </td>
                                <td class="cart_delete">

                                    <a onclick="event.preventDefault(); document.getElementById('cart-item-delete-form{{ $cart->id }}').submit()" href="JavaScript:void(0)" title="Delete" class="cart_quantity_delete"><i class="fa fa-times"></i></a>
                                    <form id="cart-item-delete-form{{ $cart->id }}" method="POST" action="{{ route('cart.destroy',$cart->id) }}" style="display: none" >
                                        @method('DELETE')
                                        @csrf()
                                    </form>
                                </td>
                            </tr>
                            @php $subtotal += (\App\Product::getProductPrice($cart->product_id,$cart->size) * $cart->quantity) @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>

            @else
                <div class="alert alert-warning fade in">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <strong>Warning!</strong> Your Cart is Empty.
                </div>
            @endif

        </div>
    </section> <!--/#cart_items-->

    @if($carts->count() > 0)
    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose_area">
                        <ul class="user_option">
                            <li>
                                <form action="{{ route('cart.applay.coupon') }}" method="post">
                                    @csrf
                                    <label>Coupon Code</label>
                                    <input type="text" name="coupon_code">
                                    <button type="submit">Apply</button>
                                </form>

                            </li>
                        </ul>
                        <ul class="user_info">
                            <li class="single_field">
                                <label>Country:</label>
                                <select>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field">
                                <label>Region / State:</label>
                                <select>
                                    <option>Select</option>
                                    <option>Dhaka</option>
                                    <option>London</option>
                                    <option>Dillih</option>
                                    <option>Lahore</option>
                                    <option>Alaska</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field zip-field">
                                <label>Zip Code:</label>
                                <input type="text">
                            </li>
                        </ul>
                        <a class="btn btn-default update" href="">Get Quotes</a>
                        <a class="btn btn-default check_out" href="">Continue</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            @if(!empty(Session::get('couponAmount')))
                                <li>Cart Sub Total <span>TK {{ $subtotal }}</span></li>
                                <li>Coupon Amount <span>TK {{ Session::get('couponAmount') }}</span></li>
                                <li>Grand Total <span>TK {{ $subtotal - Session::get('couponAmount') }}</span></li>
                                @else
                                <li>Grand Total <span class="btn btn-secondary" data-toggle="tooltip" data-html="true" title="<em>Tooltip</em> <u>with</u> <b>HTML</b>">TK {{ $subtotal }}</span></li>
                            @endif
                        </ul>
                        <a class="btn btn-default update" href="{{ url('/') }}">Continue Shopping</a>
                        <a class="btn btn-default check_out" href="{{ route('checkout.index') }}">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
    @endif

@endsection



@push('script')
@endpush
