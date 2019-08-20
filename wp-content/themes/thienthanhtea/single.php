<?php get_header();?>
<div class="main">
  <?php if (have_posts()) : while(have_posts()) : the_post();?>
    <section class="section section-md">
      <div class="container container-full">
        <div id="carousel-post" class="carousel">
          <div class="carousel-items">
            <img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/sansa-daenerys-game-of-thrones-finale-1558480613.jpg" alt="">
            <img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/sansa-daenerys-game-of-thrones-finale-1558480613.jpg" alt="">
            <img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/sansa-daenerys-game-of-thrones-finale-1558480613.jpg" alt="">
            <img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/sansa-daenerys-game-of-thrones-finale-1558480613.jpg" alt="">
            <img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/sansa-daenerys-game-of-thrones-finale-1558480613.jpg" alt="">
          </div>
          <div class="carousel-thumbnails">
            <div class="container">
              <div class="row">
                <div class="col col-7 col--md-7 col--sm-12">
                  <ul class="list-image">
                    <li class="list-image-item"><img src="http://www.mvaquatics.org/wp-content/uploads/2013/06/Penguin-115x115.jpeg" alt=""></li>
                    <li class="list-image-item"><img src="http://www.mvaquatics.org/wp-content/uploads/2013/06/Goldfish-115x115.jpeg" alt=""></li>
                    <li class="list-image-item"><img src="http://www.playmanija.lt/forumas/uploads/av-31500.jpg?_r=0" alt=""></li>
                    <li class="list-image-item"><img src="https://upload.wikimedia.org/wikipedia/en/e/e5/NBATV_HWC_115x115.png" alt=""></li>
                    <li class="list-image-item"><img src="http://muslimmedicine.net/wp-content/uploads/2012/09/angry-birds2-115x115.png" alt=""></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <button class="carousel-prev js-carousel-prev u-hidden"><</button>
          <button class="carousel-next js-carousel-next u-hidden">></button>
        </div>
      </div>
    </section>
    <section class="section section-lg">
      <div class="container">
        <div class="row row-reverse">
          <div class="col col-7 col--md-7 col--sm-12">
            <h3 class="headline u-mb-24">Summary</h3>
            <ul class="list-description">
              <?php if( have_rows('list_description') ): ?>
                <?php while( have_rows('list_description') ): the_row();
                  $list_description_label = get_sub_field('list_description_label');
                  $list_description_info = get_sub_field('list_description_info');
                ?>
                <li class="list-description-item">
                  <p class="list-description-label"><?php echo $list_description_label; ?></p>
                  <p class="list-description-body"><?php echo $list_description_info ?></p>
                </li>
                <?php endwhile; ?>
              <?php endif; ?>
            </ul>
          </div>
          <div class="col col-4 col-offset-1 col--md-5 col--sm-12">
            <div class="banner banner-overlap">
              <h3 class="banner-title headline-lg"><?php the_title(); ?></h3>
              <p class="banner-text"><?php echo wp_strip_all_tags(get_the_content()) ?></p>
              <?php $product_unit = get_field('product_unit');?>
              <p class="banner-price headline"><?php echo $product_unit['product_unit_price']; ?></p>
              <p class="banner-info">Net weight (<?php echo $product_unit['product_unit_weight']; ?>)</p>
              <a href="<?php echo $product_unit['product_unit_link']; ?>" class="btn btn-primary" target="_blank">Mua không</a>
            </div>
            <h3 class="headline u-mb-24 u-mt-40">Recommend Brewing Method</h3>
            <div class="content">
              <div class="content-block">
                <p class="content-title content-title-sm">Cup Method</p>
                <ul class="list-infomation">
                  <li>Teacup: 12oz / 355ml</li>
                  <li>194℉ / 90℃</li>
                  <li>2 Teaspoons / 3g Tea</li>
                  <li>Brewing time: 2 - 5 mins</li>
                </ul>
              </div>
              <div class="content-block">
                <p class="content-title content-title-sm">Chinese Gongfu Method</p>
                <ul class="list-infomation">
                  <li>Teacup: 12oz / 355ml</li>
                  <li>194℉ / 90℃</li>
                  <li>2 Teaspoons / 3g Tea</li>
                  <li>Brewing time: 2 - 5 mins</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section section-lg">
      <div class="container">
        <div class="separator"></div>
      </div>
    </section>
    <section class="section section-lg">
      <div class="container">
        <div class="row">
          <div class="col col-8 col-offset-2">
            <div class="post">
              <img class="post-image" src="https://media.giphy.com/media/964zGz0ijfBqE/giphy.gif" alt="">
              <div class="row">
                <div class="col col-10 col-offset-1">
                  <div class="content">
                    <h3 class="content-title content-title-lg">一度に2つ以上のクラスを受講希望の場合は、併行履修の欄に2つ目のクラスをご入力ください。 満席等の理由により、</h3>
                    <p class="content-text">あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波。あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波。あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら</p>
                  </div>
                </div>
              </div>
              <div class="post-thumbnail">
                <div class="row">
                  <div class="col col-6 col--md-6 col--sm-10 col--sm-offset-1">
                    <img src="https://media1.giphy.com/media/ndeeQ7hss4WWI/source.gif" alt="">
                  </div>
                  <div class="col col-6 col--md-6 col--sm-10 col--sm-offset-1">
                    <img src="https://media.giphy.com/media/vchPV7ckLrZ3W/giphy.gif" alt="">
                  </div>
                </div>
              </div>
              <p class="post-caption">サイマル・インターナショナルでは、学んだスキルを実際の通訳、翻訳の現場で実践いただく機会を提供することによって、受講生のキャリアアップを支援するを設けています。</p>
              <div class="row">
                <div class="col col-10 col-offset-1">
                  <div class="content">
                    <p class="content-text">一橋大学経済学部卒業、上智大学大学院外国語学研究科修士課程卒業。東京銀行（現・三菱UFJ銀行）で資産運用業務、ドイツ銀行で証券保管業務、ステート･ストリート信託銀行で受託資産管理業務に従事。サイマル・アカデミー受講を経て実務翻訳者に転じた後、サイマル･インターナショナルのインハウス校閲・翻訳を担当。</p>
                    <p class="content-text">併行履修の欄に2つ目のクラスをご入力ください。 満席等の理由により、ご希望のクラスにご案内できない場合もございます。 できるだけ、第2、第3希望もご入力ください。半角英数字で入力してください。 一度に2つ以上のクラスを受講希望の場合は、併行履修の欄に2つ目のクラスをご入力ください。 満席等の理由により、ご希望のクラスにご案内できない場合もございます。 できるだけ、第2、第3希望もご入力ください。半角英数字で入力してください。 一度に2つ以上のクラスを受講希望の場合は、</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php  endwhile; endif; ?>
</div>
<?php get_footer();?>
