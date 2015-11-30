@extends('misc._layout')
  
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
          <div class="item-list">
              <div class="cornerRibbons topAds">
           <a href="#"> Top Ads</a>
        </div>
                
                <div class="col-sm-2 no-padding photobox">
                  <div class="add-image"> <span class="photo-count"><i class="fa fa-camera"></i> 2 </span> <a href="ads-details.html"><img class="thumbnail no-margin" src="images/item/tp/Image00015.jpg" alt="img"></a> </div>
                </div>
                <!--/.photobox-->
                <div class="col-sm-7 add-desc-box">
                  <div class="add-details">
                    <h5 class="add-title"> <a href="ads-details.html"> 
Brand New Samsung Phones </a> </h5>
                    <span class="info-row"> <span class="add-type business-ads tooltipHere" data-toggle="tooltip" data-placement="right" title="Business Ads">B </span> <span class="date"><i class=" icon-clock"> </i> Today 1:21 pm </span> - <span class="category">Electronics </span>- <span class="item-location"><i class="fa fa-map-marker"></i> London </span> </span> </div>
                </div>
                <!--/.add-desc-box-->
                <div class="col-sm-3 text-right  price-box">
                  <h2 class="item-price"> $ 320 </h2>
                  <a class="btn btn-danger  btn-sm make-favorite"> <i class="fa fa-certificate"></i> <span>Top Ads</span> </a> <a class="btn btn-default  btn-sm make-favorite"> <i class="fa fa-heart"></i> <span>Save</span> </a> </div>
                <!--/.add-desc-box--> 
              </div>
              <!--/.item-list-->
              
              <div class="item-list">
              <div class="cornerRibbons featuredAds">
           <a href="#"> Featured Ads</a>
        </div>
                
                <div class="col-sm-2 no-padding photobox">
                  <div class="add-image"> <span class="photo-count"><i class="fa fa-camera"></i> 2 </span> <a href="ads-details.html"><img class="thumbnail no-margin" src="images/item/tp/Image00008.jpg" alt="img"></a> </div>
                </div>
                <!--/.photobox-->
                <div class="col-sm-7 add-desc-box">
                  <div class="add-details">
                    <h5 class="add-title"> <a href="ads-details.html"> 
