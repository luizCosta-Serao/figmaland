<?php
  // Scroll Suave
  switch (@$_GET['url']) {
    case 'product':
      echo '<target target="product" />';
      break;
    case 'pricing':
      echo '<target target="pricing" />';
      break;
    case 'about':
      echo '<target target="about" />';
      break;
  }

?>

<div class="bg-home"></div>
<section class="hero-home">
  <h1>The best products start with Figma</h1>
  <p>Most calendars are designed for teams. Slate is designed for freelancers</p>
  <a href="/">Try For Free</a>
</section>

<section id="product" class="features">
  <h2 class="features-title">Features</h2>
  <p class="features-description">Most calendars are designed for teams. Slate is designed for freelancers</p>
  <ul class="features-list">
    <?php
      // Inserir valores do banco de dados no site
      $sql = MySql::conectar()->prepare("SELECT * FROM `site_features`");
      $sql->execute();
      $features = $sql->fetchAll();
      foreach ($features as $key => $value) {
    ?>
      <li>
        <img src="<?php echo INCLUDE_PATH; ?>/assets/mdi_drawing.svg" alt="">
        <h3><?php echo $value['title']; ?></h3>
        <p><?php echo $value['description']; ?></p>
      </li>
    <?php } ?>
  </ul>
</section>

<section id="about" class="fastest-organize">
  <div class="fastest-organize-content">
    <h2>Fastest way to organize</h2>
    <p>Most calendars are designed for teams. Slate is designed for freelancers</p>
    <a href="">Try For Free</a>
  </div>
  
  <div class="fastest-organize-img">
    <img title="Macbook Pro" src="<?php echo INCLUDE_PATH; ?>/assets/macbook-pro.png" alt="Macbook Pro">
  </div>
</section>

<section class="prototyping">
  <div class="prototyping-img">
    <img src="<?php echo INCLUDE_PATH; ?>/assets/screen-content.png" alt="">
  </div>

  <div class="prototyping-content">
    <span>At your fingertips</span>
    <h2>Lightning fast prototyping</h2>
    <span>Subscribe to our Newsletter</span>
    <p>Available exclusivery on Figmaland</p>
    <form action="">
      <input type="email" placeholder="Your email" name="email">
      <input type="submit" value="Subscribe" name="acao">
    </form>
  </div>
</section>

<section class="partners">
  <h2>Partners</h2>
  <p>Most calendars are designed for teams. Slate is designed for freelancers</p>
  <div class="partners-img">
    <img title="Partners" src="<?php echo INCLUDE_PATH; ?>/assets/partners_imgs.png" alt="Partners">
  </div>
</section>

<section class="testimonials">
  <h2>Testimonials</h2>
  <img class="ibm" src="<?php echo INCLUDE_PATH; ?>/assets/logos_ibm.png" alt="">
  <p>Most calendars are designed for teams. Slate is designed for freelancers who want a sinple way to plan their schedule.</p>
  <div class="testimonial-single">
    <img class="testimonial-img" title="Testimonial" src="<?php echo INCLUDE_PATH; ?>/assets/testimonial.png" alt="Testimonial">
    <div class="testimonial-content">
      <p>Organize across</p>
      <p>Ui designer</p>
    </div>
  </div>
  <button class="more-testimonials">More Testimonials</button>
</section>

<section id="pricing" class="pricing">
  <h2>Pricing</h2>
  <p>Most calendars are designed for teams. Slate is designed for freelancers</p>
  <ul class="pricing-list">
    <li>
      <span>Free</span>
      <p>Organize across all apps by hand</p>
      <div class="pricing-per-month">
        <span>0</span>
        <div>
          <span>$</span>
          <p>Per Month</p>
        </div>
      </div>
      <p class="pricing-feature">Pricing Feature</p>
      <p class="pricing-feature">Pricing Feature</p>
      <p class="pricing-feature">Pricing Feature</p>
      <p class="pricing-feature">Pricing Feature</p>
      <p class="pricing-feature">Pricing Feature</p>
      <a class="order-now" href="">Order Now</a>
    </li>

    <li>
      <span>Standard</span>
      <p>Organize across all apps by hand</p>
      <div class="pricing-per-month">
        <span>10</span>
        <div>
          <span>$</span>
          <p>Per Month</p>
        </div>
      </div>
      <p class="pricing-feature">Pricing Feature</p>
      <p class="pricing-feature">Pricing Feature</p>
      <p class="pricing-feature">Pricing Feature</p>
      <p class="pricing-feature">Pricing Feature</p>
      <p class="pricing-feature">Pricing Feature</p>
      <a class="order-now" href="">Order Now</a>
    </li>

    <li>
      <span>Business</span>
      <p>Organize across all apps by hand</p>
      <div class="pricing-per-month">
        <span>99</span>
        <div>
          <span>$</span>
          <p>Per Month</p>
        </div>
      </div>
      <p class="pricing-feature">Pricing Feature</p>
      <p class="pricing-feature">Pricing Feature</p>
      <p class="pricing-feature">Pricing Feature</p>
      <p class="pricing-feature">Pricing Feature</p>
      <p class="pricing-feature">Pricing Feature</p>
      <a class="order-now" href="">Order Now</a>
    </li>
  </ul>
</section>
