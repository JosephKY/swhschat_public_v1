<?php
    include 'auth.php';
    include 'template.php';
?>
<html>
    <head><link rel="stylesheet" href="/styles/login.css"/><script src="https://www.google.com/recaptcha/api.js" async defer></script></head>
    <body>
        <h1>Sign Up</h1>
        <h3>Don't have an account? Get started here</h3>
        <label for="signupFirstName">First Name:</label>
        <input type="text" id="signupFirstName"/>
        </br>
        <label for="signupLastName">Last Name:</label>
        <input type="text" id="signupLastName"/>
        </br>
        <label for="signupEmail">School Email:</label>
        <input type="text" id="signupEmail"/>
        </br>
        <label for="signupPassword">Password:</label>
        <input type="password" id="signupPassword"/>
        </br>
        <div class="g-recaptcha" data-callback="onSubmit" data-sitekey="6LfweyUiAAAAAO5in_yCtI16Jf8YPrpuCJLNI2vP"></div>
        <button type="button" id="signupSubmit" onclick="signup(($('#signupFirstName').val() + ' ' + $('#signupLastName').val()), $('#signupEmail').val(), $('#signupPassword').val() )">Submit</button>
        <p id="signupError" class="error"></p>
        </br>
        <h4>Already have an account? Login <a href="/login">here</a></h4>
    </body>
    <script src="/scripts/login.js"></script>
</html>