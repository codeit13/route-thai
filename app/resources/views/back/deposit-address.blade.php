@extends('layouts.back')
@section('content')
 <div class="header filter bg-primary pb-6">
         <div class="container-fluid">
            <div class="header-body">
               <div class="row align-items-center py-4">

                  <div class="col-xl-12">

                     <div class="card">
@php 

$action=route('admin.deposit.address.create');
$method='post';

if(isset($deposit_address->id))
{
  $action=route('admin.deposit.address.update',$deposit_address->id);

}

@endphp

         <form action="{{$action}}" method="{{$method}}" enctype="multipart/form-data">

          @if(isset($deposit_address->id))

         {{ method_field('PUT') }}

          @endif

          @csrf

          


  <div class="form-row">

    <div class="col-md-4">
    <label for="exampleFormControlInput1">Address :</label>
    <textarea class="form-control" name="address" required="required" rows="2" placeholder="address">{{$deposit_address->address??''}}</textarea>
        @error('address')
                                <p class="invalid-value" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror
  </div>


    <div class="col-md-3">

    <label for="exampleFormControlInput1">Currency :</label>


      <div class="dropdown currency_two three_coins crypto currencyDropdown d-block">
                  
                               @foreach($currencies as $cIndex=> $currency)

                               @php 
                              
                              $existing_currencies[]=$currency;

                               @endphp

                    @if(isset($deposit_address->currency_id) && $currency->id==$deposit_address->currency_id)

                      <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                      @if($currency->hasMedia('icon'))
    
                                      

                      <img style="max-width:28px;" src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>
                      </button>
                      @endif

                      @endforeach

                      
                    @if(!(isset($deposit_address->currency_id)) && isset($currencies[0]))

                      <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                      @if($currencies[0]->hasMedia('icon'))
    
                                      

                      <img style="max-width:28px;" src="{{$currencies[0]->firstMedia('icon')->getUrl()}}" alt="{{__($currencies[0]->name)}}"/> 

                      @endif

                      {{__($currencies[0]->short_name)}} <span>{{__($currencies[0]->name)}}</span>
                      </button>



                    @endif



                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                           @foreach($currencies as $cIndex=> $currency)

                            <a class="dropdown-item" data-id="{{$currency->id}}" href="#">

                                 @if($currency->hasMedia('icon'))
    
                                      

                      <img style="max-width:28px;" src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>



                            </a>


                    @endforeach


                        </div>
                             <input type="hidden" name="currency" class="coin_id_class" id="coin_id" value="{{($deposit_address->currency_id??$currencies[0]->id??'')}}"/>
                             @error('currency')
                                <p class="invalid-value" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror
                  </div>
                 
                 
    </div>

    <div class="col-md-3">
    <label for="exampleFormControlFile1">Qr Code :</label>
    <input type="file" name="qr" class="form-control-file d-block" id="exampleFormControlFile1">
     @error('qr')
                                <p class="invalid-value" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror
  </div>

     <div class="col-md-2">
       <div class="col-md-12 ml-2 mt-3">

                   <button class="btn btn-success">Attach Address</button>
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
      <!-- Page content -->
      <div class="container-fluid mt--6 points-card">
       
         <div class="row">
            <div class="col-xl-12">
               <div class="row row-eq-height">
                  <div class="col">
                     <div class="card text-center">

                        <div class="table-responsive red-scrollbar">
                              <!-- Projects table -->
                           <table class="display points-tb table align-items-center table-flush table table-striped table-bordered" id="" style="width:100%">
                              <thead class="thead-light">
                                 <tr>
                                    <th scope="col">{{__('ID')}}</th>
                                  
                                    <th scope="col">{{__('Type')}}</th>

                                      <th scope="col">{{__('Address')}}</th>

                                      <th scope="col">{{__('Qr Code')}}</th>

                                    <th scope="col">{{__('Action')}}</th>
                                   
                                 </tr>
                              </thead>
                              <tbody>

                                 @foreach($addresses as $index => $address)

                                 <tr role="row" class="even">
                                    <td class="dtr-control" tabindex="0">{{$address->id}}</td>

                                   

                                    <td class="sorting_1">@if($address->currency->hasMedia('icon'))
                                       <img style="max-width:28px;" src="{{$address->currency->firstMedia('icon')->getUrl()}}" alt="{{__($address->currency->name)}}"/> 
                                       @endif {{__($address->currency->short_name)}}</td>

                                        <td class="sorting_1">{{__($address->address)}}</td>

                                        <td>@if($address->hasMedia('qr_code'))
                                             <img style="width: 50px;" src="{{$address->firstMedia('qr_code')->getUrl()}}"/>
                                           @endif</td>

                                    <td>
                                      <a href="{{route('admin.deposit.address.edit',$address->id)}}"><i class="fa fa-edit" style="font-size: x-large;"></i></a>

                                      <a href="{{route('admin.deposit.address.delete',$address->id)}}"><i class="fa fa-trash" style="font-size: x-large;"></i></a>

                                    </td>
                                   
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>

                        </div>

      

                     </div>

                     <div class="row">
                  <div class="col-lg-12 text-center nav-pagi hidden-xs col-sm-12 col-12">
  {{ $addresses->links('back._inc._paginator') }}

</div></div>


                   
                  </div>


               </div>
            </div>
         </div>

       

                     
                  
              

   </div>
    @endsection

    @section('page_scripts')

    <script type="text/javascript">

      $(".currencyDropdown .dropdown-menu .dropdown-item").on("click", function(e) { e.preventDefault();

      var currency_id=$(this).attr('data-id');


      $('.coin_id_class').val(currency_id);
    $('.currencyDropdown .dropdown-toggle').html($(this).html());

   


    //submitForm();

   
});
       
    // function submitForm(resetCurrency=false)
    // {

    //   if(resetCurrency)
    //   {
    //     $('.coin_id_class').val("");
    //   }

    //   $('form').submit();

    // }

    </script>

    @endsection