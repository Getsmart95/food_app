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
                            <h4 class="card-title">Edit country</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="post" action="{{ route('country.update', $id) }}" autocomplete="off">
                                    @csrf
                                    @method('PUT')
                                    {{-- <label>Your vanity URL</label> --}}
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
                                                                <label>Country</label>
                                                                @empty($language->translation->language_id)
                                                                    <input type="text" class="form-control" name="value[{{ $language->iso_code }}]">
                                                                @endempty
                                                                @isset($language->translation->language_id)
                                                                    <input type="text" class="form-control" name="value[{{ $language->iso_code }}]" value="{{ $language->translation->value }}">
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
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label class="form-label">Code</label>
                                            <div class="input-group mb-3 input-success">
                                            <input type="text" class="form-control" name="code" value="{{ $country->code }}"> 
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                            <label class="form-label">Saving</label>
                                            <div class="mb-3">
                                                <button type="submit" style="width:100%; float: left; " class="btn btn-primary mb-2">Save</button>
                                            </div>
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
