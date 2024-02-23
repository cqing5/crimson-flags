<?php
  session_start();
  if ($_SESSION['sessionUserID'] == null){
    header("location: ../");  
  }else{
  include_once 'conn.php';


  // $result = mysqli_query($conn,"SELECT  * FROM map");
  // while ($row = mysqli_fetch_array($result)) {
  //   $latitudes[] = $row['lat'];
  //   $longitudes[] = $row['lon'];
  //   $name[] = $row['name'];
  //   $address[] = $row['address'];
  //   $link[] = $row['link'];
  // }

  
  $success = $_GET['success'];
  $message = "";
  if($success == 'report') {
    $message = "Thank you for submitting a report! An admin will examine your response soon.";
  }
  if($success == 'review') {
    $message = "Thank you for submitting a review! It will be very helpful for other users.";
  }
  if($success == 'makeAdmin') {
    $message = "You have successfully changed user permissions.";
  }
  if($success == 'unmatch') {
    $message = "You have successfully unmatched from this user.";
  }
  if($success == 'banned') {
    $message = "This user has been banned!";
  }
  if($success == 'unbanned') {
    $message = "This user has been unbanned!";
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../navbar/main.css" />
    <link rel="stylesheet" href="../navbar/adminNav/style.css" />
    <link rel="stylesheet" href="../footer/style.css" />
  </head>
  <body>
  <?php 
  if (isset($success)) {
    echo("<div class='errorAlert'>");
    echo($message);
    echo("</div>");
  }

  include("../navbar/index.php");
  ?>

  <main>
    <div id="map"> </div>
    <div id="informationSection">
        <h1 class='title'>How to use Crimson Flags</h1>
        <h3>Finding a roommate has never been easier!</h3>
      
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
      <div class='continuedInfo'>

      </div>
    </div>
  </main>
  
  <?php 
  include("../footer/index.php");
  ?>
  <script>
    let map;

    function initMap() {
    <?php
    $query = "SELECT * FROM map";
    $results = $conn->query($query);;
    $row_count = mysqli_num_rows($results);
    ?>

    //Centering map at wells library
      map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 39.17230635359691,  lng: -86.51657112847843},
          zoom: 15,
          mapId: 'cbf204acaefc993'
          });
      
      <?php while($row = $results -> fetch_assoc()){ ?>
        var marker = new google.maps.Marker({
          position: {lat: parseFloat(<?php echo $row['lat']; ?>), lng: parseFloat(<?php echo $row['lon']; ?>)},
          map,
          title: "<?php echo $row['name']; ?> \n <?php echo $row['address']; ?>",
        });
      <?php } ?>
       
}
    </script>
    <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVAv79XGMK0oVOfrqikkpbGc-3QHOKzDM&callback=initMap">
    </script>

  </body>
</html>

<?php }?>