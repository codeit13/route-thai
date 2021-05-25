<div class="modal fade" id="usernameUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog model-centered" role="document">
        <form action="#" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Username</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label> Username: </label>
                    <input class="form-control" id="username" value="{{ Auth::user()->name }}" type="text"
                        name="username">
                    <span class="usr-msg"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-username">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('extra_scripts')
<script>
    $(document).find('#username').on('change keyup',function(){
        var dis = $(this);
        if(dis.val() !== $('.username').text().trim() && dis.val().length > 3){
            $.ajax({
                url: "{{ route('user.check.username') }}",
                method: "POST",
                headers: {
                   'X-CSRF-Token': "{{ csrf_token() }}"
                },
                data: { _token: "{{ csrf_token() }}", name: dis.val(), is_usename_updated:true },
                dataType: "json",
                async: true,
                cache: false,
                beforeSend:function(){
                    $('.usr-msg').html("Checking...");
                },
                success: function (res) {
                 cls = '';
                 if (res.status == 'OK') {
                    cls  = 'text-success';
                 } else if (res.status == 'NOT OK') {
                    cls  = 'text-danger';
                 }
                 $('.usr-msg').html("<label class='"+ cls +"'>"+res.message+"</label>");
                },
                error: function (event) { 
                    
                },
            });
        }
        else {  
           $('.usr-msg').html("<label></label>");
           return false; }
    });

   $('.save-username').on('click',function(e){
        e.preventDefault();
        $.ajax({
            type:'POST',
            dataType:'JSON',
            url:"{{ route('user.update.username') }}",
            data:{ username : $('#username').val(), _token: "{{ csrf_token() }}" },
            success:function(data) {
               $('.toggle-msg').html(data.message).show();
               setTimeout(function() { $(".toggle-msg").hide() }, 2000);
               $('#usernameUpdate .close').trigger('click');
               $('.username span').html($('#username').val());
               $('.username a').remove();
            }
         });
   });
</script>
@endpush

