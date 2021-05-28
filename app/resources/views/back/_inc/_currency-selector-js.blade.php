<script type="text/javascript">
//Docs for choices.js https://github.com/jshjohnson/Choices
//Choices is used to create multiple selection dropdown
  // coinsList.forEach((coinInfo) => {
  	
  //   const coinimgpath = coinsAlertsList[coinInfo]['img'];
  //   const coinimg = $('<img>', { src: coinimgpath, height: '25px',width:'25px',class:'mr-2' });
  //   // console.log(coinimgpath);
  //   $('#crypto-list').append('<option>'+coinimg[0].outerHTML+coinInfo+'</option>');
  // });
  // currencyList.forEach((currencyInfo) => {
  //   const currencyimgpath = currencyDetails[currencyInfo]['img'];
  //   const currencyimg = $('<img>', { src: currencyimgpath, height: 'auto',width:'25px',class:'mr-2' });
  //   $('#fiat-list').append('<option>'+currencyimg[0].outerHTML+currencyInfo+'</option>');
  // });
  // coinsList.forEach((coinLoanInfo) => {
  //   const coinimgpath = coinsAlertsList[coinLoanInfo]['img'];
  //   const coinimg = $('<img>', { src: coinimgpath, height: '25px',width:'25px',class:'mr-2' });
  //   $('#coin-loan-list').append('<option>'+coinimg[0].outerHTML+coinLoanInfo+'</option>');
  // });

//Exhange Dropdown with image using ddSlick jquery
var ddData=[];
const sortedexList = exchangeList.sort();
  sortedexList.forEach((exchange) => {
    const eximgpath = exchangeDetails[exchange]['img'];
    let temp= {
      text: exchange,
      value: exchange.toLowerCase(),
      selected: false,
      imageSrc: eximgpath
  }
    ddData.push(temp);
  });
$('#exchange-list').ddslick({
  data:ddData,
  width:300,
  height:400,
  selectText: "Select Exchange",
  imagePosition:"left",
  onSelected: function(selectedData){
      //callback function: do something with selectedData;
  }   
});	

</script>


<script type="text/javascript">
	

$(document).ready(function(){

    var multipleCancelButton = new Choices('#crypto-list', {
    removeItemButton: true,
    maxItemCount:10,
    searchResultLimit:8,
    renderChoiceLimit:100,
    items: [],
    choices: [{'iid':1,'selected':true,'value':'BTC','label':'<img src="'+coinsAlertsList['BTC']['img']+'" class="mr-2" style="height: 25px; width: 25px;">BTC'}],
   
    });    
    var currencyListSelector = new Choices('#fiat-list', {
    removeItemButton: true,
    maxItemCount:10,
    searchResultLimit:8,
    renderChoiceLimit:100,
    items: [],
    choices: [],
    });    
    var currencyLoanListSelector = new Choices('#coin-loan-list', {
    removeItemButton: true,
    maxItemCount:10,
    searchResultLimit:8,
    renderChoiceLimit:100,
    items: [],
    choices: [],
    }); 


    var tradeList = new Choices('#trade-list', {
    removeItemButton: true,
    maxItemCount:10,
    searchResultLimit:8,
    renderChoiceLimit:100,
    items: [],
    choices: [{'id':1,'selected':false,'value':'BTC','label':'<img src="'+coinsAlertsList['BTC']['img']+'" class="mr-2" style="height: 25px; width: 25px;">BTC'}],
    });   

   multipleCancelButton.config.choices.map(function(v,k)
   {
   	  return v;
   })
   
   var serverData=new Array();

   // multipleCancelButton.render();
   document.getElementById('UpdateCurrencySettings').addEventListener("click",function(e)
    {
    	e.preventDefault();

    	serverData['crypto']=new Array();
    	serverData['trade']=new Array();
    	serverData['fiat']=new Array();

    	multipleCancelButton._currentState.items.forEach(function(v,k)
    	{
    		 
    		    serverData['crypto'].push({'value':v.value,'id':v.id,'img':coinsAlertsList[v.value]['img'],'fullname':coinsAlertsList[v.value]['name']});
    	});

    	currencyListSelector._currentState.items.forEach(function(v,k)
    	{
    		 
    		    serverData['fiat'].push({'value':v.value,'id':v.id,'img':currencyDetails[v.value]['img'],'fullname':currencyDetails[v.value]['name']});
    	});

    	console.log(serverData);

    	$.ajax({
        url: "{{route('admin.settings.update')}}",
        type:"POST",
        data:{
           "selection":serverData,
          "_token":'{{csrf_token()}}',
        },
        success:function(response){
          console.log(response);
          if(response) {
            $('.success').text(response.success);
            $("#ajaxform")[0].reset();
          }
        }
       });

    });
});

    
   

function tradeableCoinsList(selector){

        //console.log(multipleCancelButton);
    }

    

// $('#coin-list').change(function () {
//     console.log("selection changed");
    
// })
</script>