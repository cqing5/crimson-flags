<?php
  $isBanned = $_GET['banned'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crimson Flags - Roommate Matcher</title>
    <base href="CapstoneSkeleton">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="footer/style.css" />
  </head>
  <body>
  <nav>
    <ul>
      <li>Crimson Flags</li>
      <li><a href="login/login.php">Login</a></li>
    </ul>
  </nav>
<main> 
  <?php 
  if(!empty($isBanned)) {
    echo("<div class='banned'>Sorry! It looks like that account has been banned!</div>");
  }?>
  <section class='hero'>
    <div class='heroWrapper'>
      <div class='heroBGContainer'></div>
      <div class='heroTextContent'>
        <h1 class='animatedTitle'>
          <span class="text-wrapper"><span class="letters">CRIMSON FLAGS</span></span></h1>
        <p class="ml6"><span class="text-wrapper2">
    <span class="letters2">Roommate matching at IU has never been this easy!</span>
  </span></p>
  <p class="mobile">
    Roommate matching at IU has never been this easy!
  </p>
        <a href="login/login.php">Find your next roommate!</a>
      </div>
    </div>
    <div class='bottomTriangleContainer'>
          <div class='triangle-left'></div>
          <div class='triangle-right'></div>
      </div>
  </section>
  <section class='about'>
    <h1>How it works</h1>
    <div class='useWrapper'>
        <div class='step'>
        <div class="tempPic"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-medical" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
  <rect x="9" y="3" width="6" height="4" rx="2" />
  <line x1="10" y1="14" x2="14" y2="14" />
  <line x1="12" y1="12" x2="12" y2="16" />
</svg></div>
        <h2>Complete your personality quiz</h2>
        </div>

        <div class='step step2'>
        <div class="tempPic"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <circle cx="9" cy="7" r="4" />
  <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
  <path d="M16 3.13a4 4 0 0 1 0 7.75" />
  <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
</svg></div>
        <h2>Match and chat with potential roommates</h2>
        </div>

        <div class='step'>
        <div class="tempPic"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <polyline points="5 12 3 12 12 3 21 12 19 12" />
  <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
  <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
</svg></div>
        <h2>Start looking at some places to live</h2>
        </div>
      </div>
    <div class='about-info'>
      <div class='about-info-left'>
        <div class='about-left-image'></div>
        <div class='accent-square1'></div>
      </div>
      <div class='about-info-right'>
        <div class='about-info-right-text'>
          <h2>Our system does matching like you've never seen before:</h2>
          <p>Our developers are college students just like you, so we channeled our own experiences at IU into building a roommate matching system that tackles the many challenges with the roommate searching methods that IU students currently use. Crimson Flags is the only roommate matching software that offers a compatability quiz with a red flag, or "Crimson Flag", feature that filters out everyone who does not meet a desired criteria!</p>

          <p>Recognizing how important having a good roommate is to the entire college experience, our goal is to match you with someone whose living habits, goals, and lifestyle aligns with yours. We hope you find your future roommate with us! To learn more about Crimson Flags, check out how our services compare to some of our competitors below. </p>
          <!-- <a href="#">Learn More!</a> -->
        </div>
      </div>
    </div>
  </section>
  <section class="us">
    <div class="usWrapper">
    <h2>How we compare</h2>
    <table>
      <tr>
        <td></td>
        <td class='head'>RoomSurf</td>
        <td class='head'>IU's School App</td>
        <td class='cfTable head'>Crimson Flags</td>
      </tr>
      <tr>
        <td class='tableTitle'>Custom Matching</td>
        <td><div class='trueTable'>✔️</div></td>
        <td><div class='falseTable'>❌</div></td>
        <td><div class='trueTable'>✔️</div></td>
      </tr>
      <tr>
        <td class='tableTitle'>Red Flag Feature</td>
        <td><div class='falseTable'>❌</div></td>
        <td><div class='falseTable'>❌</div></td>
        <td><div class='trueTable'>✔️</div></td>
      </tr>
      <tr>
        <td class='tableTitle'>Available To All IU Students</td>
        <td><div class='falseTable'>❌</div></td>
        <td><div class='trueTable'>✔️</div></td>
        <td><div class='trueTable'>✔️</div></td>
      </tr>
      <tr>
        <td class='tableTitle'>Easily Sorted Information</td>
        <td><div class='falseTable'>❌</div></td>
        <td><div class='falseTable'>❌</div></td>
        <td ><div class='trueTable'>✔️</div></td>
      </tr>
      <tr>
        <td class='tableTitle'>All Features Free</td>
        <td><div class='falseTable'>❌</div></td>
        <td><div class='trueTable'>✔️</div></td>
        <td><div class='trueTable'>✔️</div></td>
      </tr>
      <tr>
        <td class='tableTitle'>User Verification</td>
        <td><div class='trueTable'>✔️</div></td>
        <td><div class='falseTable'>❌</div></td>
        <td><div class='trueTable'>✔️</div></td>
      </tr>
      <tr>
        <td class='tableTitle'>Built For All Devices</td>
        <td><div class='falseTable'>❌</div></td>
        <td><div class='falseTable'>❌</div></td>
        <td><div class='trueTable'>✔️</div></td>
      </tr>
      <tr>
        <td class='tableTitle'>All-In-One Platform</td>
        <td><div class='falseTable'>❌</div></td>
        <td><div class='falseTable'>❌</div></td>
        <td><div class='trueTable'>✔️</div></td>
      </tr>
    </table>
    </div>
      <svg class='wave' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#ffe9ef" fill-opacity="1" d="M0,96L80,101.3C160,107,320,117,480,133.3C640,149,800,171,960,176C1120,181,1280,171,1360,165.3L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
      </svg>
  </section>

  <section class='quote'>
    <div class='quote-content'>
      <div class='quote-pic'></div>
      <h3>Kara Martin</h3>
      <p>"I couldn't have asked for a better roommate, and I owe it all to Crimson Flags! I matched with my current roommate after taking the quiz, and we're best friends now. We work so well together and we've really made our apartment a home!</p>
    </div>
    <div class='pro-pic pro-pic1'></div>
    <div class='pro-pic pro-pic2'></div>
    <div class='pro-pic pro-pic3'></div>
    <div class='pro-pic pro-pic4'></div>
  </section>
</main>

  <?php 
  include("footer/index.php");
  ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
  <script src='main.js'></script>
  </body>
</html>
