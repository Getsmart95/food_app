@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Languages')])

@section('head')
    @parent
@endsection

@section('content')
    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
                <div class="col-xl-6 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Food</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="post" action="{{ route('food.store') }}" autocomplete="off">
                                    @csrf
                                    {{-- @method('POST') --}}

                                    @foreach ($languages as $language)
                                    <div class="input-group mb-3  input-success">
                                        <span class="input-group-text">{{ $language->name }}</span>
                                        <input type="hidden" name="language_code[]" value="{{ $language->code }}">
                                        <input type="text" class="form-control" name="value[]"> 
                                    </div>
                                    @endforeach
                                    
                                    {{-- <div class="input-group mb-3 input-group-text"> --}}
                                    <label>Choose food category</label>
                                    <div class="input-group mb-3 input-success">
                                        <span class="input-group-text">Category</span>
                                        <select class="default-select form-control wide" name="food_category_id">
                                            @foreach ($categories as $category)
                                            <option value ="{{ $category->name }}">{{ $category->translation->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-16">
                                        <button type="submit" style="float: right" class="btn btn-primary mb-2">Save</button>
                                    </div>
                                    </div>
                                </form>
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