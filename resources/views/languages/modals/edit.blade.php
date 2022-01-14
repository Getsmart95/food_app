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
                            <h4 class="card-title">Edit language</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="post" action="{{ route('language.update', $iso) }}" autocomplete="off">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label class="form-label">Language</label>
                                            <div class="input-group mb-3 input-success">
                                                <input type="text" class="form-control" name="name" value="{{ $language->name }}"> 
                                            </div>                              
                                        </div>
                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                            <label class="form-label">ISO</label>
                                            <div class="input-group mb-3 input-success">
                                                <input type="text" class="form-control" name="iso_code" value="{{ $language->iso_code }}"> 
                                            </div>                                           
                                        </div>
                                    </div>
                                    <div class="col-16">
                                        <button type="submit" style="float: right" class="btn btn-primary mb-2">Save</button>
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
