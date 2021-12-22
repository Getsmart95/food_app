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
                            <h4 class="card-title">Edit Food</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="post" action="{{ route('food.update', $id) }}" autocomplete="off">
                                    @csrf
                                    @method('PUT')
                                    {{-- <label>Your vanity URL</label> --}}
                                    @foreach ($languages as $language)
                                        <div class="input-group mb-3  input-success">
											<span class="input-group-text">{{ $language->iso_code }}</span>
                                            <input type="hidden" class="form-control" name="id" value="{{ $id }}">
                                            @empty($language->translation->language_id)
                                                <input type="text" class="form-control" name="value[{{ $language->iso_code }}]">
                                            @endempty
                                            @isset($language->translation->language_id)
                                                <input type="text" class="form-control" name="value[{{ $language->iso_code }}]" value="{{ $language->translation->value }}">
                                            @endisset
                                        </div>
                                    @endforeach
                                    <label>Choose food category</label>
                                    <div class="input-group mb-3 input-success">
                                        <span class="input-group-text">Category</span>
                                        <select class="default-select form-control wide" name="food_category_key">
                                            @foreach ($categories as $category)
                                            <option value ="{{ $category->food_category_key }}" {{ $category->food_category_key === $food->food_category_key  ? 'selected' : null }}>{{ $category->translation->value }}</option>
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
