<div class="sidebar col-lg-3">
  <div class="sidebar-widgets-wrap">
    @php
      $params_taxonomy['status'] = App\Consts::TAXONOMY_STATUS['active'];
      $params_taxonomy['taxonomy'] = App\Consts::TAXONOMY['product'];
      
      $taxonomys = App\Http\Services\ContentService::getCmsTaxonomy($params_taxonomy)->get();
    @endphp
    @isset($taxonomys)
      <div class="widget widget_links clearfix">

        <h4>@lang('Product category')</h4>
        <ul>
          @foreach ($taxonomys as $item)
            @if ($item->parent_id == 0 || $item->parent_id == null)
              @php
                $title = $item->json_params->title->{$locale} ?? $item->title;
                $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $title, $item->id);
                
                $url_current = url()->full();
                $current = $alias_category == $url_current ? 'current-nav-item' : '';
              @endphp
              <li class="{{ $current }}">
                <a href="{{ $alias_category }}" title="{{ $title }}">
                  {{ Str::limit($title, 100) }}
                </a>
              </li>
              @foreach ($taxonomys as $sub)
                @if ($sub->parent_id == $item->id)
                  @php
                    $title_sub = $sub->json_params->title->{$locale} ?? $sub->title;
                    $alias_category_sub = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $title_sub, $sub->id);
                    
                    $current = $alias_category_sub == $url_current ? 'current-nav-item' : '';
                  @endphp
                  <li class="{{ $current }}">
                    <a href="{{ $alias_category_sub }}" title="{{ $title_sub }}" class="ps-3">
                      {{ Str::limit($title_sub, 100) }}
                    </a>
                  </li>
                @endif
              @endforeach
            @endif
          @endforeach
        </ul>
      </div>

    @endisset

    @php
      $params_product['status'] = App\Consts::POST_STATUS['active'];
      $params_product['is_type'] = App\Consts::POST_TYPE['product'];
      $params_product['order_by'] = 'id';
      
      $recents = App\Http\Services\ContentService::getCmsPost($params_product)
          ->limit(App\Consts::DEFAULT_SIDEBAR_LIMIT)
          ->get();
    @endphp
    @isset($recents)
      <div class="widget clearfix">

        <h4>@lang('Latest products')</h4>
        <div class="posts-sm row col-mb-30" id="recent-shop-list-sidebar">

          @foreach ($recents as $item)
            @php
              $title = $item->json_params->title->{$locale} ?? $item->title;
              $brief = $item->json_params->brief->{$locale} ?? $item->brief;
              $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
              $date = date('H:i d/m/Y', strtotime($item->created_at));
              // Viet ham xu ly lay slug
              $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $item->taxonomy_title, $item->taxonomy_id);
              $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $title, $item->id, 'detail');
            @endphp
            <div class="entry col-12">
              <div class="grid-inner row g-0">
                <div class="col-auto">
                  <div class="entry-image">
                    <a href="{{ $alias }}"><img src="{{ $image }}" alt="{{ Str::limit($title, 500) }}"></a>
                  </div>
                </div>
                <div class="col ps-3">
                  <div class="entry-title">
                    <h4><a href="{{ $alias }}">{{ Str::limit($title, 50) }}</a></h4>
                  </div>
                  <div class="entry-meta no-separator">
                    <ul>
                      <li class="color">
                        {{ isset($item->json_params->price) && $item->json_params->price > 0 ? number_format($item->json_params->price, 0, ',', '.') . ' đ' : __('Contact') }}

                      </li>
                      <li class="product-rating d-none">
                        <i class="icon-star3"></i>
                        <i class="icon-star3"></i>
                        <i class="icon-star3"></i>
                        <i class="icon-star3"></i>
                        <i class="icon-star3"></i>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

    @endisset

    @php
      $params_product['status'] = App\Consts::POST_STATUS['active'];
      $params_product['is_type'] = App\Consts::POST_TYPE['product'];
      $params_product['order_by'] = 'count_visited';
      
      $mostViews = App\Http\Services\ContentService::getCmsPost($params_product)
          ->limit(App\Consts::DEFAULT_SIDEBAR_LIMIT)
          ->get();
    @endphp
    @isset($mostViews)
      <div class="widget clearfix">

        <h4>@lang('Most viewed products')</h4>
        <div class="posts-sm row col-mb-30" id="recent-shop-list-sidebar">

          @foreach ($mostViews as $item)
            @php
              $title = $item->json_params->title->{$locale} ?? $item->title;
              $brief = $item->json_params->brief->{$locale} ?? $item->brief;
              $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
              $date = date('H:i d/m/Y', strtotime($item->created_at));
              // Viet ham xu ly lay slug
              $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $item->taxonomy_title, $item->taxonomy_id);
              $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $title, $item->id, 'detail');
            @endphp
            <div class="entry col-12">
              <div class="grid-inner row g-0">
                <div class="col-auto">
                  <div class="entry-image">
                    <a href="{{ $alias }}"><img src="{{ $image }}"
                        alt="{{ Str::limit($title, 500) }}"></a>
                  </div>
                </div>
                <div class="col ps-3">
                  <div class="entry-title">
                    <h4><a href="{{ $alias }}">{{ Str::limit($title, 50) }}</a></h4>
                  </div>
                  <div class="entry-meta no-separator">
                    <ul>
                      <li class="color">
                        {{ isset($item->json_params->price) && $item->json_params->price > 0 ? number_format($item->json_params->price, 0, ',', '.') . ' đ' : __('Contact') }}

                      </li>
                      <li class="product-rating d-none">
                        <i class="icon-star3"></i>
                        <i class="icon-star3"></i>
                        <i class="icon-star3"></i>
                        <i class="icon-star3"></i>
                        <i class="icon-star3"></i>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

    @endisset

  </div>
</div>
