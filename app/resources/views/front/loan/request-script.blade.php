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

		//console.log(v);

	   return v.symbol==cryptoRow.short_name+'USDT';
	})

	if(cryptoRow.short_name=='USDT')
	{
		return {
    "symbol": "USDT",
    "priceChange": "-0.55308000",
    "priceChangePercent": "-31.201",
    "weightedAvgPrice": "1.57545245",
    "prevClosePrice": "1.77265000",
    "lastPrice": "1.00000000",
    "lastQty": "41.00000000",
    "bidPrice": "1.21599000",
    "bidQty": "640.00000000",
    "askPrice": "1.21973000",
    "askQty": "117.00000000",
    "openPrice": "1.77265000",
    "highPrice": "1.89057000",
    "lowPrice": "1.12100000",
    "volume": "131974930.00000000",
    "quoteVolume": "207920226.31104000",
    "openTime": 1623067237426,
    "closeTime": 1623153637426,
    "firstId": 1071985,
    "lastId": 1727494,
    "count": 655510
       }
	}

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

   	//console.log(filteredCryptoExchangeRow);return false;

    usdPrice=parseFloat(filteredCryptoExchangeRow.lastPrice).toFixed(2);



	var newText='<img src="" alt=""/>&nbsp; '+cryptoRow.short_name+':<b>'+numberWithCommas(usdPrice)+'</b> USDT <span></span> <a href="#"></a>';

	  $('plimit').html((usdPrice*parseFloat(price_down_limit)/100).toFixed(2));

	  $('#backend-limit-text').html(cryptoRow.short_name+'/USDT');

		$('#backend-current-usd-rate').html(newText);

		var fiat_currency=$('#backend-fiat-coin-id').val();

		if(fiat_currency)
		{
			var fiatRow=get_currency_row_by_id(fiat_currency);

		    var filteredLoanExchangeRow=get_crypto_exchange_row(fiatRow);

		   // console.log(filteredLoanExchangeRow);



		    var newUpdateLoanPrice=((parseFloat(filteredCryptoExchangeRow.lastPrice)/parseFloat(filteredLoanExchangeRow.lastPrice))*collateral_quantity);
		  //  console.log(newUpdateLoanPrice);

		    newUpdateLoanPrice=(newUpdateLoanPrice - (newUpdateLoanPrice * (100-term.terms_percentage) / 100)).toFixed(5);



		     $('#backend-min-price').html(numberWithCommas((parseFloat(usdPrice)-parseFloat(usdPrice*parseFloat(set_price_min)/100)).toFixed(2)));



		    $('#backend-max-price').html(numberWithCommas((parseFloat(usdPrice)+parseFloat(usdPrice*parseFloat(set_price_max)/100)).toFixed(2)));

		    




		   //newUpdateLoanPrice= Math.round((newUpdateLoanPrice + Number.EPSILON) * 100) / 100

		    
		}

		

		

		if(newUpdateLoanPrice >0)
		{

		$('#backend-loan-amount').val(newUpdateLoanPrice);

		var timeDuration=term.no_of_duration;

		if(term.duration_type=='month')
		{
			timeDuration=term.no_of_duration*30;
		}

		if(term.duration_type=='year')
		{
			timeDuration=term.no_of_duration*12*30;
		}

         //console.log(timeDuration);

		var Interest=(newUpdateLoanPrice*2.1*(timeDuration/30)/100);




		newUpdateLoanPrice=(parseFloat(newUpdateLoanPrice)+parseFloat(Interest)).toFixed(5);


		$('#backend-loan-repayment,#backend-final-loan-amount').html(newUpdateLoanPrice+'<span>'+fiatRow.short_name+'</span>');

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

	$(document).on('keyup','#backend-close-price',function()
	{

		 $(this).parents('form').eq(0).next('.validateError').remove();
		 var minimum_price=(parseFloat(usdPrice)-parseFloat(usdPrice*parseFloat(set_price_min)/100)).toFixed(2);



		  var maximum_price= (parseFloat(usdPrice)+parseFloat(usdPrice*parseFloat(set_price_max)/100)).toFixed(2);

		  console.log(minimum_price,maximum_price);

		  var close_price=parseFloat($(this).val());


		    if(close_price > maximum_price || close_price < minimum_price)
		    {
		    	$(this).parents('form').eq(0).after('<p class="text-danger text-bold validateError">{{__("The close price must be between minimum and maximum price.")}}</p>');
		    }
		   
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

     $('#backend-term-days').html(term.no_of_duration+' '+term.duration_type);

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