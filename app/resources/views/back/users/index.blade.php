@extends('layouts.back')
@section('content')
<div class="header filter bg-primary pb-6">
    <div class="container-fluid">
       <div class="header-body">
          <div class="row align-items-center py-4">
             <div class="col-lg-12">
                <div class="card">
                   <ul>
                      <li>
                         <h3><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </h3>
                      </li>
                      <li class="last">
                         <form class="search needs-validation" target="_blank" action="trades_data.php" method="POST" novalidate id="search_trans_id">
                            <input name="search_transaction_id" type="text" class="form-control" id="search_transaction_id" required>
                            <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                         </form>
                      </li>
                   </ul>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 <!-- Page content -->
 <div class="container-fluid mt--6 team-members">
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
                <table class="display2 table align-items-center table-flush table table-striped table-bordered" id="" style="width:100%; display: inline-table !important;">
                   <thead class="thead-light">
                      <tr>
                         <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
                         <th scope="col">#</th>
                         <th scope="col">Name</th>
                         <th scope="col">Email</th>
                         <th scope="col">Mobile</th>
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
                            <td> {{ $item->created_at }}</td>
                            <td> <button type="button" class="btn btn-primary my-4">Edit Data</button>
                                <button type="button" class="btn btn-success my-4">Save Data</button>
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
 @endsection