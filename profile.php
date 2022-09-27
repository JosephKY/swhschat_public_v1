<?php
    include 'auth.php';
    include 'template.php';
?>
<!DOCTYPE html>
<html>
    <head><link rel="stylesheet" href="/styles/profile.css"/></head>
    <body>
        <div id="profileDetailsContainer">
            <img id="profilePicture" src="/assets/usrgen/pfpplaceholder.png"/>
            <div id="profileDetailsInfo">
                <h1 id="profileName">Loading...</h1>
                <h3 id="profileCreated"></h3>
            </div>
        </div>
    </body>
    <script src="/scripts/profile.js"></script>
</html>