 @extends('layouts.back')
@section('content')
 <div class="header filter bg-primary pb-6">
         <div class="container-fluid">
            <div class="header-body">
               <div class="row align-items-center py-4">
                  <div class="col-lg-12">
                  <form action="" method="post">
                     <div class="card">
                        <ul>
                           <li><h3><i class="fa fa-filter" aria-hidden="true"></i> Filter</h3></li>
                           <li>
                              <select name="status" id="status_change">
                                 <option value="all">All</option>
                                 <option value="open">To Approve</option>
                                 <option value="approved">Approved</option>
                                 <option value="rejected">Rejected</option>
                              </select>
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
                                    <th scope="col">{{__('Transaction ID')}}</th>
                                    <th scope="col">{{__('Username')}}</th>
                                    <th scope="col">{{__('Type')}}</th>
                                    <th scope="col">{{__('Amount')}}</th>
                                    <th scope="col">{{__('File')}}</th>

                                    <th scope="col">{{__('Action')}}</th>
                                 </tr>
                              </thead>
                              <tbody>

                                 @foreach($transactions as $index => $transaction)

                                 <tr role="row" class="even">
                                    <td class="dtr-control" tabindex="0">{{$transaction->id}}</td>
                                    <td class="sorting_1">{{__($transaction->user->name)}}</td>
                                    <td class="sorting_1">@if($transaction->currency->hasMedia('icon'))
                                       <img style="max-width: 28px;" src="{{$transaction->currency->firstMedia('icon')->getUrl()}}" alt="{{__($transaction->currency->name)}}"/> 
                                       @endif {{__($transaction->currency->short_name)}}</td>
                                    <td>{{$transaction->trans_amount}}</td>
                                    <td>
                                       @if($transaction->hasMedia('file'))
                                       <a target="_blank" href="{{$transaction->firstMedia('file')->getUrl()}}">File</a>
                                       @else
                                       N/A
                                       @endif
                                       </td>
                                    <td>
                                       @switch($transaction->status)
                                          @case('pending')
                                             <a class="btn btn-sm text-success approve-btn" href="{{route('admin.wallet.change.status',['type'=>'withdraw','status'=>'approved','transaction'=>$transaction->id])}}" >Accept</a>
                                             <a class="btn btn-sm text-danger reject-btn" href="{{route('admin.wallet.change.status',['type'=>'withdraw','status'=>'rejected','transaction'=>$transaction->id])}}">Reject</a>
                                          @break
                                          @case('rejected')
                                             <span class="btn-sm text-red">REJECTED</span>
                                          @break
                                          @case('approved')
                                             <span class="btn-sm text-green">APPROVED</span>
                                          @break
                                          @endswitch
                                    </td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>

                      <div class="row">
                  <div class="col-lg-12 text-center nav-pagi hidden-xs col-sm-12 col-12">
  {{ $transactions->links('back._inc._paginator') }}

</div></div>
                  </div>
               </div>
            </div>
         </div>
   </div>
    @endsection