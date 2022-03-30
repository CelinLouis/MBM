<!-- Main Footer -->
<footer class="main-footer">
  <strong>Copyright <?= (new DateTime())->format('Y'); ?> &copy; <a href="#">MBM</a>.</strong>
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.0.3-pre
  </div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="js/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="js/overlayScrollbars/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="js/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="js/raphael/raphael.min.js"></script>
<script src="js/jquery-mapael/jquery.mapael.min.js"></script>
<script src="js/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="js/chart.js/Chart.min.js"></script>
<!-- DataTables -->
<script src="js/datatables/jquery.dataTables.js"></script>
<script src="js/datatables-bs4/dataTables.bootstrap4.js"></script>

<!-- PAGE SCRIPTS -->
<script src="js/dashboard2.js"></script>
<script type="text/javascript">
  $(function() {
    $("#example1").DataTable();
  });
</script>
</body>

</html>