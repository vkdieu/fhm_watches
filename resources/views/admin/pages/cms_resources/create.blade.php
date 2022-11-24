@extends('admin.layouts.app')

@section('title')
  {{ $module_name }}
@endsection
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{ $module_name }}
      <a class="btn btn-sm btn-warning pull-right" href="{{ route(Request::segment(2) . '.create') }}"><i
          class="fa fa-plus"></i> @lang('Add')</a>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    @if (session('errorMessage'))
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('errorMessage') }}
      </div>
    @endif
    @if (session('successMessage'))
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('successMessage') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach

      </div>
    @endif

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">@lang('Create form')</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{ route(Request::segment(2) . '.store') }}" method="POST">
        @csrf
        <div class="box-body">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active">
                <a href="#tab_1" data-toggle="tab">
                  <h5>Thông tin chính <span class="text-danger">*</span></h5>
                </a>
              </li>
              <li>
                <a href="#tab_2" data-toggle="tab">
                  <h5>@lang('Gallery')</h5>
                </a>
              </li>
              <li>
                <a href="#tab_3" data-toggle="tab">
                  <h5>@lang('Related Resources')</h5>
                </a>
              </li>
              <button type="submit" class="btn btn-primary btn-sm pull-right">
                <i class="fa fa-floppy-o"></i>
                @lang('Save')
              </button>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Resource category') <small class="text-red">*</small></label>
                      <select name="taxonomy_id" id="taxonomy_id" class="form-control select2">
                        <option value="">@lang('Please select')</option>
                        @foreach ($parents as $item)
                          @if ($item->parent_id == 0 || $item->parent_id == null)
                            <option value="{{ $item->id }}" {{ old('taxonomy_id') == $item->id ? 'selected' : '' }}>
                              {{ $item->title }}</option>

                            @foreach ($parents as $sub)
                              @if ($item->id == $sub->parent_id)
                                <option value="{{ $sub->id }}"
                                  {{ old('taxonomy_id') == $sub->id ? 'selected' : '' }}>
                                  - - {{ $sub->title }}
                                </option>

                                @foreach ($parents as $sub_child)
                                  @if ($sub->id == $sub_child->parent_id)
                                    <option value="{{ $sub_child->id }}"
                                      {{ old('taxonomy_id') == $sub_child->id ? 'selected' : '' }}>
                                      - - - -
                                      {{ $sub_child->title }}
                                    </option>
                                  @endif
                                @endforeach
                              @endif
                            @endforeach
                          @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Title') <small class="text-red">*</small></label>
                      <input type="text" class="form-control" name="title" placeholder="@lang('Title')"
                        value="{{ old('title') }}" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>@lang('Status')</label>
                      <div class="form-control">
                        <label>
                          <input type="radio" name="status" value="active" checked="">
                          <small>@lang('active')</small>
                        </label>
                        <label>
                          <input type="radio" name="status" value="deactive" class="ml-15">
                          <small>@lang('deactive')</small>
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>@lang('Is featured')</label>
                      <div class="form-control">
                        <label>
                          <input type="radio" name="is_featured" value="1">
                          <small>@lang('true')</small>
                        </label>
                        <label>
                          <input type="radio" name="is_featured" value="0" class="ml-15" checked="">
                          <small>@lang('false')</small>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>@lang('Order')</label>
                      <input type="number" class="form-control" name="iorder" placeholder="@lang('Order')"
                        value="{{ old('iorder') }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Image')</label>
                      <div class="input-group">
                        <span class="input-group-btn">
                          <a data-input="image" data-preview="image-holder" class="btn btn-primary lfm"
                            data-type="cms-image">
                            <i class="fa fa-picture-o"></i> @lang('choose')
                          </a>
                        </span>
                        <input id="image" class="form-control" type="text" name="image"
                          placeholder="@lang('image_link')...">
                      </div>
                      <div id="image-holder" style="margin-top:15px;max-height:100px;">
                        @if (old('image') != '')
                          <img style="height: 5rem;" src="{{ old('image') }}">
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Image thumb')</label>
                      <div class="input-group">
                        <span class="input-group-btn">
                          <a data-input="image_thumb" data-preview="image_thumb-holder" class="btn btn-primary lfm"
                            data-type="cms-image">
                            <i class="fa fa-picture-o"></i> @lang('choose')
                          </a>
                        </span>
                        <input id="image_thumb" class="form-control" type="text" name="image_thumb"
                          placeholder="@lang('image_link')...">
                      </div>
                      <div id="image_thumb-holder" style="margin-top:15px;max-height:100px;">
                        @if (old('image_thumb') != '')
                          <img style="height: 5rem;" src="{{ old('image_thumb') }}">
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('Description')</label>
                      <textarea name="json_params[brief][vi]" class="form-control" rows="3">{{ old('json_params[brief][vi]') }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('Content')</label>
                      <textarea name="json_params[content][vi]" class="form-control" id="content_vi">{{ old('json_params[content][vi]') }}</textarea>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <hr style="border-top: dashed 2px #a94442; margin: 10px 0px;">
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('seo_title')</label>
                      <input name="json_params[seo_title]" class="form-control"
                        value="{{ old('json_params[seo_title]') }}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('seo_keyword')</label>
                      <input name="json_params[seo_keyword]" class="form-control"
                        value="{{ old('json_params[seo_keyword]') }}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('seo_description')</label>
                      <input name="json_params[seo_description]" class="form-control"
                        value="{{ old('json_params[seo_description]') }}">
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane " id="tab_2">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input class="btn btn-warning btn-sm add-gallery-image" data-toggle="tooltip"
                        title="Nhấn để chọn thêm ảnh" type="button" value="Thêm ảnh" />
                    </div>
                    <div class="row list-gallery-image">

                    </div>
                  </div>
                  <div class="col-md-12">
                    <hr style="border-top: dashed 2px #a94442; margin: 10px 0px;">
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input class="btn btn-warning btn-sm add-gallery-video" data-toggle="tooltip"
                        title="Nhấn để chọn thêm video" type="button" value="Thêm video" />
                    </div>
                    <div class="list-gallery-video">
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane " id="tab_3">
                <div class="row">
                  <div class="col-xs-6">
                    <div class="box" style="border-top: 3px solid #d2d6de;">
                      <div class="box-header">
                        <h3 class="box-title">Danh sách liên quan</h3>
                      </div><!-- /.box-header -->
                      <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th class="col-md-1">ID</th>
                              <th class="col-md-5">Tên</th>
                              <th class="col-md-2">Danh mục</th>
                              <th class="col-md-2">Đăng lúc</th>
                              <th class="col-md-2">Bỏ chọn</th>
                            </tr>
                          </thead>
                          <tbody id="post_related">
                          </tbody>
                        </table>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                  </div>
                  <div class="col-xs-6">
                    <div class="box" style="border-top: 3px solid #d2d6de;">
                      <div class="box-header">
                        <h3 class="box-title"></h3>
                        <div class="box-tools col-md-12">
                          <div class="col-md-6">
                            <select class="form-control select2" id="search_taxonomy_id" style="width:100%">
                              <option value="">- Chọn danh mục -</option>
                              @foreach ($parents as $item)
                                @if ($item->parent_id == 0 || $item->parent_id == null)
                                  <option value="{{ $item->id }}">{{ $item->title }}</option>

                                  @foreach ($parents as $sub)
                                    @if ($item->id == $sub->parent_id)
                                      <option value="{{ $sub->id }}">
                                        - -
                                        {{ $sub->title }}
                                      </option>

                                      @foreach ($parents as $sub_child)
                                        @if ($sub->id == $sub_child->parent_id)
                                          <option value="{{ $sub_child->id }}">
                                            - - - -
                                            {{ $sub_child->title }}
                                          </option>
                                        @endif
                                      @endforeach
                                    @endif
                                  @endforeach
                                @endif
                              @endforeach
                            </select>
                          </div>
                          <div class="input-group col-md-6">
                            <input type="text" id="search_title_post" class="form-control pull-right"
                              placeholder="Tiêu đề..." autocomplete="off">
                            <div class="input-group-btn">
                              <button type="button" class="btn btn-default btn_search">
                                <i class="fa fa-search"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div><!-- /.box-header -->
                      <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th class="col-md-1">ID</th>
                              <th class="col-md-5">Tên</th>
                              <th class="col-md-2">Danh mục</th>
                              <th class="col-md-2">Đăng lúc</th>
                              <th class="col-md-2">Chọn</th>
                            </tr>
                          </thead>
                          <tbody id="post_available">

                          </tbody>
                        </table>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                  </div>
                </div>

              </div>

            </div>
          </div>

        </div>

        <div class="box-footer">
          <a class="btn btn-success btn-sm" href="{{ route(Request::segment(2) . '.index') }}">
            <i class="fa fa-bars"></i> @lang('List')
          </a>
          <button type="submit" class="btn btn-primary pull-right btn-sm"><i class="fa fa-floppy-o"></i>
            @lang('Save')</button>
        </div>
      </form>
    </div>
  </section>

@endsection

@section('script')
  <script>
    CKEDITOR.replace('content_vi', ck_options);
    CKEDITOR.replace('content_en', ck_options);

    $(document).ready(function() {
      // Fill Available Blocks by template
      $(document).on('click', '.btn_search', function() {
        let keyword = $('#search_title_post').val();
        let taxonomy_id = $('#search_taxonomy_id').val();
        let _targetHTML = $('#post_available');
        _targetHTML.html('');
        let checked_post = [];
        $("input:checkbox:checked").each(function() {
          checked_post.push($(this).val());
        });

        let url = "{{ route('cms_posts.search') }}/";
        $.ajax({
          type: "GET",
          url: url,
          data: {
            keyword: keyword,
            taxonomy_id: taxonomy_id,
            other_list: checked_post,
            is_type: "{{ App\Consts::POST_TYPE['resource'] }}"
          },
          success: function(response) {
            if (response.message == 'success') {
              let list = response.data || null;
              let _item = '';
              if (list.length > 0) {
                list.forEach(item => {
                  _item += '<tr>';
                  _item += '<td>' + item.id + '</td>';
                  _item += '<td>' + item.title + '</td>';
                  _item += '<td>' + item.taxonomy_title + '</td>';
                  _item += '<td>' + formatDate(item.created_at) + '</td> ';
                  _item +=
                    '<td><input name="json_params[related_post][]" type="checkbox" value="' + item.id +
                    '" class="mr-15 related_post_item cursor" autocomplete="off"></td>';
                  _item += '</tr>';
                });
                _targetHTML.html(_item);
              }
            } else {
              _targetHTML.html('<tr><td colspan="5">' + response.message + '</td></tr>');
            }
          },
          error: function(response) {
            // Get errors
            let errors = response.responseJSON.message;
            _targetHTML.html('<tr><td colspan="5">' + errors + '</td></tr>');
          }
        });
      });

      // Checked and unchecked item event
      $(document).on('click', '.related_post_item', function() {
        let ischecked = $(this).is(':checked');
        let _root = $(this).closest('tr');
        let _targetHTML;

        if (ischecked) {
          _targetHTML = $("#post_related");
        } else {
          _targetHTML = $("#post_available");
        }
        _targetHTML.append(_root);
      });


      var no_image_link = '{{ url('themes/admin/img/no_image.jpg') }}';

      $('.add-gallery-image').click(function(event) {
        let keyRandom = new Date().getTime();
        let elementParent = $('.list-gallery-image');
        let elementAppend =
          '<div class="col-lg-2 col-md-3 col-sm-4 mb-1 gallery-image my-15">';
        elementAppend += '<img class="img-width"';
        elementAppend += 'src="' + no_image_link + '">';
        elementAppend += '<input type="text" name="json_params[gallery_image][' + keyRandom +
          ']" class="hidden" id="gallery_image_' + keyRandom +
          '">';
        elementAppend += '<div class="btn-action">';
        elementAppend += '<span class="btn btn-sm btn-success btn-upload lfm mr-5" data-input="gallery_image_' +
          keyRandom +
          '" data-type="cms-image">';
        elementAppend += '<i class="fa fa-upload"></i>';
        elementAppend += '</span>';
        elementAppend += '<span class="btn btn-sm btn-danger btn-remove">';
        elementAppend += '<i class="fa fa-trash"></i>';
        elementAppend += '</span>';
        elementAppend += '</div>';
        elementParent.append(elementAppend);

        $('.lfm').filemanager('image', {
          prefix: route_prefix
        });
      });
      // Change image for img tag gallery-image
      $('.list-gallery-image').on('change', 'input', function() {
        let _root = $(this).closest('.gallery-image');
        var img_path = $(this).val();
        _root.find('img').attr('src', img_path);
      });

      // Delete image
      $('.list-gallery-image').on('click', '.btn-remove', function() {
        // if (confirm("@lang('confirm_action')")) {
        let _root = $(this).closest('.gallery-image');
        _root.remove();
        // }
      });

      $('.list-gallery-image').on('mouseover', '.gallery-image', function(e) {
        $(this).find('.btn-action').show();
      });
      $('.list-gallery-image').on('mouseout', '.gallery-image', function(e) {
        $(this).find('.btn-action').hide();
      });

      // Xử lý video input
      $('.add-gallery-video').click(function(event) {
        let keyRandom = new Date().getTime();
        let elementParent = $('.list-gallery-video');
        let elementAppend = '';
        elementAppend += '<div class="row gallery-video border-bottom">';
        elementAppend += '<div class="col-md-6 col-xs-12 py-2 ">';
        elementAppend += '<input type="text" name="json_params[gallery_video][' + keyRandom +
          '][title]" class="form-control" id="gallery_video_title_' + keyRandom +
          '" placeholder="Tiêu đề, giới thiệu ngắn...">';
        elementAppend += '</div>';
        elementAppend += '<div class="col-md-5 col-xs-10 py-2 ">';
        elementAppend += '<div class="input-group">';
        elementAppend += '<span class="input-group-btn">';
        elementAppend += '<a data-input="gallery_video_source_' + keyRandom + '" class="btn btn-primary video">';
        elementAppend += '<i class="fa fa-file-video-o"></i> ';
        elementAppend += '@lang('choose')';
        elementAppend += '</a>';
        elementAppend += '</span>';
        elementAppend += '<input id="gallery_video_source_' + keyRandom +
          '" class="form-control" type="text" name = "json_params[gallery_video][' + keyRandom +
          '][source]" placeholder = "Link video youtube hoặc chọn file video upload..." required>';
        elementAppend += '</div>';
        elementAppend += '</div>';
        elementAppend += '<div class="col-md-1 col-xs-2 py-2 ">';
        elementAppend +=
          '<span class="btn btn-sm btn-danger btn-remove" data-toggle="tooltip" title="@lang('delete')">';
        elementAppend += '<i class="fa fa-trash"></i>';
        elementAppend += '</span>';
        elementAppend += '</div>';
        elementAppend += '</div>';
        elementParent.append(elementAppend);

        $('.video').filemanager('video', {
          prefix: route_prefix
        });
      });
      // Remove
      $('.list-gallery-video').on('click', '.btn-remove', function() {
        let _root = $(this).closest('.gallery-video');
        _root.remove();
      });

      // Xử lý audio input
      $('.add-gallery-audio').click(function(event) {
        let keyRandom = new Date().getTime();
        let elementParent = $('.list-gallery-audio');
        let elementAppend = '';
        elementAppend += '<div class="row gallery-audio border-bottom">';
        elementAppend += '<div class="col-md-6 col-xs-12 py-2 ">';
        elementAppend += '<input type="text" name="json_params[gallery_audio][' + keyRandom +
          '][title]" class="form-control" id="gallery_audio_title_' + keyRandom +
          '" placeholder="Tiêu đề, giới thiệu ngắn...">';
        elementAppend += '</div>';
        elementAppend += '<div class="col-md-5 col-xs-10 py-2 ">';
        elementAppend += '<div class="input-group">';
        elementAppend += '<span class="input-group-btn">';
        elementAppend += '<a data-input="gallery_audio_source_' + keyRandom + '" class="btn btn-primary audio">';
        elementAppend += '<i class="fa fa-file-audio-o"></i> ';
        elementAppend += '@lang('choose')';
        elementAppend += '</a>';
        elementAppend += '</span>';
        elementAppend += '<input id="gallery_audio_source_' + keyRandom +
          '" class="form-control" type="text" name = "json_params[gallery_audio][' + keyRandom +
          '][source]" placeholder = "Link audio..." required>';
        elementAppend += '</div>';
        elementAppend += '</div>';
        elementAppend += '<div class="col-md-1 col-xs-2 py-2 ">';
        elementAppend +=
          '<span class="btn btn-sm btn-danger btn-remove" data-toggle="tooltip" title="@lang('delete')">';
        elementAppend += '<i class="fa fa-trash"></i>';
        elementAppend += '</span>';
        elementAppend += '</div>';
        elementAppend += '</div>';
        elementParent.append(elementAppend);

        $('.audio').filemanager('audio', {
          prefix: route_prefix
        });
      });
      // Remove
      $('.list-gallery-audio').on('click', '.btn-remove', function() {
        let _root = $(this).closest('.gallery-audio');
        _root.remove();
      });

    });
  </script>
@endsection
