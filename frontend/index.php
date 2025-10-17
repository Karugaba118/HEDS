<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>digital.com</title>

  <!-- Assets CSS -->
  <link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/bootstrap-icons/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/aos/aos.css">
  

  <script src="../assets/angular/angular.js"></script>
  <script src="../assets/angular/angular-route.js"></script>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../css/style.css">
</head>
<body ng-app="myApp">

  <!--------- navigation menu start ------------->  
  <?php
    include '../assets/includes/navigationbar.php';
  ?>
  <!--------- navigation menu end -------->

  <div ng-view autoscroll="true"></div>

  <!---------- footer start --------------> 
  <?php
    include '../assets/includes/footer.php';
  ?>
  <!---------- footer end -------------->

  <!-- Assets JS -->
  <script>window.jQuery || document.write('<script src="../assets/j-query/jquery-slim.min.js"><\/script>')</script>
  <script src="../assets/bootstrap/bootstrap.min.js"></script>
  <script src="../assets/aos/aos.js"></script>
  <script src="../assets/purecounter/purecounter_vanilla.js"></script>
  

  <!-------- AOS initiation script ----------->
  <script>
    AOS.init({
      once: true
    });
  </script>

  <!-- Main JS -->
  <script src="../js/app.js"></script>
  <script src="../js/main.js"></script>
  
</body>
</html>
