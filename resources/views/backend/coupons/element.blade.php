
 <div class="form-group">
     <label class="col-lg-2 control-label">Coupon Code<span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <input type="text" value="{{ isset($coupon->coupon_code) ? $coupon->coupon_code : old('coupon_code')}}" name="coupon_code" class="form-control">
         @error('coupon_code') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>


 <div class="form-group"><label class="col-lg-2 control-label">Amount <span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <input type="text" name="amount" class="form-control" value="{{ isset($coupon->amount) ? $coupon->amount : old('amount') }}">
         @error('amount') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>

 <div class="form-group"><label class="col-lg-2 control-label">Amount Type <span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <select name="amount_type" id="" class="form-control">
             <option value="percentage">Percentage</option>
             <option value="fixed">Fixed</option>
         </select>
         @error('amount_type') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>

 <div class="form-group"><label class="col-lg-2 control-label">Exipry Date <span class="required-star"> *</span></label>
     <div class="col-lg-6" id="data_3">

         <div class="input-group date">
             <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="exipry_date" class="form-control" value="{{ isset($coupon->exipre_date) ? $coupon->exipre_date : old('exipre_date') }}">
         </div>
         @error('exipry_date') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>
 <div class="form-group"><label class="col-lg-2 control-label" for="status">Status</label>
     <div class="col-lg-10">
         <input {{ (isset($coupon->status) AND $coupon->status == 1) ? 'checked':'' }} name="status" value="1" type="checkbox" class="i-checks" id="status">
     </div>
 </div>

