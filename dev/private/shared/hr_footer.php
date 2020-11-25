 <!-- Footer -->
    
 <footer class="py-5 bg-dark">
      <div class="container">
        <p class="text-white text-center"><strong>Individuals Succeed. Families Thrive. Communities Prosper.</strong></p>
        <p class="text-white text-center">4150 Illinois Road, Fort Wayne, IN 46804 | crosswinds.org | lastingchangestartshere.org | lifelineyouth.org</p>
        <p class="m-0 text-center text-white">Copyright &copy; <?php echo date('Y') ?> Lasting Change, Inc.</p>
      </div>
      <!-- /.container -->
  </footer>
 
     <!-- Bootstrap core JavaScript -->
     <script src="<?php echo url_for('/vendor/jquery/jquery.min.js'); ?>"></script>
     <script src="<?php echo url_for('/vendor/jquery/tableManager.js'); ?>"></script>
    <!-- <script src="https://unpkg.com/@popperjs/core@2"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="<?php echo url_for('vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- Bootstrap Table -->
    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>

    <!-- X-editable -->
    
    <script src="<?php echo url_for('/vendor/bootstrap3-editable/js/bootstrap-editable.min.js'); ?> "></script>  
    <script src="<?php echo url_for('/js/moment.js'); ?>"></script>
    <script src="<?php echo url_for('/js/custom.js'); ?>"></script>

    <?php
      db_disconnect($db);
    ?>