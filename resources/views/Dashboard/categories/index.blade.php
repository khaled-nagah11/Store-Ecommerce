@extends('layouts.dashboard-layout')
@section('title' , 'Categories')
@section('Breadcrumb')
    @parent
    <li class="breadcrumb-item active">
        Categories
    </li>
@endsection

@section('content')
    <div class="mb-4 text-center">
        <a href="{{route('dashboard.categories.create')}}" class="btn btn-success">Create Category</a>
    </div>
    <div class="card">
    <table class="table">
        <thead style="background-color: rgba(211, 211, 211, 0.5);">
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
            <td>{{$category->parent_id}}</td>
            <td>{{$category->created_at}}</td>
            <td>
                <a href="{{route('dashboard.categories.edit' ,[$category->id])}}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
                <form action="{{route('dashboard.categories.destroy',[$category->id])}}" method="post">
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
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@endsection
