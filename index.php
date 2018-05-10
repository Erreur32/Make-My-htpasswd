<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

       <link rel="stylesheet" href="css/prism.css">
       <link rel="stylesheet" href="css/style.css">
       <script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.2/clipboard.min.js"></script>
       <script src="js/prism.js"></script>

<style>
@body-bg: #456;
@color-light : #999;
@color-dark  : #777;
body {
      background-color: #456;
      background-color: @body-bg;
      color: #EEE;
      color: contrast(@body-bg, @color-dark, @color-light);
      width:100%;
}

input:invalid {
  border: 2px solid red;
}

input:valid {
  border: 1px solid green;
}

input:required {
    background:hsl(180, 50%, 90%);
}

input, textarea, select {
 padding:3px;
 border:1px solid #F5C5C5;
 border-radius:5px;
 width:250px;
 box-shadow:1px 5px 5px #333;
 }

input[type=submit] {
 width:100px;
 margin-left:5px;
 box-shadow:1px 5px 5px #333;
 cursor:pointer;
 }

.post-it {
background:#fefabc; 
padding:15px; 
font-family: 'Gloria Hallelujah', cursive; 
font-size:15px; 
color:#000; 
width:250px; 

-moz-transform: rotate(7deg);
-webkit-transform: rotate(7deg);
-o-transform: rotate(7deg);
-ms-transform: rotate(7deg);
transform: rotate(7deg);

box-shadow: 0px 10px 12px #333;
-moz-box-shadow: 0px 10px 12px #333;
-webkit-box-shadow: 0px 10px 12px #333;
}

.post-it2 {
background:#FFFFB0;
text-align: left;
vertical-align: top;
padding:10px;
color: #000;
width:100%;
height:155px;
box-shadow: 0px 10px 12px #333;
-moz-box-shadow: 0px 10px 12px #333;
-webkit-box-shadow: 0px 10px 12px #333;
}

hr {
width:35%;
}

      a
        {
                color: #c94663;
        }
      a:link {
    text-decoration: none;
        }


        strong, b
        {
                font-weight: 700;
                color: #232323;
        }

</style>
</head>

<body>
<div class="site-content" id="content">
 <center> <H1>Crypteur de Mot de Passe pour les .Htaccess </H1></center>
 <center>
   <?php

      // Formulaire 
    if (isset($_POST['login']) AND isset($_POST['pass']))
   {
      // SECU XSS
     $login = htmlspecialchars($_POST['login'], ENT_QUOTES, 'UTF-8');
     $pass = htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8');
      //    $pass_crypte = md5($_POST['pass']); // On crypte le mot de passe
     $pass_crypte = password_hash($_POST["pass"], PASSWORD_BCRYPT);
     $passdecry = ' . $login . ":" . $pass_crypte.'; // on affiche le passwd
     echo '<br><font size="5">Copier la ligne ci-dessous dans le fichier <b>.htpasswd</b></font><br /><br />';
     if (!isset($login)) $login = 'joe'; 
     if (!isset($pass_crypte)) $pass_crypte = '$1$ndTfdTH2$2nTqNz5KiTfDzAsVhPSu2.';
     echo '<pre><code class="language-less">' . $login . ":" . $pass_crypte.'</code></pre>';
  ?>

 <section class="content-section content-section--paste" id="paste-section">
        <h1>Paste it here</h1>
        <div id="paste-content" contenteditable="true" style="color:black"></div>
 </section>
 <?php
  }
  else // On n'a pas encore rempli le formulaire
  {
 ?>

   <center>
        <p class="Style2">Entrez votre login et votre mot de passe pour le crypter.</p>
       <form method="post">
          <p align="center"> Login : <br />
            <input type="text" name="login" required>
              <br />
              <br />
            Mot de passe : <br />
            <input type="text" name="pass" required>
            <br />
            <br />
            <br />
            <input name="submit" type="submit" value="Crypter !">
          </p>
      </form>
   </center>


<?php
}
?>

<!-- Post-it pour rappel création fichier -->
<center>
<br /><br /><br />
<hr>
<br /><br />
<div  class="post-it">
	<h2>Don't Forget!!</h2>
		<ul>
		<li>Create file: .htpasswd </li>
    		<li>Create file: .htaccess</li>
		<li>In your web repo.</li>
    	</ul>
</div>
<br /><br />
<TABLE BORDER=0 CELLSPACING=10 CELLPADDING=20 ALIGN="center">
<TR><div align="center"><em>Exemple Fichier .htaccess</em></div></TR>

