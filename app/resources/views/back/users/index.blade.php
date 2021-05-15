@extends('layouts.back')
@section('content')
<style>
    .hidden {
        display: none;
    }
    td{
      font-weight: 500 !important;
      text-transform: capitalize
    }
    .btn-sm.btn-outline-default:hover{
      color:white;
    }
</style>

 <div class="container-fluid mt-4 team-members">
    <div class="row">
       <div class="col-xl-12">
          <div class="card text-center trade two">
             <ul>
               <li style="float: left;"><h2 class="text-left"></h2></li>
               <!-- <li class="last text-right" style="float: right; padding-right: 20px;"><a href="#" class="text-red text-right"><b><i class="fa fa-trash-o" aria-hidden="true"></i> Delete All</b></a></li> -->
             </ul>
             <form action="delete-multiple-buyer.php" method="post">
             <br><button type="submit" class="btn btn-danger" id="bulk-delete" style="display:none"><i class="fa fa-trash" aria-hidden="true"></i> </button>
             <div class="table-responsive red-scrollbar">
                <!-- Projects table -->
                <table class="datatables table text-left table-flush table table-striped table-bordered" id="" style="width:100%; display: inline-table !important;">
                   <thead class="thead-light">
                      <tr>
                         <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
                         <th scope="col">Name</th>
                         <th scope="col">Email</th>
                         <th scope="col">Mobile</th>
                         <th scope="col">Balance</th>
                         <th scope="col">Settings</th> 
                         <th scope="col">Notification</th>
                         <th scope="col">Status</th>
                         <th scope="col">Create On</th>
                         <th scope="col">Action</th>
                      </tr>
                   </thead>
                   <tbody class="no_bg">
                           @foreach ($users as $key => $item)
                            <tr>
                            <td><input type="checkbox"  value="" class="check-all"></td>
                            <td> {{ $item->name }}</td>
                            <td> {{ $item->email}}</td>
                            <td> {{ $item->mobile }}</td>
                            <td> {{ $item->wallet()->first() != null ? $item->wallet()->first()->groupBy('Currency_id')->sum('coin').' '.$item->wallet()->first()->currency()->first()->name :  0}}</td>
                            <td> <b>Currency : </b>{{ $item->currency->name ?? 'None' }} <br/>
                                 <b>Language : </b>{{ $item->language->name ?? "None" }}</td>
                            <td> <b>SMS: </b> {{  $item->sms_notification ? ' Enabled ': 'Disabled' }} 
                               <br/>
                                <b>LINE: </b> {{ $item->line_notification ? ' Enabled ': 'Disabled'}}
                            </td>
                            <td> 
                              <select class="form-control-sm bg-white userStatus" data-id="{{ $item->id}}"  name="status">
                                  <option {{ $item->status == 'Enabled' ? 'selected' :'' }} value="Enabled">Enabled</option>
                                  <option {{ $item->status == 'Disabled' ? 'selected' :'' }} value="Disabled">Disabled</option>
                                  <option {{ $item->status == 'Blocked' ? 'selected' :'' }} value="Blocked">Blocked</option>
                               </select>
                              <br><small class="msg{{$item->id}}"></small>
                            </td>
                            <td> {{ date('d M Y', strtotime($item->created_at)) }}</td>
                            <td> <a href="#" class="btn-outline-default btn-sm btn"><i class="fa fa-eye"></i> View</a>
                            </td>
                           </tr> 
                           @endforeach 
                   </tbody>
                   <tfoot class="tfoot-light">
                    <tr>
                       <th colspan="7">{{ $users->links() }}</th>
                    </tr>
                 </tfoot>
                </table>
             </div>
            </form>
          </div>
       </div>
    </div>
 </div>
 @section('page_scripts')
    <script>
      //   $('.datatables').DataTable({
      //        "paging":   false,
      //   });

        function format ( d ) {
    // `d` is the original data object for the row
               return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                  '<tr>'+
                        '<td>Full name:</td>'+
                        '<td>'+d.name+'</td>'+
                  '</tr>'+
                  '<tr>'+
                        '<td>Extension number:</td>'+
                        '<td>'+d.extn+'</td>'+
                  '</tr>'+
                  '<tr>'+
                        '<td>Extra info:</td>'+
                        '<td>And any further details here (images etc)...</td>'+
                  '</tr>'+
               '</table>';
            }
        $(document).ready(function() {
         var table = $('.datatables').DataTable({
             "paging":   false,
        });
    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
} );



   $('.userStatus').on('change',function(e){
        e.preventDefault();
        var status = $(this).val();
        var id = $(this).data('id');
         $.ajax({
            type:'POST',
            dataType:'JSON',
            async:true,
            url:"{{ route('admin.user.update.status') }}",
            data:{ status : status,id:id, _token: "{{ csrf_token() }}" },
            success:function(data) {
               $('.msg'+id).html(data.message).show();
               setTimeout(function() { $(".msg"+id).hide() }, 2000);
               // location.reload();
            }
         });
    });
    </script>
@endsection

@endsection
 