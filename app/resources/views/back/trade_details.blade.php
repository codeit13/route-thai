@extends('layouts.back')
@section('title')
    Trade Details |
@endsection
@section('content')
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
                            <li class="{{ in_array($trans->status, ['in_progress','approved','rejected']) ? "active" : "" }}">
                                <p>Order In Progress</p><br><span>2</span>
                            </li>
                            <li class="{{ in_array($trans->status, ['approved'])  ? "active" : ($trans->status == "rejected"  ? "d-none" : "") }}">
                                <p>Order Finished</p><br><span>3</span>
                            </li>
                            <li class="{{ in_array($trans->status, ['rejected']) ? "active" : "d-none" }}">
                                <p>Order Rejected</p><br><span>3</span>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <a data-value="in_progress" class="btn btn-primary statusUpdate text-white {{ $trans->status == 'pending' ? "" : "d-none" }}" id="change-to-uploaded">Change to In Progress</a>
                    <a data-value="approved" class="btn btn-primary statusUpdate text-white {{ $trans->status == 'in_progress' ? "" : "d-none" }}" id="change-to-uploaded">Change to Completed</a>
                    <a class="btn btn-primary text-white {{ $trans->status == 'approved' ? "disabled" : "d-none" }}" id="btn-status-change-from-">ORDER FINISHED</a>
                    <a class="btn btn-primary text-white {{ $trans->status == 'rejected' ? "disabled" : "d-none" }}" id="btn-status-change-from-">ORDER REJECTED</a>
                    <a data-value="rejected" class="btn btn-primary statusUpdate text-white {{ $trans->status == 'pending' || $trans->status == 'in_progress' ? "" : "d-none" }}" id="change-to-uploaded">Change to Rejected</a>
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
                        <li>Quantity : <b>{{ $trans->quantity }}</b></li>
                        {{-- <li>Currency for Transaction : <b>THB</b></li>
                        <li>Character Value : <b>0 THB</b></li> --}}
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
                        {{-- <li>Name: <b>3333</b></li> --}}
                        <li>Mobile Number: <b>{{ $trans->user->mobile}}</b></li>
                        <li>Line ID: <b>{{ $trans->user->line_number}}</b></li>
                        <li>Account Name: <b>{{ $trans->user->payment_methods->where('id',$trans->user_payment_method_id)->first()->account_label }}</b></li>
                        <li>Account No: <b>{{ $trans->user->payment_methods->where('id',$trans->user_payment_method_id)->first()->account_number}}</b></li>

                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col">
                <div class="card inner-tabs">
                    <h2 class="text-left">Buyer Details</h2>
                    <ul class="details nospace">
                        @if(isset($trans->receiver) and $trans->receiver != '')
                            <li>Buyer Username : <b>{{ $trans->receiver->name }}</b></li>
                            <li>Mobile Number: <b>{{ $trans->receiver->mobile}}</b></li>
                            <li>Line ID: <b>{{ $trans->receiver->line_number}}</b></li>
                        @else
                            @if($trans->buyer_requests != null)
                                <li>Buyer Username : <b>{{ $trans->buyer_requests->first()->name }}</b></li>
                                <li>Mobile Number: <b>{{ $trans->buyer_requests->first()->mobile}}</b></li>
                                <li>Line ID: <b>{{ $trans->buyer_requests->first()->line_number}}</b></li>
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
