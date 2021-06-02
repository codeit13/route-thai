import { createStore } from 'redux';
import alertsState from './alertsState.js';
import { coinsList, coinsAlertsList } from './globals.js';

// <div class="live">
//   <a href="#" class="intro-banner-vdo-play-btn pinkBg" target="_blank">	<i class="glyphicon glyphicon-play whiteText" aria-hidden="true"></i>
//     <span class="ripple pinkBg"></span>
//     <span class="ripple pinkBg"></span>
//     <span class="ripple pinkBg"></span>
//   </a>
// </div>

const regex = new RegExp('^\-?[0-9]+\.?\[0-9]*$');

$(function () {
  const alertsStore = createStore(alertsState);
  const storedAlerts = localStorage.getItem('alerts') ? JSON.parse(localStorage.getItem('alerts')) : [];

  coinsList.forEach((coin) => {
    const optitem = $('<option>', { value: coin, text: coinsAlertsList[coin]['name'] });
    $('#alertCoins').append(optitem);
  });

  $('#home').empty();
  if (storedAlerts.length > 0) {
    storedAlerts.forEach((alert) => {
      const card = $('<div>', { id: alert.alertID, class: 'noti_card alert alert-dismissible fade show' });
      const desc = $('<h6>', { html: alert.alertDescription });
      const closebutton = $('<button>', { type: 'button', class: 'close', 'aria-label': 'Close' });
      closebutton.html('<span aria-hidden="true">&times;</span>');
      card.append(desc);
      card.append(closebutton);
      const clist = $('<ul>');
      alert.alertCoins.forEach((coin) => {
        let cdisplay;
        if (coin == '0') {
          cdisplay = $('<p>', { html: 'All coins' });
        } else {
          const imgsrc = coinsAlertsList[coin] ? coinsAlertsList[coin]['img'] : coinsAlertsList['default']['img'];
          const imgdiv = $('<img>', { src: imgsrc });
          cdisplay = $('<li>');
          cdisplay.append(imgdiv);
        }
        clist.append(cdisplay);
      });
      card.append(clist);
      const thr = $('<p>', { html: '<span>' + alert.lowerThr + ' %</span> | <span>' + alert.upperThr + ' %</span>' });
      card.append(thr);
      $('#home').append(card);
    });
    $('.noti_card button').click((e) => {
      const elem = e.currentTarget;
      const alertDiv = $(elem).parent();
      const alertID = alertDiv.attr('id');
      const ll = JSON.parse(localStorage.getItem('alerts'));
      const newList = ll.filter((val) => val.alertID !== alertID);
      localStorage.setItem('alerts', JSON.stringify(newList));
      alertsStore.dispatch({ type: 'REMOVE_ALERT' });
    });
  } else {
    // console.log('no stored alerts found');
    const noalert = $('<p>');
    noalert.html('<span>No alerts found! Create by clicking on </span><img src="front/arbitrageimg/plus.svg" alt="">');
    $('#home').append(noalert);
  }

  alertsStore.subscribe(() => {
    const alerts = alertsStore.getState();
    // console.log(alerts);
    if (alerts.length === 0) $('#home').empty();
    if (alerts.length > 0) {
      $('#home').empty();
      alerts.forEach((alert) => {
        const card = $('<div>', { id: alert.alertID, class: 'noti_card alert alert-dismissible fade show' });
        const desc = $('<h6>', { html: alert.alertDescription });
        const closebutton = $('<button>', { type: 'button', class: 'close', 'aria-label': 'Close' });
        closebutton.html('<span aria-hidden="true">&times;</span>');
        card.append(desc);
        card.append(closebutton);
        const clist = $('<ul>');
        alert.alertCoins.forEach((coin) => {
          let cdisplay;
          if (coin == '0') {
            cdisplay = $('<p>', { html: 'All coins' });
          } else {
            const imgsrc = coinsAlertsList[coin] ? coinsAlertsList[coin]['img'] : coinsAlertsList['default']['img'];
            const imgdiv = $('<img>', { src: imgsrc });
            cdisplay = $('<li>');
            cdisplay.append(imgdiv);
          }
          clist.append(cdisplay);
        });
        card.append(clist);
        const thr = $('<p>', { html: '<span>' + alert.lowerThr + ' %</span> | <span>' + alert.upperThr + ' %</span>' });
        card.append(thr);
        $('#home').append(card);
      });
      $('.alertbox').show();
      $(".tab-content").show();
      $('#myTabContent').show();
      $('.noti_card button').click((e) => {
        const elem = e.currentTarget;
        const alertDiv = $(elem).parent();
        const alertID = alertDiv.attr('id');
        const ll = JSON.parse(localStorage.getItem('alerts'));
        const newList = ll.filter((val) => val.alertID !== alertID);
        localStorage.setItem('alerts', JSON.stringify(newList));
        alertsStore.dispatch({ type: 'REMOVE_ALERT' });
      });
    }
  });

  $('#box-1').click((e) => {
    const elem = e.currentTarget;
    if ($(elem).val() === "1") {
      $(elem).val("0");
    } else {
      $(elem).val("1");
    }
  });

  $('#alertCoins').on('change', () => {
    const val = $('#alertCoins').val();
    // console.log(val);
    if (val && val.includes('0')) {
      $('#alertCoins').val(['0']);
      $('#alertCoins').parent().dropdown('toggle');
    };
  });

  $('#show_div').click(() => {
    const alertDescription = $('#alertDescription').val();
    if (alertDescription.length < 1) {
      console.log({ 'error': 'Description is mandatory' });
      return;
    }
    const alertCoins = $('#alertCoins').val();
    if (alertCoins === null) {
      console.log({ 'error': 'Select atleast one coin' });
      return;
    }
    if (alertCoins.length < 1) {
      console.log({ 'error': 'Select atleast one coin' });
      return;
    }
    const lowerThrval = $('#txtChar1').val();
    const upperThrval = $('#txtChar2').val();
    if (!regex.test(lowerThrval)) {
      console.log({ 'error': 'enter a positive or negative number' });
      return;
    }
    if (!regex.test(upperThrval)) {
      console.log({ 'error': 'enter a positive or negative number' });
      return;
    }
    const lowerThr = parseFloat(lowerThrval.match(regex)[0]);
    const upperThr = parseFloat(upperThrval.match(regex)[0]);
    if (lowerThr > upperThr) {
      console.log({ 'error': 'lower threshold should be less than upper threshold' });
      return;
    }
    const alertSound = $('#box-1').val() === "1" ? true : false;

    let alertsList;
    const alertID = '_' + Math.random().toString(36).substr(2, 9);
    if (localStorage.getItem('alerts') === null) {
      alertsList = [{ alertID, alertDescription, alertCoins, lowerThr, upperThr, alertSound }];
    } else {
      alertsList = JSON.parse(localStorage.getItem('alerts'));
      alertsList.push({ alertID, alertDescription, alertCoins, lowerThr, upperThr, alertSound });
    }
    localStorage.setItem('alerts', JSON.stringify(alertsList));
    alertsStore.dispatch({ type: 'ADD_ALERT' });
    // $('#alertCoins').parent().dropdown('toggle');
    $(".alertbox").hide();
    $('.alert_create').hide();
  });
});
