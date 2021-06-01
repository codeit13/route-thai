import moment from 'moment';
import '../styles/status.css';
import {
  coinsList, exchangeList,
  currencySymbols, currencyDetails,
  coinsAlertsList, exchangeDetails,
  currencyList
} from './globals.js';

// if (process.env.NODE_ENV === 'development') {
//   require('../status.html');
// }

$(function() {
  const tableBody = $('#statustable_body');

  let updatedSince = {};
  let tickSince = {};

  exchangeList.forEach((exchange, idc) => {
    const erow = $('<tr>', {id: exchange+'_row'});
    const firstcol = $('<td>', {html: '<span>'+(idc+1).toString()+'</span>'});
    erow.append(firstcol);
    const eximgpath = exchangeDetails[exchange]['img'];
    const headimg = $('<img>', { src: eximgpath, alt: exchange.toLowerCase() });
    const headcol = $('<th>');
    headcol.append(headimg);
    headcol.append('   ' + exchangeDetails[exchange]['name']);
    erow.append(headcol);

    const wsurlcol = $('<td>', {id: exchange+'_wsurl', text: 'Not available'});
    const statuscol = $('<td>', {id: exchange+'_status', text: 'Not available'});
    const timecol = $('<td>', {id: exchange+'_since', text: 'Not available'});
    const tickcol = $('<td>', {id: exchange+'_tick', text: 'Not recently', class: 'concern'});
    erow.append(wsurlcol);
    erow.append(statuscol);
    erow.append(timecol);
    erow.append(tickcol);
    tableBody.append(erow);
  });

  const processMessage = (msg) => {
    const statusMessage = JSON.parse(msg.data);
    if (statusMessage['type'] === 'status') {
      const { exchange, since, wsurl, state } = statusMessage;
      updatedSince[exchange] = since;
      $('#'+exchange+'_wsurl').html(wsurl);
      $('#'+exchange+'_status').html(state);
      if (state === 'DISCONNECTED') {
        $('#'+exchange+'_status').addClass('disconnected');
        $('#'+exchange+'_status').removeClass('connected');
        $('#'+exchange+'_row').prependTo('#statustable_body');
      }
      if (state === 'CONNECTED') {
        $('#'+exchange+'_status').addClass('connected');
        $('#'+exchange+'_status').removeClass('disconnected');
      }
      const timeDifference = moment(since).fromNow();
      $('#'+exchange+'_since').html(timeDifference);
    }

    if (statusMessage['type'] === 'crypto') {
      const { info } = JSON.parse(msg.data);
      const timenow = new Date();
      const timestampnow = timenow.getTime();
      tickSince[info.exchange] = timestampnow;
      const tickDifference = moment(timestampnow).fromNow();
      $('#'+info.exchange+'_tick').html(tickDifference);
      $('#'+info.exchange+'_tick').removeClass('concern');
    }
  };

  setInterval(() => {
    exchangeList.forEach((exchange) => {

      if (exchange in updatedSince) {
        const since = updatedSince[exchange];
        const timeDifference = moment(since).fromNow();
        $('#'+exchange+'_since').html(timeDifference);
      }
      if (exchange in tickSince) {
        const since2 = tickSince[exchange];
        const tickDifference = moment(since2).fromNow();
        $('#'+exchange+'_tick').html(tickDifference);
      }

    });
  }, 5000);

  const socket = new WebSocket("wss://ws.route-thai.com/ws");
  // const socket = new WebSocket("ws://127.0.0.1:9000/ws");
  socket.onmessage = (msg) => processMessage(msg);

  // const socket2 = new WebSocket("ws://127.0.0.1:9001");
  const socket2 = new WebSocket("wss://ws.route-thai.com/nodews/");
  socket2.onmessage = (msg) => processMessage(msg);

});
