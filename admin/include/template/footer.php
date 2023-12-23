 <!--   Core JS Files   -->
 <script src="<?php  echo $js;?>core/popper.min.js"></script>
  <script src="<?php  echo $js;?>core/bootstrap.min.js"></script>
  <script src="<?php  echo $js;?>plugins/perfect-scrollbar.min.js"></script>
  <script src="<?php  echo $js;?>plugins/smooth-scrollbar.min.js"></script>
  <script src="<?php  echo $js;?>plugins/chartjs.min.js"></script>
  <script src="<?php  echo $js;?>all.min.js"></script>
  <script src="<?php  echo $js;?>jquery-3.7.0.js"></script>
  <script>

    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php  echo $js;?>material-dashboard.min.js?v=3.1.0"></script>
  
</body>
</html>
