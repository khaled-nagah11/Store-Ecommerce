@extends('layouts.dashboard-layout')
@section('Breadcrumb')
    @parent
    <li class="breadcrumb-item active">
        <a href="{{route('dashboard.categories.index')}}">Categories</a>
        / Create
    </li>
@endsection

@section('content')
    <div class="card card-dark">
        <!-- /.card-header -->
        <div class="card-header">
            <h3 class="card-title">Create Category</h3>
        </div>
        <!-- form start -->
        <form action="{{route('dashboard.categories.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" >
            @csrf
            @include('dashboard.categories._form' , ['button_label'=>'Create'])
        </form>
    </div>






@endsection
