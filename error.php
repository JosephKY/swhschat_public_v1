<!DOCTYPE html>
<html lang="en-us">
    <head><title>Error</title></head>
    <body>
        <div id="center">
            <p style="color: #222">http.cat</p>
            <img id="errorcat" alt="Error Cat"/>
            <h1 id="errorheader"></h1>
            <h3 id="errordetails"></h3>
        </div>
    </body>
    <?php
        $code = $_GET["e"];
        echo "<script>const code = '$code';</script>";
    ?>
    <script>
        const errKnowledge = {
            "400":["Bad Request","The client made an invalid request to the server. Please try again"],
            "401":["Unauthorized","You are trying to access a part of the website that requires authorization to access and your identity could not be verified"],
            "403":["Forbidden","You are trying to access a part of the website that you do not have authorization to access"],
            "404":["Not Found","What you're looking for is not here. Check for any typos in the URL and try again"],
            "405":["Method Not Allowed","The client tried using an HTTP method where it's not supposed to be used"],
            "407":["Proxy Authentication Required","To access this directory, you must authenticate via a proxy"],
            "408":["Request Timeout","The client connection to the server has been idling too long and is now being closed"],
            "409":["Conflict","Server data conflicts with the information sent by the client"],
            "410":["Gone","The content the client has requested has been permanently deleted"],
            "500":["Internal Server Error","The server ran into a problem it could not circumvent. Please try again later"],
            "499":["",""],
            "":["",""],
            "":["",""],
        }

        document.getElementById("errorcat").src = "https://http.cat/" + code;
        if(code == "499"){
            document.getElementById("errorcat").src = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZw1gAJL_GHdK3qioyOJsLiwQq4L5D1vy1smBHjzwnh-hp_6Ik1o2lbSxEUZ8AcK96FXA:www.almostrandomtheatre.co.uk/wp-content/themes/news-code/assets/img/placeholder.jpg&usqp=CAU"; 
        }
        document.getElementById("errorheader").innerHTML = code;

        if(code in errKnowledge){
            document.getElementById("errorheader").innerHTML = code + " " + errKnowledge[code][0];
            document.getElementById("errordetails").innerHTML = errKnowledge[code][1]
        }
    </script>
    <style>
        body {
            background: black;
        }

        h1 {
            width: fit-content;
            margin: 0 auto;
            color: white;
            font-size: 2.8em;
            display: none;
        }

        h3 {
            color: #EEE;
            max-width: 60%;
            word-wrap: normal;
            margin: 0 auto;
            font-weight: normal;
            min-width: 400px;
            font-size: 1.5em;
            padding-bottom: 1em;
        }

        h1, h3 {
            font-family: arial;
            text-align: center;
        }

        #center {
            width: fit-content;
            box-sizing: border-box;
            margin-left: auto;
            margin-right: auto;
        }

        img {
            background: #111;
            display: block;
            margin: 0 auto;
            min-width: 750px;
            min-height: 600px;

        }
    </style>
    <?php
        die()
    ?>
</html>
