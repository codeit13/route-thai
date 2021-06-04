	<div class="modal" id="exampleModalnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-left: 0px;">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						Transfer
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form method="post" action="{{route('wallet.transfer')}}" id="transferFormModal">
						@csrf
					 <div class="modal-body">
						<div class="line">
							<p>Internal transfter are free on Route Thai.</p>
							<div class="row">
								<div class="col-lg-2 text-center top-m col-sm-2 col-2">
									<div class="css-1kzpntp">
									   <div class="css-vwdmr0">
									      <div class="css-13zymhf"></div>
									      <div class="css-11mpmlu"></div>
									      <div class="css-1a1w98z"></div>
									      <div class="css-38fup1" onclick="transferDropdown()">
									         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="css-124czaz">
									            <path d="M2 10V8l5-5 1.414 1.414L4.83 8h17.17v2H2zM22 14v2l-5 5-1.414-1.414L19.172 16H2v-2h20z" fill="#76808F"></path>
									         </svg>
									      </div>
									   </div>
									</div>
								</div>


								<div class="col-lg-10 flush-left col-sm-10 col-10">
									<div class="field">
										<label>From</label>
										<select class="form-control" onchange="changeCurrencyDropdown(this)" name="wallet_from">
										
											<option value="1">Fiat and Spot</option>
											<option value="3">P2P</option>
										</select>

										@error('wallet_from')
                                <p class="invalid-value" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror
									</div>
									<div class="field">
										<label>To</label>
										<select class="form-control" id="to_wallet_server" name="wallet_to">
											<option value="1">Fiat and Spot</option>
											<option value="3">P2P</option>
										</select>
										@error('wallet_to')
                                <p class="invalid-value" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror
									</div>
								</div>
							</div>
						</div>	
						<div class="line b-none">
							<div class="field">
								<label>Coin</label>
								<div class="dropdown currency_two three_coins crypto" id="transfer_coin_server">
								  
								</div>
								<input type="hidden" id="transfer_coin_id" name="transfer_currency_id" value="">

								@error('transfer_currency_id')
                                <p class="invalid-value" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror
							</div>
							<div class="field">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-xs-12">
										<label>Amount</label>
									</div>
									<div class="col-lg-6 text-right col-sm-6 col-xs-12">
										<label><span id="totalBalanceForTransfer"></span> available</label>
									</div>
								</div>
								<!--dont delete this element -->
								<span style="position:relative;"></span>
								<div id="max_transfer_quantity" style="text-align:center;position: relative;color:#00c98e;top:32px;width:13%;float: right;">Max</div>

								<!--end -->
								<input type="text" name="transfer_quantity" id="transfer_quantity" style="" placeholder="" value="" />

								

								@error('transfer_quantity')
                                <p class="invalid-value" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror
							</div>
							<div class="field">
								<button type="submit" id="transferSubmitButton">Confirm</button>
							</div>
						</div>	
					 </div>

					</form>
				</div>	 
			</div>
		</div>