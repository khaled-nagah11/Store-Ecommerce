<div class="card-body">
    <div class="form-group row">
        <label for="category-name" class="col-sm-2 col-form-label">Category Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$category->name}}" id="category-name" placeholder="name...">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="category-parent" class="col-sm-2 col-form-label">Category Parent</label>
        <div class="col-sm-10">
            <select name="parent_id" class="form-control select2 select2-hidden-accessible" id="category-parent">
                <option value="" style="padding:6px 12px;">Main Category</option>
                @foreach($parents as $parent)
                    <option value="{{$parent->id}}" @selected($category->parent_id == $parent->id)>{{$parent->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="category-desc" class="col-sm-2 col-form-label">Category Description</label>
        <div class="col-sm-10">
            <textarea type="text" class="form-control" name="description"  id="category-desc" placeholder="description...">{{$category->description}}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="category-img" class="col-sm-2 col-form-label">Category Image</label>
        <div class="col-sm-10">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="category-img" name="image" accept="image/*">
                <label class="custom-file-label" for="category-img">Choose file</label>
                @if($category->image)
                    <img src="{{asset('storage/' . $category->image)}}" alt="cat_img" height="60">
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Status</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="active" @checked($category->status == 'active') id="radio1">
            <label class="form-check-label" for="radio1">Active</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="archived" @checked($category->status == 'archived') id="radio2">
            <label class="form-check-label" for="radio2">Archived</label>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-dark px-5 py-2"> {{$button_label ?? 'save'}} </button>
</div>
