@extends('layouts.dashboard-layout')
@section('Breadcrumb')
    @parent
    <li class="breadcrumb-item active">
        <a href="{{route('dashboard.categories.index')}}">Categories</a>
        / Edit
    </li>
@endsection

@section('content')
    <div class="card card-dark">
        <!-- /.card-header -->
        <div class="card-header">
            <h3 class="card-title">Edit Category</h3>
        </div>
        <!-- form start -->
        <form action="{{route('dashboard.categories.update' ,$category->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data" >
            @csrf
            @method('put')
            @include('dashboard.categories._form', ['button_label'=>'Update'])
        </form>
    </div>






@endsection
