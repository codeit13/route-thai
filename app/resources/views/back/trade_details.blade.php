@extends('layouts.back')
@section('title')
    Trade Details |
@endsection
@section('content')
<style type="text/css">
.form-wizard .form-wizard-steps li:last-child::before {
    width: 0% !important;
}

.form-wizard .form-wizard-steps li{
    width: 20% !important;
}
</style>
    <div class="container-fluid mt-6 team-members transaction">
        <div class="row row-eq-height">
            <div class="col-lg-8 col-xs-12">
                <div class="card text-center trade">
                    <h2 class="text-left">Current Transaction Status</h2>
                    <div class="form-wizard">
                        <div class="form-wizard-header text-center">
                            <ul class="list-unstyled form-wizard-steps clearfix">
                                <li class="active">
                                    <p>Order Started</p><br><span>1</span>
                                </li>
                                <li @if(in_array($trans->status,['pending','approved','in_appeal','rejected'])) class="active" @endif>
                                    <p>Order In Progress</p><br><span>2</span>
                                </li>
                                <li @if(in_array($trans->status,['approved','in_appeal','rejected'])) class="active" @endif>
                                    <p>Order In Appeal</p><br><span>3</span>
                                </li>
                                <li @if(in_array($trans->status,['approved','rejected'])) class="active" @endif>
                                    <p>Order Finished</p><br><span>4</span>
                                </li>
                                <li @if(in_array($trans->status,['rejected'])) class="active" @endif>
                                    <p>Order Cancelled</p><br><span>5</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if($trans->status == 'pending')
                        <a data-value="approved" class="btn btn-primary statusUpdate text-white">Change to Finished</a>
                        <a data-value="rejected" class="btn btn-danger statusUpdate text-white">Change to Rejected</a>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-xs-12">
                <div class="card trade">
                    <h2 class="text-left">General Transaction Details</h2>
                    <div class="profile">
                        <img alt="Image placeholder" src="{{ $trans->currency->getMedia('icon')->first()->getUrl() }}">
                    </div>
                    <div class="side_content">
                    <h3><b> {{  $trans->currency->name }}</b></h3>
                    <span>{{ date ('F d, Y: H:i:s A', strtotime($trans->created_at)) }}</span>
                    </div>
                    <ul class="details">
                        <li>Quantity: <b>{{ $trans->quantity }} {{ $trans->currency->short_name }}</b></li>
                        <li>Amount: <b>{{ $trans->trans_amount }} {{ $trans->fiat_currency->short_name }}</b></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row row-eq-height space-inner">
            <div class="col-xs-12 col">
                <div class="card inner-tabs">
                    <h2 class="text-left">Seller Details</h2>
                    <ul class="details nospace">
                        <li>Seller Username : <b>{{ $trans->user->name }}</b></li>
                        <li>Seller Email : <b>{{ $trans->user->email }}</b></li>
                        <li>Mobile Number: <b>{{ ($trans->user->mobile)?$trans->user->mobile:"N/A" }}</b></li>
                        <li>Line ID: <b>{{ ($trans->user->line_number)?$trans->user->line_number:"N/A" }}</b></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col">
                <div class="card inner-tabs">
                    <h2 class="text-left">Buyer Details</h2>
                    <ul class="details nospace">
                        @if(isset($trans->buyer_trans) and $trans->buyer_trans != '')
                            <li>Buyer Username : <b>{{ $trans->buyer_trans->user->name }}</b></li>
                            <li>Buyer Email : <b>{{ $trans->buyer_trans->user->email }}</b></li>
                            <li>Mobile Number: <b>{{ ($trans->buyer_trans->user->mobile)?$trans->buyer_trans->user->mobile:"N/A" }}</b></li>
                            <li>Line ID: <b>{{ ($trans->buyer_trans->user->mobile)?$trans->buyer_trans->user->line_number:"N/A"}}</b></li>
                        @else
                            @if($trans->buyer_requests->first() != null)
                                <li>Buyer Username : <b>{{ $trans->buyer_requests->first()->user->name }}</b></li>
                                <li>Buyer Email : <b>{{ $trans->buyer_requests->first()->user->email }}</b></li>
                                <li>Mobile Number: <b>{{ ($trans->buyer_requests->first()->user->mobile)?$trans->buyer_requests->first()->user->mobile:"N/A" }}</b></li>
                                <li>Line ID: <b>{{ ($trans->buyer_requests->first()->user->mobile)?$trans->buyer_requests->first()->user->line_number:"N/A"}}</b></li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@section('page_scripts')
<script>
$('.statusUpdate').on('click',function(e){
    e.preventDefault();
    var status = $(this).data('value');
    var id = $(this).data('id');
     $.ajax({
        type:'POST',
        dataType:'JSON',
        async:true,
        url:"{{ route('admin.trade.update.status') }}",
        data:{ status : status,id:{{ $trans->id }}, _token: "{{ csrf_token() }}" },
        success:function(data) {
           $('.msg'+id).html(data.message).show();
           setTimeout(function() { $(".msg"+id).hide() }, 2000);
           location.reload();      
        }
     });
});
</script>
@endsection
@endsection
