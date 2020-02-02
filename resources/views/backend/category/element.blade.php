<div id="root">

    <div class="form-group"><label class="col-lg-2 control-label">Name<span class="required-star"> *</span></label>
        <div class="col-lg-10"><input value="{{ isset($category->name) ? $category->name:'' }}" id="slug-source" required="required" name="name" type="text" class="form-control">
        </div>
    </div>


    <div class="form-group"><label class="col-lg-2 control-label">Description</label>
        <div class="col-lg-10"><textarea name="description" class="form-control" rows="5">{{ isset($category->description) ? $category->description:'' }}</textarea></div>
    </div>

    <div class="form-group"><label class="col-lg-2 control-label">Parent Category</label>
        <div class="col-lg-5">
            <input value="{{ isset($category->parent) ? $category->parent->name:'Primary' }}" readonly="readonly" id="parent-category-name" style="cursor: not-allowed" required="required" type="text" class="form-control">
            <input type="hidden" name="parent_id" id="parent-category-id" value="">
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

    <div class="form-group"><label class="col-lg-2 control-label">Image</label>
        <div class="col-lg-5">
            <input type="file" name="img" class="form-control">
        </div>
    </div>

    <div class="form-group"><label class="col-lg-2 control-label">Preview</label>
        <div class="col-sm-2">
            <?php
            if (isset($category->image)){
                $image_url = URL::to('public/admin/uploads/images/categories/'.$category->image);
            }else{
                $image_url = URL::to('public/admin/img/no-image.png');
            }
            ?>
            <img src="{{ $image_url }}" alt="Image" class="preview_image" id="img-preview">
        </div>
    </div>

    <div class="form-group"><label class="col-lg-2 control-label" for="status">Status</label>
        <div class="col-lg-10">
            <input {{ (isset($category->status) AND $category->status == 1) ? 'checked':'' }} name="status" value="1" type="checkbox" class="i-checks" id="status">
        </div>
    </div>
</div>


<script>
    function setParentCategory(e) {
        $('#parent-category-name').val(e.getAttribute('category_name'));
        $('#parent-category-id').val(e.getAttribute('category_id'));
    }
    /*Show image preview*/
    function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var img=document.getElementById("img-preview");
            img.file = file;
            var reader = new FileReader();
            reader.onload = (function(img) {
                return function(e) {
                    img.src = e.target.result;
                };
            })(img);
            reader.readAsDataURL(file);
        }
    }
    /*Remove image preview*/
    function removePreview() {
        var img_preview = document.getElementById("img-preview");
        img_preview.src = "<?php echo $image_url ?>";
    }
</script>
