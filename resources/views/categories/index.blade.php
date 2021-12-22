@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Languages')])

@section('head')
    @parent
@endsection

@section('content')

<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 style="float: left">Categories</h2>
                            <a type="button" style="float: right" class="btn btn-rounded btn-success" href="{{ Route('category.create') }}"><span
                                class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i>
                            </span>Add</a>
                        </div>
                    </div>
                </div>
						
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                {{-- <h4 class="card-title">Recent Payments Queue</h4> --}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md" id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th style="width:80px;"><strong>#</strong></th>
                                                <th><strong>Category</strong></th>
                                                <th><strong>Created</strong></th>
                                                <th><strong>Updated</strong></th>
                                                <th><strong>Action</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                                <tr>
                                                    @isset($category->translation)
                                                        <td><strong>{{ $category->id }}</strong></td>
                                                        <td>{{ $category->translation->value }}</td>
                                                        <td>{{ $category->created_at}}</td>
                                                        <td>{{ $category->updated_at }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown">
                                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="{{ Route('category.getById', ['id' => $category->category_key]) }}">Edit</a>
                                                                    <form method="post" action="{{ Route('category.destroy', ['id' => $category->category_key]) }}" autocomplete="off">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    <button class="dropdown-item" type="submit">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    @endisset
                                                </tr>
                                            @endforeach
											
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
  @endsection