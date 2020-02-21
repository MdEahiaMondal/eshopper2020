
 <div class="form-group">
     <label class="col-lg-2 control-label">Type<span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <select name="type" id="type" class="form-control">
             <option {{ (isset($admin->type) AND $admin->type == 'admin') ? 'selected':'' }} value="admin">Admin</option>
             <option {{ (isset($admin->type) and $admin->type == 'sub-admin') ? 'selected' : '' }} value="sub-admin">Sub-Admin</option>
         </select>
         @error('country') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>

 <div class="form-group">
     <label class="col-lg-2 control-label">Username<span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <input type="text" value="{{ isset($admin->username) ? $admin->username : old('username')}}" name="username" class="form-control">
         @error('username') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>

@php
    $editUrl = preg_match("/edit/i",Request::url());
@endphp
 @if(isset($editUrl) and $editUrl !== 1)
     <div class="form-group">
         <label class="col-lg-2 control-label">Password<span class="required-star"> *</span></label>
         <div class="col-lg-6">
             <input type="password" value="" name="password" class="form-control">
             @error('password') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
         </div>
     </div>
 @endif



 <div class="form-group" id="hideMe">
     <label class="col-lg-2 control-label">Access<span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <input type="checkbox" {{ (isset($admin->product_access) and $admin->product_access == 1) ? 'checked' : '' }} name="product_access" value="1" id="" class="i-checks"> product
         &nbsp;
         <input type="checkbox" {{ (isset($admin->category_access) and $admin->category_access == 1) ? 'checked': '' }} name="category_access" value="1" id="" class="i-checks"> category
         &nbsp;
         <input type="checkbox" {{ (isset($admin->order_access) and $admin->order_access == 1) ? 'checked' : '' }} name="order_access" value="1" id="" class="i-checks"> order
         &nbsp;
         <input type="checkbox" {{ (isset($admin->coupon_access) and $admin->coupon_access == 1) ? 'checked' : '' }} name="coupon_access" value="1" id="" class="i-checks"> coupon
     </div>
 </div>

 <div class="form-group"><label class="col-lg-2 control-label" for="status">Status</label>
     <div class="col-lg-10">
         <input {{ (isset($admin->status) AND $admin->status == 1) ? 'checked':'' }} name="status" value="1" type="checkbox" class="i-checks" id="status">
     </div>
 </div>

