<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUSH HOUR</title>
    <link rel="stylesheet" href="style.css">
    <script>
    // Active le son au premier clic de l'utilisateur
    window.addEventListener('click', function () {
        const audio = document.getElementById('bgAudio');
        audio.muted = false;
        audio.play();
    }, { once: true });

    
    </script>

</head>
<body>



    <audio id="bgAudio" autoplay loop muted>
        <source src="soundboard/musique_fond.mp3" type="audio/mpeg">
        Votre navigateur ne supporte pas la lecture audio.
    </audio>

    <div class="menu_campagnes">
        <header>
            <a class="bouton" href="index.php" style="color: white; font-weight: bold;">Back</a>
            <h1>RUSH <br> HOUR</h1>
            <a class="bouton" href="singleplayer.php" style="color: white; font-weight: bold;">Level</a>
        </header>
        <ul>
            <h3>Easy</h3>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=1">Level 01 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=2">Level 02 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=3">Level 03 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=4">Level 04 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=5">Level 05 -</a></li>
            <br>    
            <li><a href="page/jeux/play_campagne.php?level=6">Level 06 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=7">Level 07 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=8">Level 08 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=9">Level 09 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=10">Level 10 -</a></li>
            <br>
            <h3>Moderate 1</h3>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=11">Level 11 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=12">Level 12 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=13">Level 13 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=14">Level 14 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=15">Level 15 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=16">Level 16 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=17">Level 17 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=18">Level 18 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=19">Level 19 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=20">Level 20 -</a></li>
            <br>
            <h3>Moderate 2</h3>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=21">Level 21 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=22">Level 22 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=23">Level 23 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=24">Level 24 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=25">Level 25 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=26">Level 26 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=27">Level 27 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=28">Level 28 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=29">Level 29 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=30">Level 30 -</a></li>
            <br>
            <h3>Hard</h3>
            <li><a href="page/jeux/play_campagne.php?level=31">Level 31 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=32">Level 32 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=33">Level 33 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=34">Level 34 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=35">Level 35 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=36">Level 36 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=37">Level 37 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=38">Level 38 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=39">Level 39 -</a></li>
            <br>
            <li><a href="page/jeux/play_campagne.php?level=40">Level 40 -</a></li>
        </ul>
</body>
</html>