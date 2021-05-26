	<div class="modal" id="exampleModalnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-left: 0px;">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						Transfer
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form>
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
									      <div class="css-38fup1">
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
										<select class="form-control" onchange="changeCurrencyDropdown(this)">
											<option value="">Select Wallet</option>
											<option value="fiat_and_spot">Fiat and Spot</option>
											<option value="p2p">P2P</option>
										</select>
									</div>
									<div class="field">
										<label>To</label>
										<select class="form-control" id="to_wallet_server">
											<option value="fiat_and_spot">Fiat and Spot</option>
											<option value="p2p">P2P</option>
										</select>
									</div>
								</div>
							</div>
						</div>	
						<div class="line b-none">
							<div class="field">
								<label>Coin</label>
								<div class="dropdown currency_two three_coins crypto" id="transfer_coin_server">
								  
								</div>
								<input type="hidden" id="transfer_coin_id" name="currency_id" value="">
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
								<input type="text" name="quantity" id="transfter_quantity" max="" placeholder="Max"/>
							</div>
							<div class="field">
								<button type="submit">Confirm</button>
							</div>
						</div>	
					 </div>

					</form>
				</div>	 
			</div>
		</div>