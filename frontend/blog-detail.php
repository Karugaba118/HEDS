<!-- starter banner/ breadcrumb start -->
<div class="breadcrumb-header" style="  background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7) ), url('../img/blog-detail/detail.png'); background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 content">
                <h2 data-aos="slide-down" data-aos-duration="2000"><span style="color: #ff9900">Blog-Detail</span></h2>
                <h5 class="text-center breadcrumb-intro" data-aos="slide-up" data-aos-duration="1000">Read more</h5>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="index.php">Home</a></li>
                    <li>Blog-Detail</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- starter banner/ breadcrumb end -->

<!-- blog detail section start -->
<section class="blog-detail-page" ng-controller="BlogDetailController">
  <div class="bd-container">
    <!-- Back navigation -->
    <div class="bd-back-nav">
      <a href="#!blog.php" class="bd-back-link">
        <i class="bi bi-arrow-left"></i> Back to Blog
      </a>
    </div>

    <!-- Article header -->
    <article class="bd-article">
      <header class="bd-article-header">
        <div class="bd-article-meta">
          <span class="bd-category">{{blogData.category}}</span>
          <span class="bd-date"><i class="bi bi-calendar"></i> {{blogData.date}}</span>
          <span class="bd-read-time"><i class="bi bi-clock"></i> {{blogData.readTime}}</span>
        </div>
        <h1 class="bd-article-title">{{blogData.title}}</h1>
        <div class="bd-author">
          <img src="{{blogData.authorImg}}" alt="Author" class="bd-author-img">
          <div class="bd-author-info">
            <span class="bd-author-name">{{blogData.author}}</span>
            <span class="bd-author-role">{{blogData.authorRole}}</span>
          </div>
        </div>
      </header>

      <!-- Featured image -->
      <div class="bd-featured-image">
        <img src="{{blogData.featuredImage}}" alt="{{blogData.title}}" class="bd-img-fluid">
      </div>

      <!-- Article content -->
      <div class="bd-article-content">
        <div ng-bind-html="blogData.fullContent"></div>
      </div>

      <!-- Article footer -->
      <footer class="bd-article-footer">
        <div class="bd-tags">
          <span>Tags:</span>
          <a href="#" class="bd-tag" ng-repeat="tag in blogData.tags">{{tag}}</a>
        </div>
        
        <div class="bd-actions">
          <button class="bd-action-btn bd-like-btn" ng-click="toggleLike()" ng-class="{'liked': blogData.userLiked}">
            <i class="bi bi-heart" ng-class="{'bi-heart-fill': blogData.userLiked, 'bi-heart': !blogData.userLiked}"></i>
            <span>{{blogData.likes}}</span>
          </button>
          <div class="bd-social-share">
            <span>Share:</span>
            <a href="#" class="bd-social-icon"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="bd-social-icon"><i class="bi bi-linkedin"></i></a>
            <a href="#" class="bd-social-icon"><i class="bi bi-facebook"></i></a>
          </div>
        </div>
      </footer>
    </article>

    <!-- Author bio -->
    <div class="bd-author-bio">
      <img src="{{blogData.authorImg}}" alt="Author" class="bd-author-img">
      <div>
        <h3>About the Author</h3>
        <p>{{blogData.author}} is {{blogData.authorRole}} with extensive experience in their field. They specialize in {{blogData.category}} and regularly contribute to industry publications.</p>
      </div>
    </div>

    <!-- Related posts -->
    <div class="bd-related-posts">
      <h3>Read next</h3>
      <div class="bd-related-grid">
        <div class="bd-related-post" ng-repeat="post in relatedPosts">
          <img src="{{post.featuredImage}}" alt="Related post">
          <div>
            <span class="bd-category">{{post.category}}</span>
            <h4>{{post.title}}</h4>
            <a href="#!blog-detail.php/{{post.id}}" class="bd-read-more">Read more</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- blog detail section end -->