function setPassForm(){
    document.getElementById("regForm").innerHTML = `
    <div class="card-header">
    <h1>Password</h1>
  </div>

  <div class="card-body">
  
    <p><?php echo $_SESSION['email']; ?><p/>
  
    <h3>Please set your password</h3>

  <form action="index.php" method="post">
   
    <label for="password">Password</label>
    <input class="form-control" type="password" name="password" value=""/>

    <label for="password">Confirm Password</label>
    <input class="form-control" type="password" name="confirm_password" value=""/>

    <input type="submit" name="submit" value="Submit"  />
  </form>
  </div> <!-- End Card Body --> `
};