<script type="text/javascript">

	var collateral_quantity=0;
	
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


function get_currency_row_by_id(currency_id)
{

	var currency=currencies.find(function(currency)
    {
       return currency.id==currency_id;
    })

    return currency;
}



function get_fiat_currency_row_by_id(currency_id)
{

	var currency=fiat_currencies.find(function(currency)
    {
       return currency.id==currency_id;
    })

    return currency;
}

function get_crypto_exchange_row(cryptoRow)
{
	var crypto_exchange_row= crypto_exchange_rates.find(function(v,i){

	   return v.symbol==cryptoRow.short_name+'USDT';
	})

	return crypto_exchange_row;

}

function get_fiat_exchange_row(fiatRow)
{
	var fiat_exchange_rate=fiat_exchange_rates.data.rates[fiatRow.short_name];
	

	return fiat_exchange_rate;
}

function showCurrencyRate()
{
	var crypto_id=$('#coin_id').val();

	var cryptoRow=get_currency_row_by_id(crypto_id);


   	var filteredCryptoExchangeRow=get_crypto_exchange_row(cryptoRow);

    usdPrice=parseFloat(filteredCryptoExchangeRow.lastPrice).toFixed(2);



	var newText='<img src="" alt=""/>&nbsp; '+cryptoRow.short_name+':<b>'+numberWithCommas(usdPrice)+'</b> USD <span></span> <a href="#"></a>';

		$('#backend-current-usd-rate').html(newText);

		var fiat_currency=$('#backend-fiat-coin-id').val();

		var fiatRow=get_fiat_currency_row_by_id(fiat_currency);

		var fiatRateFromUsd=get_fiat_exchange_row(fiatRow);

		console.log(fiatRateFromUsd);

		var newUpdateLaonPrice=(parseFloat(usdPrice)*parseFloat(fiatRateFromUsd)*collateral_quantity);

		newUpdateLaonPrice=(newUpdateLaonPrice - (newUpdateLaonPrice * (100-term.percentage) / 100)).toFixed(2);

		if(newUpdateLaonPrice >0)
		{

		$('#backend-loan-amount').val(newUpdateLaonPrice);

		var Interest=(newUpdateLaonPrice*2.1*(term.days/30)/100);


		newUpdateLaonPrice=(parseFloat(newUpdateLaonPrice)+parseFloat(Interest)).toFixed(2);


		$('#backend-loan-repayment,#backend-final-loan-amount').html(newUpdateLaonPrice+'<span>'+fiatRow.short_name+'</span>');

		$('#backend-collateral-amount').html(collateral_quantity+'<span>'+cryptoRow.short_name+'</span>')



		}
		else
		{
		$('#backend-loan-amount').val('');

		$('#backend-loan-repayment,#backend-final-loan-amount').html('-----');

		}


       

		//console.log(newUpdateLaonPrice);


}

$(document).ready(function(){

	$(".currencyDropdown .dropdown-menu .dropdown-item").on("click", function(e) { e.preventDefault();

      var currency_id=$(this).attr('data-id');

   changeShowBalance(currency_id);


    $('#coin_id').val(currency_id);

    $('.currencyDropdown .dropdown-toggle').html($(this).html());

  showCurrencyRate();

 
});

	$(".backend-fiat-dropdown .dropdown-menu .dropdown-item").on("click", function(e) { e.preventDefault();

      var currency_id=$(this).attr('data-id');

  // changeShowBalance(currency_id);


    $('#backend-fiat-coin-id').val(currency_id);

    $('.backend-fiat-dropdown .dropdown-toggle').html($(this).html());

    showCurrencyRate();

 
});


	$(document).on('keyup','#collateral_quantity',function()
{

    collateral_quantity=parseFloat($(this).val());

    $(this).parents('.multi_form').eq(0).next('.validateError').remove();
  
    transferSelectedCurrencyBalance=parseFloat(transferSelectedCurrencyBalance);

    if(transferSelectedCurrencyBalance < collateral_quantity && $('.backend-is-wallet').prop('checked')==true)
    {
      

      $(this).parents('.multi_form').eq(0).after('<p class="text-danger text-bold validateError">{{__("Loan quantity should be less than available balance.")}}</p>');
    }

    showCurrencyRate();

    
})

	$(document).on('click','.backend-is-wallet',function()
	{
		
		$('#collateral_quantity').keyup();
	})


})



	

	var currentCurrency=$('#coin_id').val();

	var transferSelectedCurrencyBalance='';

	changeShowBalance(currentCurrency);

	showCurrencyRate();

function set_price_down_limit()
{

}

function changeShowBalance(coin_id)
{


    var balance='0.00000';
  transferSelectedCurrencyBalance=balance;

    var balanceRow=wallets.filter(function(wallet){
          return wallet.currency_id==coin_id;
    })

    balanceRow=balanceRow[0];

    var currencyRow=currencies.filter(function(currency)
    {
       return currency.id==coin_id;
    })

    currencyRow=currencyRow[0];

    balance=balance+' '+currencyRow.short_name;

    if( balanceRow && typeof balanceRow.coin !='undefined')
    {
         balance=balanceRow.coin + ' '+currencyRow.short_name;

         transferSelectedCurrencyBalance=balanceRow.coin;
    }

    $('#totalBalance').text(balance);
}





function activeThisTerm(selector,term)
{
    $(selector).parents('.row').eq(0).find('a').removeClass('active');

    $(selector).addClass('active');

     term=get_term(term);

     $('#backend-loan-term-id').val(term.id);

     $('#backend-term-days').html(term.days+' days');

     showCurrencyRate();
}

function get_term(term_id)
{
	 term=terms.find(function(v,k)
	{
		return v.id==term_id;
	})

	return term;
}
</script>