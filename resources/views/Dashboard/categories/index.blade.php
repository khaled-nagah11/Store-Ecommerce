@extends('layouts.dashboard-layout')
@section('title' , 'Categories')
@section('Breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
    <div class="mb-5 text-center">
        <a href="{{route('categories.create')}}" class="btn btn-success">Create Category</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Created At</th>
            <th colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
        <tr>
            <td></td>
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>{{$category->parent}}</td>
            <td>{{$category->created_at}}</td>
            <td>
                <a href="{{route('categories.edit')}}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
                <form action="{{route('categories.destroy')}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>

        </tr>
        @empty
            <tr>
                <td colspan="7" class="text-danger" >No Categories Defined!</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
