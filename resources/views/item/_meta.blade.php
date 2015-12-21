@foreach($metas as $meta)
  <div class="form-group">
    <label class="col-md-3 control-label" for="seller-email">
    	{{$meta->s_name}}
		@if($meta->b_required == 1)
			<span class="required">*</span>
		@endif
    </label>
    <div class="col-md-8">
      	@if($meta->e_type == 'TEXT')	
  		<input name="meta[{{$meta->pk_i_id}}]" class="form-control" type="text">
    	@elseif($meta->e_type == 'URL')
      	<input name="meta[{{$meta->pk_i_id}}]" class="form-control" type="text">
		@elseif($meta->e_type == 'CHECKBOX')
      	<div class="checkbox">
        	<label>
          		<input name="meta[{{$meta->pk_i_id}}]" type="checkbox" value="1">
       	 	</label>
      	</div>
		@elseif($meta->e_type == 'DROPDOWN')
      	<select name="meta[{{$meta->pk_i_id}}]" class="form-control">
      		@foreach($meta->options_list as $option)
        	<option value="{{$option}}">{{$option}}</option>
        	@endforeach
      	</select>
		@elseif($meta->e_type == 'RADIO')
      	<div>
        	@foreach($meta->options_list as $option)
			<label class="radio-inline">
          		<input class="radio-inline" name="meta[{{$meta->pk_i_id}}]" id="radios-1" value="{{$option}}" type="radio"> {{$option}}
        	</label>
        	@endforeach
      	</div>
		@endif
    </div>
  </div>
@endforeach