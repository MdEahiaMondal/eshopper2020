
 <div class="form-group">
     <label class="col-lg-2 control-label">Title<span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <input type="text" value="{{ isset($cms_page->title) ? $cms_page->title : old('title')}}" name="title" class="form-control">
         @error('title') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>


 <div class="form-group">
     <label class="col-lg-2 control-label">Description<span class="required-star"> *</span></label>
     <div class="col-lg-6">
        <textarea name="description" class="form-control">
            {{ isset($cms_page->description) ? $cms_page->description :   old('description')}}
        </textarea>
         @error('description') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>



 <div class="form-group">
     <label class="col-lg-2 control-label">Image<span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <input type="file"  name="img" class="form-control">
         @error('img') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>




 <div class="form-group"><label class="col-lg-2 control-label" for="status">Status</label>
     <div class="col-lg-10">
         <input {{ (isset($cms_page->status) AND $cms_page->status == 1) ? 'checked':'' }} name="status" value="1" type="checkbox" class="i-checks" id="status">
     </div>
 </div>

