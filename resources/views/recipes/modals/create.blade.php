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
                                <form method="post" action="{{ route('recipe.store') }}" autocomplete="off">
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
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#tags"><i class="la me-2"></i> Tags</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="recipe" role="tabpanel">
                                                <div class="card col-xl-8 ">
                                                    {{-- <div class="card-header">
                                                        <h4 class="card-title">Recipe</h4>
                                                    </div> --}}
                                                    <div class="card-body">
                                                        <div class="custom-tab-1">
                                                            <ul class="nav nav-tabs" role="tablist">
                                                                @foreach ($languages as $language)
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" data-bs-toggle="tab" href="#{{ $language->iso_code }}"><i class="la me-2"></i>{{ $language->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <div class="tab-content">
                                                                @foreach ($languages as $language)
                                                                @if ($loop->first)
                                                                    <div class="tab-pane fade show active" id="{{ $language->iso_code }}" role="tabpanel">
                                                                @else
                                                                    <div class="tab-pane fade" id="{{ $language->iso_code }}" role="tabpanel">
                                                                @endif
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <label>Dish</label>
                                                                            <input type="hidden" name="language_id[]" value="{{ $language->iso_code }}">
                                                                            <div class="mb-3 input-success">
                                                                                <input type="text" class="form-control" name="value[]">
                                                                            </div>
                                                                            <label>Description</label>
                                                                            <div class="mb-3 input-success">
                                                                                <textarea class="form-control" rows="8" id="comment" name="description[]"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6 mb-3">
                                                                <label>Category</label>
                                                                <div class="mb-3 input-success">
                                                                    <select class="default-select form-control wide" name="food_category_key">
                                                                        @foreach ($categories as $category)
                                                                            <option value ="{{ $category->category_key }}">{{ $category->translation->value }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>                               
                                                            </div>
                                                            <div class="col-sm-6 mt-2 mt-sm-0 mb-3">
                                                                <label>Cuisine</label>
                                                                <div class="mb-3 input-success">
                                                                    <select class="default-select form-control wide" name="cuisine_key">
                                                                        @foreach ($cuisines as $cuisine)
                                                                        <option value ="{{ $cuisine->cuisine_key }}">{{ $cuisine->translation->value }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>         
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>Level of difficulty</label>
                                                                <div class="mb-3 input-success">
                                                                    <select class="default-select form-control wide" name="difficalty">
                                                                        @foreach ($difficulties as $difficulty)
                                                                        <option value ="{{ $difficulty->difficulty }}">{{ $difficulty->difficulty }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>                               
                                                            </div>
                                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                                <label>Cooking time</label>
                                                                <div class="mb-3 input-success">
                                                                    <select class="default-select form-control wide" name="cooking_time">
                                                                        <option value ="30">30 minutes</option>
                                                                        <option value ="45">45 minutes</option>
                                                                        <option value ="60">60 minutes</option>
                                                                        <option value ="75">75 minutes</option>
                                                                        <option value ="90">90 minutes</option>
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
                                                        <a type="button" style="float: right" class="btn btn-rounded btn-success" name="add" value="Add" id="addRemoveIp"><span
                                                            class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i>
                                                        </span>Add</a>
                                                        {{-- <input type="button" name="add" value="Add" id="addRemoveIp" class="btn btn-outline-dark"> --}}
                                                    </div>
                                                    <div class="card-body">
                                                        
                                                        <div class="table-responsive">
                                                            <table class="table" id="example">
                                                                <tr>
                                                                    <th>Food</th>
                                                                    <th>Weight</th>
                                                                    <th>Price</th>
                                                                    <th>Remove</th>
                                                                </tr>
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
                                                                            <th style="width: 10%">per 100g</th>
                                                                            <th style="width: 40%">Ratio</th>
                                                                            <th>%</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Calories</td>
                                                                            <td style="width: 80px"><input type="number" step="0.1" class="form-control" name="calories"></td>
                                                                            <td>
                                                                                <div class="progress" style="background: rgba(127, 99, 244, .1)">
                                                                                    <div class="progress-bar" style="width: 60%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td><span class="badge badge-dark light">70%</span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Fats</td>
                                                                            <td style="width: 80px"><input type="number" step="0.1" class="form-control" name="fats"></td>
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
                                                                            <td style="width: 80px"><input type="number" step="0.1" class="form-control" name="carbohydrates"></td>
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
                                                                            <td style="width: 80px"><input type="number" step="0.1" class="form-control" name="proteins"></td>
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
                                            <div class="tab-pane fade" id="tags">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Tags</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        
                                                        <div class="table-responsive">
                                                            <table class="table table-responsive-md" id="example">
                                                                <tr>
                                                                    <th>Food</th>
                                                                    <th>Weight</th>
                                                                    <th>Price</th>
                                                                    <th>Remove</th>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
<script>
    var i = 0;
    $("#addRemoveIp").click(function () {
        ++i;
        $("#example").append('<tr>'+
                                    '<td><div class="default-select"><select name="food[]" class="default-select form-control wide">'+
                                        '@foreach ($foods as $food)'+
                                        '<option value ="{{ $food->food_key }}"  class="default-select form-control wide">{{ $food->translation->value }}</option>'+
                                        '@endforeach'+
                                    '</select></div></td>'+
                                    '<td><input type="text" name="weight[]" class="form-control"/></td>'+
                                    '<td><input type="text" name="piece[]" class="form-control"/></td>'+
                                    '<td><input type="button" name="remove" value="Remove"  class="btn btn-outline-dark remove-item"></td>'+
                                '</tr>'); });
    $(document).on('click', '.remove-item', function () {
        $(this).parents('tr').remove();
    });
</script>
  @endsection
  
