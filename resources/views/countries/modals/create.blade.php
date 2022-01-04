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
                            <h4 class="card-title">Add country</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="post" action="{{ route('country.store') }}" autocomplete="off">
                                    @csrf
                                    {{-- @method('POST') --}}
                                    {{-- <label>Your vanity URL</label> --}}

                                    @foreach ($languages as $language)
                                    <div class="mb-3 input-success">
                                        {{-- <span class="input-group-text">{{ $language->name }}</span> --}}
                                        <label class="form-label">{{ $language->name }}</label>
                                        <input type="hidden" name="language_id[]" value="{{ $language->iso_code }}">
                                        <input type="text" class="form-control" name="value[]">
                                    </div>
                                    @endforeach
                                    <div class="mb-3  input-success">
                                        <label class="form-label">Code</label>
                                        <input type="text" class="form-control" name="code"> 
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
