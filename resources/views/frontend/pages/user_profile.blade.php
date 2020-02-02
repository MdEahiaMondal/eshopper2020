@extends('frontend.master.master')

@section('title', 'Profile')

@push('css')


@endpush

@section('content')
    <section id="form" style="margin-top: 27px;"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form action="{{ route('user.profile.update') }}" id="userProfile" method="post">
                            @csrf
                            <input type="text" id="name" name="name" value="{{ auth()->user()->name ?? old('name') }}"/>
                            @error('name')<p class="text-danger">{{ $message }}</p>@enderror

                            <input type="email" id="email" name="email" value="{{ auth()->user()->email ?? old('email') }}"/>
                            @error('email')<p class="text-danger">{{ $message }}</p>@enderror

                            <select name="country" id="country">
                                <option class="form-control" value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option {{ $country->country_name == auth()->user()->country ? 'selected' : '' }} value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                @endforeach
                            </select>

                            <input type="text" id="state" value="{{ auth()->user()->state ?? old('state') }}" name="state" placeholder="Enter State"/>

                            <input type="text" id="city" value="{{ auth()->user()->city ?? old('city') }}" name="city" placeholder="Enter City"/>

                            <input type="text" id="zipcode" value="{{ auth()->user()->zipcode ?? old('zipcode') }}" name="zipcode" placeholder="Enter Zipcode"/>

                            <input type="text" id="phone" value="{{ auth()->user()->phone ?? old('phone') }}" name="phone" placeholder="Enter Phone"/>

                            <textarea name="address" id="address">
                                    {{ auth()->user()->address ?? 'Enter your address' }}
                            </textarea>
                            <button type="submit" class="btn btn-default">Update</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form">
                        <h2>User Password Update!</h2>
                        <form action="{{ redirect()->action('App\Http\Controllers\Frontend\UserController@userPasswordUpdate')}}" id="userProfile" method="post">
                            @csrf
                            <input type="password" id="currentPassword" name="currentPassword" placeholder="Current Password"/>
                            <span id="resultPass"></span>

                            <input type="password" id="password" name="password" placeholder="New Password"/>
                            @error('password')<p class="text-danger">{{ $message }}</p>@enderror

                            <button type="submit" class="btn btn-default">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection



@push('script')

    <script>
        $().ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#currentPassword").keyup(function () {
                var password = $(this).val();

                $.ajax({
                    url: "{{ route('user.password.checked') }}",
                    data: {
                        password:password,
                    },
                    type: "post",
                    success: function (resp) {
                        if(resp == 'false')
                        {
                            $("#resultPass").html('<span style="color: red">Password Invalide</span>')
                            $("#currentPassword").css({
                                border: "1px solid red",
                            })
                        }else{
                            $("#resultPass").html('<span style="color: darkgreen">Password Currect</span>')
                            $("#currentPassword").css({
                                border: "1px solid green",
                            });
                        }
                    }
                })
            })
        })
    </script>
@endpush
