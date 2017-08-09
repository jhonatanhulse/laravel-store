@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('alert'))
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-{{ session('alert')['type'] }}">
                    {{ session('alert')['message'] }}

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <nav class="navbar text-right">
                <a href="{{ route('products.create') }}" class="btn btn-success">Create</a>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Product List</div>
                <div class="panel-body">
                    No products found
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
