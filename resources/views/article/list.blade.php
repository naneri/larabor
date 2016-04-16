@extends('_misc._layout')

@section('content')
	<div class="main-container">
		<div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
              	
              	@foreach($articles as $article)
              		<!-- First Blog Post -->
                    <h2>
                        <a href="{{route('article.show', $article->slug)}}">{{$article->title}}</a>
                    </h2>
                    <p><span class="glyphicon glyphicon-time"></span> Опубликовано {{$article->created_at->toDateString()}}</p>
                    <br>
                    <img class="img-responsive" src="{{asset($article->image)}}" alt="">
                    <br>
                    <p>{{str_limit(strip_tags($article->text), 100)}}</p>
                    <a class="btn btn-primary" href="{{route('article.show', $article->slug)}}">
                        Читать дальше <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>

                    <hr>
              	@endforeach

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="{{$articles->nextPageUrl()}}">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                

            </div>

        </div>

    </div>
	</div>
@stop