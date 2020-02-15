
 <div class="form-group">
     <label class="col-lg-2 control-label">Currency Code<span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <input type="text" value="{{ isset($currencie->currency_code) ? $currencie->currency_code : old('currency_code')}}" name="currency_code" class="form-control">
         @error('currency_code') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>


 <div class="form-group"><label class="col-lg-2 control-label">Exchange Rate <span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <input type="text" name="exchange_rate" class="form-control" value="{{ isset($currencie->exchange_rate) ? $currencie->exchange_rate : old('exchange_rate') }}">
         @error('exchange_rate') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>


 <div class="form-group"><label class="col-lg-2 control-label" for="status">Status</label>
     <div class="col-lg-10">
         <input {{ (isset($currencie->status) AND $currencie->status == 1) ? 'checked':'' }} name="status" value="1" type="checkbox" class="i-checks" id="status">
     </div>
 </div>

