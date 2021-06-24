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

  

   <!--  second table  -->


    <div class="row">
     
      <div class="col">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <h3 class="mb-0">{{ __("Loans") }}</h3>
           
          </div>

           <div class="d-flex justify-content-center w-25 p-2">
                           <div class="col-md-5"><h3><i class="fa fa-filter" aria-hidden="true"></i> Filter</h3></div>
                           <div class="col-md-7">
                              <select name="status" class="" onchange="submitForm()" id="status_change">
                                 <option value="">All</option>
                                
                                 <option value="approved">Approved</option>
                                 <option value="rejected">Rejected</option>
                                 <option value="paid">Paid</option>
                                 <option value="close">Close</option>

                              </select>
                            </div>
                          </div>
                           
          <!-- Light table -->
          <div class="table-responsive">
            
            <table class="table table-bordered" id="loan-updated">
        <thead>
            <tr>
                 
                  <th scope="col" class="sort" data-sort="name">Id</th>
                  <th scope="col" class="sort" data-sort="name">User</th>
                  <th scope="col" class="sort" data-sort="budget">Loan Amount</th>
                  <th scope="col" class="sort" data-sort="status">Collateral</th>
                  <th scope="col" class="sort" data-sort="completion">Loan Terms</th>
                  
                  <th scope="col" class="sort" data-sort="status">Order date</th>
                  <th scope="col" class="sort" data-sort="completion">Status</th>
                  <th scope="col" class="sort" data-sort="completion">Action</th>


            </tr>
        </thead>
    </table>
            
          </div>
         
      
        </div>
    
      </div>
    </div>

   <!--end -->
</div>
@endsection

@section('page_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
  
  $(function() {
   

    // loans updated
   var loansUpdatedTable= $('#loan-updated').DataTable({
        processing: true,
        serverSide: true,
        ajax: {

            url: '{!! route('admin.loan.data.updated') !!}',
            data: function (d) {
                d.status = $('#status_change').val();
               
            }
        },
        columns: [
            { data: 'id', name: 'id' },
       //     { data: 'loan_id', name: 'loan_id' },
            { data: 'user', name: 'user.name' },
            { data: 'loan_amount', name: 'loan_amount' },
            { data: 'collateral_info', name: 'collateral_amount' },
            //{ data: 'loan_term', name: 'loan_term' },
            { data: 'term_percentage', name: 'term_percentage' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'status' },
            { data: 'detail_link', name: 'detail_link' },




        ]
    });

   $('#status_change').on('change', function(e) {
        loansUpdatedTable.draw();
        e.preventDefault();
    });
});
</script>
@endsection