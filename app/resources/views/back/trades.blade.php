@extends('layouts.back')
@section('title')
    Trades |
@endsection
<style>

</style>
@section('content')
<div class="container-fluid mt-6 team-members">
    <div class="row">
        <div class="col-xl-12">
             <small class="msg"></small>
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
                                                <th scope="col"><input type="checkbox" id="selectall_seller_list" class="checked" /></th>
                                                <th>TRANS. ID</th>
                                                <th>Seller</th>
                                                <th>Type of coin</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sell as $item)
                                                @if($item->buyer_trans == null)
                                                    <tr>
                                                        <th scope="col"><input type="checkbox" class="select_seller_list" class="checked" value="{{$item->id}}"/></th>
                                                        <td>{{ $item->trans_id }}</td>
                                                        <td>{{ ucfirst($item->user->name) }}</td>
                                                        <td>{{ ucfirst($item->currency->name) }}</td>
                                                        <td>{{ number_format(number_format((float)$item->trans_amount,2,'.','') / number_format((float)$item->quantity,2,'.',''),2,'.','')}}</td>
                                                        <td>{{ ucfirst(number_format((float)$item->quantity, 2, '.', '')) }}</td>
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
            <div class="card inner-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" id="seller_list-tab" data-toggle="tab" href="#pending" role="tab"
                            aria-controls="seller_list" aria-selected="true">Pending Approved List</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab"
                            aria-controls="pending" aria-selected="true" style="background: rgb(244 67 54 / 47%);">Pending</a>
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
                                                <th scope="col"><input type="checkbox" id="selectall_pending" class="checked" /></th>
                                                <th>TRANS. ID</th>
                                                <th>Seller</th>
                                                <th>Type of coin</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sell as $item)
                                                @if($item->buyer_trans == null)
                                                    <tr>
                                                        <th scope="col"><input type="checkbox" class="select_pending" class="checked" value="{{$item->id}}" /></th>
                                                        <td>{{ $item->trans_id }}</td>
                                                        <td>{{ ucfirst($item->user->name) }}</td>
                                                        <td>{{ ucfirst($item->currency->name) }}</td>
                                                        <td>{{ number_format(number_format((float)$item->trans_amount,2,'.','') / number_format((float)$item->quantity,2,'.',''),2,'.','')}}</td>
                                                        <td>{{ ucfirst(number_format((float)$item->quantity, 2, '.', '')) }}</td>
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
                    <div class="tab-pane fade inp" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <h2>Pending</h2>
                        <div class="table-responsive red-scrollbar">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example" class="datatables table table-striped table-bordered text-left no-footer dtr-inline" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col"><input type="checkbox" id="selectall_pending" class="checked" /></th>
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
                                                @if($item->buyer_requests->where('status','open')->first() != null and $item->buyer_trans == null and $item->status != 'approved')
                                                    <tr onclick="redirect('{{ route('admin.trade.show', $item->trans_id) }}','_self')">
                                                        <th scope="col"><input type="checkbox" class="select_pending" class="checked" value="{{$item->id}}"/></th>
                                                        <td>{{ $item->trans_id }}</td>
                                                        <td>{{ ucfirst($item->user->name) }}</td>
                                                        <td>{{ ucfirst($item->currency->name) }}</td>
                                                        <td>{{ number_format(number_format((float)$item->trans_amount,2,'.','') / number_format((float)$item->quantity,2,'.',''),2,'.','')}}</td>
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
                                                <th scope="col"><input type="checkbox" id="selectall_approved" class="checked" /></th>
                                                <th>TRANS. ID</th>
                                                <th>Seller</th>
                                                <th>Buyer</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sell as $item)
                                                @if($item->status == 'approved')
                                                    <tr>
                                                        <th scope="col"><input type="checkbox" class="select_approved" class="checked" value="{{$item->id}}"/></th>
                                                        <td  onclick="redirect('{{ route('admin.trade.show', $item->trans_id) }}','_self')">{{ $item->trans_id }}</td>
                                                        <td  onclick="redirect('{{ route('admin.trade.show', $item->trans_id) }}','_self')">{{ ucfirst($item->user->name) }}</td>
                                                        <td  onclick="redirect('{{ route('admin.trade.show', $item->trans_id) }}','_self')">@if($item->buyer_trans != null){{ ucfirst($item->buyer_trans->first()->user->name) }}@else No-Buyer @endif</td>
                                                        <td  onclick="redirect('{{ route('admin.trade.show', $item->trans_id) }}','_self')">{{ ucfirst($item->status) }}</td>
                                                        <td  onclick="redirect('{{ route('admin.trade.show', $item->trans_id) }}','_self')">{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
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
        $('.datatables').DataTable({
            "paging":   false,
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
                $('.delete_'+checked_checkbox).css('float','left');
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
