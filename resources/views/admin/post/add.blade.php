@extends('admin._misc._admin-layout')

@section('styles')
    <link href="{{asset('admin/css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
@stop

@section('content')
    <form enctype="multipart/form-data" action="{{route('admin.post-article')}}" method="POST">
        <div class="row">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add title</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="form-group">
                                <label for="exampleInputEmail2" class="sr-only">Title</label>
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="text" name="title" placeholder="Enter title" id="article-title"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <input name="image" type="file">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Add new Article</h5>
                    </div>
                    <div class="ibox-content no-padding">
                        <textarea name="text" class="summernote"></textarea>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('scripts')
	<script src="{{asset('admin/js/plugins/summernote/summernote.min.js')}}"></script>
	<script>
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
          }
        });

        $(document).ready(function(){

            $('.summernote').summernote();
            $('.savePost').click(function(){
                $.post('/admin/article/add', {
                    "title" : $("#article-title").val(),
                    "text"  : $('.summernote').code()
                }).success(function(){
                    console.log(12);
                })
            });
       });
        /*var edit = function() {
            $('.click2edit').summernote({focus: true});
        };
        var save = function() {
            var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
            $('.click2edit').destroy();
        };*/
    </script>
@stop