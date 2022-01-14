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
                            <h4 class="card-title">Append Tag</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="post" action="{{ route('tag.store') }}" autocomplete="off">
                                    @csrf
                                    {{-- @method('POST') --}}
                                    @foreach ($languages as $language)
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">{{ $language->name }}</h4>
                                        </div>
                                        <div class="card-body">
                                    <div class="mb-3 input-success">
                                        <label class="form-label">Tag</label>
                                        <input type="hidden" name="language_id[]" value="{{ $language->iso_code }}">
                                        <input type="text" class="form-control" name="value[]">
                                    </div>
                                    <div class="mb-3 input-success">
                                        <label class="form-label">Description</label>
                                        <div class="input-group mb-3 input-success">
                                            <input type="text" class="form-control" name="description[]"> 
                                        </div>                              
                                    </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    
                                    {{-- <div class="row">
                                        <div class="col-sm-6">
                                            <label class="form-label">Tag</label>
                                            <div class="input-group mb-3 input-success">
                                                <input type="text" class="form-control" name="tag"> 
                                            </div>                              
                                        </div>
                                    </div> --}}
                                    
                                    
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
