<script type="text/javascript">


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

    var cryptoCurrencyList = new Choices('#crypto-list', {
    removeItemButton: true,
    maxItemCount:10,
    searchResultLimit:8,
    renderChoiceLimit:100,
    items: [],
    choices:@json($dropdowns['crypto']) ,
   
    });    
    var fiatCurrencyList = new Choices('#fiat-list', {
    removeItemButton: true,
    maxItemCount:10,
    searchResultLimit:8,
    renderChoiceLimit:100,
    items: [],
    choices: @json($dropdowns['fiat']),
    });    
    var tradeCurrencyList = new Choices('#trade-list', {
    removeItemButton: true,
    maxItemCount:10,
    searchResultLimit:8,
    renderChoiceLimit:100,
    items: [],
    choices: @json($dropdowns['trade']),
    }); 



   
});

</script>