 <!-- Footer -->
 <footer class="py-4 bg-dark">
    <div class="container">
      <p class="text-white text-center" id="footer_tagline"><strong>Changing hearts & bringing hope to individuals, families, and communities.</strong></p>
      <p class="text-white text-center mb-0">Lasting Change, Inc.</p>
      <p class="text-white text-center mb-0">4150 Illinois Road</p>
      <p class="text-white text-center mb-0">Fort Wayne, IN 46804</p>
      <p class="m-0 text-center text-white" id="footer_disclaimer">Copyright &copy; <?php echo date('Y') ?> Lasting Change, Inc.</br>
      This website is operated by Lasting Change, Inc. pursuant to and in compliance with service agreements with both Lifeline Youth & Family Services, Inc. and Crosswinds, Inc.</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo url_for('/vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?php echo url_for('/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?php echo url_for('/js/custom.js') ?>"></script>
   <!-- Chatbot -->
   <script src="//code.tidio.co/wcvpkdgsrtwx6hqb0rd7t9w6gs881qem.js" async></script>

   <script>
    setInterval(function(){
    logout();
},1200000);

function logout(){
    if(confirm('You have been idle for more than 20 minutes.  Click OK to stay logged in.'))
        alert('OK! keeping you logged in');
        
    else
    redirect()
}

function redirect(){
    document.location = "../../../public/logout.php"
}
</script>

   <?php
      db_disconnect($db);
  ?>