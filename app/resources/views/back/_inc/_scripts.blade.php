<script src="{{ ('asset/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ ('asset/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ ('asset/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ ('asset/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ ('asset/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <!-- Optional JS -->
  <script src="{{ ('asset/vendor/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ ('asset/vendor/chart.js/dist/Chart.extension.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ ('asset/js/argon.js?v=1.2.0') }}"></script>
  <script type="text/javascript">
    var ctx = document.getElementById("myChart");

    var data = {
        labels: [
            "Red",
            "Blue",
            "Yellow"
        ],
        datasets: [
            {
                data: [300, 50, 100],
                backgroundColor: [
                    "#FF6384",
                    "#36A2EB",
                    "#FFCE56"
                ],
                hoverBackgroundColor: [
                    "#FF4394",
                    "#36A2EB",
                    "#FFCE56"
                ]


            }]
    };

    var options = {
      cutoutPercentage:40,
    };


    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: options
    });
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js') }}"></script>
  <script type="text/javascript">
    $(function(){
        $('.selectpicker').selectpicker();
    });
  </script>
  <script src="/new-admin/{{ ('asset/js/darkmode.js') }}" charset="utf-8"></script>