<?php get_header(); ?>
<div class="main">
  <section class="section section-sm">
    <div class="container container-full">
      <div id="carousel-home" class="carousel">
        <div class="carousel-items">
          <a href="#"><img src="https://www.mezz.nl/assets/uploads/2018/12/edward-cisneros-411006-unsplash-1440x534-c-top.jpg" alt=""></a>
          <a href="#"><img src="https://www.mezz.nl/assets/uploads/2018/12/edward-cisneros-411006-unsplash-1440x534-c-top.jpg" alt=""></a>
          <a href="#"><img src="https://www.mezz.nl/assets/uploads/2018/12/edward-cisneros-411006-unsplash-1440x534-c-top.jpg" alt=""></a>
        </div>
        <button class="carousel-prev js-carousel-prev"></button>
        <button class="carousel-next js-carousel-next"></button>
      </div>
    </div>
  </section>

  <section class="section section-lg u-mobile-hidden">
    <div class="container">
      <div class="row">
        <div class="col col-3 col--md-3 u-tablet-hidden">
          <div class="sidebar sidebar-overlap">
            <h3 class="sidebar-header headline">Category</h3>
            <div class="sidebar-body">
              <div class="sidebar-block">
                <a href="#" class="sidebar-lead">Tea</a>
                <ul class="sidebar-list">
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                </ul>
              </div>
              <div class="sidebar-block">
                <a href="#" class="sidebar-lead">Tea</a>
                <ul class="sidebar-list">
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                </ul>
              </div>
              <div class="sidebar-block">
                <a href="#" class="sidebar-lead">Tea</a>
                <ul class="sidebar-list">
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                  <li class="sidebar-list-item"><a href="#">Tra sua</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <?php if( have_rows('home_thumbnails') ): ?>
        <?php while( have_rows('home_thumbnails') ): the_row();
          $image = get_sub_field('image');
      	?>
        <div class="col col-3 col--md-4">
          <div class="thumbnail" style="background-image: url(<?php echo $image['url'] ?>)"></div>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <section class="section-headline">
    <div class="container">
      <h2 class="headline-lg">Features</h2>
    </div>
  </section>
  <section class="section section-lg">
    <div class="container">
      <div class="row">
        <div class="col col-3 col--md-6 col--sm-12">
          <div class="card card-primary">
            <a href="post.html" class="card-image" style="background-image: url('https://gracetea.com/media/wysiwyg/history-1000x667.jpg')"></a>
            <div class="card-body">
              <h3 class="card-headline headline"><a href="post.html">Premium Dragon Well Long Jing Green Tea</a></h3>
              <p class="card-content">Chestnut aroma, durable infusions</p>
              <p class="card-price">$ Price tag <span class="card-description">/ Net weight (OZ)</span></p>
            </div>
          </div>
        </div>
        <div class="col col-3 col--md-6 col--sm-12">
          <div class="card card-primary">
            <a href="#" class="card-image" style="background-image: url('https://gracetea.com/media/wysiwyg/history-1000x667.jpg')"></a>
            <div class="card-body">
              <h3 class="card-headline headline"><a href="#">Premium Dragon Well Long Jing Green Tea</a></h3>
              <p class="card-content">Chestnut aroma, durable infusions</p>
              <p class="card-price">$ Price tag <span class="card-description">/ Net weight (OZ)</span></p>
            </div>
          </div>
        </div>
        <div class="col col-3 col--md-6 col--sm-12">
          <div class="card card-primary">
            <a href="#" class="card-image" style="background-image: url('https://gracetea.com/media/wysiwyg/history-1000x667.jpg')"></a>
            <div class="card-body">
              <h3 class="card-headline headline"><a href="#">Premium Dragon Well Long Jing Green Tea</a></h3>
              <p class="card-content">Chestnut aroma, durable infusions</p>
              <p class="card-price">$ Price tag <span class="card-description">/ Net weight (OZ)</span></p>
            </div>
          </div>
        </div>
        <div class="col col-3 col--md-6 col--sm-12">
          <div class="card card-primary">
            <a href="#" class="card-image" style="background-image: url('https://gracetea.com/media/wysiwyg/history-1000x667.jpg')"></a>
            <div class="card-body">
              <h3 class="card-headline headline"><a href="#">Premium Dragon Well Long Jing Green Tea</a></h3>
              <p class="card-content">Chestnut aroma, durable infusions</p>
              <p class="card-price">$ Price tag <span class="card-description">/ Net weight (OZ)</span></p>
            </div>
          </div>
        </div>
        <div class="col col-3 col--md-6 col--sm-12">
          <div class="card card-primary">
            <a href="#" class="card-image" style="background-image: url('https://gracetea.com/media/wysiwyg/history-1000x667.jpg')"></a>
            <div class="card-body">
              <h3 class="card-headline headline"><a href="#">Premium Dragon Well Long Jing Green Tea</a></h3>
              <p class="card-content">Chestnut aroma, durable infusions</p>
              <p class="card-price">$ Price tag <span class="card-description">/ Net weight (OZ)</span></p>
            </div>
          </div>
        </div>
        <div class="col col-3 col--md-6 col--sm-12">
          <div class="card card-primary">
            <a href="#" class="card-image" style="background-image: url('https://gracetea.com/media/wysiwyg/history-1000x667.jpg')"></a>
            <div class="card-body">
              <h3 class="card-headline headline"><a href="#">Premium Dragon Well Long Jing Green Tea</a></h3>
              <p class="card-content">Chestnut aroma, durable infusions</p>
              <p class="card-price">$ Price tag <span class="card-description">/ Net weight (OZ)</span></p>
            </div>
          </div>
        </div>
        <div class="col col-3 col--md-6 col--sm-12">
          <div class="card card-primary">
            <a href="#" class="card-image" style="background-image: url('https://gracetea.com/media/wysiwyg/history-1000x667.jpg')"></a>
            <div class="card-body">
              <h3 class="card-headline headline"><a href="#">Premium Dragon Well Long Jing Green Tea</a></h3>
              <p class="card-content">Chestnut aroma, durable infusions</p>
              <p class="card-price">$ Price tag <span class="card-description">/ Net weight (OZ)</span></p>
            </div>
          </div>
        </div>
        <div class="col col-3 col--md-6 col--sm-12">
          <div class="card card-primary">
            <a href="#" class="card-image" style="background-image: url('https://gracetea.com/media/wysiwyg/history-1000x667.jpg')"></a>
            <div class="card-body">
              <h3 class="card-headline headline"><a href="#">Premium Dragon Well Long Jing Green Tea</a></h3>
              <p class="card-content">Chestnut aroma, durable infusions</p>
              <p class="card-price">$ Price tag <span class="card-description">/ Net weight (OZ)</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-headline">
    <div class="container">
      <h2 class="headline-lg">Visit Tea Garden</h2>
    </div>
  </section>
  <section class="section section-lg">
    <div class="container container-full">
      <div class="section-video">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/61fTb0_UvVQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  </section>
  <section class="section-headline">
    <div class="container">
      <h2 class="headline-lg">Tea Class and Education</h2>
    </div>
  </section>
  <section class="section section-xl">
    <div class="container">
      <div class="row">
        <div class="col col-3 col--md-6 col--sm-12">
          <div class="card card-secondary">
            <div class="card card-primary">
              <a href="#" class="card-image" style="background-image: url('https://www.girlfriend.com.au/media/16714/1000-cat-meme.jpg')"></a>
              <div class="card-body">
                <h3 class="card-headline headline"><a href="#">How to drink Tea</a></h3>
                <p class="card-content">Description</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col col-3 col--md-6 col--sm-12">
          <div class="card card-secondary">
            <div class="card card-primary">
              <a href="#" class="card-image" style="background-image: url('https://www.girlfriend.com.au/media/16714/1000-cat-meme.jpg')"></a>
              <div class="card-body">
                <h3 class="card-headline headline"><a href="#">How to drink Tea</a></h3>
                <p class="card-content">Description</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col col-3 col--md-6 col--sm-12">
          <div class="card card-secondary">
            <div class="card card-primary">
              <a href="#" class="card-image" style="background-image: url('https://www.girlfriend.com.au/media/16714/1000-cat-meme.jpg')"></a>
              <div class="card-body">
                <h3 class="card-headline headline"><a href="#">How to drink Tea</a></h3>
                <p class="card-content">Description</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col col-3 col--md-6 col--sm-12">
          <div class="card card-secondary">
            <div class="card card-primary">
              <a href="#" class="card-image" style="background-image: url('https://www.girlfriend.com.au/media/16714/1000-cat-meme.jpg')"></a>
              <div class="card-body">
                <h3 class="card-headline headline"><a href="#">How to drink Tea</a></h3>
                <p class="card-content">Description</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php get_footer('sup'); ?>        
</div>
<?php get_footer(); ?>