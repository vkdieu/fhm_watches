<?php if($block): ?>
  <?php
    $title = $block->json_params->title->{$locale} ?? $block->title;
    $brief = $block->json_params->brief->{$locale} ?? $block->brief;
    $content = $block->json_params->content->{$locale} ?? $block->content;
    $image = $block->image != '' ? $block->image : null;
    $background = $block->image_background != '' ? $block->image_background : null;
    $url_link = $block->url_link != '' ? $block->url_link : '';
    $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
    
  ?>
   
  <div id="form" class="section bg-transparent my-0 py-0" method="post" action="<?php echo e(route('frontend.contact.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-sm-12 g-0">
          <img
            src="<?php echo e($image); ?>"
            alt=""
          />
        </div>
        <div
          class="col-lg-6 col-sm-12 g-0 d-flex flex-column justify-content-center align-items-center findout-image"
        >
          <div
            class="border-bottom-0 mb-0 p-4 d-flex flex-column"
            style="max-width: 550px"
          >
            <h1 class="fw-normal font-secondary fst-normal mb-5">
              <?php echo e($title); ?>

            </h1>
            <input
              type="text"
              placeholder="Your email..."
              class="mb-3"
            />

            <a
              href="<?php echo e($url_link); ?>"
              class="button button-large button-light text-dark bg-transparent border nott m-0 ls0 text-center mt-3"
              style="max-width: 200px"
              > <?php echo e($url_link_title); ?></a
            >
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\FHM_Watches\resources\views/frontend/blocks/form/styles/booking.blade.php ENDPATH**/ ?>