<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('front/js/jquery.dataTables.min.js') }}"></script>
<script src="{{asset('front/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{asset('front/js/dataTables.rowReorder.min.js') }}"></script>
<script src="{{asset('front/js/dataTables.responsive.min.js') }}"></script>
<script src="{{asset('front/js/darkmode.js') }}" charset="utf-8"></script>
<script src="{{asset('front/js/offcanvas.js') }}" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    $("#footer ul li.Company:first-child").click(function(){
        $("ul.Company-main li").toggle();
    });
    $("#footer ul li.Individuals:first-child").click(function(){
        $("ul.Individuals-main li").toggle();
    });
    $("#footer ul li.Learn:first-child").click(function(){
        $("ul.Learn-main li").toggle();
    });
    $("#footer ul li.Support:first-child").click(function(){
        $("ul.Support-main li").toggle();
    });

    // show success message modal

    @if(session('success'))

        $('#successModal101').modal('show');


        @endif
    });
</script>