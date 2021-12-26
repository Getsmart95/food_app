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
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="post" action="{{ route('country.store') }}" autocomplete="off">
                                    @csrf
                                    {{-- @method('POST') --}}
                                    {{-- <label>Your vanity URL</label> --}}  
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#recipe"><i class="la me-2"></i> Recipe</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#ingredient"><i class="la me-2"></i> Ingredients</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#energy"><i class="la me-2"></i> Energy</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="recipe" role="tabpanel">
                                                <div class="card col-xl-8 ">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Recipe</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <label>Complete dish name</label>
                                                        <div class="input-group mb-3 input-success">
                                                            <span class="input-group-text">Dish</span>
                                                            <input type="text" class="form-control" name="value[]">
                                                        </div>
                                                        <label>Enter description dish</label>
                                                        <div class="input-group mb-3 input-success">
                                                            <span class="input-group-text">Description</span>
                                                            <textarea class="form-control" rows="8" id="comment"></textarea>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>Enter description dish</label>
                                                                <div class="input-group mb-3 input-success">
                                                                    <span class="input-group-text">Category</span>
                                                                    <select class="default-select form-control wide" name="food_category_key">
                                                                        {{-- @foreach ($categories as $category) --}}
                                                                        <option value ="">Halal</option>
                                                                        {{-- @endforeach --}}
                                                                    </select>
                                                                </div>                               
                                                            </div>
                                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                                <label>Enter description dish</label>
                                                                <div class="input-group mb-3 input-success">
                                                                    <span class="input-group-text">Cuisine</span>
                                                                    <select class="default-select form-control wide" name="food_category_key">
                                                                        {{-- @foreach ($categories as $category) --}}
                                                                        <option value ="">Japan</option>
                                                                        {{-- @endforeach --}}
                                                                    </select>
                                                                </div>         
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>Enter description dish</label>
                                                                <div class="input-group mb-3 input-success">
                                                                    <span class="input-group-text">Difficult</span>
                                                                    <select class="default-select form-control wide" name="food_category_key">
                                                                        {{-- @foreach ($categories as $category) --}}
                                                                        <option value ="">Hard</option>
                                                                        {{-- @endforeach --}}
                                                                    </select>
                                                                </div>                               
                                                            </div>
                                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                                <label>Enter description dish</label>
                                                                <div class="input-group mb-3 input-success">
                                                                    <span class="input-group-text">Cooking time</span>
                                                                    <select class="default-select form-control wide" name="food_category_key">
                                                                        {{-- @foreach ($categories as $category) --}}
                                                                        <option value ="">30 minutes</option>
                                                                        {{-- @endforeach --}}
                                                                    </select>
                                                                </div>                                                            
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="ingredient">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Ingredients</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        
                                                        <div class="table-responsive">
                                                            <table id="example" class="display" >
                                                                <thead>
                                                                    <tr>
                                                                        {{-- <th style="width:40px;"><strong>#</strong></th> --}}
                                                                        <th>Category</th>
                                                                        <th>Food</th>
                                                                        <th>Include</th>
                                                                        <th>Weight</th>
                                                                        <th>Piece</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($foods as $food)
                                                                    <tr>
                                                                        {{-- <th>{{ $food->id }}</th> --}}
                                                                        <td>{{ $food->food_category->value }}</td>
                                                                        <td>{{ $food->translation->value }}</td>
                                                                        <td><div class="form-check custom-checkbox mb-3 checkbox-warning check-xl">
                                                                            <input type="checkbox" name="exclude[]" value={{ $food->translation->key }} class="form-check-input"  id="customCheckBox9">
                                                                            <label class="form-check-label" for="customCheckBox9"></label>
                                                                        </div></td>
                                                                        <td><input type="text" class="form-control" name="value[]"></td>
                                                                        <td><input type="text" class="form-control" name="value[]"></td>
                                                                        
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
                                            </div>
                                            <div class="tab-pane fade" id="energy">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Energies</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table header-border table-hover verticle-middle">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Product</th>
                                                                            <th style="width: 10%">Ratio</th>
                                                                            <th scope="col"></th>
                                                                            <th>per 100g</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Calories</td>
                                                                            <td style="width: 80px"><input type="number" step="0.1" class="form-control" name="value[]"></td>

                                                                            <td>
                                                                                <div class="progress" style="background: rgba(127, 99, 244, .1)">
                                                                                    <div class="progress-bar" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td><span class="badge badge-dark light">70%</span></td>
                                                                            {{-- <td><span class="badge badge-danger">7</span></td> --}}
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Fats</td>
                                                                            <td>
                                                                                <div class="progress" style="background: rgba(76, 175, 80, .1)">
                                                                                    <div class="progress-bar bg-success" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td><span class="badge badge-dark light">70%</span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Carbohydrates</td>
                                                                            <td>
                                                                                <div class="progress" style="background: rgba(70, 74, 83, .1)">
                                                                                    <div class="progress-bar bg-dark" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td><span class="badge badge-dark light">70%</span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Proteins</td>
                                                                            <td>
                                                                                <div class="progress" style="background: rgba(255, 87, 34, .1)">
                                                                                    <div class="progress-bar bg-danger" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td><span class="badge badge-danger">70%</span></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                        {{-- </div> --}}
                                    {{-- </div> --}}
                                    
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
