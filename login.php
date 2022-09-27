<?php
    include 'auth.php';
    include 'template.php';
?>
<html>
    <head><link rel="stylesheet" href="/styles/login.css"/><script src="https://www.google.com/recaptcha/api.js" async defer></script></head>
    <body>
        <h1>Log In</h1>
        <h3>Already have an account? Log in with your credentials here</h3>
        <label for="loginEmail">School Email:</label>
        <input type="text" id="loginEmail"/>
        </br>
        <label for="loginEmail">Password:</label>
        <input type="password" id="loginPassword"/>
        </br>
        <div class="g-recaptcha" data-callback="onSubmit" data-sitekey="6LfweyUiAAAAAO5in_yCtI16Jf8YPrpuCJLNI2vP"></div>
        <button type="button" id="loginSubmit" onclick="login($('loginEmail').val(), $('loginPassword').val())">Submit</button>
        <p id="loginError" class="error"></p>
        <h4>Don't have an account? Sign up <a href="/signup">here</a></h4>
    </body>
    <script src="/scripts/login.js"></script>
</html>