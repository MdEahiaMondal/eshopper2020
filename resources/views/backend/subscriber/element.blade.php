
 <div class="form-group">
     <label class="col-lg-2 control-label">Country<span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <input type="text" value="{{ isset($shippingCharge->country) ? $shippingCharge->country : old('country')}}" name="country" class="form-control">
         @error('country') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>

 <div class="form-group">
     <label class="col-lg-2 control-label">Shipping Charge<span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <input type="text" value="{{ isset($shippingCharge->shipping_charge) ? $shippingCharge->shipping_charge : old('shipping_charge')}}" name="shipping_charge" class="form-control">
         @error('shipping_charge') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>

 <div class="form-group">
     <label class="col-lg-2 control-label">Shipping Charge (0-500g)<span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <input type="text" value="{{ isset($shippingCharge->shipping_charge_0_500g) ? $shippingCharge->shipping_charge_0_500g : old('shipping_charge_0_500g')}}" name="shipping_charge_0_500g" class="form-control">
         @error('shipping_charge') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>

 <div class="form-group">
     <label class="col-lg-2 control-label">Shipping Charge (501-1000g)<span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <input type="text" value="{{ isset($shippingCharge->shipping_charge_501_1000g) ? $shippingCharge->shipping_charge_501_1000g : old('shipping_charge_501_1000g')}}" name="shipping_charge_501_1000g" class="form-control">
         @error('shipping_charge') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>

 <div class="form-group">
     <label class="col-lg-2 control-label">Shipping Charge (1001-2000g)<span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <input type="text" value="{{ isset($shippingCharge->shipping_charge_1001_2000g) ? $shippingCharge->shipping_charge_1001_2000g : old('shipping_charge_1001_2000g')}}" name="shipping_charge_1001_2000g" class="form-control">
         @error('shipping_charge') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>

 <div class="form-group">
     <label class="col-lg-2 control-label">Shipping Charge (2001-5000g)<span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <input type="text" value="{{ isset($shippingCharge->shipping_charge_2001_5000g) ? $shippingCharge->shipping_charge_2001_5000g : old('shipping_charge_2001_5000g')}}" name="shipping_charge_2001_5000g" class="form-control">
         @error('shipping_charge') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>


 <div class="form-group"><label class="col-lg-2 control-label" for="status">Status</label>
     <div class="col-lg-10">
         <input {{ (isset($shippingCharge->status) AND $shippingCharge->status == 1) ? 'checked':'' }} name="status" value="1" type="checkbox" class="i-checks" id="status">
     </div>
 </div>

