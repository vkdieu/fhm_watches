

<?php
$title = $detail->json_params->title->{$locale} ?? $detail->title;
$brief = $detail->json_params->brief->{$locale} ?? null;
$content = $detail->json_params->content->{$locale} ?? null;
$image = $detail->image != '' ? $detail->image : null;
$image_thumb = $detail->image_thumb != '' ? $detail->image_thumb : null;
$date = date('H:i d/m/Y', strtotime($detail->created_at));

// For taxonomy
$taxonomy_json_params = json_decode($detail->taxonomy_json_params);
$taxonomy_title = $taxonomy_json_params->title->{$locale} ?? $detail->taxonomy_title;
$image_background = $taxonomy_json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? null);
$taxonomy_alias = Str::slug($taxonomy_title);
$alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['service'], $taxonomy_alias, $detail->taxonomy_id);

$seo_title = $detail->json_params->seo_title ?? $title;
$seo_keyword = $detail->json_params->seo_keyword ?? null;
$seo_description = $detail->json_params->seo_description ?? $brief;
$seo_image = $image ?? ($image_thumb ?? null);

?>

<?php $__env->startPush('style'); ?>
  <style>
    #content-detail {
      text-align: justify;
    }

    #content-detail h2 {
      font-size: 30px;
    }

    #content-detail h3 {
      font-size: 24px;
    }

    #content-detail h4 {
      font-size: 18px;
    }

    #content-detail h5,
    #content-detail h6 {
      font-size: 16px;
    }

    #content-detail p {
      margin-top: 0;
      margin-bottom: 0;
    }

    #content-detail h1,
    #content-detail h2,
    #content-detail h3,
    #content-detail h4,
    #content-detail h5,
    #content-detail h6 {
      margin-top: 0;
      margin-bottom: .5rem;
    }

    #content-detail p+h2,
    #content-detail p+.h2 {
      margin-top: 1rem;
    }

    #content-detail h2+p,
    #content-detail .h2+p {
      margin-top: 1rem;
    }

    #content-detail p+h3,
    #content-detail p+.h3 {
      margin-top: 0.5rem;
    }

    #content-detail h3+p,
    #content-detail .h3+p {
      margin-top: 0.5rem;
    }

    #content-detail ul,
    #content-detail ol {
      list-style: inherit;
      padding: 0 0 0 50px;

    }

    #content-detail ul li {
      display: list-item;
      list-style: initial;
    }

    #content-detail ol li {
      display: list-item;
      list-style: decimal;
    }

    .posts-sm .entry-image {
      width: 75px;
    }

    #content-detail img {
      max-width: 100%;
      width: auto !important;
    }

    body.light #content-detail p {
      color: #000 !important;
      font-weight: 400 !important;
    }
  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
  
  <section id="page-title">

    <div class="container clearfix">
      <h1><?php echo e($title); ?></h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('frontend.home')); ?>"><?php echo app('translator')->get('Home'); ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo e($alias_category); ?>"><?php echo e($taxonomy_title ?? ''); ?></a></li>
      </ol>
    </div>

  </section>

  <section id="content">

    <div class="content-wrap">
      <div class="container clearfix">

        <div class="single-post mb-0">

          <!-- Single Post
                  ============================================= -->
          <div class="entry clearfix">


            <!-- Entry Content
                    ============================================= -->
            <div class="entry-content mt-0" id="content-detail">

              <?php echo $content ?? ''; ?>

              <!-- Post Single - Content End -->


              <div class="clear"></div>

              <!-- Post Single - Share
                      ============================================= -->
              <div class="si-share border-0 d-flex justify-content-between align-items-center">
                <span><?php echo app('translator')->get('Share this post'); ?>:</span>
                <div>
                  <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo e(Request::fullUrl()); ?>"
                    class="social-icon si-borderless si-facebook">
                    <i class="icon-facebook"></i>
                    <i class="icon-facebook"></i>
                  </a>
                  <a href="https://twitter.com/intent/tweet?url=<?php echo e(Request::fullUrl()); ?>"
                    class="social-icon si-borderless si-twitter">
                    <i class="icon-twitter"></i>
                    <i class="icon-twitter"></i>
                  </a>
                  <a href="https://www.instagram.com/cws/share?url=<?php echo e(Request::fullUrl()); ?>"
                    class="social-icon si-borderless si-instagram">
                    <i class="icon-instagram"></i>
                    <i class="icon-instagram"></i>
                  </a>
                </div>
              </div><!-- Post Single - Share End -->

            </div>
          </div><!-- .entry end -->

          <?php if(isset($relatedPosts) && count($relatedPosts) > 0): ?>
            <h4 class="title-widget text-uppercase"><?php echo app('translator')->get('Related Posts'); ?></h4>
            <div class="related-posts row posts-md col-mb-30">
              <?php $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                  $title = $item->json_params->title->{$locale} ?? $item->title;
                  $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                  $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                  $date = date('d/m/Y', strtotime($item->created_at));
                  // Viet ham xu ly lay slug
                  $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['service'], $item->taxonomy_title, $item->taxonomy_id);
                  $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['service'], $title, $item->id, 'detail');
                ?>
                <div class="entry col-12 col-md-6">
                  <div class="grid-inner row align-items-center gutter-20">
                    <div class="col-4 col-xl-5">
                      <div class="entry-image">
                        <a href="<?php echo e($alias); ?>"><img src="<?php echo e($image); ?>" alt="Blog Single"></a>
                      </div>
                    </div>
                    <div class="col-8 col-xl-7">
                      <div class="entry-title title-xs nott">
                        <h3><a href="<?php echo e($alias); ?>"><?php echo e(Str::limit($title, 70)); ?></a></h3>
                      </div>
                      <div class="entry-content d-none d-xl-block">
                        <?php echo e(Str::limit($brief, 100)); ?>

                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php endif; ?>

        </div>

      </div>
    </div>
  </section>

  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\project\phanlong\resources\views/frontend/pages/service/detail.blade.php ENDPATH**/ ?>