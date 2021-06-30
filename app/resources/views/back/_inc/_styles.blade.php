<link rel="icon" href="{{ asset('back/img/brand/favicon.png') }}" type="image/png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
<link rel="stylesheet" href="{{ asset('back/vendor/nucleo/css/nucleo.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('back/vendor/font-awesome/css/font-awesome.min.css') }}" type="text/css">
<link href="{{ asset('back/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('back/css/argon.css') }}" type="text/css">

<link href=" {{ asset('back/css/pagination.css') }}" rel="stylesheet" />
<style>
tr {
    cursor: pointer;
}
.table-striped tbody tr:nth-of-type(odd):hover{
    background: #efefef;
}
div.dataTables_wrapper div.dataTables_filter input{
    padding-left: 45px; 
}

table.dataTable thead th, table.dataTable thead td {
    border-bottom: none !important;
    }

    table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
        /*padding: 10px 5px !important;*/
        /*text-align: center !important;*/
    }
</style>