
 <div class="form-group">
     <label class="col-lg-2 control-label">Product Name<span class="required-star"> *</span></label>
     <div class="col-lg-6">
         <input type="text" value="{{ isset($product->name) ? $product->name : old('name')}}" name="name" class="form-control">
         @error('name') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>

 <div class="form-group"><label class="col-lg-2 control-label">Category Name</label>
     <div class="col-lg-5">
         <input value="{{ isset($category->parent) ? $category->parent->name:'Primary' }}" readonly="readonly" id="parent-category-name" style="cursor: not-allowed" required="required" type="text" class="form-control">
         <input type="hidden" name="category_id" id="parent-category-id" value="">
         @error('catrgory_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
     <div class="col-lg-5">
         <a data-toggle="modal" class="btn btn-primary" href="#modal-form">Select</a>
     </div>
 </div>


 <!-- The Modal -->
 <div id="modal-form" class="modal fade" aria-hidden="true">
     <div class="modal-dialog">
         <div class="ibox float-e-margins">
             <div class="ibox-title">
                 <h5>Select parent category</h5>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <div class="ibox-content">

                 {{--Tree function--}}
                 @php
                     $GLOBALS['current_category_parent_id'] = isset($category->parent)?$category->parent->id:'';
                     function tree($main_category, $category_id){
                         $selected_category_class = ($main_category->id == $GLOBALS['current_category_parent_id'])?'selected_category':'';
                         if(count($main_category['children']) > 0 ){
                             echo "<li><span class='$selected_category_class' data-dismiss='modal' category_name='$main_category->name' category_id='$main_category->id' onclick='setParentCategory(this)'>".ucfirst($main_category['name']).
                                 "</span><ul>";
                             foreach($main_category['children'] as $main_category){
                                 if ($main_category->id != $category_id){
                                     tree($main_category, $category_id);
                                 }
                             }
                             echo "</ul>
                                 </li>";
                         }else{
                             echo "<li data-jstree=\"'type':'html'}\"><span class='$selected_category_class' data-dismiss='modal' category_name='$main_category->name' category_id='$main_category->id' onclick='setParentCategory(this)'>" .ucfirst($main_category['name'])."</span></li>";
                         }
                     }
                 @endphp

                 {{--Tree--}}
                 <div id="jstree1">

                     @if (count($main_categories) > 0)

                         @php($category_id = isset($category)?$category->id:0)

                         <ul>
                             <li class="{{ ($GLOBALS['current_category_parent_id'] == '')?'selected_category':'' }}" data-jstree=\"'type':'html'}\"><span data-dismiss='modal' category_name='Primary' category_id='' onclick='setParentCategory(this)'>Primary</span></li>;
                             @foreach ($main_categories as $main_category)
                                 @if($main_category->id != $category_id)
                                     @php(tree($main_category, $category_id))
                                 @endif
                             @endforeach
                         </ul>
                     @endif

                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="form-group"><label class="col-lg-2 control-label">Color</label>
     <div class="col-lg-6">
         <input type="text" name="color" class="form-control" value="{{ isset($product->color) ? $product->color : old('color') }}">
         @error('color') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>

 <div class="form-group"><label class="col-lg-2 control-label">Price</label>
     <div class="col-lg-6">
         <input type="text" name="price" class="form-control" value="{{ isset($product->price) ? $product->price : old('price') }}">
         @error('price') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>

 <div class="form-group"><label class="col-lg-2 control-label">Product Code</label>
     <div class="col-lg-6">
         <input type="text" name="code" class="form-control" value="{{ isset($product->code) ? $product->price : old('code') }}">
         @error('code') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>
 <div class="form-group"><label class="col-lg-2 control-label">Weight (g)</label>
     <div class="col-lg-6">
         <input type="text" name="weight" class="form-control" value="{{ isset($product->weight) ? $product->weight : old('weight') }}">
         @error('weight') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>


<div class="form-group">
    <label class="col-lg-2 control-label">Product Description<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <textarea name="details" class="form-control">
            {{ isset($product->details) ? $product->details :   old('details')}}
        </textarea>
        @error('deception') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Materials & Care<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <textarea name="care" class="form-control">
            {{ isset($product->care) ? $product->care :   old('care')}}
        </textarea>
        @error('deception') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

 <div class="form-group"><label class="col-lg-2 control-label">Image</label>
     <div class="col-lg-6">
         <input type="file" name="img" class="form-control">
         @error('img') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
     </div>
 </div>


 <div class="form-group"><label class="col-lg-2 control-label" for="status">Status</label>
     <div class="col-lg-10">
         <input {{ (isset($product->status) AND $product->status == 1) ? 'checked':'' }} name="status" value="1" type="checkbox" class="i-checks" id="status">
     </div>
 </div>

 <script >
     function setParentCategory(e) {
         $('#parent-category-name').val(e.getAttribute('category_name'));
         $('#parent-category-id').val(e.getAttribute('category_id'));
     }
 </script>

