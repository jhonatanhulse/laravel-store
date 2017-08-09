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
                    @if ($products->total() > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>
                                            <button class="btn-link" onclick="window.location = '{{ route('products.edit', ['id' => $product->id]) }}'">Edit</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        No products found
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if ($products->lastPage() > 1)
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-right">
                {!! $products->links() !!}
            </div>
        </div>
    @endif
</div>
@endsection
