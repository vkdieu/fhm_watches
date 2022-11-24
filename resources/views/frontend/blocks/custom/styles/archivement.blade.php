@if ($block)
    @php
        $title = $block->json_params->title->{$locale} ?? $block->title;
        $brief = $block->json_params->brief->{$locale} ?? $block->brief;
        $content = $block->json_params->content->{$locale} ?? $block->content;
        $image_background = $block->image_background != '' ? $block->image_background : '';
        $url_link = $block->url_link != '' ? $block->url_link : '';
        $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
        $style = isset($block->json_params->style) && $block->json_params->style == 'slider-caption-right' ? 'd-none' : '';
        
        // Filter all blocks by parent_id
        $block_childs = $blocks->filter(function ($item, $key) use ($block) {
            return $item->parent_id == $block->id;
        });
        
    @endphp
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <div class="heading-block">
            <h2 class="fw-normal ls0 nott mb-3 font-primary">

                        {{ $title }}
                    </h2>
                </div>
                <p>
                    {{ $brief }}
                </p>
            </div>
            <div class="col-md-6 offset-0 offset-md-1 mt-5 mt-md-0">
                <div class="circle-border">
                  <div class="feature-content">
                    <div
                      class="d-flex align-items-center justify-content-between h-100"
                    >
                      <div>

                                @if ($block_childs)
                                    @foreach ($block_childs as $item)
                                        @php
                                            $title_child = $item->json_params->title->{$locale} ?? $item->title;
                                            $brief_child = $item->json_params->brief->{$locale} ?? $item->brief;
                                            $content_child = $item->json_params->content->{$locale} ?? $item->content;
                                            $image_child = $item->image != '' ? $item->image : null;
                                            $url_link = $item->url_link != '' ? $item->url_link : 'javascript:void(0)';
                                            $url_link_title = $item->json_params->url_link_title->{$locale} ?? $item->url_link_title;
                                            $icon = $item->icon != '' ? $item->icon : '';
                                            $style = $item->json_params->style ?? '';
                                            $order = $item->json_params->iorder ?? $item->iorder;
                                            // dd($order);
                                        @endphp

                                        @if ($order == 1)
                                            <div class="circle-inner">
                                                <div>
                                                    <div class="counter mb-0 fw-normal font-body text-primary" ">
                                                        <span class="font-body" data-from="1"
                                                            data-to="{{ $title_child }}" data-refresh-interval="100"
                                                            data-speed="2400">{{ $title_child }}</span>{{ $brief_child }}
                                                    </div>
                                                    <h5 class="mt-1 text-muted mb-0 font-body ls0">
                                                        {{ $content_child }}
                                                    </h5>
                                                </div>
                                            </div>
                            </div>
                            <div class="d-flex h-100 flex-column justify-content-between">
                                         @elseif($order < 5 && $order > 1)
                                          <div class="circle-inner"> <div>
                                             @if ($order == 2)
                                                        <div class="counter mb-0 fw-normal font-body text-info">
                                                        @elseif($order == 3)
                                                            <div class="counter mb-0 fw-normal font-body text-danger">
                                                            @else
                                                                <div
                                                                    class="counter mb-0 fw-normal font-body text-warning">
                                        @endif
                                        <span class="font-body" data-from="1" data-to="{{ $title_child }}"
                                            data-refresh-interval="100"
                                            data-speed="2400">{{ $title_child }}</span>{{ $brief_child }}
                            </div>
                            <h5 class="mt-1 text-muted mb-0 font-body ls0">
                                {{ $content_child }}
                            </h5>
                        </div>
                    </div>
                @else
                </div>
                <div>
                    <div class="circle-inner">
                        <div>
                            <div class="counter mb-0 fw-normal font-body color">
                                <span class="font-body" data-from="1" data-to="{{ $title_child }}"
                                    data-refresh-interval="100"
                                    data-speed="2400">{{ $title_child }}</span>{{ $brief_child }}
                            </div>
                            <h5 class="mt-1 text-muted mb-0 font-body ls0">
                                {{ $content_child }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
@endif
@endforeach
@endif
@endif
