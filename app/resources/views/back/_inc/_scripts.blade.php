<script src="{{ asset('back/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('back/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('back/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('back/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('back/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <!-- Optional JS -->
  <script src="{{ asset('back/vendor/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('back/vendor/chart.js/dist/Chart.extension.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('back/js/argon.js?v=1.2.0') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
  {{-- <script src="{{ asset('back/js/darkmode.js') }}" charset="utf-8"></script> --}}
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript">
    // var ctx = document.getElementById("myChart");
    // var data = {
    //     labels: [
    //         "Red",
    //         "Blue",
    //         "Yellow"
    //     ],
    //     datasets: [
    //         {
    //             data: [300, 50, 100],
    //             backgroundColor: [
    //                 "#FF6384",
    //                 "#36A2EB",
    //                 "#FFCE56"
    //             ],
    //             hoverBackgroundColor: [
    //                 "#FF4394",
    //                 "#36A2EB",
    //                 "#FFCE56"
    //             ]


    //         }]
    // };

    // var options = {
    //   cutoutPercentage:40,
    // };


    // var myDoughnutChart = new Chart(ctx, {
    //     type: 'doughnut',
    //     data: data,
    //     options: options
    // });
  </script>
  <script type="text/javascript">
    $(function(){
        $('.selectpicker').selectpicker();
    });

    function redirect(url, target){
      window.open(url, target);
    }
  </script>
  