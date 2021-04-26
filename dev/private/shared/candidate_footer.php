 <!-- Footer -->
 <footer class="py-4 bg-dark">
    <div class="container">
      <p class="text-white text-center" id="footer_tagline"><strong>Changing hearts & bringing hope to individuals, families, and communities.</strong></p>
      <p class="text-white text-center">4150 Illinois Road, Fort Wayne, IN 46804</p>
      <p class="m-0 text-center text-white">Copyright &copy; <?php echo date('Y') ?> Lasting Change, Inc.</p>
      <p class="text-center text-white" id="footer_disclaimer">DISCLAIMER: Lasting Change, Inc. is a management services company for Lifeline or Crosswinds.</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo url_for('/vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?php echo url_for('/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?php echo url_for('/js/custom.js') ?>"></script>
   <!-- Chatbot -->
   <script src="//code.tidio.co/wcvpkdgsrtwx6hqb0rd7t9w6gs881qem.js" async></script>

   <?php
      db_disconnect($db);
  ?>