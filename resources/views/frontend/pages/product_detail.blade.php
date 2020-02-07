@extends('frontend.master.master')

@section('title', 'Product Detail')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/easyzoom/css/easyzoom.css') }}" />
@endpush


@section('content')

    <section>
        <div class="container">
            <div class="row">

                @include('frontend.component.sidebar')

                <div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                    <a href="{{ asset('backend/uploads/images/product/large/'.$product->image) }}">
                                        <img width="300" id="mainImage" src="{{ asset('backend/uploads/images/product/medium/'.$product->image) }}" alt="" />
                                    </a>
                                </div>
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active thumbnails">
                                        @foreach($product->productImages as $image)
                                            <a href="{{ asset('backend/uploads/images/product/large/'.$image->image) }}" data-standard="{{ asset('backend/uploads/images/product/small/'.$image->image) }}">
                                                <img class="alternateImage" width="90" src="{{ asset('backend/uploads/images/product/small/'.$image->image) }}" alt="">
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-7">
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <div class="product-information"><!--/product-information-->
                                    <img src="{{ asset('frontend/images/product-details/new.jpg') }}" class="newarrival" alt="" />
                                    <h2>{{ $product->name }}</h2>
                                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="product_name" id="" value="{{ $product->name }}">
                                    <input type="hidden" name="color" id="" value="{{ $product->color }}">
                                    <input type="hidden" name="price" id="productPrice" value="{{ $product->price }}">
                                    <p>Code: {{ $product->code }}</p>
                                    <select name="productSize" required id="idSize" style="width: 120px">
                                        <option value="">Select Size</option>
                                        @foreach($product->attributes as $attribute)
                                            <option value="{{ $product->id }}-{{ $attribute->size }}">{{ $attribute->size }}</option>
                                        @endforeach
                                    </select>
                                    @error('productSize')
                                    <span  class="text-danger">{{ $message }}</span>
                                    @enderror<br>
                                    {{--<img src="{{ asset('frontend/images/product-details/rating.png') }}" alt="" />--}}
                                    <span>
									<span id="getPrice">TK : {{ $product->price }}</span>
									<label>Quantity:</label>
									<input type="number" name="quantity" value="1" />
                                    @if($product_stock > 0)
                                            <button type="submit" id="addToCart" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									    </button>
                                        @endif
								</span>
                                    <p><b>Availability:</b> <span id="outOfStock">@if($product_stock > 0) <label style="color: green">In Stock</label> @else <label style="color: red"> Out of Stock</label>  @endif</span> </p>
                                    <p><b>Condition:</b> New</p>
                                    <p><b>Brand:</b> E-SHOPPER</p>
                                    <p><b>Delevary:</b> <input name="post_code" required id="post_code" type="text"><button onclick="checkPostCode()" type="button">Go</button></p>
                                    <div id="resultcode"></div>
                                    <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                                </div><!--/product-information-->
                            </form>

                        </div>
                    </div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li><a href="#details" data-toggle="tab">Details</a></li>
                                <li><a href="#care" data-toggle="tab">Material & Care</a></li>
                                <li><a href="#tag" data-toggle="tab">Delevery</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade" id="details" >
                                <div class="col-sm-12">
                                    <p>{{ $product->details }}</p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="care" >
                                <div class="col-sm-12">
                                    <p>{{ $product->care }}</p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tag" >
                                <div class="col-sm-12">
                                    <p>100% qualityfull product</p>
                                </div>
                            </div>
                        </div>
                    </div><!--/category-tab-->

                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">recommended items</h2>

                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @php $count = 1; @endphp
                                @foreach($relatedProducts->chunk(3) as $chunk)
                                    <div class="item {{ $count === 1 ? 'active' : '' }} ">
                                        @foreach($chunk as $relatedProduct)
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img width="200" src="{{ asset('backend/uploads/images/product/small/'.$relatedProduct->image) }}" alt="" />
                                                        <h2>TK {{ $relatedProduct->price }}</h2>
                                                        <p>{{ $relatedProduct->name }}</p>
                                                        <a href="{{ route('product.detail',$relatedProduct->slug) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @php $count++; @endphp
                                @endforeach


                            </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div><!--/recommended_items-->

                </div>
            </div>
        </div>
    </section>

@endsection



@push('script')

    <script src="{{ asset('frontend/easyzoom/js/easyzoom.js') }}"></script>
    <script>
        // Instantiate EasyZoom instances
        var $easyzoom = $('.easyzoom').easyZoom();

        // Setup thumbnails example
        var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

        $('.thumbnails').on('click', 'a', function(e) {
            var $this = $(this);

            e.preventDefault();

            // Use EasyZoom's `swap` method
            api1.swap($this.data('standard'), $this.attr('href'));
        });

        // Setup toggles example
        var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

        $('.toggle').on('click', function() {
            var $this = $(this);

            if ($this.data("active") === true) {
                $this.text("Switch on").data("active", false);
                api2.teardown();
            } else {
                $this.text("Switch off").data("active", true);
                api2._init();
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#idSize").change(function () {
                var idSize = $(this).val();
                if(idSize === ''){
                    $("#getPrice").html('TK : ' + "{{ $product->price }}")
                }else{
                    $.ajax({
                        url: "{{ route('get.product.price') }}",
                        data:{idSize:idSize},
                        success:function (res) {
                            if(res[1] == 0){
                                $("#outOfStock").html("<label style='color: red'>Out of Stock</label>");
                                $("#addToCart").hide();
                            }else{
                                $("#outOfStock").html("<label style='color: green'>In Stock</label>");
                                $("#addToCart").show();
                            }
                            $("#getPrice").html('TK : ' + res[0]);
                            $("#productPrice").val(res[0]);
                        }
                    });
                }
            });
            // click on small image and show
            $(".alternateImage").click(function () {
                var imglink = $(this).attr('src');
                $("#mainImage").attr('src',imglink)
            });
        });


        // check post code
        function checkPostCode() {
            var post_code = $("#post_code").val();
            if(post_code == '')
            {
                alert('Please enter your postal code')
            }

            $.ajax({
                url: "{{ route('check.postal_code') }}",
                type: "post",
                data: {
                    post_code: post_code,
                },
                success: function (res) {
                    if (res == 'true')
                    {
                        $("#resultcode").html("<p style='color: mediumseagreen'>This code is available</p>")
                    }else{
                        $("#resultcode").html("<p style='color: crimson'>This code is not available</p>")
                    }
                },
                error: function (res) {
                    alert('Error')
                }

            })
        }


    </script>

@endpush
