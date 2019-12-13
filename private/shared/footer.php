<!-- footer for every page and closing the DB connection -->
<div style="height:70px;"></div> 
<footer class="jumbotron jumbotron-fluid mt-10" style="margin-bottom:0px;">
  <div class="container">
  <br>

&copy; <?php echo date('Y'); ?> King's College London Students' Union (KCLSU).
  </div>
</footer>

</body>
</html>

<?php
  db_disconnect($db);
?>