@extends('admin._misc._admin-layout')

@section('content')
<div class="row" id="items-app">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
            	<div  class="table-responsive">
                    <table class="table">
                        <thead>
                        	<tr>
                        		<td>Name</td>
                                <td>Published</td>
                        		<td>Function</td>
                        	</tr>
                        </thead>
                        <tbody>
                        	@foreach($articles as $article)
	                        	<tr>
	                    			<td>{{$article->title}}</td>
                                    <td>
                                        @if($article->published)
                                            yes
                                        @else
                                            no
                                        @endif
                                    </td>    
	                    			<td>
                                        <a href="{{route('admin.edit-article', $article->id)}}">Edit</a>
	                    				<a href="{{route('admin.delete-article', $article->id)}}">Delete</a>
	                    			</td>
	                        	</tr>
                        	@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop