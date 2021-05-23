<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
        // $(".dropdown.onhover").on('click', function(){
        //     var dropdownMenu = $(this).children(".dropdown-menu");
        //     if(dropdownMenu.is(":visible")){
        //         dropdownMenu.toggleClass("show");
        //         dropdownMenu.parent().toggleClass("show");
        //     }
        // });

        $(".dropdown.onhover").hover(function(){
            var dropdownMenu = $(this).children(".dropdown-menu");
            if(dropdownMenu.is(":visible")){
                dropdownMenu.toggleClass("show");
                dropdownMenu.parent().toggleClass("show");
            }
        });
    });
//     $('.currency-item').on('click',function(e){
//       e.preventDefault();
//       var currency= $(this).data('currency');
//       $.ajax({
//          type:'POST',
//          dataType:'JSON',
//          url:"{{ route('user.update.currency') }}",
//          data:{ currency : currency, _token: "{{ csrf_token() }}" },
//          success:function(data) {
//             $('.currency-msg').html(data.message).show();
//             setTimeout(function() { $(".currency-msg").hide() }, 2000);
//             location.reload();
//          }
//       });
//    });
//    $('.language-item').on('click',function(e){
//       e.preventDefault();
//       var language= $(this).data('language');
//       $.ajax({
//          type:'POST',
//          dataType:'JSON',
//          url:"{{ route('user.update.language') }}",
//          data:{ language : language, _token: "{{ csrf_token() }}" },
//          success:function(data) {
//             $('.currency-msg').html(data.message).show();
//             setTimeout(function() { $(".currency-msg").hide() }, 2000);
//             location.reload();
//          }
//       });
//    });
</script>
<script type="text/javascript">
    // Iterate over each select element
$('select').each(function () {

    // Cache the number of options
    var $this = $(this),
        numberOfOptions = $(this).children('option').length;

    // Hides the select element
    $this.addClass('s-hidden');

    // Wrap the select element in a div
    $this.wrap('<div class="select"></div>');

    // Insert a styled div to sit over the top of the hidden select element
    $this.after('<div class="styledSelect"></div>');

    // Cache the styled div
    var $styledSelect = $this.next('div.styledSelect');

    // Show the first select option in the styled div
    $styledSelect.text($this.children('option').eq(0).text());

    // Insert an unordered list after the styled div and also cache the list
    var $list = $('<ul />', {
        'class': 'options'
    }).insertAfter($styledSelect);

    // Insert a list item into the unordered list for each select option
    for (var i = 0; i < numberOfOptions; i++) {
        $('<li />', {
            text: $this.children('option').eq(i).text(),
            rel: $this.children('option').eq(i).val()
        }).appendTo($list);
    }

    // Cache the list items
    var $listItems = $list.children('li');

    // Show the unordered list when the styled div is clicked (also hides it if the div is clicked again)
    $styledSelect.click(function (e) {
        e.stopPropagation();
        $('div.styledSelect.active').each(function () {
            $(this).removeClass('active').next('ul.options').hide();
        });
        $(this).toggleClass('active').next('ul.options').toggle();
    });

    // Hides the unordered list when a list item is clicked and updates the styled div to show the selected list item
    // Updates the select element to have the value of the equivalent option
    $listItems.click(function (e) {
        e.stopPropagation();
        $styledSelect.text($(this).text()).removeClass('active');
        $this.val($(this).attr('rel'));
        $list.hide();
        /* alert($this.val()); Uncomment this for demonstration! */
    });

    // Hides the unordered list when clicking outside of it
    $(document).click(function () {
        $styledSelect.removeClass('active');
        $list.hide();
    });

});
</script>