// import '../styles/index.scss';
// import './darkmode.js';
import './displayCurr.js';
import './alertsManagement.js';
import './makeTable.js';
import { coinsList } from './globals.js';
// import '../js/offcanvas.js';

// if (process.env.NODE_ENV === 'development') {
//   require('../index.html');
// }

$(function () {

  $('.bxslider').bxSlider({
    auto: false,
    controls: true,
    pager: false,
    slideWidth: 280,
    minSlides: 1,
    maxSlides: 4,
    moveSlides: 1,
    slideMargin: 0,
    speed: 300,
    touchEnabled: true
  });

  $("#hide").click(function () {
    $(".alertbox").hide();
  });
  $("#show").click(function () {
    $(".alertbox").toggle();
  });

  $(document).mouseup(function (e) {
    var container = $(".alertbox");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      container.hide();
    }
  });

  // $("#hide_div").click(function(){
  //   $(".alert_create").hide();
  // });
  // $("#show_div").click(function(){
  //   $(".alert_create").show();
  // });
  $("#plus_show_div").click(function () {
    $(".alert_create").show();
    $(".tab-content").hide();
  });
  $(".hide_div").click(function () {
    $(".alert_create").hide();
  });
  $(".show_tab").click(function () {
    $(".tab-content").show();
  });

  $('#tablesearchinput').on('keyup change', () => {
    const searchterm = $('#tablesearchinput').val().replace(/[^\w\s]/gi, '');
    if (searchterm.length > 0) {
      $('.features select').prop('disabled', true);
      coinsList.forEach((coin) => {
        if (!coin.toLowerCase().includes(searchterm.toLowerCase())) {
          $('#' + coin.toLowerCase() + '_row').hide();
        } else {
          $('#' + coin.toLowerCase() + '_row').show();
        }
      });
    } else {
      $('.features select').prop('disabled', false);
      coinsList.forEach((coin) => {
        $('#' + coin.toLowerCase() + '_row').show();
      });
    }
  });

  $('#exchange input').on('keyup change', () => {
    const searchterm = $('#exchange input').val().replace(/[^\w\s]/gi, '');
    if (searchterm.length > 0) {
      const items = $('#exchange .dropdown-item').toArray();
      items.forEach((item) => {
        if ($(item).html().includes(searchterm.toLowerCase())) {
          $(item).show();
        } else {
          $(item).hide();
        }
      });
    } else {
      $('#exchange .dropdown-item').show();
    }
  });
  $('#exchangeSelectCenter input').on('keyup change', () => {
    const searchterm = $('#exchangeSelectCenter input').val().replace(/[^\w\s]/gi, '');
    if (searchterm.length > 0) {
      const items = $('#exchangeSelectCenter .ex-select').toArray();
      items.forEach((item) => {
        if ($(item).html().includes(searchterm.toLowerCase())) {
          $(item).show();
        } else {
          $(item).hide();
        }
      });
    } else {
      $('#exchangeSelectCenter .ex-select').show();
    }
  });
  
  $('#coinSelectCenter input').on('keyup change', () => {
    const searchterm = $('#coinSelectCenter input').val().replace(/[^\w\s]/gi, '');
    if (searchterm.length > 0) {
      const items = $('#coinSelectCenter .ex-select').toArray();
      items.forEach((item) => {
        if ($(item).html().includes(searchterm.toLowerCase())) {
          $(item).show();
        } else {
          $(item).hide();
        }
      });
    } else {
      $('#coinSelectCenter .ex-select').show();
    }
  });

});
