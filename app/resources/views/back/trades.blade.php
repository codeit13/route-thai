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
            <div class="card inner-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="seller_list-tab" data-toggle="tab" href="#seller_list" role="tab"
                            aria-controls="seller_list" aria-selected="true">Seller List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab"
                            aria-controls="pending" aria-selected="true" style="background: rgb(244 67 54 / 47%);">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="approved-tab" data-toggle="tab" href="#approved" role="tab"
                            aria-controls="approved" aria-selected="true">Approved</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active inp" id="seller_list" role="tabpanel" aria-labelledby="seller_list-tab">
                        <h2>Seller List</h2>
                        <div class="table-responsive red-scrollbar">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example" class="datatables table table-striped table-bordered text-left no-footer dtr-inline" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
                                                <th>TRANS. ID</th>
                                                <th>Seller</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sell as $item)
                                                @if($item->buyer_trans == null)
                                                    <tr>
                                                        <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
                                                        <td>{{ $item->trans_id }}</td>
                                                        <td>{{ ucfirst($item->user->name) }}</td>
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
                                                <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
                                                <th>TRANS. ID</th>
                                                <th>Seller</th>
                                                <th>Buyer</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sell as $item)
                                                @if($item->buyer_requests->where('status','open')->first() != null and $item->buyer_trans == null and $item->status != 'approved')
                                                    <tr onclick="redirect('{{ route('admin.trade.show', $item->trans_id) }}','_self')">
                                                        <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
                                                        <td>{{ $item->trans_id }}</td>
                                                        <td>{{ ucfirst($item->user->name) }}</td>
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
                                                <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
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
                                                    <tr onclick="redirect('{{ route('admin.trade.show', $item->trans_id) }}','_self')">
                                                        <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
                                                        <td>{{ $item->trans_id }}</td>
                                                        <td>{{ ucfirst($item->user->name) }}</td>
                                                        <td>@if($item->buyer_trans != null){{ ucfirst($item->buyer_trans->first()->user->name) }}@else No-Buyer @endif</td>
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
        $('.datatables').DataTable({
            "paging":   false,
        });
        // $('select[name]').addClass('form-control-plaintext');
    </script>
@endsection
@endsection
