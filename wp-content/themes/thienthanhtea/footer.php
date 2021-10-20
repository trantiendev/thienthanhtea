  <footer class="footer">
    <div class="container">
      <div class="footer-global-nav">
        <div class="row">
          <div class="col col-3 col--md-4 col--sm-12">
            <p class="u-text-sm u-text-bold u-mb-16"><?php _e('Đăng ký để nhận độc quyền khuyến mãi, tin tức, từ ThienThanhTea hàng ngày', 'footerForm'); ?></p>
            <form class="form form-subcribe" method="post" action="https://thienthanhtea.com/?na=s" onsubmit="return newsletter_check(this)">
              <input type="hidden" name="nlang" value="">
              <div class="tnp-field tnp-field-email"><input class="tnp-email form-input" placeholder="<?php _e('Email của bạn ở đây...', 'footerForm'); ?>" type="email" name="ne" required></div>
              <div class="tnp-field tnp-field-button"><input class="btn btn-primary u-mt-16" type="submit" value="<?php _e('Đăng Kí', 'footerForm'); ?>" >
              </div>
            </form>
          </div>
          <div class="col col-6 col--md-8 col--sm-12">
            <nav class="footer-nav">
              <ul class="footer-link-list">
                <li class="footer-link-list-item"><?php _e('Sản Phẩm', 'footerListTitle'); ?></li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/teas/' ) ?>"><?php echo get_category_by_slug('teas')->name; ?></a></li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/teaware/' ) ?>"><?php echo get_category_by_slug('teaware')->name; ?></a></li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/gift/' ) ?>"><?php echo get_category_by_slug('gift')->name; ?></a></li>
              </ul>
              <ul class="footer-link-list">
                <li class="footer-link-list-item"><?php _e('Giới Thiệu', 'footerListTitle'); ?></li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/about-us/' ) ?>"><?php _e('Lịch sử hình thành', 'footerList'); ?></a></li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/about-us/' ) ?>"><?php _e('Hoạt động sản xuất', 'footerList'); ?></a></li>
              </ul>
              <ul class="footer-link-list">
                <li class="footer-link-list-item"><?php _e('Bài Viết', 'footerListTitle'); ?></li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/blog/' ) ?>"><?php _e('Kiến Thức', 'footerList'); ?></a></li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/blog/' ) ?>"><?php _e('Tin Tức', 'footerList'); ?></a></li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/blog/' ) ?>"><?php _e('Công Thức', 'footerList'); ?></a></li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/blog/' ) ?>"><?php _e('Tuyển Dụng', 'footerList'); ?></a></li>
              </ul>
              <ul class="footer-link-list">
                <li class="footer-link-list-item"><?php _e('Mua Hàng', 'footerListTitle'); ?></li>
                <li class="footer-link-list-item"><a href="<?php echo home_url( '/shopping-guide/' ) ?>"><?php _e('Hướng dẫn Tiki, Shoppe, Lazada', 'footerList'); ?></a></li>
              </ul>
            </nav>
          </div>
          <div class="col col-3 col--md-offset-4 col--md-8 col--sm-12">
            <ul class="footer-link-list">
              <li class="footer-link-list-item"><?php _e('Địa Chỉ 1', 'footerAddressTitle'); ?></li>
              <li class="footer-link-list-item"><?php _e('512 Trần Phú, Phường 2, Tp. Bảo Lộc, Tỉnh Lâm Đồng', 'footerAddress'); ?></li>
            </ul>
            <ul class="footer-link-list u-mt-16 u-no-ml">
              <li class="footer-link-list-item"><?php _e('Địa Chỉ 2', 'footerAddressTitle'); ?></li>
              <li class="footer-link-list-item"><?php _e('52/2 Lý Chính Thắng, Phường Võ Thị Sáu, Quận 3, Tp Hồ Chí Minh', 'footerAddress'); ?></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <p>Copyright 2011-2019 Thienthanhtea Ltd. All Rights Reserved.</p>
        <div class="footer-social">
          <a href="https://www.facebook.com/NaiVangTea"><img src="<?php bloginfo('template_directory');?>/frontend_src/public/img/ico_facebook.png" alt="ico_facebook"></a>
          <a href="#"><img src="<?php bloginfo('template_directory');?>/frontend_src/public/img/ico_twitter.png" alt="ico_twitter"></a>
          <a href="https://www.instagram.com/thienthanh.tea/"><img src="<?php bloginfo('template_directory');?>/frontend_src/public/img/ico_instagram.png" alt="ico_instagram"></a>
        </div>
      </div>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>
