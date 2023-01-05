<?php declare(strict_types = 1);?>

<?php function output_login_form(){?>
  <div id="signup_login_form">
    <h1>Login</h1>
    <form id="login_signup_form" action="actions/action_login.php" method="post">
      <input type="text" name="username" placeholder="Username" required/>
      <input type="password" name="password" placeholder="Password" required/>
      <button type="submit" class="button">Login</button>
    </form>
  </div>  
<?php } ?>

<?php function output_register_form(){?>
  <div id="signup_login_form">
    <h1>Sign Up</h1>
    <form action="actions/action_signup.php" method="post">
      <select name="role" id="role">
          <option value="customer" required>Customer</option>
          <option value="owner" required>Owner </option>
      </select>
      <input type="text" name="name" placeholder="Name" required/>
      <input type="text" name="username" placeholder="Username" required/>
      <input type="text" name="adress" placeholder="Adress" required/>
      <input type="tel" name="phone" placeholder="Phone" required/>
      <input type="password" name="password" placeholder="Password" required/>
      <button type="submit" class="button">Register</button>
    </form>
  </div>
<?php } ?>

    