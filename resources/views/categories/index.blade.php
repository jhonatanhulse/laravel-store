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
                <a href="{{ route('categories.create') }}" class="btn btn-success">Create</a>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Category List</div>
                <div class="panel-body">
                    @if ($categories->total() > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        No categories found
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if ($categories->lastPage() > 1)
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-right">
                {!! $categories->links() !!}
            </div>
        </div>
    @endif
</div>
@endsection
