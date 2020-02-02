@extends('frontend.master.master')

@section('title', 'Thanks')

@push('css')

    <style>
        .error {
            color: red;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('frontend/Visual-Password-Strength-Indicator-Plugin-For-jQuery-Passtrength-js/css/passtrength.css') }}">
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
                </div>
                <div class="col-sm-2">

                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection



@push('script')
    <script src="{{ asset('frontend/Visual-Password-Strength-Indicator-Plugin-For-jQuery-Passtrength-js/js/passtrength.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script>
        $().ready(function () {
            $("#registerForm").validate({
                rules:{
                    name:{
                        required:true,
                        minlength:3,
                        lettersonly:true,
                    },
                    pass:{
                        required:true,
                        minlength:8,
                    },
                    email:{
                        required:true,
                        email: true,
                        remote: {
                            url: "{{ route('check.email.exist') }}",
                            type: "get"
                        }
                    },
                },
                messages:{
                    name:{
                        required: "please Enter your name",
                        minlength: "Your name must be atleast 3 characters long",
                        lettersonly: "Your name must contain only letter",
                    },
                    password: {
                        required: "Please provide your password",
                        minlength: "your password must be atleast 8 characters long",
                    },
                    email:{
                        required: "Please provide your Email",
                        minlength: "Please enter Your valid Email",
                        remote: "Email already exists!",
                    },
                },

            });


            // login validaion
            $("#loginForm").validate({
                rules:{
                    loginpassword:{
                        required:true,
                        minlength:8,
                    },
                    loginemail:{
                        required:true,
                        email: true,
                    },
                },
                messages:{
                    loginpassword: {
                        required: "Please provide your password",
                        minlength: "your password must be atleast 8 characters long",
                    },
                    loginemail:{
                        required: "Please provide your Email",
                        minlength: "Please enter Your valid Email",
                    },
                },

            });



            // password length
            $('#Password').passtrength({
                passwordToggle:true,
                eyeImg :"{{ asset('frontend/Visual-Password-Strength-Indicator-Plugin-For-jQuery-Passtrength-js/img/eye.svg') }}" // toggle icon
            });

            $('#Password').passtrength({
                tooltip:true,
                textWeak:"Weak",
                textMedium:"Medium",
                textStrong:"Strong",
                textVeryStrong:"Very Strong",
            });

        });
    </script>

@endpush
