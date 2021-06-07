@extends('layouts.back')
@section('title')
    Settings |
@endsection
@section('content')
<div class="container">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <div class="alert alert-custom alert-{{ $msg }} fade show mb-5" role="alert">                           
                    <div class="alert-text">{{ Session::get($msg) }}</div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="ki ki-close"></i>
                            </span>
                        </button>
                    </div>
                </div>
            @endif 
        @endforeach
    <div class="shadow vw-50 p-5">
        <form action="{{ route('admin.settings.loan') }}" method="POST">
            @csrf()
            <!-- Price Down Limit Percentage -->
            <div class="form-group">
                <label class="text-dark">Price Down Limit (%)</label>
                <input type="number" min="1" max="100" class="form-control" id="loan_price_down_limit" name="loan_price_down_limit" value="{{ $settingValue['loan_price_down_limit'] }}">
                @error('loan_price_down_limit')
                <p class="invalid-value" role="alert">
                    <strong>{{ __($message) }}</strong>
                </p>
                @enderror
            </div>

            <!-- Price Down Limit Percentage -->
            <div class="form-group">
                <label class="text-dark">Min & Max (%)</label>
                <div class="row">
                    <div class="col">
                        <input type="number" min="1" max="100" class="form-control" id="loan_min_percentage" name="loan_min_percentage" value="{{ $settingValue['loan_min_percentage'] }}">
                        @error('loan_min_percentage')
                        <p class="invalid-value" role="alert">
                            <strong>{{ __($message) }}</strong>
                        </p>
                        @enderror
                    </div>
                    <div class="col">
                        <input type="number" min="1" max="100" class="form-control" id="loan_max_percentage" name="loan_max_percentage" value="{{ $settingValue['loan_max_percentage'] }}">
                        @error('loan_max_percentage')
                        <p class="invalid-value" role="alert">
                            <strong>{{ __($message) }}</strong>
                        </p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div class=""> 
                    <input type="submit" class="form-control btn btn-sm btn-default" value="Save Settings"> 
                </div>
            </div>
        </form>
        <form action="{{ route('admin.settings.loan.termsupdate') }}" method="POST">
            @csrf()
            
            <!--Loan Term Existing -->
            <div class="form-group pt-5">
                <label class="text-dark">Loan Terms</label>
                @foreach($lornTerms as $key=>$term)
                <div class="row pt-2">
                    <div class="col-4">
                        <input type="number" min="1" max="100" class="form-control" name="terms[{{$term->id}}][percentage]" placeholder="Terms Percentage" value="{{ $term->terms_percentage }}">
                        @error("terms.".$term->id.".percentage")
                        <p class="invalid-value" role="alert">
                            <strong>{{ __($message) }}</strong>
                        </p>
                        @enderror
                    </div>
                    <div class="col-3">
                        <input type="number" class="form-control" name="terms[{{$term->id}}][duration]" placeholder="No of Days/Month" value="{{ $term->no_of_duration }}">
                        @error("terms.".$term->id.".duration")
                        <p class="invalid-value" role="alert">
                            <strong>{{ __($message) }}</strong>
                        </p>
                        @enderror
                    </div>
                    <div class="col-3">
                        <select class="form-control" name="terms[{{$term->id}}][type]">
                          <option value="days" @if($term->duration_type == "days") selected="" @endif>days</option>
                          <option value="month" @if($term->duration_type == "month") selected="" @endif>month</option>
                          <option value="year" @if($term->duration_type == "year") selected="" @endif>year</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="form-control btn btn-icon btn-danger" value="{{ $term->id }}" name="btn_action">Delete</button>
                    </div>
                </div>
                @endforeach
                <div class="row pt-2">
                    <div class="col-4">
                        <input type="number" min="1" max="100" class="form-control" id="terms_percentage" name="terms_percentage" placeholder="Terms Percentage">
                        @error('terms_percentage')
                        <p class="invalid-value" role="alert">
                            <strong>{{ __($message) }}</strong>
                        </p>
                        @enderror
                    </div>
                    <div class="col-3">
                        <input type="number" class="form-control" id="no_of_duration" name="no_of_duration" placeholder="No of Days/Month">
                        @error('no_of_duration')
                        <p class="invalid-value" role="alert">
                            <strong>{{ __($message) }}</strong>
                        </p>
                        @enderror
                    </div>
                    <div class="col-3">
                        <select class="form-control" id="duration_type" name="duration_type">
                          <option value="days">days</option>
                          <option value="month">month</option>
                          <option value="year">year</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="form-control btn btn-icon btn-success" value="new_record" name="btn_action">Add New</button>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="">
                        <button type="submit" class="form-control btn btn-sm btn-default" value="update_record" name="btn_action">Update Loan Term</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> 
@section('page_scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/prashantchaudhary/ddslick/master/jquery.ddslick.min.js" ></script>
@include('back._inc._currency-list-js')
@include('back._inc._currency-selector-js')


@endsection
@endsection
