<!-- // File used in bottom of all webpages
// Mostly html code but also closes DB connection -->

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