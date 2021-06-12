import {
  coinsList, exchangeList,
  currencySymbols, currencyDetails,
  coinsAlertsList, exchangeDetails,
  currencyList
} from './globals.js';
import { createStore } from 'redux';
import alertsState from './alertsState.js';
import favListState from './favListState.js';

$(function () {
  const alertsStore = createStore(alertsState);
  const favListStore = createStore(favListState);
  localStorage.setItem('favState', false);

  const base_exchange_button = $('#modalBaseExchange');
  const base_currency_button = $('#dropdownBaseCurrency');

  let localbasecurrency = localStorage.getItem('localbasecurrency');
  if (localbasecurrency === null) {
    localStorage.setItem('localbasecurrency', 'unitedstatesdollar');
    localbasecurrency = 'unitedstatesdollar';
  }
  base_currency_button.empty();
  base_currency_button.val(localbasecurrency);
  const buttoncontent = $('<img>', { src: currencyDetails[localbasecurrency]['img'] });
  base_currency_button.append(buttoncontent);
  base_currency_button.append('<span>' + currencyDetails[localbasecurrency]['name'] + '</span>');
  base_currency_button.append(' ' + currencyDetails[localbasecurrency]['sname']);

  $('#tablesearchinput').prop('disabled', false);
  // const maxrows = $('.features select').val();

  let baseexchangename = base_exchange_button.val().toLowerCase();
  let basecurrencyname = base_currency_button.val().toLowerCase();
  let currentForexData;
  console.log($('#numrowselector'));
  $('#numrowselector').on('change', () => {
    console.log('change');
    const maxrow = $('.features select').val();
    console.log(maxrow)
    if (maxrow === 'all') {
      $('#tablesearchinput').prop('disabled', false);
      coinsList.forEach((coin) => {
        $('#' + coin.toLowerCase() + '_row').show();
      });
    }
    if (maxrow !== 'all') {
      $('#tablesearchinput').prop('disabled', true);
      const maxrownum = parseInt(maxrow);
      const hideList = coinsList.slice(maxrownum);
      hideList.forEach((coin) => {
        $('#' + coin.toLowerCase() + '_row').hide();
      });
      const showList = coinsList.slice(0, maxrownum);
      showList.forEach((coin) => {
        $('#' + coin.toLowerCase() + '_row').show();
      });
    }
  });
  //Generating exchange filter modal
exchangeList.forEach((exchange) => {
  const eximgpath = exchangeDetails[exchange]['img'];
  const eximage = $('<img>', { src: eximgpath,height: '20px',width:'auto',alt: exchange.toLowerCase(), class:'pr-1' });
  const inputCh=$('<input type="checkbox" value="'+exchange+'" name="exchangecheckbox" autocomplete="off">');
  const inputicon=$('<i class="cr-icon fa fa-check"></i>');
  $('#ex-data-img').append(
     '<div class="col ex-select"> <label class="btn bg-white rounded btn-light btn-block text-left">'+
     inputCh[0].outerHTML+'<span class="cr">'+inputicon[0].outerHTML+'</span>'+
      eximage[0].outerHTML + exchange+
      '</label></div>'
      );        
});
//Generating coin filter modal
coinsList.forEach((coin) => {
  const Coinimgpath = coinsAlertsList[coin]['img'];
  const Coinimage = $('<img>', { src: Coinimgpath,height: '20px',width:'auto',alt: coin.toLowerCase(), class:'mr-1'});
  const inputCh=$('<input type="checkbox" value="'+coin+'" name="coincheckbox" autocomplete="off">');
  const inputicon=$('<i class="cr-icon fa fa-check"></i>');
  $('#coin-data-img').append(
     '<div class="col ex-select"> <label class="btn bg-white rounded btn-light btn-block text-left">'+
     inputCh[0].outerHTML+'<span class="cr">'+inputicon[0].outerHTML+'</span>'+
     Coinimage[0].outerHTML + coin+
      '</label></div>'
      );        
});
//show or hide exchange columns
$(document).ready(function() {
  //Exchange Filter
  $('input[type=checkbox][name=exchangecheckbox]').change(function() {
    const checkboxes = document.querySelectorAll(`input[name="exchangecheckbox"]:checked`);
    let values = [];
    checkboxes.forEach((checkbox) => {
        values.push(checkbox.value);
    });
    console.log(values);
    if(values.length>=3){
      exchangeList.forEach((exchange)=>{
        if(values.includes(exchange)){$("."+exchange).show();}
        else{$("."+exchange).hide();}        
      });
    }
    else{
      exchangeList.forEach((exchange)=>{
          $("."+exchange).show();
      });
    }
  });

  //Coin Filter
  $('input[type=checkbox][name=coincheckbox]').change(function() {
    const checkboxes = document.querySelectorAll(`input[name="coincheckbox"]:checked`);
    let values = [];
    checkboxes.forEach((checkbox) => {
        values.push(checkbox.value);
    });
    if(values.length!=0){
      coinsList.forEach((coin)=>{
        if(values.includes(coin)){$('#'+coin.toLowerCase() + '_row').show();}
        else{$('#'+coin.toLowerCase() + '_row').hide();}        
      });
    }
    else{
      coinsList.forEach((coin)=>{
        $('#'+coin.toLowerCase() + '_row').show();
            });
    }
  });
});

  const tableBody = $('#currencytable_body');
  const tableHeader = $('#currency_header_row');
  exchangeList.forEach((exchange) => {
    const headercol = $('<th>', { scope: 'col', id: exchange + '_col' ,class:exchange });
    const eximgpath = exchangeDetails[exchange]['img'];
    const headimg = $('<img>', { src: eximgpath, alt: exchange.toLowerCase() });
    headercol.append(headimg);
    headercol.append(' ' + exchangeDetails[exchange]['name']);
    tableHeader.append(headercol);
    if (exchange.toLowerCase() === baseexchangename) {
      headercol.addClass('highlight-top');
    }
    const ddlink = $('<a>', { class: 'dropdown-item' });
    const ddimage = $('<img>', { src: eximgpath, alt: exchange.toLowerCase() , height:'20px',width:'auto'});
    ddlink.append(ddimage);
    ddlink.append(' ' + exchangeDetails[exchange]['name']);
    const ddcont = $('<div>',{class:'ex-select my-1'});
    ddcont.append(ddlink);
    $('#ex-select-menu').append(ddcont);
  });

  coinsList.forEach((coin, idc) => {
    const coinrow = $('<tr>', { id: coin.toLowerCase() + '_row' });
    // const firstcol = $('<td>', { class: 'fav', html: '<i class="fa fa-star-o" aria-hidden="true"></i>' });
    // coinrow.append(firstcol);
    const imgpath = coinsAlertsList[coin]['img'];
    const imgtext = ' <span class="d-none d-sm-none d-md-block">' + coinsAlertsList[coin]['name'] + '</span> <span class="d-sm-block">' + coin + '</span>';
    const imgdiv = $('<img>', { src: imgpath, alt: coin });
    const headcol = $('<th>', { class: 'first' });
    headcol.append(imgdiv);
    headcol.append(imgtext);
    coinrow.append(headcol);
    exchangeList.forEach((exchange) => {
      const divname1 = exchange.toLowerCase() + '_' + coin.toLowerCase();
      const divname2 = divname1 + '_p';
      const span2 = $('<span>', { id: divname2, text: '--' });
      const span1 = $('<span>', { id: divname1, class: 'text-green', text: '--' });
      const coincol = $('<td>',{class:exchange});
      const lb = $('<br>');
      coincol.append(span2);
      coincol.append(lb);
      coincol.append(span1);
      if (exchange.toLowerCase() === baseexchangename) {
        coincol.addClass('highlight');
      }
      coinrow.append(coincol);
    });
    tableBody.append(coinrow);
  });
  $('#main_data_table').addClass('table-striped');

  const storedFavList = localStorage.getItem('favList') ? JSON.parse(localStorage.getItem('favList')) : [];
  storedFavList.forEach((item) => {
    const favdiv = $('#' + item + ' td').first();
    const stardiv = $(favdiv).children()[0];
    $(stardiv).toggleClass('fa-star-o fa-star');
  });


  let storedAlerts = localStorage.getItem('alerts') ? JSON.parse(localStorage.getItem('alerts')) : [];
  alertsStore.subscribe(() => {
    storedAlerts = alertsStore.getState();
    storedAlerts.forEach((alert) => {
      const alertCoins = alert.alertCoins;
      alertCoins.forEach((coin) => {

        const filtered = exchangeList.filter((exchange) => {
          const pr = currentPratio[coin][exchange];
          if (pr === 0 || exchange === baseexchangename.toUpperCase()) {
            return false;
          } else {
            if (alert.lowerThr < 0 && alert.upperThr > 0) {
              return (pr <= alert.lowerThr || pr >= alert.upperThr);
            }
            if (alert.lowerThr > 0 && alert.upperThr > 0) {
              return (pr >= alert.lowerThr && pr <= alert.upperThr);
            }
            if (alert.lowerThr < 0 && alert.upperThr < 0) {
              return (pr >= alert.lowerThr && pr <= alert.upperThr);
            }
            if (alert.lowerThr > 0 && alert.upperThr < 0) {
              return (pr <= alert.lowerThr || pr >= alert.upperThr);
            }
            return false;
          }
        });
        if (filtered.length > 0) {
          const shouldChange = $('#' + alert.alertID).hasClass('active');
          const fillist = $('#' + alert.alertID).data('filtered');
          let differentList;
          if (fillist) {
            differentList = fillist.length !== filtered.length;
          } else {
            differentList = true;
          }
          if (!shouldChange || differentList) {
            $('#' + alert.alertID).addClass('active');
            $('#' + alert.alertID + ' p.elist').remove();
            const elist = $('<p>', { class: "elist", html: 'For ' + filtered.join(', ') });
            $('#' + alert.alertID).data('filtered', filtered);
            $('#' + alert.alertID).append(elist);
          }
        } else {
          const shouldChange = $('#' + alert.alertID).hasClass('active');
          if (shouldChange) {
            $('#' + alert.alertID).removeClass('active');
            $('#' + alert.alertID + ' p.elist').remove();
            $('#' + alert.alertID).removeData();
          }
        }

      });
    });
  });

  let basevalues = coinsList.reduce((accu, item) => {
    return Object.assign(accu, { [item]: 0 });
  }, {});
  let currentPrice = coinsList.reduce((accu1, coin) => {
    const obj1 = exchangeList.reduce((accu2, exchange) => {
      return Object.assign(accu2, { [exchange]: 0 });
    }, {});
    return Object.assign(accu1, { [coin]: obj1 });
  }, {});
  let currentPratio = coinsList.reduce((accu1, coin) => {
    const obj1 = exchangeList.reduce((accu2, exchange) => {
      return Object.assign(accu2, { [exchange]: 0 });
    }, {});
    return Object.assign(accu1, { [coin]: obj1 });
  }, {});

  $('#ex-select-menu a').click((e) => {
    e.preventDefault();
    const elem = $(e.currentTarget);
    $('#exchangeCenter').modal('hide');
    const imgelem = elem.html();
    const exchangeVAL = $(imgelem).attr('alt');
    const oldexchangename = baseexchangename;
    if (exchangeList.includes(exchangeVAL.toUpperCase()) === false) {
      return;
    };
    base_exchange_button.html(elem.html());
    base_exchange_button.val(exchangeVAL.toUpperCase());
    baseexchangename = exchangeVAL.toUpperCase();

    coinsList.forEach((coin) => {
      basevalues[coin] = currentPrice[coin][baseexchangename];
    });


    coinsList.forEach((coin) => {
      const baseprice = basevalues[coin];

      exchangeList.forEach((exchange) => {
        const price = currentPrice[coin][exchange];
        const divname = exchange.toLowerCase() + '_' + coin.toLowerCase();
        const divnamep = divname + '_p';
        const parentcell = $('#' + divnamep).parent();
        if (oldexchangename.toLowerCase() === exchange.toLowerCase()) {
          const parentcell = $('#' + divnamep).parent();
          parentcell.removeClass('highlight');
          $('#' + oldexchangename.toUpperCase() + '_col').removeClass('highlight-top');
        }
        if (baseexchangename === exchange) {
          const parentcell = $('#' + divnamep).parent();
          parentcell.addClass('highlight');
          $('#' + exchange + '_col').addClass('highlight-top');
        }

        if (baseprice !== 0 && price !== 0) {
          $('#' + divname).empty();
          $('#' + divnamep).empty();
          if (exchange.toLowerCase() !== baseexchangename.toLowerCase()) {
            const pratio = ((price / baseprice) - 1) * 100;
            currentPratio[coin.toUpperCase()][exchange] = pratio;
            if (pratio < 0) {
              $('#' + divname).addClass('text-red');
              $('#' + divname).removeClass('text-green');
            } else {
              $('#' + divname).addClass('text-green');
              $('#' + divname).removeClass('text-red');
            }

            $('#' + divname).text(pratio.toFixed(2) + ' %');
            $('#' + divnamep).text(currencySymbols[basecurrencyname.toUpperCase()] + price.toFixed(2));
          } else {
            $('#' + divnamep).text(currencySymbols[basecurrencyname.toUpperCase()] + price.toFixed(2));
          }
        } else if (price !== 0 && baseprice === 0) {
          $('#' + divname).text('--');
          $('#' + divnamep).text(currencySymbols[basecurrencyname.toUpperCase()] + price.toFixed(2));
        }
        else {
          $('#' + divname).text('--');
          $('#' + divnamep).text('--');
        }
      });
    });

    const getAlerts = localStorage.getItem('alerts') ? JSON.parse(localStorage.getItem('alerts')) : [];

    getAlerts.forEach((alert) => {
      const alertCoins = alert.alertCoins;
      alertCoins.forEach((coin) => {

        const filtered = exchangeList.filter((exchange) => {
          const pr = currentPratio[coin][exchange];
          if (pr === 0 || exchange === baseexchangename.toUpperCase()) {
            return false;
          } else {
            if (alert.lowerThr < 0 && alert.upperThr > 0) {
              return (pr <= alert.lowerThr || pr >= alert.upperThr);
            }
            if (alert.lowerThr > 0 && alert.upperThr > 0) {
              return (pr >= alert.lowerThr && pr <= alert.upperThr);
            }
            if (alert.lowerThr < 0 && alert.upperThr < 0) {
              return (pr >= alert.lowerThr && pr <= alert.upperThr);
            }
            if (alert.lowerThr > 0 && alert.upperThr < 0) {
              return (pr <= alert.lowerThr || pr >= alert.upperThr);
            }
            return false;
          }
        });
        if (filtered.length > 0) {
          const shouldChange = $('#' + alert.alertID).hasClass('active');
          const fillist = $('#' + alert.alertID).data('filtered');
          let differentList;
          if (fillist) {
            differentList = fillist.length !== filtered.length;
          } else {
            differentList = true;
          }
          if (!shouldChange || differentList) {
            $('#' + alert.alertID).addClass('active');
            $('#' + alert.alertID + ' p.elist').remove();
            const elist = $('<p>', { class: "elist", html: 'For ' + filtered.join(', ') });
            $('#' + alert.alertID).data('filtered', filtered);
            $('#' + alert.alertID).append(elist);
          }
        } else {
          const shouldChange = $('#' + alert.alertID).hasClass('active');
          if (shouldChange) {
            $('#' + alert.alertID).removeClass('active');
            $('#' + alert.alertID + ' p.elist').remove();
            $('#' + alert.alertID).removeData();
          }
        }

      });
    });

  });

  $('#currency a').click((e) => {
    e.preventDefault();
    const excname = baseexchangename.toUpperCase();
    if (exchangeList.includes(excname) === false) {
      return;
    };
    const oldbasecurrencyname = basecurrencyname;
    const elem = $(e.currentTarget);
    $('#dropdownBaseCurrency').dropdown('toggle');
    const imgelem = elem.html();
    const currencyVAL = $(imgelem).attr('alt');
    base_currency_button.html(elem.html());
    base_currency_button.val(currencyVAL.toLowerCase());
    localStorage.setItem('localbasecurrency', currencyVAL.toLowerCase());
    basecurrencyname = currencyVAL.toLowerCase();
    const oldrate = currentForexData.rates[currencyDetails[oldbasecurrencyname]['sname']];
    const newrate = currentForexData.rates[currencyDetails[basecurrencyname]['sname']];

    coinsList.forEach((coin) => {
      basevalues[coin] = currentPrice[coin][excname] * newrate / oldrate;
    });

    coinsList.forEach((coin) => {
      const baseprice = basevalues[coin];
      exchangeList.forEach((exchange) => {
        const oldprice = currentPrice[coin][exchange];
        const newprice = oldprice * newrate / oldrate;
        currentPrice[coin][exchange] = newprice;
        const divname = exchange.toLowerCase() + '_' + coin.toLowerCase();
        const divnamep = divname + '_p';

        if (baseprice !== 0 && newprice !== 0) {
          $('#' + divname).empty();
          $('#' + divnamep).empty();
          if (exchange.toLowerCase() !== baseexchangename.toLowerCase()) {
            const pratio = ((newprice / baseprice) - 1) * 100;
            currentPratio[coin.toUpperCase()][exchange] = pratio;
            if (pratio < 0) {
              $('#' + divname).addClass('text-red');
              $('#' + divname).removeClass('text-green');
            } else {
              $('#' + divname).addClass('text-green');
              $('#' + divname).removeClass('text-red');
            }

            $('#' + divname).text(pratio.toFixed(2) + ' %');
            $('#' + divnamep).text(currencySymbols[basecurrencyname.toUpperCase()] + newprice.toFixed(2));
          } else {
            $('#' + divnamep).text(currencySymbols[basecurrencyname.toUpperCase()] + newprice.toFixed(2));
          }
        } else if (newprice !== 0 && baseprice === 0) {
          $('#divname').text('--');
          $('#divnamep').text(currencySymbols[basecurrencyname.toUpperCase()] + newprice.toFixed(2));
        }
        else {
          $('#' + divname).text('--');
          $('#' + divnamep).text('--');
        }
      });
    });
  });

    //Dropdown auto close bug fixing.
    $('div.dropdown-menu.custome-class').on('click', function(event){
      var events = $._data(document, 'events') || {};
      events = events.click || [];
      for(var i = 0; i < events.length; i++) {
          if(events[i].selector) {
  
              //Check if the clicked element matches the event selector
              if($(event.target).is(events[i].selector)) {
                  events[i].handler.call(event.target, event);
              }
  
              // Check if any of the clicked element parents matches the 
              // delegated event selector (Emulating propagation)
              $(event.target).parents(events[i].selector).each(function(){
                  events[i].handler.call(this, event);
              });
          }
      }
      event.stopPropagation(); //Always stop propagation
  });

  var addCount = 1;
  var str1='';
  $('.add-more-range').click((e) =>  {
    e.preventDefault();
    str1 = `<div class="d-flex align-items-center addrange" id="range-row-`+ addCount +`"> <div class="mb-3 pr-3"> <input type="number" id="min-value-`+ addCount +`" style="width: 80px;height: 35px;" class="form-control" placeholder="Min"> </div> <div class="mb-3 pr-3"> <span class="font-weight-bold">-</span> </div> <div class="mb-3 pr-3"> <input type="number"  id="max-value-`+ addCount +`" style="width: 80px;height: 35px;" class="form-control" placeholder="Max"> </div> <div class="mb-3 pr-3"> <!-- <label class="d-flex justify-content-start">Choose color :</label> --> <input type="color" id="set-color-`+ addCount +`" class="form-control p-0 border-0 rounded-circle selectcolor" style="box-shadow: none !important;"> </div></div>`;
    //  <div> <button style="font-size: 22px;" class="btn mt-2 bg-transparent p-0 delete-more-range-`+addCount+`"><i class="text-red fa fa-trash"></i></button> </div> </div>`;
    var finalDiv = document.createElement('div'); // is the node
    finalDiv.innerHTML = str1;
    addCount++;

    document.getElementsByClassName("range-percent")[0].appendChild(finalDiv);
    // $('#dropdownMenuLink').trigger('click');

});

  var minrange = [];
  var maxrange = [];
  var color = [];

  $('#change-color').click((e)=>{
    e.preventDefault();
    var clist = document.getElementsByClassName('addrange');
    for (let i = 0; i < clist.length; i++) {
        minrange.push(document.getElementById(`min-value-`+ i +``).value);
        maxrange.push(document.getElementById(`max-value-`+ i +``).value);
        color.push(document.getElementById(`set-color-`+ i +``).value);
    }
  });

  $('#cancel-color').click((e)=>{
    e.preventDefault();
    var str= '';
    str = '<div class="d-flex align-items-center addrange" id="range-row-0"> <div class="mb-3 pr-3"> <input type="number" id="min-value-0" style="width: 80px;height: 35px;" class="form-control" placeholder="Min"> </div> <div class="mb-3 pr-3"> <span class="font-weight-bold">-</span> </div> <div class="mb-3 pr-3"> <input type="number" id="max-value-0" style="width: 80px;height: 35px;" class="form-control" placeholder="Max"> </div> <div class="mb-3 pr-3"> <input type="color" id="set-color-0" class="form-control p-0 border-0 rounded-circle selectcolor" style="box-shadow: none !important;"> </div> </div>';
    document.getElementsByClassName("range-percent")[0].innerHTML = str;
    minrange = [];
    maxrange = [];
    color = [];
  });

  const processMessage = (msg) => {
    const { type, info } = JSON.parse(msg.data);
    if (type === 'forex') {
      currentForexData = info;
    }
    if (type === 'crypto' || type === 'snapshot') {

      if (!coinsList.includes(info.uid) || !exchangeList.includes(info.exchange)) {
        return;
      }
      if (!currencyList.includes(info.base_currency)) {
        return;
      }

      const idname = info.exchange.toLowerCase() + '_' + info.uid.toLowerCase();
      const idnamep = idname + '_p';
      if (info.base_currency !== currencyDetails[basecurrencyname]['sname'] && currentForexData) {
        if (basecurrencyname === 'unitedstatesdollar') {
          info.price = info.price / currentForexData.rates[info.base_currency];
        } else {
          const usdrate = currentForexData.rates[info.base_currency];
          const otherrate = currentForexData.rates[currencyDetails[basecurrencyname]['sname']];
          info.price = info.price * otherrate / usdrate;
        }
      }
      if (info.exchange.toLowerCase() === baseexchangename.toLowerCase()) {
        basevalues[info.uid] = info.price;
        if (info.price !== 0) {
          for (var i = 0; i < exchangeList.length; i++) {
            if (currentPrice[info.uid][exchangeList[i]] !== 0) {
              if (baseexchangename.toLowerCase() !== exchangeList[i].toLowerCase()) {
                const pratio = ((currentPrice[info.uid][exchangeList[i]] / info.price) - 1) * 100;
                currentPratio[info.uid][exchangeList[i]] = pratio;
                const divname = exchangeList[i].toLowerCase() + '_' + info.uid.toLowerCase();
                const divnamep = divname + '_p';

                if (pratio < 0) {
                  if(minrange.length > 0 && maxrange.length > 0 && color.length > 0) {
                    for (let i = 0; i < minrange.length; i++) {
                      if (minrange[i] && maxrange[i] && pratio > minrange[i] && pratio < maxrange[i]) {
                        $('#' + divname).removeClass('text-green');
                        $('#' + divname).css("color",color[i]);
                      }
                    }
                  }
                  else {
                    $('#' + divname).css("color",'');
                    $('#' + divname).addClass('text-red');
                    $('#' + divname).removeClass('text-green');
                  }
                } else {
                  if(minrange.length > 0 && maxrange.length > 0 && color.length > 0) {
                    for (let i = 0; i < minrange.length; i++) {
                      if (minrange[i] && maxrange[i] && pratio > minrange[i] && pratio < maxrange[i]) {
                        $('#' + divname).removeClass('text-red');
                        $('#' + divname).css("color",color[i]);
                      }
                    }
                  }
                  else {
                    $('#' + divname).css("color",'');
                    $('#' + divname).addClass('text-green');
                    $('#' + divname).removeClass('text-red');
                  }
                }
                $('#' + divname).text(pratio.toFixed(2) + ' %');
                $('#' + divnamep).text(currencySymbols[basecurrencyname.toUpperCase()] + currentPrice[info.uid][exchangeList[i]].toFixed(2));
              }
            }
          }
        }
      } else if (basevalues[info.uid] !== 0 && baseexchangename !== info.exchange) {
        const pratio = ((info.price / basevalues[info.uid]) - 1) * 100;
        currentPratio[info.uid.toUpperCase()][info.exchange] = pratio;
        // if (pratio < 0) {
        //   $('#' + idname).addClass('text-red');
        //   $('#' + idname).removeClass('text-green');
        // } else {
        //   $('#' + idname).addClass('text-green');
        //   $('#' + idname).removeClass('text-red');
        // }
        if (pratio < 0) {
          if(minrange.length > 0 && maxrange.length > 0 && color.length > 0) {
            for (let i = 0; i < minrange.length; i++) {
              if (minrange[i] && maxrange[i] && pratio > minrange[i] && pratio < maxrange[i]) {
                $('#' + idname).removeClass('text-green');
                $('#' + idname).css("color",color[i]);
              }
            }
          }
          else {
            $('#' + idname).css("color",'');
            $('#' + idname).addClass('text-red');
            $('#' + idname).removeClass('text-green');
          }
        } else {
          if(minrange.length > 0 && maxrange.length > 0 && color.length > 0) {
            for (let i = 0; i < minrange.length; i++) {
              if (minrange[i] && maxrange[i] && pratio > minrange[i] && pratio < maxrange[i]) {
                $('#' + idname).removeClass('text-red');
                $('#' + idname).css("color",color[i]);
              }
            }
          }
          else {
            $('#' + idname).css("color",'');
            $('#' + idname).addClass('text-green');
            $('#' + idname).removeClass('text-red');
          }
        }
        $('#' + idname).text(pratio.toFixed(2) + ' %');
      }
      $('#' + idnamep).text(currencySymbols[basecurrencyname.toUpperCase()] + info.price.toFixed(2));
      // $('#'+idnamep).animate({backgroundColor: 'red'}, 'fast', () => {
      //   $('#'+idnamep).animate({backgroundColor: 'white'}, 'fast');
      // });
      // const parentcell = $('#'+idnamep).parent();
      // parentcell.addClass('updated');
      // setTimeout(()=>{
      //   parentcell.removeClass('updated');
      // }, 1100);
      currentPrice[info.uid][info.exchange] = info.price;

      const getAlerts = localStorage.getItem('alerts') ? JSON.parse(localStorage.getItem('alerts')) : [];

      getAlerts.forEach((alert) => {
        const alertCoins = alert.alertCoins;
        alertCoins.forEach((coin) => {
          if (info.uid === coin) {
            const filtered = exchangeList.filter((exchange) => {
              const pr = currentPratio[coin][exchange];
              if (pr === 0 || exchange === baseexchangename.toUpperCase()) {
                return false;
              } else {
                if (alert.lowerThr < 0 && alert.upperThr > 0) {
                  return (pr <= alert.lowerThr || pr >= alert.upperThr);
                }
                if (alert.lowerThr > 0 && alert.upperThr > 0) {
                  return (pr >= alert.lowerThr && pr <= alert.upperThr);
                }
                if (alert.lowerThr < 0 && alert.upperThr < 0) {
                  return (pr >= alert.lowerThr && pr <= alert.upperThr);
                }
                if (alert.lowerThr > 0 && alert.upperThr < 0) {
                  return (pr <= alert.lowerThr || pr >= alert.upperThr);
                }
                return false;
              }
            });
            if (filtered.length > 0) {
              // console.log(coin, filtered);
              const shouldChange = $('#' + alert.alertID).hasClass('active');
              const fillist = $('#' + alert.alertID).data('filtered');
              let differentList;
              if (fillist) {
                differentList = fillist.length !== filtered.length;
              } else {
                differentList = true;
              }
              if (!shouldChange || differentList) {
                $('#' + alert.alertID).addClass('active');
                $('#' + alert.alertID + ' p.elist').remove();
                const elist = $('<p>', { class: "elist", html: 'For ' + filtered.join(', ') });
                $('#' + alert.alertID).data('filtered', filtered);
                $('#' + alert.alertID).append(elist);
              }
            } else {
              const shouldChange = $('#' + alert.alertID).hasClass('active');
              if (shouldChange) {
                $('#' + alert.alertID).removeClass('active');
                $('#' + alert.alertID + ' p.elist').remove();
                $('#' + alert.alertID).removeData();
              }
            }
          }
        });
      });

    }

  };

  $('.fav').click((e) => {
    const elem = e.currentTarget;
    const stardiv = $(elem).children('i')[0];
    $(stardiv).toggleClass('fa-star fa-star-o');
    const rowdiv = $(elem).parent();
    const rowid = $(rowdiv).attr('id');
    const favList = localStorage.getItem('favList') ? JSON.parse(localStorage.getItem('favList')) : [];
    let newList;
    if (favList.includes(rowid)) {
      newList = favList.filter((item) => { return item !== rowid; });
    } else {
      newList = favList.concat([rowid]);
    }
    localStorage.setItem('favList', JSON.stringify(newList));
    favListStore.dispatch({ type: 'UPDATE_FAV' });
  });

  $('#toggleFav').click(() => {
    const storedFavList = localStorage.getItem('favList') ? JSON.parse(localStorage.getItem('favList')) : [];
    if (storedFavList.length === 0) {
      return;
    }

    $('#toggleFav i').toggleClass('fa-star-o fa-star');
    $('#toggleFav').toggleClass('btn-primary btn-outline-primary');
    const favState = localStorage.getItem('favState');
    if (favState === 'true') {
      localStorage.setItem('favState', false);
    } else if (favState === 'false') {
      localStorage.setItem('favState', true);
    }
    const newfavState = localStorage.getItem('favState');

    const tablerows = $('#currencytable_body tr');
    tablerows.each((idx, elem) => {

      // const elemid = elem.id;
      if (newfavState === 'false') {
        $('#' + elem.id).show();
      }
      if (newfavState === 'true') {
        if (storedFavList.includes(elem.id)) {
          $('#' + elem.id).show();
        } else {
          $('#' + elem.id).hide();
        }
      }
    });

  });

  const socket = new WebSocket("wss://ws.route-thai.com/ws");
  // const socket = new WebSocket("ws://127.0.0.1:9000/ws");
  socket.onmessage = (msg) => processMessage(msg);

  // const socket2 = new WebSocket("ws://127.0.0.1:9001");
  const socket2 = new WebSocket("wss://ws.route-thai.com/nodews/");
  socket2.onmessage = (msg) => processMessage(msg);

});
