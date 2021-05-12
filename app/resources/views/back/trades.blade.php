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
                                    <table
                                        class="datatables-1 display2 table align-items-center table-flush table table-striped table-bordered dataTable no-footer dtr-inline"
                                        id="DataTables_Table_0"
                                        style="width: 100%; display: inline-table !important; position: relative;"
                                        role="grid" aria-describedby="DataTables_Table_0_info">
                                        <thead class="thead-light">
                                            <tr role="row">
                                                <th scope="col" class="sorting_asc" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    style="width: 162px;" aria-sort="ascending"
                                                    aria-label=": activate to sort column descending"><input
                                                        type="checkbox" id="selectall" class="checked"></th>
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    style="width: 378px;"
                                                    aria-label="Serial Number: activate to sort column ascending">Serial
                                                    number </th>
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    style="width: 177px;"
                                                    aria-label="Buyer: activate to sort column ascending">Buyer</th>
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    style="width: 215px;"
                                                    aria-label="Model: activate to sort column ascending">Model</th>
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    style="width: 222px;"
                                                    aria-label="Status: activate to sort column ascending">status</th>
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    style="width: 154px;"
                                                    aria-label="Delete: activate to sort column ascending">delete</th>
                                            </tr>
                                        </thead>
                                        <tbody class="no_bg">
                                            <tr class="odd">
                                                <td valign="top" colspan="6" class="dataTables_empty">No data available
                                                    in table</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status"
                                        aria-live="polite">Showing 0 to 0 of 0 entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers"
                                        id="DataTables_Table_0_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled"
                                                id="DataTables_Table_0_previous"><a href="#"
                                                    aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0"
                                                    class="page-link">Previous</a></li>
                                            <li class="paginate_button page-item next disabled"
                                                id="DataTables_Table_0_next"><a href="#"
                                                    aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0"
                                                    class="page-link">Next</a></li>
                                        </ul>
                                    </div>
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
                            <!-- Projects table -->
                            <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="DataTables_Table_1_length"><label>Show
                                                <select name="DataTables_Table_1_length"
                                                    aria-controls="DataTables_Table_1"
                                                    class="custom-select custom-select-sm form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select> entries</label></div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="DataTables_Table_1_filter" class="dataTables_filter">
                                            <label>Search:<input type="search" class="form-control form-control-sm"
                                                    placeholder="" aria-controls="DataTables_Table_1"></label></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table
                                            class="display3 table align-items-center table-flush table table-striped table-bordered dataTable no-footer dtr-inline"
                                            id="DataTables_Table_1"
                                            style="width: 100%; display: inline-table !important; position: relative;"
                                            role="grid" aria-describedby="DataTables_Table_1_info">
                                            <thead class="thead-light">
                                                <tr role="row">
                                                    <th scope="col" class="sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_1" rowspan="1" colspan="1"
                                                        style="width: 277px;" aria-sort="ascending"
                                                        aria-label="Transaction ID: activate to sort column descending">
                                                        Transaction code </th>
                                                    <th scope="col" class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_1" rowspan="1" colspan="1"
                                                        style="width: 171px;"
                                                        aria-label="Vendor: activate to sort column ascending">Seller
                                                    </th>
                                                    <th scope="col" class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_1" rowspan="1" colspan="1"
                                                        style="width: 152px;"
                                                        aria-label="Buyer: activate to sort column ascending">Buyer</th>
                                                    <th scope="col" class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_1" rowspan="1" colspan="1"
                                                        style="width: 185px;"
                                                        aria-label="Model: activate to sort column ascending">Model</th>
                                                    <th scope="col" class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_1" rowspan="1" colspan="1"
                                                        style="width: 191px;"
                                                        aria-label="Status: activate to sort column ascending">status
                                                    </th>
                                                    <th scope="col" class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_1" rowspan="1" colspan="1"
                                                        style="width: 153px;"
                                                        aria-label="Slip: activate to sort column ascending">Slip</th>
                                                    <th scope="col" class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_1" rowspan="1" colspan="1"
                                                        style="width: 131px;"
                                                        aria-label="Delete: activate to sort column ascending">delete
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="no_bg">
                                                <tr class="odd">
                                                    <td valign="top" colspan="7" class="dataTables_empty">No data
                                                        available in table</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="DataTables_Table_1_info" role="status"
                                            aria-live="polite">Showing 0 to 0 of 0 entries</div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                            id="DataTables_Table_1_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled"
                                                    id="DataTables_Table_1_previous"><a href="#"
                                                        aria-controls="DataTables_Table_1" data-dt-idx="0" tabindex="0"
                                                        class="page-link">Previous</a></li>
                                                <li class="paginate_button page-item next disabled"
                                                    id="DataTables_Table_1_next"><a href="#"
                                                        aria-controls="DataTables_Table_1" data-dt-idx="1" tabindex="0"
                                                        class="page-link">Next</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade inp" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h2>The transaction is completed. </h2>
                        <div class="table-responsive red-scrollbar">
                            <!-- Projects table -->
                            <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="DataTables_Table_2_length"><label>Show
                                                <select name="DataTables_Table_2_length"
                                                    aria-controls="DataTables_Table_2"
                                                    class="custom-select custom-select-sm form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select> entries</label></div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="DataTables_Table_2_filter" class="dataTables_filter">
                                            <label>Search:<input type="search" class="form-control form-control-sm"
                                                    placeholder="" aria-controls="DataTables_Table_2"></label></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table
                                            class="display4 table align-items-center table-flush table table-striped table-bordered dataTable no-footer dtr-inline"
                                            id="DataTables_Table_2"
                                            style="width: 100%; display: inline-table !important; position: relative;"
                                            role="grid" aria-describedby="DataTables_Table_2_info">
                                            <thead class="thead-light">
                                                <tr role="row">
                                                    <th scope="col" class="sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                                        style="width: 0px;" aria-sort="ascending"
                                                        aria-label="Transaction ID: activate to sort column descending">
                                                        Transaction code </th>
                                                    <th scope="col" class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                                        style="width: 0px;"
                                                        aria-label="Vendor: activate to sort column ascending">Seller
                                                    </th>
                                                    <th scope="col" class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                                        style="width: 0px;"
                                                        aria-label="Buyer: activate to sort column ascending">Buyer</th>
                                                    <th scope="col" class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                                        style="width: 0px;"
                                                        aria-label="Model: activate to sort column ascending">Model</th>
                                                    <th scope="col" class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                                        style="width: 0px;"
                                                        aria-label="Status: activate to sort column ascending">status
                                                    </th>
                                                    <th scope="col" class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                                        style="width: 0px;"
                                                        aria-label="Slip: activate to sort column ascending">Slip</th>
                                                    <th scope="col" class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                                        style="width: 0px;"
                                                        aria-label="Payment ID: activate to sort column ascending">
                                                        Payment ID</th>
                                                    <th scope="col" class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                                        style="width: 0px;"
                                                        aria-label="Delete: activate to sort column ascending">delete
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="no_bg">

                                                <tr role="row" class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">1</td>
                                                    <td>user14</td>
                                                    <td>user15</td>
                                                    <td>Suzuki Swift</td>
                                                    <td>approved</td>
                                                    <td><a target="_blank"
                                                            href="/tabs/actions/uploads/user15-pay-reciept-1.jpg"><i
                                                                class="fa fa-file-text" aria-hidden="true"></i> File</a>
                                                    </td>
                                                    <td>345234234</td>
                                                    <td><a href="delete-finished.php?_finishedId=1" class="text-red"><i
                                                                class="fa fa-trash-o" aria-hidden="true"></i> delete</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="even">
                                                    <td class="dtr-control sorting_1" tabindex="0">2</td>
                                                    <td>user3</td>
                                                    <td>user2</td>
                                                    <td>Suzuki Swift</td>
                                                    <td>approved</td>
                                                    <td><a target="_blank"
                                                            href="/tabs/actions/uploads/user2-pay-reciept-4.PNG"><i
                                                                class="fa fa-file-text" aria-hidden="true"></i> File</a>
                                                    </td>
                                                    <td>234</td>
                                                    <td><a href="delete-finished.php?_finishedId=2" class="text-red"><i
                                                                class="fa fa-trash-o" aria-hidden="true"></i> delete</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">3</td>
                                                    <td>user2</td>
                                                    <td>user3</td>
                                                    <td>Suzuki Swift</td>
                                                    <td>approved</td>
                                                    <td><a target="_blank"
                                                            href="/tabs/actions/uploads/user3-pay-reciept-5.PNG"><i
                                                                class="fa fa-file-text" aria-hidden="true"></i> File</a>
                                                    </td>
                                                    <td>234</td>
                                                    <td><a href="delete-finished.php?_finishedId=3" class="text-red"><i
                                                                class="fa fa-trash-o" aria-hidden="true"></i> delete</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="even">
                                                    <td class="dtr-control sorting_1" tabindex="0">5</td>
                                                    <td>user1</td>
                                                    <td>sky00</td>
                                                    <td>Suzuki Swift</td>
                                                    <td>approved</td>
                                                    <td><a target="_blank"
                                                            href="/tabs/actions/uploads/sky00-pay-reciept-8.jpg"><i
                                                                class="fa fa-file-text" aria-hidden="true"></i> File</a>
                                                    </td>
                                                    <td>123456</td>
                                                    <td><a href="delete-finished.php?_finishedId=5" class="text-red"><i
                                                                class="fa fa-trash-o" aria-hidden="true"></i> delete</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">6</td>
                                                    <td>user1</td>
                                                    <td>sky00</td>
                                                    <td>Suzuki Swift</td>
                                                    <td>approved</td>
                                                    <td><a target="_blank"
                                                            href="/tabs/actions/uploads/sky00-pay-reciept-9.jpg"><i
                                                                class="fa fa-file-text" aria-hidden="true"></i> File</a>
                                                    </td>
                                                    <td>test</td>
                                                    <td><a href="delete-finished.php?_finishedId=6" class="text-red"><i
                                                                class="fa fa-trash-o" aria-hidden="true"></i> delete</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="even">
                                                    <td class="dtr-control sorting_1" tabindex="0">7</td>
                                                    <td>sky05</td>
                                                    <td>daytrade</td>
                                                    <td>Suzuki Swift</td>
                                                    <td>approved</td>
                                                    <td><a target="_blank"
                                                            href="/tabs/actions/uploads/daytrade-pay-reciept-10.jpg"><i
                                                                class="fa fa-file-text" aria-hidden="true"></i> File</a>
                                                    </td>
                                                    <td>daytrade</td>
                                                    <td><a href="delete-finished.php?_finishedId=7" class="text-red"><i
                                                                class="fa fa-trash-o" aria-hidden="true"></i> delete</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">8</td>
                                                    <td>yukiyuki</td>
                                                    <td>user1</td>
                                                    <td>Suzuki Swift</td>
                                                    <td>approved</td>
                                                    <td><a target="_blank"
                                                            href="/tabs/actions/uploads/user1-pay-reciept-12.png"><i
                                                                class="fa fa-file-text" aria-hidden="true"></i> File</a>
                                                    </td>
                                                    <td>tekwn2354</td>
                                                    <td><a href="delete-finished.php?_finishedId=8" class="text-red"><i
                                                                class="fa fa-trash-o" aria-hidden="true"></i> delete</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="even">
                                                    <td class="dtr-control sorting_1" tabindex="0">9</td>
                                                    <td>sky05</td>
                                                    <td>abc</td>
                                                    <td>Suzuki Swift</td>
                                                    <td>approved</td>
                                                    <td><a target="_blank"
                                                            href="/tabs/actions/uploads/abc-pay-reciept-13.jpg"><i
                                                                class="fa fa-file-text" aria-hidden="true"></i> File</a>
                                                    </td>
                                                    <td></td>
                                                    <td><a href="delete-finished.php?_finishedId=9" class="text-red"><i
                                                                class="fa fa-trash-o" aria-hidden="true"></i> delete</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">10</td>
                                                    <td>sky05</td>
                                                    <td>abc</td>
                                                    <td>Suzuki Swift</td>
                                                    <td>approved</td>
                                                    <td><a target="_blank"
                                                            href="/tabs/actions/uploads/abc-pay-reciept-14.jpg"><i
                                                                class="fa fa-file-text" aria-hidden="true"></i> File</a>
                                                    </td>
                                                    <td>My name</td>
                                                    <td><a href="delete-finished.php?_finishedId=10" class="text-red"><i
                                                                class="fa fa-trash-o" aria-hidden="true"></i> delete</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="even">
                                                    <td class="dtr-control sorting_1" tabindex="0">11</td>
                                                    <td>sky05</td>
                                                    <td>abc</td>
                                                    <td>Suzuki Swift</td>
                                                    <td>approved</td>
                                                    <td><a target="_blank"
                                                            href="/tabs/actions/uploads/abc-pay-reciept-15.jpg"><i
                                                                class="fa fa-file-text" aria-hidden="true"></i> File</a>
                                                    </td>
                                                    <td>My name</td>
                                                    <td><a href="delete-finished.php?_finishedId=11" class="text-red"><i
                                                                class="fa fa-trash-o" aria-hidden="true"></i> delete</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="DataTables_Table_2_info" role="status"
                                            aria-live="polite">Showing 1 to 10 of 24 entries</div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                            id="DataTables_Table_2_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled"
                                                    id="DataTables_Table_2_previous"><a href="#"
                                                        aria-controls="DataTables_Table_2" data-dt-idx="0" tabindex="0"
                                                        class="page-link">Previous</a></li>
                                                <li class="paginate_button page-item active"><a href="#"
                                                        aria-controls="DataTables_Table_2" data-dt-idx="1" tabindex="0"
                                                        class="page-link">1</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="DataTables_Table_2" data-dt-idx="2" tabindex="0"
                                                        class="page-link">2</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="DataTables_Table_2" data-dt-idx="3" tabindex="0"
                                                        class="page-link">3</a></li>
                                                <li class="paginate_button page-item next" id="DataTables_Table_2_next">
                                                    <a href="#" aria-controls="DataTables_Table_2" data-dt-idx="4"
                                                        tabindex="0" class="page-link">Next</a></li>
                                            </ul>
                                        </div>
                                    </div>
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
        $('#datatables-1').DataTable();
    </script>
@endsection
@endsection
