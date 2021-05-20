
//Docs for choices.js https://github.com/jshjohnson/Choices
//Choices is used to create multiple selection dropdown
  coinsList.forEach((coinInfo) => {
    const coinimgpath = coinsAlertsList[coinInfo]['img'];
    const coinimg = $('<img>', { src: coinimgpath, height: '25px',width:'25px',class:'mr-2' });
    // console.log(coinimgpath);
    $('#coin-list').append('<option>'+coinimg[0].outerHTML+coinInfo+'</option>');
  });
  currencyList.forEach((currencyInfo) => {
    const currencyimgpath = currencyDetails[currencyInfo]['img'];
    const currencyimg = $('<img>', { src: currencyimgpath, height: 'auto',width:'25px',class:'mr-2' });
    $('#currency-list').append('<option>'+currencyimg[0].outerHTML+currencyInfo+'</option>');
  });
  coinsList.forEach((coinLoanInfo) => {
    const coinimgpath = coinsAlertsList[coinLoanInfo]['img'];
    const coinimg = $('<img>', { src: coinimgpath, height: '25px',width:'25px',class:'mr-2' });
    $('#coin-loan-list').append('<option>'+coinimg[0].outerHTML+coinLoanInfo+'</option>');
  });

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