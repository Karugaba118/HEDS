var app = angular.module("myApp", ["ngRoute"]);

app.config(function($routeProvider) {
    $routeProvider
        .when("/", {
            templateUrl: "home.php"
        })
        .when("/about.php", {
            templateUrl: "about.php"
        })
        .when("/services.php", {
            templateUrl: "services.php"
        })
        .when("/portfolio.php", {
            templateUrl: "portfolio.php"
        })
        .when("/blog.php", {
            templateUrl: "blog.php"
        })
        .when("/contact.php", {
            templateUrl: "contact.php"
        })
        .when("/web-design.php", {
            templateUrl: "web-design.php"
        })
        .when("/app-development.php", {
            templateUrl: "app-development.php"
        })
        .when("/graphics-design.php", {
            templateUrl: "graphics-design.php"
        })
        .when("/seo-ads.php", {
            templateUrl: "seo-ads.php"
        })
        .when("/roadside-banner.php", {
            templateUrl: "roadside-banner.php"
        })
        .when("/branding.php", {
            templateUrl: "branding.php"
        })
        .when("/terms.php", {
            templateUrl: "terms.php"
        })
        .when("/blog-detail.php", {
            templateUrl: "blog-detail.php"
        })
        .otherwise({
            redirectTo: "/"
        });
});

app.controller("NavController", function($scope, $location) {
    $scope.isActive = function(route) {
        return route === $location.path();
    };
});

app.controller('TermsController', ['$scope', '$location', '$anchorScroll', '$timeout', 
function($scope, $location, $anchorScroll, $timeout) {
    // Scroll to section function
    $scope.scrollTo = function(sectionId) {
        // Set the location hash
        $location.hash(sectionId);
        
        // Use $anchorScroll to navigate to the section
        $anchorScroll();
        
        // Update active class after a short delay
        $timeout(function() {
            // Remove active class from all links
            var links = document.querySelectorAll('.tc-nav-link');
            for (var i = 0; i < links.length; i++) {
                links[i].classList.remove('active');
            }
            
            // Add active class to clicked link
            var clickedLink = document.querySelector('[ng-click="scrollTo(\'' + sectionId + '\')"]');
            if (clickedLink) {
                clickedLink.classList.add('active');
            }
        }, 100);
    };
    
    // Initialize active section based on URL hash
    $scope.initSection = function() {
        var hash = $location.hash();
        if (hash) {
            $timeout(function() {
                $scope.scrollTo(hash);
            }, 500);
        }
    };
    
    // Call initialization
    $scope.initSection();
}]);