
$(document).ready(function(){

    var multipleCancelButton = new Choices('#coin-list', {
    removeItemButton: true,
    maxItemCount:10,
    searchResultLimit:8,
    renderChoiceLimit:100,
    items: [],
    choices: [],
    });    
    var currencyListSelector = new Choices('#currency-list', {
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

    function tradeableCoinsList(){

        console.log("Hello");
    }
    });

// $('#coin-list').change(function () {
//     console.log("selection changed");
    
// })