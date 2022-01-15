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
                            <h4 class="card-title">Edit Cuisine</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="post" action="{{ route('cuisine.update', $id) }}" autocomplete="off">
                                    @csrf
                                    @method('PUT')
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
                                                                <div class="mb-3 input-success">
                                                                @empty($language->translation->language_id)
                                                                    <label>Reason</label>
                                                                    <div class="mb-3 input-success">
                                                                    <input type="text" class="form-control" name="value[{{ $language->iso_code }}]">
                                                                    </div>
                                                                    <label>Description</label>
                                                                    <div class="mb-3 input-success">
                                                                        <textarea class="form-control" rows="8" id="comment" name="description[{{ $language->iso_code }}]"></textarea>
                                                                    </div>
                                                                @endempty
                                                                @isset($language->translation->language_id)
                                                                    <label>Cuisine</label>
                                                                    <div class="mb-3 input-success">
                                                                    <input type="text" class="form-control" name="value[{{ $language->iso_code }}]" value="{{ $language->translation->value }}">
                                                                    </div>
                                                                    <label>Description</label>
                                                                    <div class="mb-3 input-success">
                                                                        <textarea class="form-control" rows="8" id="comment" name="description[{{ $language->iso_code }}]">{{ $language->translation->description }}</textarea>
                                                                    </div>
                                                                @endisset
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
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

  @endsection
