@extends('layouts.back')
@section('title')
    Trades |
@endsection
@section('content')
<div class="container-fluid mt-6 team-members">
    <div class="row">
        <div class="col-xl-12">
            <div class="card text-center trade two">
                <ul>
                    <li style="float: left;">
                        <h2 class="text-left">Buyer list</h2>
                    </li>
                    <!-- <li class="last text-right" style="float: right; padding-right: 20px;"><a href="#" class="text-red text-right"><b><i class="fa fa-trash-o" aria-hidden="true"></i> Delete All</b></a></li> -->
                </ul>
                <form action="delete-multiple-buyer.php" method="post">
                    <br><button type="submit" class="btn btn-danger" id="bulk-delete" style="display:none"><i
                            class="fa fa-trash" aria-hidden="true"></i> delete</button>
                    <div class="table-responsive red-scrollbar">
                        <!-- Projects table -->
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example" class="datatables table table-striped table-bordered text-left no-footer dtr-inline" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card inner-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Completed </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active inp" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h2>In the process of transaction</h2>
                        <div class="table-responsive red-scrollbar">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example" class="datatables table table-striped table-bordered text-left no-footer dtr-inline" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade inp" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h2>The transaction is completed. </h2>
                        <div class="table-responsive red-scrollbar">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example" class="datatables table table-striped table-bordered text-left no-footer dtr-inline" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th scope="col"><input type="checkbox" id="selectall" class="checked" /></th>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </tfoot>
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
