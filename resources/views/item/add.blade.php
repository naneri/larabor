@extends('_misc._layout')


@section('content')
<div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-md-9 page-content">
          <div class="inner-box category-content">
            <h2 class="title-2 uppercase"><strong> <i class="icon-docs"></i> Подать Объявление</strong> </h2>
            @include('_partials._alerts')
            <div class="row">
              <div class="col-sm-12">
                <form 
	                enctype="multipart/form-data"
									action="{{url('item/add')}}" 
									method="POST" 
									class="form-horizontal add-item-form">
                {{ csrf_field() }}
                  <fieldset>

						<input type="hidden" name="image_key" value="{{$image_key}}">
                    <!-- Select Basic -->
            <div class="row form-group">
              <label class="col-md-3 control-label" >Категория <span class="required">*</span></label>
              <div class="col-md-8 category_list"></div>
            </div>
            <script id="entry-template" type="text/x-handlebars-template">
              <div class="outer-div" rank='@{{rank}}'>
                  <select name="category[]" rank='@{{rank}}' class="form-control category-select">
                    <option>Выберите категорию...</option>
                    @{{#each categories}} 
            <option value="@{{this.pk_i_id}}">
              @{{this.description.s_name}}
                      </option>
                    @{{/each}}
                  </select>
              </div>
            </script>

                    
                    <!-- Text input-->
                    <div class="form-group {{zbCheckError($errors->first('title'))}}">
                      <label class="col-md-3 control-label" for="title">Название <span class="required">*</span></label>
                      <div class="col-md-8">
                        <input id="Adtitle" name="title" placeholder="Ad title" class="form-control input-md" required="" type="text" value="{{old('title')}}"> 
                        @foreach ($errors->get('title') as $error)
                          <p class="checkbox help-block">
                            <small>{{$error}}</small>
                          </p>
                        @endforeach
                      </div>
                    </div>
                    
                    <!-- Textarea -->
                    <div class="form-group {{zbCheckError($errors->first('description'))}}">
                      <label class="col-md-3 control-label" for="textarea">Описание <span class="required">*</span></label>
                      <div class="col-md-8">
                        <textarea class="form-control" id="textarea" name="description" rows="7" placeholder="Describe what makes your ad unique">{{old('description')}}</textarea>
                        @foreach ($errors->get('description') as $error)
                          <p class="checkbox help-block">
                            <small>{{$error}}</small>
                          </p>
                        @endforeach
                      </div>
                    </div>
                    
                    <!-- Prepended text-->
                    <div class="form-group {{zbCheckError($errors->first('price'))}}">
                      <label class="col-md-3 control-label" for="price">Price <span class="required">*</span></label>
                      <div class="col-md-4">
                          <input id="Price" name="price" class="form-control" placeholder="placeholder" type="text" value="{{old('price')}}">
                          @foreach ($errors->get('price') as $error)
                            <p class="checkbox help-block">
                              <small>{{$error}}</small>
                            </p>
                          @endforeach
                      </div>
                      <div class="col-md-4">
                        <div data-toggle="buttons">
                          @foreach($currencies as $currency)
                            <label class="btn btn-info
                              {{$currency->pk_c_code == 'KGS' ? 'active' : ''}}">
                              <input type="radio" name="currency" id="option2" value='{{$currency->pk_c_code}}'
                              {{$currency->pk_c_code == 'KGS' ? 'checked' : ''}}>
                              {{$currency->s_description}}
                            </label>
                          @endforeach
                        </div>
                      </div>
                    </div>
                    
                    <!-- photo -->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="textarea"> Picture </label>
                      <div class="col-md-8">
                      	<div id="item_images" class="dropzone"></div>
                        <p class="help-block">Add up to 5 photos. Use a real image of your product, not catalogs.</p>
                      </div>
                    </div>
                    <div class="content-subheading"> <i class="fa fa-info-circle"></i> <strong>Дополнительная информация</strong> </div>

                    <!-- Appended checkbox -->
                    @if(!Auth::check())
                    <div class="form-group {{zbCheckError($errors->first('seller-email'))}}">
                      <label class="col-md-3 control-label" for="seller-email"> Seller Email <span class="required">*</span></label>
                      <div class="col-md-8">
                        <input id="seller-email" name="seller-email" class="form-control" placeholder="Email" required="" type="text" value="{{old('seller-email')}}">
                        @foreach ($errors->get('seller-email') as $error)
                          <p class="checkbox help-block">
                            <small>{{$error}}</small>
                          </p>
                        @endforeach
                      </div>
                    </div>
                    @endif

                    <div class="draw-meta">
                      @if(!empty($metas))
                        @include('item._meta', compact('metas'))
                      @endif
                    </div>
                    
                    <!-- Button  -->
                    <div class="form-group">
                      <label class="col-md-3 control-label"></label>
                      <div class="col-md-8"> 
                        <button type="submit" id="button1id" class="btn btn-primary btn-lg">
                          Submit
                        </button> 
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /.page-content -->
        
        <div class="col-md-3 reg-sidebar">
          <div class="reg-sidebar-inner text-center">
            <div class="promo-text-box"> <i class=" icon-picture fa fa-4x icon-color-1"></i>
              <h3><strong>Post a Free Classified</strong></h3>
              <p> Post your free online classified ads with us. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
            </div>
            
            <div class="panel sidebar-panel">
              <div class="panel-heading uppercase"><small><strong>How to sell quickly?</strong></small></div>
              <div class="panel-content">
                <div class="panel-body text-left">
                  <ul class="list-check">
                    <li> Use a brief title and  description of the item  </li>
                    <li> Make sure you post in the correct category</li>
                    <li> Add nice photos to your ad</li>
                    <li> Put a reasonable price</li>
                    <li> Check the item before publish</li>

                  </ul>
                </div>
              </div>
            </div>
            
            
          </div>
        </div><!--/.reg-sidebar-->
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container --> 
  </div>
@stop

@section('scripts')
<script type="text/javascript" src="{{asset('assets/js/handlebars.js')}}"></script>

<script>
$.ajaxSetup({
	headers: { 
		'X-CSRF-TOKEN': "{{ csrf_token() }}",
		'imageKey'		: "{{ $image_key }}"	
	}
});
$(document).ready(function(){

	Dropzone.autoDiscover = false;

	var dropzone = new Dropzone("div#item_images", { 
		url 						: "{{url('item/add-image')}}" ,
		addRemoveLinks 	: true ,
		headers					: {
				'X-CSRF-TOKEN' : "{{ csrf_token() }}",
				'imageKey'		 : "{{ $image_key }}"
		},
		acceptedFiles		: 'image/jpeg,jpg,png',
		parallelUploads : 1,
		maxFiles				: 7,
    init            : function() {
      if(window.dz_images != null){
        dz = this;
        $.each(window.dz_images, function(key, value){
          var dz_file = {
            name : value,
            size : 12345,
            server_name : value
          }
          console.log(dz_file);
          dz.emit("addedfile", dz_file);
          dz.createThumbnailFromUrl(dz_file, "{{url('uploads/temp')}}" + '/' + value);
          dz.emit("complete", dz_file);
          dz.files.push(dz_file);   
        });

        console.log(this.files);
      }
    }
	});

	dropzone.removeFile =function(file) {

		var dz = this;

    if (file.status === Dropzone.UPLOADING) {
      this.cancelUpload(file);
    }

    $.post("{{url('item/remove-image')}}", {
    	 name : file.server_name
    }).fail(function(){

    	$.notify('Проблемы при удалении изображения', 'error');

    }).done(function(){

    	dz.files = _.without(dz.files, file);

	    dz.emit("removedfile", file);

	    if (dz.files.length === 0) {
	      return dz.emit("reset");
	    }

    });

  }  

	dropzone.on('error', function(file, error, xhr){

		if( xhr != null){

			$.notify('Проблемы при загрузке', 'error');

		}else{

			$.notify('Файлы не верного формата', 'error');

		}

		this.files = _.without(this.files, file);

		this.emit("removedfile", file);

	}).on('maxfilesexceeded', function(file){

		$.notify('Максимум 7 фотографий', 'error');

	}).on('success', function(file, response){

		// adding the server_name to the file
		var id = _.findIndex(this.files, file);

		this.files[id].server_name = response.name;

		console.log(this.files);
	})

  

})	
		
</script>

<script>
  var current_category = null;

  $(document).ready(function(){
    
    // creating a template for selects
    var source    = $("#entry-template").html();
    var template  = Handlebars.compile(source);

    /**
     * creates an html template and appends it
     * 
     * @param  {[array]} all_cats    [description]
     * @param  {[int]} cat_id      [description]
     * @param  {[int]} select_rank [description]
     */
		var draw_select = function(all_cats, cat_id, select_rank){
  		var cats = _.where(all_cats, {'fk_i_parent_id' : cat_id});

      if(cats.length != 0){
        var rank = select_rank + 1;

        var html = template({
          categories : cats,
          rank     : rank
        });

        $('.category_list').append(html);

      }
  	}

  	/**
  	 * Some logic triggered by category select
  	 * 
  	 * @param  {int} 			select_rank [description]
  	 * @param  {int} 			category_id [description]
  	 * @param  {boolean} 	ajax    		[description]
  	 */
    var select_category = function(select_rank, category_id, ajax){

      // ToDo - add filling of meta on category change
      if(ajax === true){
      	$('.draw-meta').empty();
      }

      current_category = category_id;
      
      $('.outer-div').each(function(){
        if(parseInt($(this).attr('rank')) > select_rank){
          $(this.remove());
        }
      });
      
      draw_select(window.categories, category_id, select_rank)

			if(ajax === true){
				if(select_rank > 0){
					$.get(
					  "{{url('api/category-meta')}}/" + category_id 
					)
				  .done(function(data){
				    if(current_category == category_id){
				      $('.draw-meta').append(data);
				    }
					}); 
				}
			}
    }

    //if we have array with chosen categories - we render them in the template
    if(window.cat_list != null){
    	rank 				= -1;
    	parent_cat 	= null;
    	$.each(window.cat_list, function(key, cat_id){
    		draw_select(window.categories, parent_cat, rank);
    		$('.category-select').last().val(cat_id);
    		rank = rank + 1;
    		parent_cat = cat_id;
    	});
    //  else render the first select
    }else{
    	draw_select(window.categories, null, -1);
    }
    
    /**
     * event handler for category-select change
     */
    $(document.body).on('change', '.category-select',function(event){

      var select_rank = parseInt($(event.target).attr('rank'));

      var current_category = event.target.value;

      select_category(select_rank, current_category, true)
    });

    
    
  });
</script>

@stop