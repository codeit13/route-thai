@extends('layouts.back')
@section('title')
    Settings |
@endsection
@section('content')
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" rel="stylesheet">
<div class="container-fluid"> 
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has($msg))
          <div class="alert alert-custom alert-{{ $msg }} fade show" role="alert">
              <div class="alert-text">{{ Session::get($msg) }}</div>
              <div class="alert-close">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">
                          <i class="ki ki-close"></i>
                      </span>
                  </button>
              </div>
          </div>
      @endif 
    @endforeach

    <div class="row">
      <div class="col">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <h3 class="mb-0">{{ __("Loan Request Table") }}</h3>
          </div>
          <!-- Light table -->
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="sort" data-sort="name">User</th>
                  <th scope="col" class="sort" data-sort="budget">Collateral</th>
                  <th scope="col" class="sort" data-sort="status">Loan Applied</th>
                  <th scope="col" class="sort" data-sort="status">Loan Term</th>
                  <th scope="col" class="sort" data-sort="completion">Min Price</th>
                  <th scope="col" class="sort" data-sort="completion">Max Price</th>
                  <th scope="col" class="sort" data-sort="completion">Action</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody class="list">
                @if($loans->count() > 0)
                @foreach ($loans as $item)
                <tr>
                  <th>
                    <div class="media-body">
                      <span class="name mb-0 text-sm">{{ $item->user->name }}</span>
                    </div>
                    <small class="text-muted">{{ $item->user->email }}</small>
                  </th>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="rounded-circle mr-3">
                        <img alt="Image placeholder" width="25" src="{{ $item->collateral_currency->hasMedia('icon') ? $item->collateral_currency->firstMedia('icon')->getUrl() : '' }}">
                      </a>
                      <div class="media-body">
                      <span class="name mb-0 text-sm"> {{ $item->collateral_amount }}</span>
                      </div>
                    </div>
                  </th>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="rounded-circle mr-3">
                        <img alt="Image placeholder" width="25" src="{{ $item->loan_currency->hasMedia('icon') ? $item->loan_currency->firstMedia('icon')->getUrl() : '' }}">
                      </a>
                      <div class="media-body">
                        <span class="name mb-0 text-sm">{{ $item->loan_amount }}</span>
                      </div>
                    </div>
                  </th>
                  <th scope="row">
                     {{ $item->duration ? $item->duration.' '.$item->duration_type : ''  }} 
                  </th>
                  <th scope="row">
                    {{ $item->min_price }} 
                 </th>
                 <th scope="row">
                  {{ $item->max_price }}
                 </th>
                  <td>
                    <div class="dropdown">
                      @if($item->status != 'approved')
                      <a class="btn btn-sm btn-icon-only text-success" href="{{ route('admin.loan.update.status',['id'=>$item->id, 'status'=>'approved'])}}">
                        Approve
                      </a> &nbsp;&nbsp;&nbsp; 
                      @endif
                      <a class="btn btn-sm btn-icon-only text-danger" href="{{ route('admin.loan.update.status',['id'=>$item->id, 'status'=>'rejected'])}}">
                        Reject
                      </a>                       
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
              
            </table>
            
          </div>
         
          <!-- Card footer -->
          {{-- <div class="card-footer py-4">
            <nav aria-label="...">
              <ul class="pagination justify-content-end mb-0">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">
                    <i class="fas fa-angle-left"></i>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                <li class="page-item active">
                  <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">
                    <i class="fas fa-angle-right"></i>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div> --}}
        </div>
        {{ $loans->links() }}
      </div>
    </div>
</div>
@endsection

@section('page_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection