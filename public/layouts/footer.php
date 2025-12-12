<?php
//...\spkbayes\public\layouts\footer.php

// Variabel yang dibutuhkan dari admin.php (router)
if (!isset($BASE_URL_ADMINLTE)) {
  $BASE_URL_ADMINLTE = "./adminlte/";
}
?>
</div>
</section>
</div>
<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 1.0
  </div>
  <strong>Copyright &copy; 2024 <a href="index.php">SPK Bayes</a>.</strong> All rights reserved.
</footer>

<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<script src="<?= $BASE_URL_ADMINLTE ?>plugins/jquery/jquery.min.js"></script>
<script src="<?= $BASE_URL_ADMINLTE ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $BASE_URL_ADMINLTE ?>dist/js/adminlte.min.js"></script>

</body>

</html>