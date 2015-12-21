@extends('_misc._layout')

@section('content')

<div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 page-sidebar">
          <aside>
            <div class="inner-box">
              @include('search._categories', compact('cat_ancestors', 'cat_children'))
              <!--/.categories-list-->
              
              @include('search._form', compact('metas', 'searchParams', 'currencies'))    
              <div style="clear:both"></div>
            </div>
            
            <!--/.categories-list--> 
          </aside>
        </div>
        <!--/.page-side-bar-->
        <div class="col-sm-9 page-content col-thin-left">
        
          <div class="category-list">
            <div class="tab-box "> 
              
              <!-- Nav tabs -->
              <ul class="nav nav-tabs add-tabs" role="tablist">
                <li class="active"><a href="#allAds" role="tab" data-toggle="tab">All Ads <span class="badge">{{$items->total()}}</span></a></li>
                <li class="dropdown pull-right">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Сортировка: {{searchOrderName($searchParams)}}<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{publishedAsc($searchParams)}}">Новые</a></li>
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