@extends('_misc._layout')

@section('content')
<div class="main-container">
    <div class="container">
      <div class="row">
        @include('profile._sidebar', ['page' => 'ads'])
        <!--/.page-sidebar-->
        
        <div class="col-sm-9 page-content">
          <div class="inner-box">
            <h2 class="title-2"><i class="icon-docs"></i> My Ads </h2>
            <div class="table-responsive">
              @include('profile._item-table', compact('items'))
            </div>
            <!--/.row-box End--> 
            <div class="pagination-bar text-center">
              <ul class="pagination">
                {!! $items->render()!!}
              </ul>
            </div>
          </div>
        </div>
        <!--/.page-content--> 
      </div>
      <!--/.row--> 
    </div>
    <!--/.container--> 
  </div>
@stop