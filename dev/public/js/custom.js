function setPassForm(){
    document.getElementById("regForm").innerHTML = `
    <div class="card-header" id="login-header">
    <h1>Password</h1>
  </div>

  <div class="card-body">
  
    <p><?php echo $_SESSION['email']; ?><p/>
  
    <h3>Please Set Your Password</h3>

  <form action="index.php" method="post">
   
    <label for="password">Password</label>
    <input class="form-control" type="password" name="password" value=""/>

    <label for="password">Confirm Password</label>
    <input class="form-control" type="password" name="confirm_password" value=""/>

    <p>Passwords should be at least 12 characters and include at least one uppercase letter, lowercase letter, number, and symbol.</p>
    <input type="submit" name="submit" value="Submit"  />
  </form>
  </div> <!-- End Card Body --> `
};

function enterPass(){
  document.getElementById("regForm").innerHTML = `
  <div class="card-header" id="login-header">
  <h1>Password</h1>
</div>

<div class="card-body">

  <h3>Please enter your password</h3>

<form action="login.php" method="post">
 
<input class="form-control" type="email" name="email" value="<?php echo ($_SESSION['email']); ?>" disabled /><br />
  <input class="form-control" type="password" name="password" value=""/>

  <input class="btn btn-outline-warning" id="cust-btn" type="submit" name="submit" value="Submit"  />
</form>
</div> <!-- End Card Body --> `
};

function resetPass(){
  confirm("Do you wish to reset the password for id " + document.getElementById("clearPass").value + "?" );
};