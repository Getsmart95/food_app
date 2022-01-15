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
                        <form method="post" action="{{ route('diet.store') }}" autocomplete="off">

                        <div class="card-header">
                            <h4 class="card-title">Append Diet</h4>
                            <div class="col-4">
                                <button type="submit" style="float: right" class="btn btn-primary mb-2">Save</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                    @csrf
                                    <div class="tab-pane fade show active" id="recipe" role="tabpanel">
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
                                                                <label>Diet</label>
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
                                        </div>
                                    </div>
                                    
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Basic Datatable</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="example" class="display" >
                                                    <thead>
                                                        <tr>
                                                            <th>Category</th>
                                                            <th>Food</th>
                                                            <th>Exclude</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($foods as $food)
                                                        <tr>
                                                            <td>{{ $food->food_category->value }}</td>
                                                            <td>{{ $food->translation->value }}</td>
                                                            <td><div class="form-check custom-checkbox mb-3 checkbox-warning check-xl">
                                                                <input type="checkbox" name="exclude[]" value={{ $food->translation->key }} class="form-check-input"  id="customCheckBox9">
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
