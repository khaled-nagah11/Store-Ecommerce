@extends('layouts.dashboard-layout')
@section('Breadcrumb')
    @parent
    <li class="breadcrumb-item active">
        <a href="{{route('categories.index')}}">Categories</a>
        / Create
    </li>
@endsection

@section('content')
    <div class="card card-primary">
        <!-- /.card-header -->
        <div class="card-header">
            <h3 class="card-title">Create Category</h3>
        </div>
        <!-- form start -->
        <form action="{{route('categories.store')}}" method="post" class="form-horizontal" >
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="category-name" class="col-sm-2 col-form-label">Category Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="category-name" placeholder="name...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category-parent" class="col-sm-2 col-form-label">Category Parent</label>
                    <div class="col-sm-10">
                        <select name="parent_id" class="form-control select2 select2-hidden-accessible" id="category-parent">
                            <option value="" style="padding:6px 12px;">Main Category</option>
                        @foreach($parents as $parent)
                                <option value="{{$parent->id}}">{{$parent->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category-desc" class="col-sm-2 col-form-label">Category Description</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" name="description" id="category-desc" placeholder="description..."></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category-img" class="col-sm-2 col-form-label">Category Image</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="image" id="category-img">
                    </div>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="active" checked id="radio1">
                        <label class="form-check-label" for="radio1">Active</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="archived" id="radio2">
                        <label class="form-check-label" for="radio2">Archived</label>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary px-5 py-2"> Save </button>
            </div>
        </form>
    </div>






@endsection
