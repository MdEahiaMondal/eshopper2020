@extends('frontend.master.master')

@section('title', 'Chackout')

@push('css')
@endpush


@section('content')
    <section id="form" style="margin-top: 27px;margin-bottom: 59px;">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Shopping Review</li>
                </ol>
            </div>
            <div class="row">
                <div class="col-sm-5 col-sm-offset-1">
                    <div class="login-form">
                        <h2>Billing Address</h2>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Activisits</th>
                                <th scope="col"></th>
                                <th scope="col">Value</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Name</td>
                                 <td width="200"></td>
                                <td>{{ auth()->user()->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td width="200"></td>
                                <td>{{ auth()->user()->email }}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                 <td width="200"></td>
                                <td>{{ auth()->user()->phone }}</td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                 <td width="200"></td>
                                <td>{{ auth()->user()->country }}</td>
                            </tr>
                            <tr>
                                <td>State</td>
                                 <td width="200"></td>
                                <td>{{ auth()->user()->state }}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                 <td width="200"></td>
                                <td>{{ auth()->user()->city }}</td>
                            </tr>
                              <tr>
                                <td>Zipcode</td>
                                 <td width="200"></td>
                                <td>{{ auth()->user()->zipcode }}</td>
                            </tr>
                              <tr>
                                <td>Address</td>
                                 <td width="200"></td>
                                <td>{{ auth()->user()->address }}</td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Shipping Address</h2>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Activisits</th>
                                <th scope="col"></th>
                                <th scope="col">Value</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Name</td>
                                 <td width="200"></td>
                                 <td>{{ $shipping_detail->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                 <td width="200"></td>
                                <td>{{ $shipping_detail->email }}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                 <td width="200"></td>
                                <td>{{ $shipping_detail->phone }}</td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                 <td width="200"></td>
                                <td>{{ $shipping_detail->country }}</td>
                            </tr>
                            <tr>
                                <td>State</td>
                                 <td width="200"></td>
                                <td>{{ $shipping_detail->state }}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                 <td width="200"></td>
                                <td>{{ $shipping_detail->city }}</td>
                            </tr>
                            <tr>
                                <td>Zipcode</td>
                                 <td width="200"></td>
                                <td>{{ $shipping_detail->zipcode }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                 <td width="200"></td>
                                <td>{{ $shipping_detail->address }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->

    <section id="cart_items">
        <div class="container">
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
                                    <p>TK {{ $cart->price }}</p>
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
                                    <p class="cart_total_price">TK {{ ($cart->price * $cart->quantity) }}</p>
                                </td>
                                <td class="cart_delete">
                                    <a onclick="event.preventDefault(); document.getElementById('cart-item-delete-form{{ $cart->id }}').submit()" href="JavaScript:void(0)" title="Delete" class="cart_quantity_delete"><i class="fa fa-times"></i></a>
                                    <form id="cart-item-delete-form{{ $cart->id }}" method="POST" action="{{ route('cart.destroy',$cart->id) }}" style="display: none" >
                                        @method('DELETE')
                                        @csrf()
                                    </form>
                                </td>
                            </tr>
                            @php $subtotal += ($cart->price * $cart->quantity) @endphp
                        @endforeach
                        </tbody>
                    </table>
                    <div class="total_area">
                        <ul style="padding-left: inherit;">
                            @if(!empty(Session::get('couponAmount')))
                                <li>Cart Sub Total <span>TK {{ $subtotal }}</span></li>
                                <li>Coupon Amount(-) <span>TK {{ Session::get('couponAmount') }}</span></li>
                                <li>Shipping Charge(+) <span>TK {{ Session::get('shipping_charge') }}</span></li>
                                <li>Grand Total <span>TK {{ $grand_total =  ($subtotal + Session::get('shipping_charge')) - Session::get('couponAmount') }}</span></li>
                            @else
                                <li>Shipping Charge(+) <span>TK {{ Session::get('shipping_charge') }}</span></li>
                                <li>Grand Total <span>TK {{ $grand_total = ( $subtotal + Session::get('shipping_charge')) }}</span></li>
                            @endif
                        </ul>
                    </div>
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
                    <p>Please select your payment method</p>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="chose_area">
                            <form action="{{ route('order.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="grand_total" value="{{ $grand_total }}">
                                <input type="hidden" name="shipping_charge" value="{{ Session::get('shipping_charge') }}">
                                <ul class="user_option text-center">
                                    <li>
                                        <label for=""><b>select payment method: </b> </label>
                                        <input type="radio" name="payment_method" id="cad" value="cad"> <b>CAD</b>
                                        <input type="radio" name="payment_method" id="paypal" value="paypal"> <b>Paypal</b>
                                        <label class="float-right"><button type="submit" onclick=" return selectPayment()" class="btn btn-default" href="">Order Confirm</button></label>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--/#do_action-->
    @endif


@endsection



@push('script')

    <script>
        function selectPayment() {
            if($("#cad").is(':checked') || $("#paypal").is(':checked')){
            }else{
                alert('Please selecte payment method');
                return false;
            }
        }
    </script>

@endpush
