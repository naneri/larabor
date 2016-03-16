@extends('_misc._layout')

@section('meta')
<meta name="title" content="Zabor.KG - Доска бесплатных объявлений." />
<meta name="description" content="Главная страница сайта Zabor.kg - доска бесплатных объявлений. Куплля, продажа, аренда и предоставляение услег в Бишкеке и Кыргызстане" />
@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/fontastic/styles.css')}}">
@stop

@section('content')
  <div class="intro">
    <div class="dtable hw100">
      <div class="dtable-cell hw100">

        <div class="container text-center">
       <h1 class="intro-small-title animated fadeInDown"> Удобный поиск объявлений в Кыргызстане  </h1>
          
          
          <div class="row search-row animated fadeInUp">
            <form action="{{url('search')}}" method="GET">
              <div class="col-lg-6 col-sm-6 search-col relative locationicon">
                <i class="icon-search icon-append"></i>
                <input type="text" name="text"  class="form-control locinput input-rel searchtag-input has-icon" placeholder="Искать среди {{$item_count + 2000}} объявлений" value="">

              </div>
              <div class="col-lg-4 col-sm-4 search-col relative"> 
                <select name="category" id="" class="form-control">
                  <option value="">Выбрать категорию...</option>
                  @foreach($categories as $category)
                  <option value="{{$category->pk_i_id}}">
                    {{$category->description->s_name}}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="col-lg-2 col-sm-2 search-col">
                <button type="submit" class="btn btn-primary btn-search btn-block"><strong>Искать</strong></button>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <!-- /.intro -->
  
  <div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 page-sidebar col-thin-left">
          <aside>
            <div class="inner-box">
              <h2 class="title-2">Категории </h2>
              <div class="inner-box-content">
                <ul class="cat-list main-category-list">
                  @foreach($categories as $category)
                    <li> <i class="fontastic-{{$category->s_icon}}"></i><a href="{{url('search?category=' . $category->pk_i_id)}}"> {{$category->description->s_name}} <span style="color:grey" class="small">({{$category->stats->i_num_items}}) </span></a></li>
                  @endforeach
                </ul>
              </div>
            </div>
          </aside>
        </div>
        <div class="col-sm-9 page-content col-thin-right">
          <div class="">
            @include('_partials._item', compact('items'))
            <p class="main-ad-list">
              <a href="{{route('search')}}"><button class="btn btn-success">
                <b>Посмотреть все объявления</b>
              </button></a>
            </p>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  <!-- /.main-container -->
  
  
@stop