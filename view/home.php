<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="home.css">

    <title>High5 App Homepage</title>
</head>
<body>
    <div id="fullpage">
    <section class="section s1">
        <div class="hero">
            <div class="hero-image">

                <div class='nav'>

                    <nav>
                        <ul class="menu-list">
                            <li class="menu-list-item"><a href="#">about us</a></li>
                            <li class="menu-list-item"><a href="#">the team</a></li>
                            <li class="menu-list-item"><a href="#">contact us</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="left-main-content">
                <img src="./img/high5.png" id="logo-img" />
                <div class="main-content">
               
                  
                        <div class="content-container">
                            <div class="column" id="left-side">
                                <img src="./img/1.png" class="image" id="leon" />
                                    <div id="button-div">
                                        <input type="button" value="GET STARTED" id="button" onclick="window.location.href = '../index.php?action=login' " />
                                    </div>
                            </div>
                            <div class="column" id="right-side">
                                <div class="phone-layout">
                                    <div class="phone-layout-top">
                                        <h1>What Are Your Favorite Movies Of All Time..?</h1>
                             
                                    </div>
                                    <div class="phone-layout-border">
                                    <div class="phone-layout-bottom">

                                    <span
                                    class="txt-rotate"
                                    data-period='2000'
                                    data-rotate='[
                                    "Fight Club",
                                    "A Clockwork Orange",
                                    "Casablanca",
                                    "The Godfather",
                                    "Star Wars: Episode IV",
                                    "Taxi Driver",
                                    "Goodfellas"
                                    ]'
                                    ></span>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

    </section>

</div>


<script src="../public/js/home.js"></script>

</body>
</html>