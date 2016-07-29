@extends('_misc._layout')

@section('title')
  Поиск{{$category ? ': ' . $category->description->s_name : ' объявлений'}} на Zabor.kg
@stop

@section('meta')
<meta name="robots" content="noindex">
<meta name="title" content="Поиск{{$category ? ': ' . $category->description->s_name : ' объявлений'}} на Zabor.kg" />
<meta name="description" content="Страница поиска объявлений на Zabor.kg. {{$category ? ': ' . $category->description->s_name : ' Все объявления'}}" />
@stop



@section('content')
<div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 page-sidebar">
          <aside>
            <div class="inner-box">
              <button type="button" data-toggle="collapse" data-target="#search-filters" class="visible-xs btn btn-fb btn-block">Показать фильтры</button>
               <div class="collapse" id="search-filters">
                 @include('search._categories', compact('cat_ancestors', 'cat_children', 'searchParams'))
                   <!--/.categories-list-->

                 @include('search._form', compact('metas', 'searchParams', 'currencies'))
               </div>
              <div style="clear:both"></div>
            </div>
            <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- zabor.kg -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-2797655075626618"
                 data-ad-slot="5671692383"
                 data-ad-format="auto"></ins>
            <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
            </script>

            
            <!--/.categories-list--> 
          </aside>
        </div>
        <!--/.page-side-bar-->
        <div class="col-sm-9 page-content col-thin-left">
        
          <div class="category-list">
            <div class="tab-box "> 
              
              <!-- Nav tabs -->
              <ul class="nav nav-tabs add-tabs" role="tablist">
                <li class="active"><a href="#allAds" role="tab" data-toggle="tab">Все объявления <span class="badge">{{$items->total()}}</span></a></li>
                <li class="dropdown pull-right">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Сортировка: {{searchOrderName($searchParams)}}<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a data-toggle="tooltip" data-placement="right" title="Сортировка - вначале недавно продлённые или созданные" href="{{updatedDesc($searchParams)}}">Активные</a></li>
                    <li><a data-toggle="tooltip" data-placement="right" title="Сортировка - вначале недавно созданные" href="{{publishedDesc($searchParams)}}">Новые</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{priceOrderAsc($searchParams)}}">Подешевле</a></li>
                    <li><a href="{{priceOrderDesc($searchParams)}}">Подороже</a></li>
                  </ul>
                </li>
              </ul>
                
            </div>
            <!--/.tab-box-->
            
            <!--/.listing-filter-->
            <div class="adds-wrapper">
                @include('_partials._item', compact('items'))
            </div> <!--/.adds-wrapper-->
            
          </div>
          <div class="pagination-bar text-center">
            <ul class="pagination">
              {!! $items->render()!!}
            </ul>
          </div>
          <!--/.pagination-bar -->
          
        </div>
        <!--/.page-content--> 
        
      </div>
    </div>
  </div>


@stop  