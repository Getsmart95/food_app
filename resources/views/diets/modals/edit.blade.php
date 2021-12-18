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
                <div class="col-lg-12">
                    <div class="card">
                        <form method="post" action="{{ route('diet.update', $id) }}" autocomplete="off">

                        <div class="card-header">
                            <h4 class="card-title">Add Diet</h4>
                            <div class="col-4">
                                <button type="submit" style="float: right" class="btn btn-primary mb-2">Save</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                    @csrf
                                    @method('PUT')
                                    {{-- <label>Your vanity URL</label> --}}
                                    @foreach ($languages as $language)
                                        <div class="input-group mb-3  input-success">
                                            <span class="input-group-text">{{ $language->code }}</span>
                                            <input type="hidden" class="form-control" name="id" value="{{ $id }}">
                                            @empty($language->translation->language_code)
                                                <input type="text" class="form-control" name="language_code[{{ $language->code }}]">
                                            @endempty
                                            @isset($language->translation->language_code)
                                                <input type="text" class="form-control" name="language_code[{{ $language->code }}]" value="{{ $language->translation->value }}">
                                            @endisset
                                        </div>
                                    @endforeach
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Basic Datatable</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="example" class="display" >
                                                    <thead>
                                                        <tr>
                                                            <th style="width:40px;"><strong>#</strong></th>
                                                            <th>Category</th>
                                                            <th>Food</th>
                                                            <th>Exclude</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($foods as $food)
                                                        <tr>
                                                            <th>{{ $food->id }}</th>
                                                            <td>{{ $food->food_category->value }}</td>
                                                            <td>{{ $food->translation->value }}</td>
                                                            <td><div class="form-check custom-checkbox mb-3 checkbox-warning check-xl">
                                                       
                                                                @empty($food->diet_foods)
                                                                <input type="checkbox" name="exclude[]" value={{ $food->translation->id }} class="form-check-input"  id="customCheckBox9">
                                                                @endempty
                                                                @isset($food->diet_foods)
                                                                <input type="checkbox" name="exclude[]" value={{ $food->translation->id }} checked class="form-check-input"  id="customCheckBox9">
                                                                @endisset
                                                              
                                                                <label class="form-check-label" for="customCheckBox9"></label>
                                                            </div></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    {{-- <tfoot>
                                                        <tr>
                                                            <th style="width:40px;"><strong>#</strong></th>
                                                            <th>Food</th>
                                                            <th>Category</th>
                                                            <th>Exclude</th>
                                                        </tr>
                                                    </tfoot> --}}
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-4">
                                        <button type="submit" style="float: right" class="btn btn-primary mb-2">Save</button>
                                    </div> --}}
                                    
                                    
                                    </div>
                            </div>
                        </form>

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
