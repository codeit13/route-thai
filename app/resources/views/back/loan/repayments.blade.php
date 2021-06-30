@extends('layouts.back')
@section('title')
    Settings |
@endsection
<style>
  svg {
    width: 10px;
  }
  .flex.justify-between.flex-1.sm\:hidden, a[rel="prev"],  a[rel="next"] , span[aria-label="&laquo; Previous"], span[aria-label="Next &raquo;"]
  {
    display: none;
  }
</style>

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
            <h3 class="mb-0">{{ __("Loan Repayments Table") }}</h3>
          </div>
          <!-- Light table -->
          <div class="table-responsive">
            
            <table class="table table-bordered" id="loan-table">
        <thead>
            <tr>
                 
                  <th scope="col" class="sort" data-sort="name">Id</th>
                  <th scope="col" class="sort" data-sort="name">User</th>
                  <th scope="col" class="sort" data-sort="status">Collateral</th>
                  <th scope="col" class="sort" data-sort="budget">Loan</th>
                  <th scope="col" class="sort" data-sort="budget">Repayment</th>

                  <th scope="col" class="sort" data-sort="budget" style="width:60px !important;">Repay<br> Date</th>

                  
                  <th scope="col" class="sort" data-sort="completion">Loan <br> Terms</th>
                  
                  <th scope="col" class="sort" data-sort="status">Date</th>
                  <th scope="col" class="sort" data-sort="completion">Action</th>

            </tr>
        </thead>
    </table>
            
          </div>
         
      
        </div>
    
      </div>
    </div>


</div>

<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#151c31 !important;color: white !important;">
        <h5 class="modal-title text-light" id="exampleModalLabel">Suggestion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Collateral transferred manually.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="markAsDone()">Yes</button>
      </div>
    </div>
  </div>
</div>


@endsection

@section('page_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
  
  $(function() {
    $('#loan-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.repayments.request.list') !!}',
        columns: [
            { data: 'id', name: 'id' },
       //     { data: 'loan_id', name: 'loan_id' },
            { data: 'user', name: 'user.name' },
            { data: 'collateral_info', name: 'collateral_amount' },

            { data: 'loan_amount', name: 'loan_amount' },
            { data: 'loan_repayment_amount', name: 'loan_repayment_amount' },

            { data: 'loan_request.repay_date', name: 'loan_request.repay_date' },

            //{ data: 'loan_term', name: 'loan_term' },
            { data: 'loan_request.term_percentage', name: 'loan_request.term_percentage' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },



        ]
    });

    
});

  var current_repay_request='';

 
  function confirm_action(selector)
  {
    current_repay_request=$(selector).attr('href');

     $('#confirmModal').modal('show');

     return false;

     
  }

  function markAsDone()
  {
    window.location.href=current_repay_request;
  }
</script>
@endsection