<TR><TD><h1>.htpasswd</h1></TD><TD><h1>.htaccess</h1></TD></TR>
<TR><TD>
<div class="post-it2" WIDTH=100%>
<?php 
if (!isset($login)) $login = 'joe'; 
if (!isset($pass_crypte)) $pass_crypte = '$1$ndTfdTH2$2nTqNz5KiTfDzAsVhPSu2.';
echo '<span style="color:black;" id="copyTarget">' . $login . ':' . $pass_crypte.'</span>'; ?>
</div>
</TD>
<TD>
<div  class="post-it2">
	    <em>
            <font size="3"> AuthName &quot;Restricted Access&quot;<br />
            AuthGroupFile /dev/null<br />
            AuthType Basic<br />
            AuthUserFile /path/to/.htpasswd<br />
            require valid-user<br />
            </font></em>
 </div>        </TD></TR>
</TABLE>

<br />
<!-- // en test 
<?php
 ini_set("allow_url_fopen", "On");
 define('VERSION', '0.1');
 $script = file_get_contents('https://tools.echosystem.fr/Password/htpasswd/version.txt');
 define('REMOTE_VERSION', $script);
// echo REMOTE_VERSION;
 if(VERSION == REMOTE_VERSION) {
    echo "<div class='success'>
    <p>You have the latest version! </p>
    </div>"; echo VERSION;
} else {
 echo "<div class='error'>  Update v.";
 echo $script;
 echo " available!";
 echo "  Your version is v.";
  echo VERSION;
 // echo "<br /> Latest Version: ";
 // echo REMOTE_VERSION; echo $script;
 echo "</div>";
}
?>
-->

<br />
Script by <a href="https://erreur32.echosystem.fr">Erreur32</a> | Version:  <a href="https://git.echosystem.fr/Erreur32/Make-My-htpasswd"><?php echo VERSION; ?></a> | <?php echo date('Y'); ?>
</center>

<script>
(function(){

        // Get the elements.
        // - the 'pre' element.
        // - the 'div' with the 'paste-content' id.

        var pre = document.getElementsByTagName('pre');
        var pasteContent = document.getElementById('paste-content');

        // Add a copy button in the 'pre' element.
        // which only has the className of 'language-'.

        for (var i = 0; i < pre.length; i++) {
                var isLanguage = pre[i].children[0].className.indexOf('language-');

                if ( isLanguage === 0 ) {
                        var button           = document.createElement('button');
                                        button.className = 'copy-button';
                                        button.textContent = 'Copy';

                                        pre[i].appendChild(button);
                }
        };

        // Run Clipboard

        var copyCode = new Clipboard('.copy-button', {
                target: function(trigger) {
                        return trigger.previousElementSibling;
    }
        });

        // On success:
        // - Change the "Copy" text to "Copied".
        // - Swap it to "Copy" in 2s.
        // - Lead user to the "contenteditable" area with Velocity scroll.

        copyCode.on('success', function(event) {
                event.clearSelection();
                event.trigger.textContent = 'Copied';
                window.setTimeout(function() {
                        event.trigger.textContent = 'Copy';
                }, 2000);

                $.Velocity(pasteContent, 'scroll', {
                        duration: 1000
                });
        });

        // On error (Safari):
        // - Change the  "Press Ctrl+C to copy"
        // - Swap it to "Copy" in 2s.

        copyCode.on('error', function(event) {
                event.trigger.textContent = 'Press "Ctrl + C" to copy';
                window.setTimeout(function() {
                        event.trigger.textContent = 'Copy';
                }, 5000);
        });

})();
</script> </div>
 </body>

<!-- /!\ Your ip is loggued! -->
<!-- <?php  echo $_SERVER['REMOTE_ADDR'];   ?> -->
<!-- Get info: <?php $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); echo $hostname; ?> -->
<!-- Bye -->
<!--
by 🅴🆁🆁🅴🆄🆁32

Hosted on

🅴🅲🅷🔵🆂🆈🆂🆃🅴🅼
  _____       _                              _
 | ____| ___ | |__    ___   ___  _   _  ___ | |_  ___  _ __ ___
 |  _|  / __|| '_ \  / _ \ / __|| | | |/ __|| __|/ _ \| '_ ` _ \
 | |___| (__ | | | || (_) |\__ \| |_| |\__ \| |_|  __/| | | | | |
 |_____|\___||_| |_| \___/ |___/ \__, ||___/ \__|\___||_| |_| |_|
                                 |___/


01010111011001010110110001100011011011110110110101100101001000000111010001101111001000000100110101111001001000000101001101101001011101000110010100100000001000010010000000111010001010010010000000001101000010100000110100001010010000010110111001101111011101000110100001100101011100100010000001000010011011000110111101100111001000000110000101100010011011110111010101110100001000000100100101010100001000000010110100100000010100110110010101100011011101010111001001101001011101000111100100001101000010100000110100001010000011010000101001010000011011110111011101100101011100100110010101100100001000000100001001111001001000000100010101110010011100100110010101110101011100100011001100110010


</body>
</html>
