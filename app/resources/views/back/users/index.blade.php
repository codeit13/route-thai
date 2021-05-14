@extends('layouts.back')
@section('content')
<style>
    .hidden {
        display: none;
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
                         <th scope="col">#</th>
                         <th scope="col">Name</th>
                         <th scope="col">Email</th>
                         <th scope="col">Mobile</th>
                         <th scope="col">Currency</th>
                         <th scope="col">Language</th>
                         <th scope="col">Create On</th>
                         <th scope="col">Action</th>
                      </tr>
                   </thead>
                   <tbody class="no_bg">
                           @foreach ($users as $key => $item)
                            <tr>
                            <td><input type="checkbox"  value="" class="check-all"></td>
                            <td> {{ $key+1 }}</td>
                            <td> {{ $item->name }}</td>
                            <td> {{ $item->email}}</td>
                            <td> {{ $item->mobile }}</td>
                            <td> {{ $item->currency->name ?? '' }}</td>
                            <td> {{ $item->language->name ?? "" }}</td>
                            <td> {{ date('d M Y, h:i:s A', strtotime($item->created_at)) }}</td>
                            <td> <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit Data</a>
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
        $('.datatables').DataTable({
         "paging":   false,
        });
        // $('select[name]').addClass('form-control-plaintext');
    </script>
@endsection

@endsection
 