@extends('_misc._layout')

@section('content')
	<div class="main-container">
        <div class="container">
          <ol class="breadcrumb pull-left">
            <li>
              <a href="{{url('/')}}"><i class="icon-home fa"></i></a>
            </li>
            <li>
              <a href="{{route('article.index')}}">Все публикации</a></li>
            <li class="active">
              {{str_limit($article->title, 30)}} 
            </li>
          </ol>
        </div>
		<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner inner-box ads-details-wrapper">
                        <!-- Title -->
                        <h1>{{$article->title}}</h1>

                        <!-- Date/Time -->
                        <p><span class="glyphicon glyphicon-time"></span> Опубликовано {{$article->created_at->toDateString()}}</p>

                        <hr>

                        <!-- Preview Image -->
                        <div class="center-block">
                            <img class="img-responsive" src="{{asset($article->image)}}" alt="">
                        </div>

                        <hr>

                        <!-- Post Content -->
                        <p class="lead">
                            {!! $article->text !!}
                        </p>
                        <div class="content-footer text-left"> 
                          <div class="text-right">
                             <a class="btn btn-fb" target="_blank" href="http://www.facebook.com/sharer.php?u={{urlencode(route('article.show', $article->slug))}}"> 
                              <i class="fa fa-facebook"></i> Facebook
                             </a>
                             <a class="btn btn-danger" target="_blank" href="https://plus.google.com/share?url={{route('article.show', $article->slug)}}"> 
                              <i class="fa fa-google-plus"></i> Google+
                             </a>
                             <a class="btn btn-tw" target="_blank" href="http://twitter.com/share?url={{route('article.show', $article->slug)}}"> 
                              <i class="fa fa-twitter"></i> Twitter
                             </a>
                          </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
	</div>
@stop