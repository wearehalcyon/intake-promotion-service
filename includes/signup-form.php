<form id="signupform" action="signup.php" method="POST">
    <p class="formControl">
        <input class="inputText typeUsername" type="text" name="username" placeholder="Username" value="<?php echo @$data['username']; ?>">
    </p>
    <p class="formControl">
        <input class="inputText typeUserFirstname" type="text" name="userfirstname" placeholder="First Name" value="<?php echo @$data['userfirstname']; ?>">
    </p>
    <p class="formControl">
        <input class="inputText typeUserLastname" type="text" name="userlastname" placeholder="Last Name" value="<?php echo @$data['userlastname']; ?>">
    </p>
    <p class="formControl">
        <input class="inputText typeUserAlias" type="text" name="useralias" placeholder="Alias" value="<?php echo @$data['useralias']; ?>">
    </p>
    <p class="formControl">
        <input class="inputText typeUserEmail" type="email" name="useremail" placeholder="Email" value="<?php echo @$data['useremail']; ?>">
    </p>
    <p class="formControl">
        <input class="inputText typeUserpassword" type="password" name="userpass" placeholder="Password" value="<?php echo @$data['userpass']; ?>">
    </p>
    <p class="formSubmit">
        <button class="button" type="submit" name="signup">Signup</button>
    </p>
</form>
