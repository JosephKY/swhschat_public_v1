<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
    <body>
        <h1>Successfully Signed Out</h1>
        <h3>You'll be redirected momentarily</h3>
    </body>
    <script>
        setTimeout(() => {
            window.location.href = "/";
        }, 1800);
    </script>
</html>