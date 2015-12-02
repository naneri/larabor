@extends('_misc._layout')
  
@section('content')
  <div class="intro">
    <div class="dtable hw100">
      <div class="dtable-cell hw100">
        <div class="container text-center">
       <h1 class="intro-title animated fadeInDown"> Find Classified Ads  </h1>
<p class="sub animateme fittext3 animated fadeIn"> Find local classified ads on bootclassified in  Minutes </p>
          
          <div class="row search-row animated fadeInUp">
              <div class="col-lg-6 col-sm-6 search-col relative locationicon">
               
                <input type="text" name="country" id="autocomplete-ajax"  class="form-control locinput input-rel searchtag-input" placeholder="City/Zipcode..." value="">

              </div>
              <div class="col-lg-4 col-sm-4 search-col relative"> 
                <select name="" id="" class="form-control"></select>
              </div>
              <div class="col-lg-2 col-sm-2 search-col">
                <button class="btn btn-primary btn-search btn-block"><i class="icon-search"></i><strong>Find</strong></button>
              </div>
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
              <h2 class="title-2">Popular Categories </h2>
              <div class="inner-box-content">
                <ul class="cat-list arrow">
                  <li> <a href="sub-category-sub-location.html"> Apparel (1,386) </a></li>
                  <li> <a href="sub-category-sub-location.html"> Art (1,163) </a></li>
                  <li> <a href="sub-category-sub-location.html"> Business Opportunities (4,974) </a></li>
                  <li> <a href="sub-category-sub-location.html"> Community and Events (1,258) </a></li>
                  <li> <a href="sub-category-sub-location.html"> Electronics and Appliances (1,578) </a></li>
                  <li> <a href="sub-category-sub-location.html"> Jobs and Employment (3,609) </a></li>
                  <li> <a href="sub-category-sub-location.html"> Motorcycles (968) </a></li>
                  <li> <a href="sub-category-sub-location.html"> Pets (1,188) </a></li>
                  <li> <a href="sub-category-sub-location.html"> Services (7,583) </a></li>
                  <li> <a href="sub-category-sub-location.html"> Vehicles (1,129) </a></li>
                </ul>
              </div>
            </div>
          </aside>
        </div>
        <div class="col-sm-9 page-content col-thin-right">
          @include('_partials._item', compact('items'))
        </div>
        
      </div>
    </div>
  </div>
  <!-- /.main-container -->
  
  
@stop