@extends('frontend.master.master')

@section('title', 'Chackout')

@push('css')
@endpush


@section('content')
    <section id="form" style="margin-top: 27px;"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Billing Address</h2>
                        <form action="{{ route('user.profile.update') }}" id="userProfile" method="post">
                            @csrf
                            <input type="text" id="billing_name"  value="{{ auth()->user()->name  }}"/>

                            <input type="email" id="billing_email"  value="{{ auth()->user()->email  }}"/>

                            <input type="text" id="billing_country" value="{{ auth()->user()->country  }}" placeholder="Enter State"/>

                            <input type="text" id="billing_state" value="{{ auth()->user()->state  }}"  placeholder="Enter State"/>

                            <input type="text" id="billing_city" value="{{ auth()->user()->city  }}"  placeholder="Enter City"/>

                            <input type="text" id="billing_zipcode" value="{{ auth()->user()->zipcode  }}"  placeholder="Enter Zipcode"/>

                            <input type="text" id="billing_phone" value="{{ auth()->user()->phone  }}"  placeholder="Enter Phone"/>

                            <textarea  id="billing_address">
                                    {{ auth()->user()->address }}
                            </textarea>

                            <div class="form-check">
                                <input type="checkbox" style="height: 17px; width: 18px; display: inline-block; margin-top: 10px" class="form-check-input" id="billingtoshipping">
                                <label class="form-check-label" for="billingtoshipping">Billing address same to shipping address</label>
                            </div>
                        </form>
                    </div><!--/login form-->
                </div>

                <div class="col-sm-5">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Shipping Address</h2>
                        <form  method="post" action="{{ route('checkout.store') }}">
                            @csrf
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Name"/>
                            @error('name')<p class="text-danger">{{ $message }}</p>@enderror

                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email"/>
                            @error('email')<p class="text-danger">{{ $message }}</p>@enderror

                            <select name="country" id="country">
                                <option class="form-control" value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option  value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                @endforeach
                            </select>
                            @error('country')<p class="text-danger">{{ $message }}</p>@enderror

                            <input style="margin-top: 10px;" type="text" id="state"  name="state" value="{{ old('state') }}" placeholder="Enter State"/>
                            @error('state')<p class="text-danger">{{ $message }}</p>@enderror

                            <input type="text" id="city"  name="city" value="{{ old('city') }}" placeholder="Enter City"/>
                            @error('city')<p class="text-danger">{{ $message }}</p>@enderror

                            <input type="text" id="zipcode" name="zipcode" value="{{ old('zipcode') }}" placeholder="Enter Zipcode"/>
                            @error('zipcode')<p class="text-danger">{{ $message }}</p>@enderror

                            <input type="text" id="phone"  name="phone" value="{{ old('phone') }}" placeholder="Enter Phone"/>
                            @error('phone')<p class="text-danger">{{ $message }}</p>@enderror

                            <textarea name="address" id="address">
                                    {{ old('address') }}
                            </textarea>
                            @error('address')<p class="text-danger">{{ $message }}</p>@enderror

                            <button type="submit" style="margin-top: 20px;" class="btn btn-default">Check Out</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection



@push('script')

    <script>
        $().ready(function () {
            $("#billingtoshipping").click(function () {
                if(this.checked)
                {
                    $("#name").val($("#billing_name").val());
                    $("#email").val($("#billing_email").val());
                    $("#country").val($("#billing_country").val());
                    $("#state").val($("#billing_state").val());
                    $("#city").val($("#billing_city").val());
                    $("#zipcode").val($("#billing_zipcode").val());
                    $("#phone").val($("#billing_phone").val());
                    $("#address").val($("#billing_address").val());
                }else{
                    $("#name").val('');
                    $("#email").val('');
                    $("#country").val('');
                    $("#state").val('');
                    $("#city").val('');
                    $("#zipcode").val('');
                    $("#phone").val('');
                    $("#address").val('');
                }
            });
        })
    </script>


@endpush
