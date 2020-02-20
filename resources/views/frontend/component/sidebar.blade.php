@php
    $categories = App\Category::with('children')->where('parent_id', '=', null)->get();
    $colors = \App\Product::distinct('color')->pluck('color');
@endphp

<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <div class="panel panel-default">

                @foreach($categories as $category)
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordian" href="#{{ $category->id }}">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                {{ $category->name }}
                            </a>
                        </h4>
                    </div>
                    <div id="{{ $category->id }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach($category->children as $subCat)
                                    <li><a href="{{ route('products',$subCat->slug) }}"> {{ $subCat->name }} </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div><!--/category-products-->

        <div class="brands_products"><!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                    <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                    <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
                    <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
                    <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
                    <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
                    <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                </ul>
            </div>
        </div><!--/brands_products-->

        @php
            $colorArr = explode('-', request('color'));
        @endphp

        <form action="{{ route('product.color.filter') }}" method="get">
            <div class="brands_products"><!--color filter-->
                <h2>Color</h2>
                <div class="panel panel-default">
                    <div class="panel-body">
                        @foreach($colors as $color)
                            <div class="checkbox">
                                <input type="checkbox" @if(!empty($colorArr) && in_array($color, $colorArr)) checked @endif id="{{ $color }}" onchange="javascript:this.form.submit();" name="colorFilter[]" value="{{ $color }}">
                                <label style="color: {{ $color }}" for="{{ $color }}">{{ $color }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div><!--/end color filter-->

        </form>

        <div class="price-range"><!--price-range-->
            <h2>Price Range</h2>
            <div class="well text-center">
                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div><!--/price-range-->

        <div class="shipping text-center"><!--shipping-->
            <img src="images/home/shipping.jpg" alt="" />
        </div><!--/shipping-->
    </div>
</div>
