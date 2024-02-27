<?php
get_header();
?>

<main id="main-content">
<div class="mobile-padding-top">
<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
?>
  <section class="gws-cart padding-bottom-large padding-top-mid">
    <div id="cart-holder" class="container">
      <div id="cart-items" class="gws-cart-items">
        <div class="gws-cart-item margin-bottom-basic">
          <div class="grid-row">
            <div class="grid-row grid-item item-s-4 item-m-2">
              <div class="gws-cart-thumb"></div>
            </div>
            <div class="grid-row item-s-8 item-m-10">
              <div class="grid-row item-s-12 item-m-6 margin-bottom-small align-content-start">
                <div class="grid-item item-s-12 margin-bottom-small">
                  <span class="gws-cart-title"></span>
                </div>
                <div class="grid-row item-s-12 align-content-start">
                  <div class="grid-item item-s-6 item-m-3">
                    <span class="font-cond">Qty</span>
                  </div>
                  <div class="grid-item item-s-6 item-m-3">
                    <input type="number" min="1" max="100" class="gws-cart-quantity" />
                  </div>
                </div>
              </div>
              <div class="item-s-12 item-m-3 grid-row align-content-start">
                <div class="mobile-only grid-item item-s-6 item-m-12 margin-bottom-small">
                  <span class="font-cond">Price</span>
                </div>
                <div class="grid-item item-s-6 item-m-12">
                  <span>$<span class="gws-cart-item-subtotal"></span></span>
                </div>
              </div>
              <div class="item-s-12 item-m-3 grid-row align-content-start">
                <div class="mobile-only grid-item item-s-6 item-m-12 margin-bottom-small">
                  <span class="font-cond">Remove</span>
                </div>
                <div class="grid-item item-s-6 item-m-12">
                  <img class="remove-item u-pointer gws-cart-remove" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/close.png" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="grid-row margin-bottom-small">
          <div class="grid-item item-s-4 item-m-2 offset-m-5">
            <span class="font-cond">Shipping</span>
          </div>
          <div class="grid-item">
            <span>Calculated at checkout</span>
          </div>
        </div>
        <div class="grid-row margin-bottom-small">
          <div class="grid-item item-s-4 item-m-2 offset-m-5">
            <span class="font-cond">Subtotal</span>
          </div>
          <div class="grid-item">
            <span>$</span><span id="gws-cart-subtotal"></span>
          </div>
        </div>
        <div class="grid-row">
          <div class="grid-item item-s-12 offset-m-7 item-l-3">
            <a href="" class="gws-checkout-link shop-button">Proceed to Checkout</a>
          </div>
        </div>
      </div>
    </div>
    <div id="cart-empty" class="container">
      <div class="grid-row justify-center">
        <div class="grid-item">
          <span>Your cart is empty!</span>
        </div>
      </div>
    </div>
  </section>
<?php
  }
}
?>
</div>
</main>

<?php
get_footer();
?>
