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
                      <input type="number" min="1" max="100" id="loan_price_down_limit" name="loan_price_down_limit" class="form-control percentage_input" placeholder="Price Down Limit" value="{{ $settingValue['loan_price_down_limit'] }}">
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
                      <input type="number" min="1" max="100" id="loan_min_percentage" name="loan_min_percentage" class="form-control percentage_input" placeholder="Min Percentage" onchange="checkMinMax()" value="{{ $settingValue['loan_min_percentage'] }}">
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
                      <input type="number" min="1" max="100" id="loan_max_percentage" name="loan_max_percentage" class="form-control percentage_input" placeholder="Max Percentage" onchange="checkMinMax()" value="{{ $settingValue['loan_max_percentage'] }}">
                      <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">%</span>
                      </div>
                    </div>
                    <p class="invalid-value" role="alert" id="max_validation">
                        @error('loan_max_percentage')
                            <strong>{{ __($message) }}</strong>
                        @enderror
                    </p>
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
                <button type="submit" class="btn btn-default" value="update_record" name="btn_action">Update</button>
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
                      <input type="number" min="1" max="100" class="form-control percentage_input" name="terms[{{$term->id}}][percentage]" placeholder="Terms Percentage" value="{{ $term->terms_percentage }}">

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
                    <input type="number" class="form-control percentage_input" name="terms[{{$term->id}}][duration]" placeholder="No of Days/Month" value="{{ $term->no_of_duration }}">
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
                      <input type="number" min="1" max="100" class="form-control percentage_input" id="terms_percentage" name="terms_percentage" placeholder="Terms Percentage">

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
                    <input type="number" class="form-control percentage_input" id="no_of_duration" name="no_of_duration" placeholder="No of Days/Month">
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

<!-- Loan Repay Setting -->
@if($actionName=="admin.settings.loan.repay.edit")
    <form action="{{ route('admin.settings.loan.repay.edit.post',$editId) }}" method="POST">
    @csrf()
    {{ method_field('PUT') }}
@else
    <form action="{{ route('admin.settings.loan.repay') }}" method="POST">
    @csrf()
@endif
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Loan Repay Settings</h3>
              </div>
              <div class="col-4 text-right">
                <button type="submit" class="btn btn-default" value="update_record" name="btn_action">Update</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="loan_repay_currency_type">Loan Repay Currency Type</label>
                    <div class="tab-pane tab-example-result fade show active" id="loan_repay_currency_type" role="tabpanel" aria-labelledby="-component-tab">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                                <input type="radio" name="loan_repay_currency_type" id="option1" autocomplete="off" @if($settingValue["loan_repay_currency_type"]==1) checked="" @endif value="1"> Loan Crypto Currency
                            </label>
                            <label class="btn btn-secondary">
                                <input type="radio" name="loan_repay_currency_type" id="option2" autocomplete="off" @if($settingValue["loan_repay_currency_type"]==2) checked="" @endif value="2"> Other Crypto Currency
                            </label>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                </div>
              </div>
            </div>
            <div id="other_crypto_section" @if($settingValue["loan_repay_currency_type"]==1) style="display: none" @endif>
                <hr class="my-4">
                <h6 class="heading-small text-muted mb-4">Select & Add Crypto Address</h6>
                <div class="pl-lg-4">
                    @foreach($loanRepay as $key=>$record)
                        @if($record->id==$editId) @php $editData=$record; continue; @endphp @endif
                        <div class="row">
                            <div class="col-lg-3">
                              <div class="form-group">
                                <select class="form-control" name="" disabled="">
                                  <option>{{ $record->currency->name }}</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-5">
                              <div class="form-group">
                                <input type="text" class="form-control" id="crypto_wallet_address" name="crypto_wallet_address" placeholder="Crypto Wallet Address" value="{{ $record->crypto_wallet_address }}" disabled="">
                              </div>
                            </div>
                            <div class="col-lg-4" >
                                @if($actionName!="admin.settings.loan.repay.edit")
                                <a href="{{route('admin.settings.loan.repay.edit',$record->id)}}">
                                    <button type="button" class="btn btn-success" value="new_record" name="btn_action">Edit</button>
                                </a>

                                <button type="submit" class="btn btn-danger" value="{{ $record->id }}" name="btn_action">Delete</button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    @if($actionName=="admin.settings.loan.repay.edit" && $editData) 
                    <div class="row">
                        <div class="col-lg-3">
                          <div class="form-group">
                            <select class="form-control" name="currency_id" disabled="">
                              @foreach($cruptoCurrencies as $record)
                                <option value="{{ $record->id }}" @if($record->id==$editData->id) selected="" @endif>{{ $record->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="form-group">
                            <input type="text" class="form-control" id="crypto_wallet_address" name="crypto_wallet_address" placeholder="Crypto Wallet Address" value="{{$editData->crypto_wallet_address}}">
                            @error('crypto_wallet_address')
                            <p class="invalid-value" role="alert">
                                <strong>{{ __($message) }}</strong>
                            </p>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <button type="submit" class="btn btn-success" value="update_record" name="btn_action">Update</button>
                          <a href="{{route('admin.settings.loan')}}">
                            <button type="button" class="btn btn-info">Cancel</button>
                          </a>
                          
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-lg-3">
                          <div class="form-group">
                            <select class="form-control" name="currency_id">
                              @foreach($cruptoCurrencies as $record)
                                <option value="{{ $record->id }}">{{ $record->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="form-group">
                            <input type="text" class="form-control" id="crypto_wallet_address" name="crypto_wallet_address" placeholder="Crypto Wallet Address">
                            @error('crypto_wallet_address')
                            <p class="invalid-value" role="alert">
                                <strong>{{ __($message) }}</strong>
                            </p>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <button type="submit" class="btn btn-success" value="new_record" name="btn_action">New Record</button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
          </div>
        </div>
      </form>
    </div>
</div>
@endsection

@section('page_scripts')

<script type="text/javascript">
    function checkMinMax() {
        var minVal = parseInt($("#loan_min_percentage").val());
        var maxVal = parseInt($("#loan_max_percentage").val());

        if(minVal && maxVal) {
            if(minVal > maxVal) {
                if(minVal>=99) $("#loan_min_percentage").val("1");
                $("#max_validation").html("<strong>Max percentage should be greater then min.</strong>");
            } else {
                $("#max_validation").html("");
            }
        }
    }

    $('.percentage_input').on('change', function() {
      var percentageVal = this.value;
      if(percentageVal > 100) { $(this).val(100); }
      else if(percentageVal < 1) { $(this).val(1); }
    });

    $(".currencyDropdown .dropdown-menu .dropdown-item").on("click", function(e) {
        e.preventDefault();
        var currency_id=$(this).attr('data-id');
        $('.coin_id_class').val(currency_id);
        $('.currencyDropdown .dropdown-toggle').html($(this).html());
    });

    $('input[name=loan_repay_currency_type]').change(function() {
        if($(this).val()==2) {
            $("#other_crypto_section").show();
        } else {
            $("#other_crypto_section").hide();
        }
    });
</script>
@endsection