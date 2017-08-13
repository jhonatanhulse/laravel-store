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

    @if ($errors->has('file'))
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-danger">
                    <strong>{{ $errors->first('file') }}</strong>

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
                <button data-toggle="modal" data-target="#import-modal" class="btn btn-primary">Import</button>
            </nav>
        </div>
    </div>

    <div id="import-modal" tabindex="-1" role="dialog" aria-labelledby="Import Products" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Import Products</h4>
                </div>

                <form method="POST" action="{{ route('products.import') }}" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file" class="col-md-4 control-label">CSV File (max: 5MB)</label>

                            <div class="col-md-6">
                                <input id="file" name="file" type="file" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
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
                                        <td>
                                            <form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn-link">Remove</button>
                                            </form>
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
