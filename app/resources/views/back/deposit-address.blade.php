@extends('layouts.back')
@section('content')
 <div class="header filter bg-primary pb-6">
         <div class="container-fluid">
            <div class="header-body">
               <div class="row align-items-center py-4">

                  <div class="col-xl-12">

                     <div class="card">


         <form>
  <div class="form-row">
    <div class="col">
      <textarea class="form-control" rows="4" placeholder="address"></textarea>



    </div>
    <div class="col-md-6">

      <div class="dropdown currency_two three_coins crypto currencyDropdown">
                  
                               @foreach($currencies as $cIndex=> $currency)

                               @php 
                              
                              $existing_currencies[]=$currency;

                               @endphp

                    @if($currency->id==$request->currency)

                      <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                      @if($currency->hasMedia('icon'))
    
                                      

                      <img src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>
                      </button>
                      @endif

                      @endforeach

                      
                    @if(!$request->currency)

                      <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                      @if($currencies[0]->hasMedia('icon'))
    
                                      

                      <img src="{{$currencies[0]->firstMedia('icon')->getUrl()}}" alt="{{__($currencies[0]->name)}}"/> 

                      @endif

                      {{__($currencies[0]->short_name)}} <span>{{__($currencies[0]->name)}}</span>
                      </button>



                    @endif



                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                           @foreach($currencies as $cIndex=> $currency)

                            <a class="dropdown-item" data-id="{{$currency->id}}" href="#">

                                 @if($currency->hasMedia('icon'))
    
                                      

                      <img src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>



                            </a>


                    @endforeach


                        </div>
                             <input type="hidden" name="currency" class="coin_id_class" id="coin_id" value="{{($request->currency)}}"/>
                  </div>
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
                                    <th scope="col">{{__('Action')}}</th>
                                   
                                 </tr>
                              </thead>
                              <tbody>

                                 @foreach($addresses as $index => $address)

                                 <tr role="row" class="even">
                                    <td class="dtr-control" tabindex="0">{{$address->id}}</td>

                                   

                                    <td class="sorting_1">@if($address->currency->hasMedia('icon'))
                                       <img src="{{$address->currency->firstMedia('icon')->getUrl()}}" alt="{{__($address->currency->name)}}"/> 
                                       @endif {{__($address->currency->short_name)}}</td>

                                        <td class="sorting_1">{{__($address->address)}}</td>

                                    <td>edit/delete</td>
                                   
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

   


    submitForm();

   
});
       
    function submitForm(resetCurrency=false)
    {

      if(resetCurrency)
      {
        $('.coin_id_class').val("");
      }

      $('form').submit();

    }

    </script>

    @endsection