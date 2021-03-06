@extends('layouts.back')
@section('title')
    Trades |
@endsection
<style>
    .card.inner-tabs li.nav-item:first-child a{
        background: #ed960b !important;
        color: #fff !important;
    }
    .card.inner-tabs li.nav-item:last-child a{
        background: green !important;
        color: #fff;
    }
    .card.inner-tabs li.nav-item:last-child a.active{
        background: green !important;
    }
    .red-scrollbar table tr td span{
        font-size: 13px !important;
    }
    .img_icon{
        width: 20px !important;
        height: auto !important;
        margin-bottom: 11px;
    }
    .red-scrollbar table tr td span{
        padding: 7px 4px !important;
    }
    .td p {
        margin-bottom: 0px !important;
    }
    .b6{
        bottom: 6px !important;
    }
    .checkbox_m{
        margin-left: -1px !important;
        padding-left: 0px !important;
    }
</style>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@section('content')
<div class="container-fluid mt-6">
    <div class="row">
        <div class="col-xl-12">
            <small class="msg"></small>
            <div class="card">
                <div class="card-body" style="padding-bottom: 0px !important;">
                    {{ Form::open(['route'=>'admin.trades.list','id'=>'search_form','method'=>'GET']) }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::select('currency',$crypto_currencies,Request::get('currency')?Request::get('currency'):null,['class'=>'form-control search_form','placeholder'=>'Select currency']); }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::select('fiat_currency',$fiat_currencies,Request::get('fiat_currency')?Request::get('fiat_currency'):null,['class'=>'form-control search_form','placeholder'=>'Select fiat currency']); }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::select('payment_method_id',$payment_methods,Request::get('payment_method_id')?Request::get('payment_method_id'):null,['class'=>'form-control search_form','placeholder'=>'Select payment method']); }}
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="card inner-tabs">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active inp" id="seller_list" role="tabpanel" aria-labelledby="seller_list-tab">
                        <h2>Seller List</h2>
                        <div class="table-responsive red-scrollbar">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example" class="datatables table table-striped table-bordered text-left no-footer dtr-inline" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center"><input type="checkbox" id="selectall_seller_list" class="checked" /></th>
                                                <th>TRANS. ID</th>
                                                <th>Seller</th>
                                                <th>Type of coin</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sell as $item)
                                                @if($item->buyer_trans == null)
                                                    <tr>
                                                        <th scope="col" class="text-center"><input type="checkbox" class="select_seller_list checkbox_m" class="checked" value="{{$item->id}}"/></th>
                                                        <td>{{ $item->trans_id }}</td>
                                                        <td>{{ ucfirst($item->user->name) }}</td>
                                                        <td>
                                                            <img class="img_icon" src="{{ $item->currency->getMedia('icon')->first()->getUrl() }}"><span class="b6">{{ ucfirst($item->currency->short_name) }}</span>
                                                        </td>
                                                        <td>
                                                            <img class="img_icon" src="{{ $item->fiat_currency->getMedia('icon')->first()->getUrl() }}"><span class="b6">{{ $item->trans_amount }}</span>
                                                        </td>
                                                        <td>{{ ucfirst(number_format((float)$item->quantity, 2, '.', '')) }}</td>
                                                        <td>{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="card inner-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" id="seller_list-tab" data-toggle="tab" href="#pending" role="tab"
                            aria-controls="seller_list" aria-selected="true">Pending Approved List</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab"
                            aria-controls="pending" aria-selected="true">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="approved-tab" data-toggle="tab" href="#approved" role="tab"
                            aria-controls="approved" aria-selected="true">Approved</a>
                    </li>
                </ul>
               
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active inp" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <h2>Pending</h2>
                        <div class="table-responsive red-scrollbar">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example" class="datatables table table-striped table-bordered text-left no-footer dtr-inline" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center"><input type="checkbox" id="selectall_pending" class="checked" /></th>
                                                <th>TRANS. ID</th>
                                                <th>Seller</th>
                                                <th>Type of coin</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Buyer</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sell as $item)
                                                @if($item->buyer_trans != null and $item->status != 'approved')
                                                    <tr onclick="redirect('{{ route('admin.trade.show', $item->trans_id) }}','_self')">
                                                        <th scope="col" class="text-center"><input type="checkbox" class="select_pending checkbox_m" class="checked" value="{{$item->id}}" /></th>
                                                        <td>{{ $item->trans_id }}</td>
                                                        <td>{{ ucfirst($item->user->name) }}</td>
                                                        <td>
                                                            <img class="img_icon" src="{{ $item->currency->getMedia('icon')->first()->getUrl() }}"><span class="b6">{{ ucfirst($item->currency->short_name) }}</span>
                                                        </td>
                                                        <td>
                                                            <img class="img_icon" src="{{ $item->fiat_currency->getMedia('icon')->first()->getUrl() }}"><span class="b6">{{ $item->trans_amount }}</span>
                                                        </td>
                                                        <td>{{ ucfirst(number_format((float)$item->quantity, 2, '.', '')) }}</td>
                                                        <td>
                                                            @if($item->buyer_trans != null)
                                                                {{ ucfirst($item->buyer_trans->first()->user->name) }}
                                                            @elseif($item->buyer_requests->where('status','open')->first() != null)
                                                                {{ ucfirst($item->buyer_requests->where('status','open')->first()->user->name) }}
                                                            @else 
                                                                No-Buyer 
                                                            @endif
                                                        </td>
                                                        <td>{{ ucfirst($item->status) }}</td>
                                                        <td>{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade inp" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                        <h2>Approved</h2>
                        <div class="table-responsive red-scrollbar">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example" class="datatables table table-striped table-bordered text-left no-footer dtr-inline" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center"><input type="checkbox" id="selectall_pending" class="checked" /></th>
                                                <th>TRANS. ID</th>
                                                <th>Seller</th>
                                                <th>Type of coin</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Buyer</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sell as $item)
                                                @if($item->status == 'approved')
                                                    <tr onclick="redirect('{{ route('admin.trade.show', $item->trans_id) }}','_self')">
                                                        <th scope="col" class="text-center"><input type="checkbox" class="select_pending checkbox_m" class="checked" value="{{$item->id}}" /></th>
                                                        <td>{{ $item->trans_id }}</td>
                                                        <td>{{ ucfirst($item->user->name) }}</td>
                                                        <td>
                                                            <img class="img_icon" src="{{ $item->currency->getMedia('icon')->first()->getUrl() }}"><span class="b6">{{ ucfirst($item->currency->short_name) }}</span>
                                                        </td>
                                                        <td>
                                                            <img class="img_icon" src="{{ $item->fiat_currency->getMedia('icon')->first()->getUrl() }}"><span class="b6">{{ $item->trans_amount }}</span>
                                                        </td>
                                                        <td>{{ ucfirst(number_format((float)$item->quantity, 2, '.', '')) }}</td>
                                                        <td>
                                                            @if($item->buyer_trans != null)
                                                                {{ ucfirst($item->buyer_trans->first()->user->name) }}
                                                            @elseif($item->buyer_requests->where('status','open')->first() != null)
                                                                {{ ucfirst($item->buyer_requests->where('status','open')->first()->user->name) }}
                                                            @else 
                                                                No-Buyer 
                                                            @endif
                                                        </td>
                                                        <td>{{ ucfirst($item->status) }}</td>
                                                        <td>{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@section('page_scripts')
    <script>
        $('.datatables').DataTable();
        
        $('.search_form').change(function(){
            $('#search_form').submit();
        });

       $('#selectall_pending,#selectall_approved,#selectall_seller_list').click(function(){
           

            var checkbox = $(this).attr('id');
            
            var checked_checkbox = "";
            if(checkbox == "selectall_seller_list"){

                checked_checkbox = 'select_seller_list';
            }else if(checkbox == "selectall_approved"){
               
                checked_checkbox = 'select_approved';
            }else if(checkbox == "selectall_pending"){

                checked_checkbox = 'select_pending';
            }

            var example_wrapper = $(this).closest('#example_wrapper').children().find('.col-md-6:first');  
            example_wrapper.empty();
            if($(this).is(':checked',true))  
            {
                $("."+checked_checkbox).prop('checked', true);  
                example_wrapper.append('<button class="btn btn-danger delete_'+checked_checkbox+'">Delele</button>');
                $('.delete_'+checked_checkbox).css('float','right');
            } else {  

                $("."+checked_checkbox).prop('checked',false);  
            }
       })
         $('.select_pending,.select_seller_list,.select_approved').click(function(){

            var example_wrapper = $(this).closest('#example_wrapper').children().find('.col-md-6:first'); 
            var checkbox_class = $(this).attr('class');
            example_wrapper.empty();

            var split = checkbox_class.split('_');
            var select_all_class = "";
            
            if(split.length > 2){
                select_all_class = split[0]+'all_'+split[1]+'_'+split[2]; 
            }else{
                select_all_class = split[0]+'all_'+split[1];

            }
            
            if($('.'+checkbox_class).is(':checked',true)){
                
                example_wrapper.append('<button class="btn btn-danger delete_'+checkbox_class+'">Delele</button>');
                $('.delete_'+checkbox_class).css('float','left');

            }else{
            
                $('#'+select_all_class).prop('checked',false);
               
            }
         })

        $(document).on('click','.delete_select_pending,.delete_select_seller_list,.delete_select_approved',function(){

            var class_name = $(this).attr('class').split(' ')[2];
            var selected_checkbox_class = class_name.split('delete_')[1];
            // console.log(selected_checkbox_class);
            var allVals = [];  
            $("."+selected_checkbox_class+":checked").each(function() {  
                allVals.push($(this).attr('value'));
            }); 
            // console.log(allVals);
            if(allVals.length > 0){

                var token = "{{csrf_token()}}";
                var url = "{{ route('admin.trade.remove') }}";
                $.ajax({

                    'url':url, 
                    'type':'POST',
                    'data':{_token:token,data:allVals},
                    'dataType':'json',
                    success:function(response){
                        $('.msg').html(response.message).show();
                        setTimeout(function() { $(".msg").hide() }, 2000);
                        document.location.reload();
                    }
                })
            }



        })
        
    </script>
@endsection
@endsection
