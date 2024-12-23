﻿<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("inc/config.php");

$msg = "";
$sessionname = session_name("auth");
session_set_cookie_params(0, '/', '');
session_start();

if (isset($_GET['error'])) {
    $error = mysqli_real_escape_string($conn, strip_tags($_GET['error']));
    if ($error == 1001) {
        $msg = "<br><p style='color:#fff'>Nigga</p>";
    } else if ($error == 1002) {
        $msg = "<br><p style='color:#fff'>Expired link.</p>";
    }
}

if (isset($_POST['submit_login'])) {
    $username = mysqli_real_escape_string($conn, strip_tags($_POST['username']));
    $password = mysqli_real_escape_string($conn, strip_tags($_POST['password']));
    $password_converter = hash("sha512", $password);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1");
    $stmt->bind_param("ss", $username, $password_converter);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["username"] = $username;
        $_SESSION['loginvia'] = "Email";
        $msg = "<br><p style='color:#fff'>Logged in. Redirecting.</p>";
        header("Location: dash/index.php");
        exit();
    } else {
        $msg = "<br><p style='color:#fff'>ERROR: Wrong data.</p>";
    }

    $stmt->close();
}

?>

    <!--- Page HTML --->


    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feds.blog - login</title>
    <link rel="icon" type="image/x-icon" href="attachments/15e8c86f61a2f1178a2f19692f257dbe.jpg">
    <meta name="description" content="scammer">
    <meta property="og:title" content="Private Biolink">
    <meta property="og:description" content="The best Bio Link service">
    <meta property="og:url" content="index.html">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#4B4B4B">
    <link rel="stylesheet" href="css/landing.css">
    <link rel="icon" type="image/x-icon" href="#">



        <script>
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });

        document.addEventListener('keydown', function (e) {
            if (e.ctrlKey && (e.key === 'u' || e.key === 'U' || e.key === 's' || e.key === 'S')) {
                e.preventDefault();
            }
        });
    </script>

    <style>

    @font-face {
        font-family: custom-font;
        src: url(fonts/wvrbvfnafxtazrvybrms.ttf);
    }
    * {
        font-family: custom-font;
        cursor: url(sxdaup.cur) 16 16, auto !important;
    }

    body {
        background-size: cover;
        background-position: center center;
        display: flex;
        color: #fff;
        background-color: #1F2128;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }


    .customglow-username {
        font-size: 30px;
        margin-right: 10px;
        color: #ffffff;
        font-weight: bold;
        line-height: 2rem;
        text-align: center;
        filter: drop-shadow(0 0 0.2rem #ffffff);
    }


    .username-container {
    display: flex;
    align-items: center;
    justify-content: center;
    }


    @keyframes glow {
        0% {
            box-shadow: 0 0 5px #ffffff, 0 0 10px #ffffff, 0 0 15px #ffffff, 0 0 20px #ffffff;
        }
        50% {
            box-shadow: 0 0 20px #ffffff, 0 0 30px #ffffff, 0 0 40px #ffffff, 0 0 50px #ffffff;
        }
        100% {
            box-shadow: 0 0 5px #ffffff, 0 0 10px #ffffff, 0 0 15px #ffffff, 0 0 20px #ffffff;
        }
    }

    .avatar_effect {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        -o-object-fit: cover;
        object-fit: cover;
        margin: 0 auto;
        animation: glow 2s infinite;
        margin-bottom: 10px;
    }


    .avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        -o-object-fit: cover;
        object-fit: cover;
        margin: 0 auto;
        margin-bottom: 10px;
    }

    #particles-js {
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: -1;
        top: 0;
        left: 0;
    }


    .rainbow-username {
    font-size: 30px;
    font-weight: bold;
    
    margin-right: 10px;
    color: #ff0000;
    animation: animate 3s linear infinite;
    text-shadow: 0 0 5px #ff0000, 0 0 10px #ff0000, 0 0 15px #ff0000, 0 0 20px #ff0000;
    }

    @keyframes animate {
    from {
        filter: hue-rotate(0deg);
    }
    to {
        filter: hue-rotate(360deg);
    }
    }


    /* border */
    .border {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        padding: 39px 27px;
        width: 100%;
        max-width: 35.9rem;
        border-radius: 35px;
        backdrop-filter: blur(7px);
        background-color: rgb(255, 255, 255, 0.13) !important;
        box-shadow: 0 0 2.5px #ffffff;
    }
        
    @media (max-width : 480px) {
        .border {
            left: 50%;
            padding: 0px, 0px;
            width: 80%;
            max-width: 100%;
            border-radius: 21px;
        }
    }
    
    .role-icon-wrapper {
        padding: 7px 10px 1.5px;
        border-radius: 50px;
        max-width: -moz-fit-content;
        max-width: fit-content;
        display: inline-flex;
        place-items: center;
        margin: 2px auto 20px;
        background-color: rgba(255, 255, 255, 0.09);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .icon:active {
    transform: scale(1.2);
    }

    .icon {
    transition: all 0.2s ease-in-out;
    }

    .icon:hover {
    transform: scale(1.2);
    }

    .pixelated {
        width: 100%;
        height: 100%;
        z-index: -1;
        opacity: 1;
        background: transparent url(images/EyzV6w4.png) repeat 0 0;
    }



    /* icons */
    social-icons {
        text-align: center;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .icon {
        margin: 3px;
        width: 35px;
        height: 35px;
    }
    
    .icon-link {
        margin: 10px;
        text-decoration: none;
        text-align: center;
    }
    
    .icon-link:not(:nth-child(-n+8)) {
        display: none;
    }
    
    /* social media */
    
    .social-media {
        text-align: center;
        position: relative;
    }
    
    .description {
        font-size: 17px;
            margin: 14px 0;
        color: #fff;
    }
    
    .username {
        color: #777777;
        font-size: 30px;
        margin-right: 10px;
        
        font-weight: bold;
        text-shadow: 0 0 10px rgba(150, 47, 191, 0.7), 0 0 20px rgba(255, 0, 80, 0.7), 0 0 30px rgba(0, 242, 234, 0.7);
        animation: username 13s infinite;
    }
    

    
    .normal-username {
        color: #fff;
        font-size: 30px;
        margin-right: 10px;
        
        font-weight: bold;
    }

    

    .role-icon {
        display: inline-block;
        position: relative;
        cursor: pointer;
        outline: none;
        border: none;
        box-shadow: none;
    }

    .role-icon img {
        width: 31px;
        height: 31px;
    }



    .sparky-effect {
        background-image: url(images/sparkle.gif);
        display: inline-block;
        padding: 10px;
    }


    .glowblue-username {
        font-size: 30px;
        margin-right: 10px;
        
        font-weight: bold;
        line-height: 2rem;
        text-align: center;
        text-shadow: 0 0 10px #0000ff, 0 0 20px #0000ff, 0 0 30px #0000ff, 0 0 40px #0000ff, 0 0 50px #0000ff, 0 0 60px #0000ff, 0 0 70px #0000ff, 0 0 80px #0000ff;
    }





    @keyframes popin {
        0% { transform: scale(0.5) translateX(-50%); }
        100% { transform: scale(1) translateX(-50%); }
    }

    .tooltip {
        position: absolute;
        background-color: rgba(0, 0, 0, 0.5);
        color: #f0f0f0;
        font-weight: 580!important;
        user-select: none;
        padding: 5px;
        border-radius: 6px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        white-space: nowrap;
        display: block;
        z-index: 1;
        transform: scale(0) translateX(-50%);
        left: 50%;
        bottom: 110%;
        letter-spacing: .01cm!important;
        font-size: 14.3px;
        transition: transform 0.1s ease-out;
    }


    .role-icon:hover .tooltip,
    .role-icon:focus-within .tooltip {
        animation: popin 0.1s ease-out forwards;
    }

    ::placeholder {
color: white;
opacity: 0.4; /* Firefox */
}

    
    /* glow animation */
    
    @keyframes username {
        0% {
            text-shadow: 0px 0px 9px #5539cc;
            opacity: 1;
        }
        14% {
            text-shadow: 0px 0px 9px #5539cc;
            opacity: 0.50;
        }
        20% {
            text-shadow: 0px 0px 5px #feda75,
            0px 0px 5px #fa7e1e,
            0px 0px 5px #d62976,
            0px 0px 5px #962fbf,
            0px 0px 5px #4f5bd5;
            opacity: 1;
        }
        30% {
            text-shadow: 0px 0px 5px #229ED9;
            opacity: 0.25;
        }
        40% {
            text-shadow: 0px 0px 10px #A00003;
            opacity: 1;
        }
        50% {
            text-shadow: 0px 0px 10px #FFFC00;
            opacity: 0.25;
        }
        60% {
            text-shadow: 0px 0px 5px #0079C1;
            opacity: 1;
        }
        70% {
            text-shadow: 0px 0px 5px gray;
            opacity: 0.25;
        }
        80% {
            text-shadow: 0px 0px 5px blue;
            opacity: 1;
        }
        90% {
            text-shadow: 0px 0px 5px #E60023;
            opacity: 0.25;
        }
    }
    

    .videobg {
        width: 100%;
        height: 100%;
        z-index: -3;
        position: absolute
    }

    #vidx {
        width: 100vw;
        height: 100vh;
        -o-object-fit: cover;
        object-fit: cover;
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        z-index: -1
    }

    @keyframes fadeinout{
        0%{
            background-position:-500%
        }
        100%{
            background-position:500%
        }
    }
    .fadeinoutname{
        margin-right: 10px;
        position:relative;
        overflow:hidden;
        background: linear-gradient(90deg,#000,#ffffff,#ffffff,#000);
        background-repeat:no-repeat;
        background-size:80%;
        animation:fadeinout 2s linear infinite;
        -webkit-background-clip:text;
        -webkit-text-fill-color:transparent
    }



        </style>

    <style>
    .status {
        color: #f23f43;
        position: absolute;
        font-size: 19.5px;
        bottom: 3.5px;
        left: 55.5px;
        user-select: none;
        -moz-user-select: none;
        -webkit-user-select: none
    }

    .statuscontainer_dnd {
        color: #f23f43;
        position: absolute;
        font-size: 19.5px;
        bottom: 3.5px;
        left: 55.5px;
        user-select: none;
        -moz-user-select: none;
        -webkit-user-select: none
    }

    .statuscontainer_idle {
        color: #eff23f;
        position: absolute;
        font-size: 19.5px;
        bottom: 3.5px;
        left: 55.5px;
        user-select: none;
        -moz-user-select: none;
        -webkit-user-select: none
    }

    .statuscontainer_online {
        color: #08d334;
        position: absolute;
        font-size: 19.5px;
        bottom: 3.5px;
        left: 55.5px;
        user-select: none;
        -moz-user-select: none;
        -webkit-user-select: none
    }

    .statuscontainer_offline {
        color: #858585;
        position: absolute;
        font-size: 19.5px;
        bottom: 3.5px;
        left: 55.5px;
        user-select: none;
        -moz-user-select: none;
        -webkit-user-select: none
    }

    .container, .discordcontainer {
        padding: 10px;
        border-radius: 15px;
        position: relative;
        display: inline-flex;
        place-items: center;
    }

    .profile-pic, .avatarcontainer {
        user-select: none;
        -moz-user-select: none;
        -webkit-user-select: none;
        border-radius: 50%;
        -o-object-fit: cover;
        object-fit: cover;
    }

    .info h1, .infocontainer h1 {
        text-align: left;
        padding: 0;
        margin: 0 0 0 11px;
        font-size: 19.7px;
        max-width: 240px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        font-weight: 630;
    }

    .status, .statuscontainer_dnd, .statuscontainer_idle, .statuscontainer_online {
        position: absolute;
        font-size: 19.5px;
        bottom: 3.5px;
        left: 55.5px;
        user-select: none;
        -moz-user-select: none;
        -webkit-user-select: none;
    }

    .status {
        color: #f23f43;
    }

    .statuscontainer_dnd {
        color: #f23f43;
    }

    .statuscontainer_idle {
        color: #eff23f;
    }

    .statuscontainer_online {
        color: #08d334;
    }

    .infocontainer h3 {
        text-align: left;
        padding: 0;
        font-size: 13.2px;
        font-weight: 520;
        max-width: 270px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        margin: 3.5px 6px 0 11px;
    }

    @media (max-width: 767px) {
        .info h1, .infocontainer h1 {
            max-width: 115px;
        }

        .infocontainer h3 {
            max-width: 115px;
        }
    }

    @media (min-width: 768px) {
        .info h1, .infocontainer h1 {
            max-width: 170px;
        }

        .infocontainer h3 {
            max-width: 170px;
        }
    }

    @media (min-width: 992px) {
        .info h1, .infocontainer h1 {
            max-width: 210px;
        }

        .infocontainer h3 {
            max-width: 210px;
        }
    }

    @media (min-width: 1200px) {
        .info h1, .infocontainer h1 {
            max-width: 240px;
        }

        .infocontainer h3 {
            max-width: 270px;
        }
    }

    @media (max-width: 359px) {
        .info h1, .infocontainer h1 {
            max-width: 100px;
        }

        .infocontainer h3 {
            max-width: 100px;
        }
    }
    </style>

    <script>
    var i = 0;
    var txt = '';
    var speed = 1000;
    var isDeleting = false;

    function typeWriter() {
        if (isDeleting && i > 0) {
        document.title = "@" + txt.substring(0, i-1);
        i--;
        setTimeout(typeWriter, speed);
        } else if (!isDeleting && i < txt.length) {
        document.title = "@" + txt.substring(0, i+1);
        i++;
        setTimeout(typeWriter, speed);
        }

        if (i == txt.length) {
        isDeleting = true;
        } else if (i == 0) {
        isDeleting = false;
        }
    }

    typeWriter();
    </script>



    <link rel="stylesheet" href="css/all.min.css">
    </head>

    
    <body>      
    <div style="background-image:url(media/bg.gif); position: absolute; height: 100%; width: 100%; background-size: cover; background-position: 50%; z-index: -1;"></div>

    <div class="videobg">
    <video id="vidx" loop="" playsinline="" draggable="false" autoplay="" muted="">
        <source src="media/backgroundcuz.mp4" type="video/mp4" id="video-source"></video>
    </div>

    <div class="pixelated"></div>


        <div class="landing" id="landing">
        
    <div id="particles-js"></div>

    <div class="border">
    <div class="avatar">
        <div class="avatar-container" style="display: flex; justify-content: center; align-items: center;">
            <img src="images/logo.png" alt="Avatar" class="inline-effect avatar">
        </div>
    </div>


            <div class="social-media">

<form method="POST">
        <br>
        <input type="text" style="color:white;background-color:#696969" name="username" id="username" placeholder="Username" data-val="true" data-val-required="The Login field is required." value=""><br>
        <input type="password" style="color:white;background-color:#696969" name="password" id="password" placeholder="Password" data-val="true" data-val-required="The Password field is required."><br><br>

        <input type="hidden" name="submit_login" id="submit_login" value="submit_login">

        <button data-sitekey="6LfwzG4iAAAAAI8zFD6H7IwbDB8ov6_PRB_qDFvQ" data-callback="onSubmit" data-action='submit' name="submit_login" style="color:white;background-color:#696969" style="margin-top: 10px">Login</button>
        <br>
        <small id="loginHelp" class="form-text text-muted">Don't have an account? <a href="./register.php" class="text-muted link-secondary">Sign up.</a></small>
    </form>






            </div>
        </div>
    <audio loop="true" id="audio">
            <source src="media/audioye.mp3" type="audio/mpeg">
        </audio>



    <script src="js/script.js"></script>
    <script src="js/particles.min.js"></script>

    <script>
        var roleIconWrapper = document.querySelector('.role-icon-wrapper');
        if (roleIconWrapper.innerHTML.trim() === '') {
            roleIconWrapper.style.display = 'none';
        }
    </script>

    <script src="js/browser.js"></script>
    <script>
    window.addEventListener("load", (event) => {
            new cursoreffects.fairyDustCursor({colors: ["#fffafa"]});
    });
    </script>
    

    </script>
    

    <script>
    function getElapsedTime(startTimestamp) {
        let currentTime = new Date();
        let elapsedTime = currentTime - new Date(startTimestamp);
        let seconds = Math.floor((elapsedTime / 1000) % 60);
        let minutes = Math.floor((elapsedTime / (1000 * 60)) % 60);
        let hours = Math.floor((elapsedTime / (1000 * 60 * 60)) % 24);
        return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }

        document.addEventListener("DOMContentLoaded", function () {
            const discordApi = '';
            fetch(discordApi)
                .then(response => response.json())
                .then(data => {
                    if (data.success !== true) {
                        console.error('I can\'t find user');
                        return;
                    }
        
                    const discordrpc = document.getElementById('discordrpc');
        
                    const discordContainer = document.createElement('div');
                    discordContainer.className = 'discordcontainer';
                    discordContainer.style = 'margin-bottom: 10px;background-color: rgb(0, 0, 0, 0.09);border: 1px solid rgb(0, 0, 0, 0.02);border-radius: 15px';
        
                    const avatar = document.createElement('img');
                    avatar.src = data.data.discord_user.avatar;
                    avatar.height = '65';
                    avatar.draggable = 'true';
                    avatar.width = '65';
                    avatar.className = 'avatarcontainer';
                    avatar.style = 'border: 2px solid rgb(0, 0, 0, 0.2)!important';
                    discordContainer.appendChild(avatar);
        
                    const infoDiv = document.createElement('div');
                    infoDiv.className = 'infocontainer';
        
                    const username = document.createElement('h1');
                    username.id = 'username22';
                    username.style = 'color: rgb(255 255 255);margin-right: 3px;width: 100%';
                    username.textContent = `${data.data.discord_user.username}`;
                    infoDiv.appendChild(username);
        
                    const activities = document.createElement('h3');
                    activities.id = 'activities22';
                    activities.style = 'color: rgb(255 255 255);display: block;justify-content: left;margin-top: 4.5px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap; width: auto;';
                    if (data.data.activities && data.data.activities.length > 0) {
                        let playingActivity = data.data.activities.find(activity => activity.type === 'PLAYING');
                        let customActivity = data.data.activities.find(activity => activity.type === 'CUSTOM');
                        let activityText = '';
                        if (playingActivity) {
                            let details = playingActivity.details || '';
                            if (playingActivity.timestamps) {
                                setInterval(function() {
                                    let elapsedTime = getElapsedTime(playingActivity.timestamps.start);
                                    activityText = `Playing ${playingActivity.name}${details ? '<br>' + details : ''}<br>Elapsed: ${elapsedTime}`;
                                    activities.innerHTML = activityText; 

                                    if (details.length > elapsedTime.length) {
                                        activities.style.width = 'auto';
                                    } else {
                                        activities.style.width = '170px';
                                    }
                                }, 100);
                            } else {
                                activityText = `Playing ${playingActivity.name}${details ? '<br>' + details : ''}`;
                                activities.innerHTML = activityText; 
                            }
                        } else if (customActivity) {
                            activityText = customActivity.state;
                            activities.textContent = activityText;                    
                        }
                        activities.textContent = activityText;
                    } else {
                        activities.textContent = 'No activity';
                    }

                    infoDiv.appendChild(activities);
        
                    const statusDiv = document.createElement('div');
                    statusDiv.id = 'status22';
                    if (data.data.discord_status === 'dnd') {
                        statusDiv.className = 'statuscontainer_dnd';
                    } else if (data.data.discord_status === 'idle') {
                        statusDiv.className = 'statuscontainer_idle';
                    } else if (data.data.discord_status === 'online') {
                        statusDiv.className = 'statuscontainer_online';
                    } else if (data.data.discord_status === 'offline') {
                        statusDiv.className = 'statuscontainer_offline';
                    }
                    statusDiv.style = 'left: 55.5px; font-size: 19.5px; margin-bottom: 3px;';
                    statusDiv.innerHTML = getStatus(data.data.discord_status);
                    infoDiv.appendChild(statusDiv);
                    let largeImageUrl;
                    let smallImageUrl;

                    if (data.data.activities && data.data.activities.length > 0) {
                        let playingActivity = data.data.activities.find(activity => activity.type === 'PLAYING');
                        if (playingActivity) {
                            if (playingActivity.assets && playingActivity.assets.largeImage) {
                                if (playingActivity.assets.largeImage.startsWith('mp:external/')) {
                                    largeImageUrl = playingActivity.assets.largeImage.replace('mp:external/', 'https://media.discordapp.net/external/');
                                } else {
                                    largeImageUrl = 'https://cdn.discordapp.com/app-assets/' + playingActivity.application_id + '/' + playingActivity.assets.largeImage + '.png';
                                }
                            }

                            if (playingActivity.assets && playingActivity.assets.smallImage) {
                                if (playingActivity.assets.smallImage.startsWith('mp:external/')) {
                                    smallImageUrl = playingActivity.assets.smallImage.replace('mp:external/', 'https://media.discordapp.net/external/');
                                } else {
                                    smallImageUrl = 'https://cdn.discordapp.com/app-assets/' + playingActivity.application_id + '/' + playingActivity.assets.smallImage + '.png';
                                }
                            }
                        }
                    }

                    discordContainer.appendChild(infoDiv);

                    if (largeImageUrl) {
                        const largeImage = document.createElement('img');
                        largeImage.src = largeImageUrl;
                        largeImage.style = 'height: 63px;width: 63px;border-radius: 10px; margin-left:10px;';
                        discordContainer.appendChild(largeImage);
                    }

                    if (smallImageUrl) {
                        const smallImage = document.createElement('img');
                        smallImage.src = smallImageUrl;
                        smallImage.style = 'height: 25px;width: 25px;border-radius: 150px;position: absolute;bottom: 11px;right: 2px; margin-left:10px;';
                        discordContainer.appendChild(smallImage);
                    }


                    discordrpc.appendChild(discordContainer);
                }).catch(error => console.error('Error fetching data from Discord API:', error));
        
        function getStatus(status) {
            switch (status) {
                    case 'dnd':
                        return '<svg style="background-color: rgb(0, 0, 0, 0.2)!important; border-radius: 50%!important; padding: 0.5px 0.5px 0.2px 0.5px!important;" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10s10-4.486 10-10S17.514 2 12 2zm5 11H7v-2h10v2z" fill="currentColor"></path></svg>';
                    case 'idle':
                        return '<svg style="background-color: rgb(0, 0, 0, 0.2)!important; border-radius: 50%!important; padding: 0.5px 0.5px 0.2px 0.5px!important;" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="currentColor" d="M235.54 150.21a104.84 104.84 0 0 1-37 52.91A104 104 0 0 1 32 120a103.09 103.09 0 0 1 20.88-62.52a104.84 104.84 0 0 1 52.91-37a8 8 0 0 1 10 10a88.08 88.08 0 0 0 109.8 109.8a8 8 0 0 1 10 10Z"></path></svg>';
                    case 'online':
                        return '<svg style="background-color: rgb(0, 0, 0, 0.2)!important; border-radius: 50%!important; padding: 0.5px 0.5px 0.2px 0.5px!important;" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m0 2a8 8 0 0 1 8 8a8 8 0 0 1-8 8a8 8 0 0 1-8-8a8 8 0 0 1 8-8m0 2a6 6 0 0 0-6 6a6 6 0 0 0 6 6a6 6 0 0 0 6-6a6 6 0 0 0-6-6m0 2a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4Z"></path></svg></div>';
                    case 'offline':
                        return '<svg style="background-color: rgb(0, 0, 0, 0.2)!important; border-radius: 50%!important; padding: 0.5px 0.5px 0.2px 0.5px!important;" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M16.06 7.94a1.5 1.5 0 0 1 0 2.12L14.122 12l1.94 1.94a1.5 1.5 0 0 1-2.122 2.12L12 14.122l-1.94 1.94a1.5 1.5 0 0 1-2.12-2.122L9.878 12l-1.94-1.94a1.5 1.5 0 1 1 2.122-2.12L12 9.878l1.94-1.94a1.5 1.5 0 0 1 2.12 0ZM0 12C0 5.373 5.373 0 12 0s12 5.373 12 12s-5.373 12-12 12S0 18.627 0 12Zm12-9a9 9 0 1 0 0 18a9 9 0 0 0 0-18Z"></path></svg></div>'
                    default:
                        return '';
            }
        }
    });
    </script>

    <script>
        var roleIconWrapper = document.querySelector('.role-icon-wrapper');
        if (roleIconWrapper.innerHTML.trim() === '') {
            roleIconWrapper.style.display = 'none';
        }
    </script>


    

    <script>
    let text = `harmfulskid`;
    let formattedText = text.replace(/(\r\n|\n|\r)/g, '<br>');
    console.log(formattedText)

    </script>


    <script>
    var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 1000;
        this.txt = '';
        this.isDeleting = false;
        this.messages = this.toRotate[this.loopNum].split('|').map(message => message.replace(/!br!/g, '<br/>'));
        this.messageIndex = 0;
        this.tick();
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            toRotate = toRotate.replace(/\n|\r\n/g, '\\n');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
                var parsed = JSON.parse(toRotate); 
                for (var j=0; j<parsed.length; j++) {
                    parsed[j] = parsed[j].replace(/\\n/g, '\n').replace(/\n/g, '!br!');
                }
                new TxtType(elements[i], parsed, period);
            }
        }
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };

    TxtType.prototype.tick = function() {
        var fullTxt = this.messages[this.messageIndex];

        if (this.isDeleting) {
            if (this.txt.endsWith('<br/>')) {
                this.txt = this.txt.substring(0, this.txt.lastIndexOf('<'));
            } else {
                this.txt = fullTxt.substring(0, this.txt.length - 1);
            }
        } else {
            if (fullTxt.substring(this.txt.length, this.txt.length + 5) === '<br/>') {
                this.txt += '<br/>';
            } else {
                this.txt = fullTxt.substring(0, this.txt.length + 1);
            }
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { 
            delta /= 4;
            if (this.txt === '') {
                this.isDeleting = false;
                if (++this.messageIndex >= this.messages.length) {
                    this.messageIndex = 0;
                    this.loopNum++;
                    if (this.loopNum >= this.toRotate.length) {
                        this.loopNum = 0;
                    }
                    this.messages = this.toRotate[this.loopNum].split('|').map(message => message.replace(/!br!/g, '<br/>'));
                }
                delta = 500;
            }
        }

        if (!this.isDeleting && this.txt === fullTxt) {
            delta = this.period;
            this.isDeleting = true;
        }

        setTimeout(function() {
            that.tick();
        }, delta);
    };
    </script>



        <script>
    particlesJS("particles-js", {
        particles: {
            number: {
            value: 100,
            density: {
                enable: true,
                value_area: 800,
            },
            },
            color: {
            value: "#ffffff", 
            },
            shape: {
            type: "circle", 
            },
            opacity: {
            value: 0.8,
            random: true,
            anim: {
                enable: true,
                speed: 1,
                opacity_min: 0.1,
                sync: false,
            },
            },
            size: {
            value: 5,
            random: true,
            anim: {
                enable: true,
                speed: 2,
                size_min: 1,
                sync: false,
            },
            },
            line_linked: {
            enable: false,
            },
            move: {
            enable: true,
            speed: 1, 
            direction: "bottom",
            random: true,
            straight: false,
            out_mode: "out",
            bounce: false,
            },
        },
        interactivity: {
            detect_on: "canvas",
            events: {
            onhover: {
                enable: false,
            },
            onclick: {
                enable: false,
            },
            resize: true,
            },
            modes: {
            grab: {
                distance: 400,
                line_linked: {
                opacity: 1,
                },
            },
            bubble: {
                distance: 250,
                size: 0,
                duration: 2,
                opacity: 0,
            },
            repulse: {
                distance: 400,
                duration: 0.4,
            },
            push: {
                particles_nb: 4,
            },
            remove: {
                particles_nb: 2,
            },
            },
        },
        retina_detect: true,
        });

        </script>


    <style type="text/css">.typewrite > .wrap { border-right: 0.08em solid #fff}</style></body>
    </html>

    <script>
    function onSubmit(token) {
    document.getElementById("register-form").submit();
    }
    </script></head><body>


    <?php echo $msg; ?>
    </div></div>