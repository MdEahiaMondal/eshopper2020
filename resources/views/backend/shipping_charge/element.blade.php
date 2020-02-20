
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


 <div class="form-group"><label class="col-lg-2 control-label" for="status">Status</label>
     <div class="col-lg-10">
         <input {{ (isset($shippingCharge->status) AND $shippingCharge->status == 1) ? 'checked':'' }} name="status" value="1" type="checkbox" class="i-checks" id="status">
     </div>
 </div>

