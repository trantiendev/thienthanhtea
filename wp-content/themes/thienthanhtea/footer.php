  <footer class="footer">
    <div class="container">
      <div class="footer-global-nav">
        <div class="row">
          <div class="col col-3 col--md-4 col--sm-12">
            <p class="u-text-sm u-text-bold u-mb-16">Subcribe to get exclusive<br> promotions, news, from<br> Thienthanhtea</p>
            <form class="form form-subcribe" method="post" action="https://thienthanhtea.com/?na=s" onsubmit="return newsletter_check(this)">
              <input type="hidden" name="nlang" value="">
              <div class="tnp-field tnp-field-email"><input class="tnp-email form-input" placeholder="Your email goes here" type="email" name="ne" required></div>
              <div class="tnp-field tnp-field-button"><input class="btn btn-primary u-mt-16" type="submit" value="Subscribe" >
              </div>
            </form>
          </div>
          <div class="col col-6 col--md-8 col--sm-12">
            <nav class="footer-nav">
              <ul class="footer-link-list">
                <li class="footer-link-list-item">Sản Phẩm</li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/teas/' ) ?>">Trà</a></li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/teaware/' ) ?>">Trà Cụ</a></li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/gift/' ) ?>">Quà Tặng</a></li>
              </ul>
              <ul class="footer-link-list">
                <li class="footer-link-list-item">Giới Thiệu</li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/about-us/' ) ?>">Lịch sử hoạt động</a></li>
              </ul>
              <ul class="footer-link-list">
                <li class="footer-link-list-item">Bài Viết</li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/news/' ) ?>">Kiến Thức</a></li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/news/' ) ?>">Tin Tức</a></li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/news/' ) ?>">Công Thức</a></li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/news/' ) ?>">Tuyển Dụng</a></li>
              </ul>
              <ul class="footer-link-list">
                <li class="footer-link-list-item">Mua Hàng</li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/shopping-guide/' ) ?>">Hướng dẫn Tiki, Shoppe, Lazada</a></li>
              </ul>
            </nav>
          </div>
          <div class="col col-3 col--md-offset-4 col--md-8 col--sm-12">
            <ul class="footer-link-list">
              <li class="footer-link-list-item">Address 1</li>
              <li class="footer-link-list-item">512 Trần Phú, Phường 2, Tp. Bảo Lộc, Tỉnh Lâm Đồng</li>
            </ul>
            <ul class="footer-link-list u-mt-16 u-no-ml">
              <li class="footer-link-list-item">Address 2</li>
              <li class="footer-link-list-item">52/2 Lý Chính Thắng, Phường 8, Quận 3, TP HCM</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <p>Copyright 2011-2019 Thienthanhtea Ltd. All Rights Reserved.</p>
        <div class="footer-social">
          <a href="#"><img src="<?php bloginfo('template_directory');?>/frontend_src/public/img/ico_facebook.png" alt="ico_facebook"></a>
          <a href="#"><img src="<?php bloginfo('template_directory');?>/frontend_src/public/img/ico_twitter.png" alt="ico_twitter"></a>
          <a href="#"><img src="<?php bloginfo('template_directory');?>/frontend_src/public/img/ico_instagram.png" alt="ico_instagram"></a>
        </div>
      </div>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>
