<script type="text/javascript">
	
	var allCurrencies=@json($allCurrencies);

	var wallet_types=[{'type':'fiat_and_spot','text':'Fiat and Spot'},{'type':'p2p','text':'P2P'}];

	

	function changeCurrencyDropdown(selector)
	{
        var wallet=$(selector).val();

        $('#to_wallet_server').html('');



        wallet_types.forEach(function(v,k)
        {
        

        	if(wallet!=v.type)
        	{
               $('#to_wallet_server').append('<option value="'+v.type+'">'+v.text+'</option>');
        	}
        })

        var filteredCurrencies=allCurrencies.filter(function(v,k)
        {
        	if(wallet=='fiat_and_spot')
        	{
               return v.wallet_type==1;
        	}
        	else
        	{
               return v.is_tradable==1 && v.wallet_type==3;
               
        	}
        	
        })

        //console.log(allCurrencies);

        console.log(filteredCurrencies);

        $('#transfer_coin_server').html('');

        var button='';

        var options='';

        $('#transfer_coin_id').val('');

        filteredCurrencies.forEach(function(v,k)
        {
        	var currency_icon='';
        	if(v.img)
        	{
              currency_icon='<img style="max-width:28px;" src="'+v.img+'" alt="'+v.name+'">'
        	}
        	if(k==0)
        	{
        		button='<button class="btn btn-secondary dropdown-toggle transfer-dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+currency_icon+' '+v.short_name+' <span>'+v.name+'</span> </button>';
        		$('#transfer_coin_id').val(v.id);
        		showBalanceForTransfer(v.id);
        	}

        	options+='<a class="dropdown-item" data-id="'+v.id+'" href="javascript:void(0)">'+currency_icon+' '+v.short_name+' <span>'+v.name+'</span></a>';
        })

        var dropdown=button+'<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">'+options+'</div>';

        $('#transfer_coin_server').html(dropdown);
        $('#transfer_quantity').keyup();
    
	}


	//second

	$(document).on('click',"#transfer_coin_server .dropdown-menu .dropdown-item", function(e) { e.preventDefault();

      var currency_id=$(this).attr('data-id');

   showBalanceForTransfer(currency_id);


    $('#transfer_coin_id').val(currency_id);

    $('.transfer-dropdown').html($(this).html());

    $('#transfer_quantity').keyup();
    

  


   
});

 var transferSelectedCurrencyBalance=0;

function showBalanceForTransfer(coin_id)
{
    var walletSelected=1;
    if($('[name="wallet_from"]').val()=='p2p')
    {
        walletSelected=3;
    }


	

    var balance='0.00000';

    transferSelectedCurrencyBalance=balance;


    var balanceRows=wallets.filter(function(wallet){
          return wallet.currency_id==coin_id && wallet.wallet_type==walletSelected;
    })

    if(balanceRows.length)
    {

      balanceRow=balanceRows[0];

    }


    var currencyRow=allCurrencies.filter(function(currency)
    {
       return currency.id==coin_id;
    })

    console.log(currencyRow);

    currencyRow=currencyRow[0];

    balance=balance+' '+currencyRow.short_name;

    if( balanceRow && typeof balanceRow.coin !='undefined')
    {

         balance=balanceRow.coin + ' '+currencyRow.short_name;
         transferSelectedCurrencyBalance=balanceRow.coin;
    }



    $('#totalBalanceForTransfer').text(balance);


}


$(document).on('keyup','#transfer_quantity',function()
{

    var quantity=parseFloat($(this).val());

    $(this).next('.validateError').remove();
  
    transferSelectedCurrencyBalance=parseFloat(transferSelectedCurrencyBalance);

    if(transferSelectedCurrencyBalance < quantity)
    {
      $(this).addClass('is-invalid');

      $(this).after('<p class="text-danger text-bold validateError">{{__("Withdraw quantity should be less than available balance.")}}</p>');
    }
    else
    {
      $(this).removeClass('is-invalid');

    }

})


document.getElementById("transferSubmitButton").addEventListener("click", function(event){
  event.preventDefault()

  $('.validateInputError').remove();

   var formdata=['wallet_from','wallet_to','transfer_currency_id','transfer_quantity'];
   var error=0;
   $.each(formdata,function(k,v)
   {

   	   if(v=='transfer_quantity' && isNaN($('[name="'+v+'"').val()))
   	   {
   	   	 error=1;
   	   	 $('[name="'+v+'"]').after('<p class="text-danger text-bold validateInputError">{{__("This field must be number.")}}</p>');
   	   }
   	   else if(v=='transfer_quantity' &&  parseFloat($('[name="'+v+'"').val()) <= 0)
   	   {
           error=1;


   	   	   $('[name="'+v+'"]').after('<p class="text-danger text-bold validateInputError">{{__("This field must be greater than 0.")}}</p>');

   	   }
   	   else if(v=='transfer_quantity' &&  parseFloat($('[name="'+v+'"').val())>transferSelectedCurrencyBalance)
   	   {
           error=1;
   	   }
   	   else if($('[name="'+v+'"').val().length <1)
   	   {
           error=1;


	   	  $('[name="'+v+'"]').after('<p class="text-danger text-bold validateInputError">{{__("The field is required.")}}</p>');
   	   	   

   	   	   
   	   }


   })

   if(!error)
   {
   	  $('#transferFormModal').submit();
   }

});

function transferDropdown()
{
	 var wallet_from =$('[name="wallet_from"]').html();
	 var wallet_to =$('[name="wallet_to"]').html();

	  var wallet_from_value =$('[name="wallet_from"]').val();
	  var wallet_to_value =$('[name="wallet_to"]').val();

	 $('[name="wallet_from"]').html(wallet_to).val(wallet_to_value);
	 $('[name="wallet_to"]').html(wallet_from).val(wallet_from_value);

     $('[name="wallet_from"]').trigger('change');



}


$(document).on('change','#to_wallet_server',function()
{
	

	var wallet=$(this).val();

	wallet_types.forEach(function(v,k)
        {
        

        	if(wallet!=v.type)
        	{
               $('[name="wallet_from"]').append('<option value="'+v.type+'">'+v.text+'</option>');
        	}
        })

	$('[name="wallet_from"]').trigger('change');



})

$('[name="wallet_from"]').trigger('change');
	

</script>