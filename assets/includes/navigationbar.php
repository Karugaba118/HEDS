<!--------- navigation menu start ------------->  
<header id="header" class="fixed-top header-transparent">
  <nav class="navbar navbar-expand-md navbar-dark bgcolor" id="navbar" ng-controller="NavController">
    <div class="container d-flex justify-content-between align-items-center" style="padding-left: 20px; padding-right: 20px;">

      <!-- Logo / Brand - Simple Fix -->
      <a class="navbar-brand" href="#">
        <img src="../logo/logo.png" alt="Company Logo" style="height: 4rem; width: auto; max-width: 150px;">
      </a>

      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" onclick="myFunction(this)">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
      </button>

      <!-- Nav Items -->
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">

          <li class="nav-item" ng-class="{ active: isActive('/') }">
            <a class="nav-link" href="#/!"> HOME</a>
          </li>

          <li class="nav-item" ng-class="{ active: isActive('/about.php') }">
            <a class="nav-link" href="#!about.php"> ABOUT</a>
          </li>

          <li class="nav-item dropdown" ng-class="{ active: isActive('/services.php') }">
            <a class="nav-link dropdown-toggle" href="#!services.php" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               SERVICES
            </a>
            <div class="dropdown-menu" aria-labelledby="servicesDropdown">
              <a class="dropdown-item" href="#!web-design.php">Web Design & Development</a>
              <a class="dropdown-item" href="#!app-development.php">App Development</a>
              <a class="dropdown-item" href="#!graphics-design.php">Graphics Design</a>
              <a class="dropdown-item" href="#!seo-ads.php">SEO and Ads</a>
              <a class="dropdown-item" href="#!roadside-banner.php">Roadside Banner Ads</a>
              <a class="dropdown-item" href="#!branding.php">Branding</a>
            </div>
          </li>

          <li class="nav-item" ng-class="{ active: isActive('/portfolio.php') }">
            <a class="nav-link" href="#!portfolio.php"> PORTFOLIO</a>
          </li>

          <li class="nav-item" ng-class="{ active: isActive('/blog.php') }">
            <a class="nav-link" href="#!blog.php"> BLOG</a>
          </li>

          <!-- Mobile View Contact Button -->
          <li class="nav-item d-md-none" style="width: fit-content;">
            <a href="#!contact.php" class="nav-link contact-button">Contact</a>
          </li>

        </ul>
      </div>

      <!-- Desktop View Contact Button -->
      <div class="d-none d-md-block ml-auto">
        <a href="#!contact.php" class="btn btn-outline-light">Contact</a>
      </div>

    </div>
  </nav>
</header>
<!--------- navigation menu end ------------->