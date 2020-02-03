
 <div class="form-group">
    <label class="col-lg-2 control-label">Product Name<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <input type="text" value="{{ isset($product->name) ? $product->name : old('name')}}" name="name" class="form-control">
        @error('name') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>


 <div class="form-group">
    <label class="col-lg-2 control-label">Buy Price<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <input type="text" value="{{ isset($product->buy_price) ? $product->buy_price : old('buy_price')}}" name="buy_price" class="form-control">
        @error('buy_price') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

 <div class="form-group">
    <label class="col-lg-2 control-label">Sell Price<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <input type="text" value="{{ isset($product->sell_price) ? $product->sell_price : old('sell_price')}}" name="sell_price" class="form-control">
        @error('sell_price') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

 <div class="form-group">
    <label class="col-lg-2 control-label">Tax<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <input type="text" value="{{ isset($product->tax) ? $product->tax : old('tax')}}" name="tax" class="form-control">
        @error('tax') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

 <div class="form-group">
    <label class="col-lg-2 control-label">Discount percentage<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <input type="text" value="{{ isset($product->discount) ? $product->discount : old('discount')}}" name="discount" class="form-control">
        @error('discount') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

 <div class="form-group">
    <label class="col-lg-2 control-label">Product Deception<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <textarea name="deception" class="form-control" id="" cols="30" rows="10">
            {{ isset($product->deception) ? $product->deception : old('deception')}}
        </textarea>
        @error('deception') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>
