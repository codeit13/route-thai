@if(!isset($show))
    <input type="hidden" name="chat_to" id="chat_to" value="@if(isset($transaction)) {{ $transaction->user_id }} @else {{ $transcation->buyer_requests->first()->user_id }} @endif">
    <input type="hidden" name="chat_from" id="chat_from" value="@if(!isset($transcation)){{ auth()->user()->id }} @else {{ $transcation->user_id }} @endif">
    <div class="col-lg-6 hidden-xs visible-sm col-sm-6 col-12">
        <div class="card chat  p-payment">
            <div class="chat_box">
                <h2 class="head_box bit"><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> ⚡ @if(isset($transaction)) {{ $transaction->user->name }} @else {{ $transcation->buyer_requests->first()->user->name }} @endif ⚡</h2>
                <div class="chat_body">
                    <div class="alert">ATTEBTION! DO NOT - release crypto before confirming the money (availble balance) has arrived in your payment account. DO NOT trust anyone claims to be customer support in this chat	<a href="#">Less</a>
                    </div>
                    <div id="chat_body" style="max-height: 70%;overflow-y: scroll;overflow-x: hidden;display: flex;flex-direction: column-reverse;"></div>
                </div>
                <div class="chat_footer">
                    <form>
                        <div class="form-group">
                            <div class="row">
                                {{-- <div class="col-lg-1 flush text-center col-sm-2 col-2">
                                    <a href="#">
                                    <img src="{{asset('front/img/paperclip.png')}}">
                                    </a>
                                </div> --}}
                                <div class="col-lg-11 flush col-sm-7 col-8">
                                    <input type="text" name="content" id="content_message" placeholder="Enter your message here">
                                </div>
                                <div class="col-lg-1 col-sm-3 col-2 xs-center xs-flush">
                                    <div class="send_box">
                                        <button id="content_button" type="button">
                                        <img src="{{asset('front/img/icon-green.png')}}">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif