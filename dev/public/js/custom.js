function setPassForm(){
    document.getElementById("regForm").innerHTML = `
    <div class="card-header">
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
  <div class="card-header">
  <h1>Please Enter Your Password</h1>
</div>

<div class="card-body">

  <p><?php echo $_SESSION['email']; ?><p/>

  <h3>Please enter your password</h3>

<form action="login.php" method="post">
 
  <label for="password">Password</label>
  <input class="form-control" type="password" name="password" value=""/>

  <input type="submit" name="submit" value="Submit"  />
</form>
</div> <!-- End Card Body --> `
};

function resetPass(){
  confirm("Do you wish to reset the password for id " + document.getElementById("clearPass").value + "?" );
};