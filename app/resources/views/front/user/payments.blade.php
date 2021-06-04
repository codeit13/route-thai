@extends('layouts.front')
@section('title')
Payment Methods - Route: P2P Trading Platform
@endsection
@section('content')
<section id="dashboard">
    <div class="container-fluid">
       <div class="row">
         @include('front.user._sidebar')
          <div class="col-lg-10 col-xs-12 flush">
             <div class="content_dashboard">
                <div class="container">
                   <div class="row">
                      <div class="col user_details"> 
                         <h2>Payment</h2>
                         <div class="row">
                            <div class="col-lg-6 col-xs-12">
                               <p class="no_top">P2P payment methods: When you sell cryptocurrencies, the payment method added<br/> will be displayed to buyer as options to accept payment, please ensure that the account owner’s name is consistent with your verified name on Binance. You can add up to 20 payment methods.</p>
                            </div>
                            <div class="col-lg-6 col-xs-12 text-center">
                               <div class="dropdown payment_dd">
                                  <a href="#" class="add_payment_btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-plus"></i> Add payment method</a>
                                 </button>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                   <h4>Select Payment Method</h4>
                                   @foreach ($payment_methods as $item)
                                      @if($item->hasMedia('icon'))
                                       <a class="dropdown-item" href="{{ route('user.payment.add',$item->name) }}"><img src="{{ $item->firstMedia('icon')->getUrl() }}"> {{ $item->name }}</a>
                                       @endif
                                   @endforeach
                                   {{-- <a href="#" data-toggle="modal" data-target="#exampleModal4"><h4>More <i class="far fa-chevron-down"></i></h4></a> --}}
                                 </div>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                   <hr/>
                   @if(session()->has('message'))
                     <div class="alert alert-success">
                        {{ session()->get('message') }}
                     </div>
                   @endif

                   @if(Auth::user()->user_payment_method->count() > 0 )
                     <div class="row row-eq-height">
                     @foreach (Auth::user()->user_payment_method as $item)
                     <div class="col-lg-6 col-xs-12 flush-left  xs-flush">
                           <div class="card pd_card an_card">
                              <h2><img src=" {{ $item->payment_methods->firstMedia('icon')->getUrl() }} "> {{ $item->payment_methods->name }} 
                                 <span class="rt_span"><a href="{{ route('user.payment.edit', $item->id)}}"><i class="fal fa-edit"></i></a>
                                 <a href="#" data-target="#exampleModal" data-url="{{ route('user.payment.delete', $item->id)}}"  data-toggle="modal" class="delete-this" ><i class="fal fa-trash-alt"></i></a></span></h2> 
                              <div class="iverify baccount">
                                 <div class="row">
                                    <div class="col text-right xs-left">
                                       <ul>
                                          <li><p>Name</p></li>
                                          @if($item->payment_methods->name == 'Bank' || $item->payment_methods->name == 'IMPS')
                                          <li><p>Bank account number</p></li>
                                          @endif
                                          @if($item->payment_methods->name == 'UPI')
                                          <li><p>UPI ID</p></li>
                                          @endif
                                          
                                          @if($item->payment_methods->name == 'Bank' || $item->payment_methods->name == 'IMPS')
                                          <li><p>Bank name</p></li>
                                          <li><p>IFSC</p></li>
                                          @endif
                                       </ul>
                                    </div>
                                    <div class="col xs-right">
                                       <ul>
                                          <li><p class="text-dark">{{ $item->account_label }}</p></li>
                                          <li><p class="text-dark">{{ $item->account_number }}</p></li>
                                          
                                          @if($item->payment_methods->name == 'Bank' || $item->payment_methods->name == 'IMPS')
                                          <li><p class="text-dark">{{$item->branch_name ?? '' }}  {{$item->branch_location ?? '' }}  {{ $item->bank_name }}</li>
                                             <li><p class="text-dark">{{ $item->ifs_code }}</li>
                                          @endif    
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                     </div>
                     @endforeach
                     </div>
                   @else 
                     <div class="row mb-5">
                        <div class="col-lg-12 col-xs-12 flush-left xs-flush text-center mb-5">
                           <h6> No payment methods found.</h6> 
                           <p class="mb-5"> &nbsp; </p>
                        </div>
                     </div>
                   @endif
                </div>
             </div>
          </div>
       </div>
    </div>
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Do you really want to delete?</h5>
         <button class="close" type="button" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
       </div>
       <div class="modal-body">Select "Yes, Delete" below if you are really want to delete payment method.</div>
       <div class="modal-footer">
         <button class="btn btn-outline-primary btn_outline_frm" type="button" data-dismiss="modal">Close</button>
         <a href="" class="btn btn-outline-danger btn_outline_frm">Yes, Delete</a>
       </div>
      </div>
   </div>
 </div>
@section('page_scripts')
    <script>
       $('.delete-this').on('click', function () {
            $('#exampleModal a.btn_outline_frm').attr('href', $(this).data('url'))
       })
   </script>
@endsection
@endsection