Sony Xperia  dual sim 100% brand new  </a> </h5>
                    <span class="info-row"> <span class="add-type business-ads tooltipHere" data-toggle="tooltip" data-placement="right" title="Business Ads">B </span> <span class="date"><i class=" icon-clock"> </i> Today 1:21 pm </span> - <span class="category">Electronics </span>- <span class="item-location"><i class="fa fa-map-marker"></i> London </span> </span> </div>
                </div>
                <!--/.add-desc-box-->
                <div class="col-sm-3 text-right  price-box">
                  <h2 class="item-price"> $ 250 </h2>
                  <a class="btn btn-danger  btn-sm make-favorite"> <i class="fa fa-certificate"></i> <span>Featured Ads</span> </a> <a class="btn btn-default  btn-sm make-favorite"> <i class="fa fa-heart"></i> <span>Save</span> </a> </div>
                <!--/.add-desc-box--> 
              </div>
              
              <!--/.item-list-->
              <div class="item-list">
              <div class="cornerRibbons urgentAds">
           <a href="#"> Urgent</a>
        </div>
                <div class="col-sm-2 no-padding photobox">
                  <div class="add-image"> <span class="photo-count"><i class="fa fa-camera"></i> 2 </span> <a href="ads-details.html"><img class="thumbnail no-margin" src="images/item/tp/Image00014.jpg" alt="img"></a> </div>
                </div>
                <!--/.photobox-->
                <div class="col-sm-7 add-desc-box">
                  <div class="add-details">
                    <h5 class="add-title"> <a href="ads-details.html"> Samsung Galaxy S Dous (Brand New/ Intact Box) With 1year Warranty </a> </h5>
                    <span class="info-row"> <span class="add-type business-ads tooltipHere" data-toggle="tooltip" data-placement="right" title="Business Ads">B </span> <span class="date"><i class=" icon-clock"> </i> Today 1:21 pm </span> - <span class="category">Electronics </span>- <span class="item-location"><i class="fa fa-map-marker"></i> London </span> </span> </div>
                </div>
                <!--/.add-desc-box-->
                <div class="col-sm-3 text-right  price-box">
                  <h2 class="item-price"> $ 230</h2>
                  <a class="btn btn-danger  btn-sm make-favorite"> <i class="fa fa-certificate"></i> <span>Urgent</span> </a> <a class="btn btn-default  btn-sm make-favorite"> <i class="fa fa-heart"></i> <span>Save</span> </a> </div>
                <!--/.add-desc-box--> 
              </div>
              <!--/.item-list-->
              <div class="item-list">
                <div class="col-sm-2 no-padding photobox">
                  <div class="add-image"> <span class="photo-count"><i class="fa fa-camera"></i> 2 </span> <a href="ads-details.html"><img class="thumbnail no-margin" src="images/item/tp/Image00003.jpg" alt="img"></a> </div>
                </div>
                <!--/.photobox-->
                <div class="col-sm-7 add-desc-box">
                  <div class="add-details">
                    <h5 class="add-title"> <a href="ads-details.html"> MSI GE70 Apache Pro-061 17.3" Core i5-4200H/8GB DDR3/NV GTX860M Gaming Laptop </a> </h5>
                    <span class="info-row"> <span class="add-type business-ads tooltipHere" data-toggle="tooltip" data-placement="right" title="Business Ads">B </span> <span class="date"><i class=" icon-clock"> </i> Today 1:21 pm </span> - <span class="category">Electronics </span>- <span class="item-location"><i class="fa fa-map-marker"></i> London </span> </span> </div>
                </div>
                <!--/.add-desc-box-->
                <div class="col-sm-3 text-right  price-box">
                  <h2 class="item-price"> $ 400 </h2>
                  <a class="btn btn-default  btn-sm make-favorite"> <i class="fa fa-heart"></i> <span>Save</span> </a> </div>
                <!--/.add-desc-box--> 
              </div>
              <!--/.item-list-->
              <div class="item-list">
                <div class="col-sm-2 no-padding photobox">
                  <div class="add-image"> <span class="photo-count"><i class="fa fa-camera"></i> 2 </span> <a href="ads-details.html"><img class="thumbnail no-margin" src="images/item/tp/Image00022.jpg" alt="img"></a> </div>
                </div>
                <!--/.photobox-->
                <div class="col-sm-7 add-desc-box">
                  <div class="add-details">
                    <h5 class="add-title"> <a href="ads-details.html"> Apple iPod touch 16 GB 3rd Generation  </a> </h5>
                    <span class="info-row"> <span class="add-type business-ads tooltipHere" data-toggle="tooltip" data-placement="right" title="Business Ads">B </span> <span class="date"><i class=" icon-clock"> </i> Today 1:21 pm </span> - <span class="category">Electronics </span>- <span class="item-location"><i class="fa fa-map-marker"></i> London </span> </span> </div>
                </div>
                <!--/.add-desc-box-->
                <div class="col-sm-3 text-right  price-box">
                  <h2 class="item-price"> $ 150 </h2>
                  <a class="btn btn-default  btn-sm make-favorite"> <i class="fa fa-heart"></i> <span>Save</span> </a> </div>
                <!--/.add-desc-box--> 
              </div>
              <!--/.item-list-->
              <div class="item-list">
                <div class="col-sm-2 no-padding photobox">
                  <div class="add-image"> <span class="photo-count"><i class="fa fa-camera"></i> 2 </span> <a href="ads-details.html"><img class="thumbnail no-margin" src="images/item/FreeGreatPicture.com-46405-google-drops-price-of-nexus-4-smartphone.jpg" alt="img"></a> </div>
                </div>
                <!--/.photobox-->
                <div class="col-sm-7 add-desc-box">
                  <div class="add-details">
                    <h5 class="add-title"> <a href="ads-details.html"> Google drops Nexus 4 by $100, offers 15 day price protection refund  </a> </h5>
                    <span class="info-row"> <span class="add-type business-ads tooltipHere" data-toggle="tooltip" data-placement="right" title="Business Ads">B </span> <span class="date"><i class=" icon-clock"> </i> Today 1:21 pm </span> - <span class="category">Electronics </span>- <span class="item-location"><i class="fa fa-map-marker"></i> London </span> </span> </div>
                </div>
                <!--/.add-desc-box-->
                <div class="col-sm-3 text-right  price-box">
                  <h2 class="item-price"> $ 150 </h2>
                  <a class="btn btn-default  btn-sm make-favorite"> <i class="fa fa-heart"></i> <span>Save</span> </a> </div>
                <!--/.add-desc-box--> 
              </div>
              <!--/.item-list--> 
              
              
              <div class="item-list">
                <div class="col-sm-2 no-padding photobox">
                  <div class="add-image"> <span class="photo-count"><i class="fa fa-camera"></i> 2 </span> <a href="ads-details.html"><img class="thumbnail no-margin" src="images/item/FreeGreatPicture.com-46404-google-drops-nexus-4-by-100-offers-15-day-price-protection-refund.jpg" alt="img"></a> </div>
                </div>
                <!--/.photobox-->
                <div class="col-sm-7 add-desc-box">
                  <div class="add-details">
                    <h5 class="add-title"> <a href="ads-details.html"> Google drops Nexus 4  </a> </h5>
                    <span class="info-row"> <span class="add-type business-ads tooltipHere" data-toggle="tooltip" data-placement="right" title="Business Ads">B </span> <span class="date"><i class=" icon-clock"> </i> Today 1:21 pm </span> - <span class="category">Electronics </span>- <span class="item-location"><i class="fa fa-map-marker"></i> London </span> </span> </div>
                </div>
                <!--/.add-desc-box-->
                <div class="col-sm-3 text-right  price-box">
                  <h2 class="item-price"> $ 150 </h2>
                  <a class="btn btn-default  btn-sm make-favorite"> <i class="fa fa-heart"></i> <span>Save</span> </a> </div>
                <!--/.add-desc-box--> 
              </div>
                 <!--/.item-list--> 
          
        </div>
        
      </div>
    </div>
  </div>
  <!-- /.main-container -->
  
  
@stop