@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('content')
<style>
    .go-back {
        color: grey;
    }
    .go-back:hover {
        color: white;
    }
</style>
<section id="banner_search">
   <div class="container">
      <div class="row">
         <div class="col text-center xs-left">
            <h2>Line Bot</h2>
            <p>Add our Line Bot as a friend and get every updates regarding your account right in your line app.</p>
            <a target="_blank" href="" class="btn btn-success" id="add-friend">Add Friend</a>
            <br><br>
            <a href="{{ route('user.dashboard') }}" class="btn btn-sm go-back">Go back to Dashboard</a>
         </div>
      </div>
   </div>
</section>
<script>
    let bot_url = "http://line.me/ti/p/@" + "{{env('LINE_BOT_USERID')}}"
    document.getElementById('add-friend').href = bot_url
</script>
@endsection