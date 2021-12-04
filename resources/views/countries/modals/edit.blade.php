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
                                    <label>Your vanity URL</label>

                                    @foreach ($translates as $translate)
                                    <div class="input-group mb-3  input-success">
                                        <input type="text" class="form-control" name="value[]" value="{{ $translate->value }}">
                                        <input type="text" class="form-control" name="language_code[]" value="{{ $translate->language_code }}">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                        {{-- <span class="input-group-text">{{ $translate->value }}</span>
                                        <input type="text" class="form-control" name="value[]">
                                        <input type="text" class="form-control" name="language_code[]" value="{{ $language->code }}"> --}}
                                        
                                    </div>
                                    @endforeach
                                    
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
