<script type = "text/javascript" >
    var minutes = '00';
	var hours = '00';
	var seconds = '00';

	@if(isset($buyer_request->expiry_time))
		hours = '{{$buyer_request->expiry_time->hours}}';
		minutes = '{{$buyer_request->expiry_time->minutes}}';
		seconds = '{{$buyer_request->expiry_time->seconds}}';
	@endif

	const opts = {
	    DOMselector: '#app',
	    sliders: [{
	        radius: 40,
	        min: 0,
	        max: {{$transcation->timer * 60}},
	        step: 10,
	        initialValue: {{($transcation->getTime() * 60 > 0) ? $transcation->getTime() * 60: 0}},
	        timer: (minutes < 10 ? "0" + minutes : minutes) + ':' + (seconds < 10 ? "0" + seconds : seconds),
	        color: '#00c98e',
	        displayName: 'Value 3'
	    }]
	};
	// instantiate the slider
	const slider = new Slider(opts);
	slider.draw();

	function updateSliderRange(m, s) {
	    if (opts.sliders[0].initialValue > 0) {
	        $('#app').html('');
	        opts.sliders[0].timer = m + ':' + s;
	        var rr = new Slider(opts);
	        rr.draw();
	    }
	}

	$(document).ready(function() {
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
	    $("#footer ul li.Company:first-child").click(function() {
	        $("ul.Company-main li").toggle();
	    });
	    $("#footer ul li.Individuals:first-child").click(function() {
	        $("ul.Individuals-main li").toggle();
	    });
	    $("#footer ul li.Learn:first-child").click(function() {
	        $("ul.Learn-main li").toggle();
	    });
	    $("#footer ul li.Support:first-child").click(function() {
	        $("ul.Support-main li").toggle();
	    });
	});

	document.getElementById('timer').innerHTML = hours + ":" + minutes + ":" + seconds;
	startTimer();

	function startTimer() {
	    var presentTime = document.getElementById('timer').innerHTML;
	    var timeArray = presentTime.split(/[:]+/);
	    var h = timeArray[0];
	    var m = timeArray[1];
	    var s = checkSecond((timeArray[2] - 1));
	    var regex = /\d/;

	    if (s == 59) {
	        if (m == 0 && h > 0) {
	            m = 59;
	        } else {
	            m = m - 1;
	        }
	    }

	    if (m < 10 && m != 0) {
	        m = m.toString().replace("0", '');
	        m = "0" + m;
	    }

	    if (m == 0) {
	        m = "00";
	    }
	    if (m == 59 && s == 59 && h >= 1) {
	        h = h - 1;
	    }

	    if (h < 10 && h != 0) {
	        h = h.toString().replace("0", '');
	        h = "0" + h;
	    }

	    if (h == 0) {
	        h = "00";
	    }
	    updateSliderRange(m, s);
	    document.getElementById('timer').innerHTML = h + ":" + m + ":" + s;

	    if (s == 0 && h == 0 && m == 0) {
	        setTimeout(function() {
	            window.location.reload();
	        }, 1000);
	        return false;
	    }
	    setTimeout(startTimer, 1000);
	}

	function checkSecond(sec) {
    	if (sec < 10 && sec >= 0) {
        	sec = "0" + sec
    	}; // add zero in front of numbers < 10
    	if (sec < 0) {
        	sec = "59"
    	};
    	return sec;
	} 
</script>