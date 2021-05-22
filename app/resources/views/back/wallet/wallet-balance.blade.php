@extends('layouts.back')
@section('content')
 <div class="header filter bg-primary pb-6">
         <div class="container-fluid">
            <div class="header-body">
               <div class="row align-items-center py-4">
                  <div class="col-lg-12">
                  <form action="{{route('admin.user.wallets')}}" method="GET">
                     <div class="card">
                        <ul>
                           <li><h3><i class="fa fa-filter" aria-hidden="true"></i> {{__("Type")}}</h3></li>
                           <li>
                              <select name="type" onchange="submitForm(true)" id="">

                                 <option value="">Select</option>

                                 @foreach($currencyTypes as $type)

                                 <option value="{{$type->id}}" @if($type->id==$request->type)selected @endif >{{__($type->type)}}</option>

                               @endforeach
                              </select>
                           </li>

                            <li><h3><i class="fa fa-filter" aria-hidden="true"></i> {{__("Currency")}}</h3></li>
                           <li>

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
                             
                           </li>
                           <!-- <li class="mini_filter">
                             <button type="submit" class="btn btn-primary">Filter</button>
                           </li> -->
                        </ul>
                     </div>
                     </form>
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
                                    <th scope="col">{{__('Username')}}</th>
                                    <th scope="col">{{__('Type')}}</th>
                                    <th scope="col">{{__('Balance')}}</th>
                                   
                                 </tr>
                              </thead>
                              <tbody>

                                 @foreach($balances as $index => $balance)

                                 <tr role="row" class="even">
                                    <td class="dtr-control" tabindex="0">{{$balance->id}}</td>
                                    <td class="sorting_1">{{__($balance->user->name)}}</td>
                                    <td class="sorting_1">@if($balance->currency->hasMedia('icon'))
                                       <img src="{{$balance->currency->firstMedia('icon')->getUrl()}}" alt="{{__($balance->currency->name)}}"/> 
                                       @endif {{__($balance->currency->short_name)}}</td>
                                    <td>{{$balance->coin}}</td>
                                   
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>

                        </div>

      

                     </div>

                     <div class="row">
                  <div class="col-lg-12 text-center nav-pagi hidden-xs col-sm-12 col-12">
  {{ $balances->links('back._inc._paginator') }}

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