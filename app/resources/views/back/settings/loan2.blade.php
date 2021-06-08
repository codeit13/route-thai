@extends('layouts.back')
@section('title')
    Settings |
@endsection
@section('content')
<div class="container">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has($msg))
          <div class="alert alert-custom alert-{{ $msg }} fade show" role="alert">
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
      <!-- Loan Apply Setting -->
      <form action="{{ route('admin.settings.loan') }}" method="POST">
            @csrf()
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Loan Settings</h3>
              </div>
              <div class="col-4 text-right">
                <button type="submit" class="btn btn-default">Update</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="loan_price_down_limit">Price Down Limit</label>
                    <div class="input-group">
                      <input type="number" min="1" max="100" id="loan_price_down_limit" name="loan_price_down_limit" class="form-control" placeholder="Price Down Limit">
                      <div class="input-group-append">
                        <span class="input-group-text">%</span>
                      </div>
                    </div>
                    @error('loan_price_down_limit')
                    <p class="invalid-value" role="alert">
                        <strong>{{ __($message) }}</strong>
                    </p>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="loan_min_percentage">Min</label>
                    <div class="input-group">
                      <input type="number" min="1" max="100" id="loan_min_percentage" name="loan_min_percentage" class="form-control" placeholder="Min Percentage">
                      <div class="input-group-append">
                        <span class="input-group-text">%</span>
                      </div>
                    </div>
                    @error('loan_min_percentage')
                    <p class="invalid-value" role="alert">
                        <strong>{{ __($message) }}</strong>
                    </p>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="loan_max_percentage">Max</label>
                    <div class="input-group">
                      <input type="number" min="1" max="100" id="loan_max_percentage" name="loan_max_percentage" class="form-control" placeholder="Max Percentage">
                      <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">%</span>
                      </div>
                    </div>
                    @error('loan_max_percentage')
                    <p class="invalid-value" role="alert">
                        <strong>{{ __($message) }}</strong>
                    </p>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>

      <!-- Loan Term Setting -->
      <form action="{{ route('admin.settings.loan.termsupdate') }}" method="POST">
        @csrf()
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Loan Terms Settings</h3>
              </div>
              <div class="col-4 text-right">
                <button type="submit" class="btn btn-default">Update</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="pl-lg-4">
              @foreach($lornTerms as $key=>$term)
              <div class="row">
                <div class="col-lg-3">
                  <div class="form-group">
                    <div class="input-group">
                      <input type="number" min="1" max="100" class="form-control" name="terms[{{$term->id}}][percentage]" placeholder="Terms Percentage" value="{{ $term->terms_percentage }}">

                      <div class="input-group-append">
                        <span class="input-group-text">%</span>
                      </div>
                    </div>
                    @error("terms.".$term->id.".percentage")
                    <p class="invalid-value" role="alert">
                        <strong>{{ __($message) }}</strong>
                    </p>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <input type="number" class="form-control" name="terms[{{$term->id}}][duration]" placeholder="No of Days/Month" value="{{ $term->no_of_duration }}">
                    @error("terms.".$term->id.".duration")
                    <p class="invalid-value" role="alert">
                        <strong>{{ __($message) }}</strong>
                    </p>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <select class="form-control" name="terms[{{$term->id}}][type]">
                      <option value="days" @if($term->duration_type == "days") selected="" @endif>days</option>
                      <option value="month" @if($term->duration_type == "month") selected="" @endif>month</option>
                      <option value="year" @if($term->duration_type == "year") selected="" @endif>year</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-3">
                  <button type="submit" class="btn btn-danger" value="{{ $term->id }}" name="btn_action">Delete</button>
                </div>
              </div>
              @endforeach
              <div class="row">
                <div class="col-lg-3">
                  <div class="form-group">
                    <div class="input-group">
                      <input type="number" min="1" max="100" class="form-control" id="terms_percentage" name="terms_percentage" placeholder="Terms Percentage">

                      <div class="input-group-append">
                        <span class="input-group-text">%</span>
                      </div>
                    </div>
                    @error('terms_percentage')
                    <p class="invalid-value" role="alert">
                        <strong>{{ __($message) }}</strong>
                    </p>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <input type="number" class="form-control" id="no_of_duration" name="no_of_duration" placeholder="No of Days/Month">
                    @error('no_of_duration')
                    <p class="invalid-value" role="alert">
                        <strong>{{ __($message) }}</strong>
                    </p>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <select class="form-control" name="duration_type" id="duration_type">
                      <option value="days">days</option>
                      <option value="month">month</option>
                      <option value="year">year</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-3">
                  <button type="submit" class="btn btn-success" value="new_record" name="btn_action">Add New</button>
                </div>
              </div>
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
