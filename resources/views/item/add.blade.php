@extends('misc._layout')

@section('content')
<div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-md-9 page-content">
          <div class="inner-box category-content">
            <h2 class="title-2 uppercase"><strong> <i class="icon-docs"></i> Post a Free Classified Ad</strong> </h2>
            <div class="row">
              <div class="col-sm-12">
                <form class="form-horizontal">
                  <fieldset>
                    <!-- Select Basic -->
                    <div class="form-group">
                      <label class="col-md-3 control-label" >Category</label>
                      <div class="col-md-8">
                        <select name="category-group" id="category-group" class="form-control">
                          <option value="0" selected="selected"> Select a category... </option>
                          <option value="Vehicles" style="background-color:#E9E9E9;font-weight:bold;" disabled="disabled"> - Vehicles - </option>
                          <option value="Cars"> Cars </option>
                          <option value="Commercial vehicles"> Commercial vehicles </option>
                          <option value="Motorcycles"> Motorcycles </option>
                          <option value="Motorcycle Equipment"> Car &amp; Motorcycle Equipment </option>
                          <option value="Boats"> Boats </option>
                          <option value="Vehicles"> Other Vehicles </option>
                          <option value="House" style="background-color:#E9E9E9;font-weight:bold;" disabled="disabled"> - House and Children - </option>
                          <option value="Appliances"> Appliances </option>
                          <option value="Inside"> Inside </option>
                          <option value="Games"> Games and Clothing </option>
                          <option value="Garden"> Garden </option>
                          <option value="Multimedia" style="background-color:#E9E9E9;font-weight:bold;" disabled="disabled"> - Multimedia - </option>
                          <option value="Telephony"> Telephony </option>
                          <option value="Image"> Image and sound </option>
                          <option value="Computers"> Computers and Accessories </option>
                          <option value="Video"> Video games and consoles </option>
                          <option value="Real" style="background-color:#E9E9E9;font-weight:bold;" disabled="disabled"> - Real Estate - </option>
                          <option value="Apartment"> Apartment </option>
                          <option value="Home"> Home </option>
                          <option value="Vacation"> Vacation Rentals </option>
                          <option value="Commercial"> Commercial offices and local </option>
                          <option value="Grounds"> Grounds </option>
                          <option value="Houseshares"> Houseshares </option>
                          <option value="Other real estate"> Other real estate </option>
                          <option value="Services" style="background-color:#E9E9E9;font-weight:bold;" disabled="disabled"> - Services - </option>
                          <option value="Jobs"> Jobs </option>
                          <option value="Job application"> Job application </option>
                          <option value="Services"> Services </option>
                          <option value="Price"> Price </option>
                          <option value="Business"> Business and goodwill </option>
                          <option value="Professional"> Professional equipment  </option>
                          <option value="dropoff" style="background-color:#E9E9E9;font-weight:bold;" disabled="disabled"> - Extra - </option>
                          <option value="Other"> Other </option>
                        </select>
                      </div>
                    </div>
                    
                    <!-- Multiple Radios (inline) -->
                    <div class="form-group">
                      <label class="col-md-3 control-label" >Add Type</label>
                      <div class="col-md-8">
                        <label class="radio-inline" for="radios-0">
                          <input name="radios" id="radios-0" value="Private" checked="checked" type="radio">
                          Private </label>
                        <label class="radio-inline" for="radios-1">
                          <input name="radios" id="radios-1" value="Business" type="radio">
                          Business </label>
                      </div>
                    </div>
                    
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="Adtitle">Ad title</label>
                      <div class="col-md-8">
                        <input id="Adtitle" name="Adtitle" placeholder="Ad title" class="form-control input-md" required="" type="text">
                        <span class="help-block">A great title needs at least 60 characters. </span> </div>
                    </div>
                    
                    <!-- Textarea -->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="textarea">Describe ad </label>
                      <div class="col-md-8">
                        <textarea class="form-control" id="textarea" name="textarea">Describe what makes your ad unique</textarea>
                      </div>
                    </div>
                    
                    <!-- Prepended text-->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="Price">Price</label>
                      <div class="col-md-4">
                        <div class="input-group"> <span class="input-group-addon">$</span>
                          <input id="Price" name="Price" class="form-control" placeholder="placeholder" required="" type="text">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox">
                            Negotiable </label>
                        </div>
                      </div>
                    </div>
                    
                    <!-- photo -->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="textarea"> Picture </label>
                      <div class="col-md-8">
                        <div class="mb10">
                          <input id="input-upload-img1" type="file" class="file" data-preview-file-type="text">
                        </div>
                        <div class="mb10">
                          <input id="input-upload-img2" type="file" class="file" data-preview-file-type="text">
                        </div>
                        <div class="mb10">
                          <input id="input-upload-img3" type="file" class="file" data-preview-file-type="text">
                        </div>
                        <div class="mb10">
                          <input id="input-upload-img4" type="file" class="file" data-preview-file-type="text">
                        </div>
                        <div class="mb10">
                          <input id="input-upload-img5" type="file" class="file" data-preview-file-type="text">
                        </div>
                        <p class="help-block">Add up to 5 photos. Use a real image of your product, not catalogs.</p>
                      </div>
                    </div>
                    <div class="content-subheading"> <i class="icon-user fa"></i> <strong>Seller information</strong> </div>
                    
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="textinput-name">Name</label>
                      <div class="col-md-8">
                        <input id="textinput-name" name="textinput-name" placeholder="Seller Name" class="form-control input-md" required="" type="text">
                      </div>
                    </div>
                    
                    <!-- Appended checkbox -->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="seller-email"> Seller Email</label>
                      <div class="col-md-8">
                        <input id="seller-email" name="seller-email" class="form-control" placeholder="Email" required="" type="text">
                      </div>
                    </div>
                    
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="seller-Number">Phone Number</label>
                      <div class="col-md-8">
                        <input id="seller-Number" name="seller-Number" placeholder="Phone Number" class="form-control input-md" required="" type="text">
                      </div>
                    </div>
                    
                    <!-- Button  -->
                    <div class="form-group">
                      <label class="col-md-3 control-label"></label>
                      <div class="col-md-8"> <a href="posting-success.html" id="button1id" class="btn btn-success btn-lg">Submit</a> </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /.page-content -->
        
        <div class="col-md-3 reg-sidebar">
          <div class="reg-sidebar-inner text-center">
            <div class="promo-text-box"> <i class=" icon-picture fa fa-4x icon-color-1"></i>
              <h3><strong>Post a Free Classified</strong></h3>
              <p> Post your free online classified ads with us. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
            </div>
            
            <div class="panel sidebar-panel">
              <div class="panel-heading uppercase"><small><strong>How to sell quickly?</strong></small></div>
              <div class="panel-content">
                <div class="panel-body text-left">
                  <ul class="list-check">
                    <li> Use a brief title and  description of the item  </li>
                    <li> Make sure you post in the correct category</li>
                    <li> Add nice photos to your ad</li>
                    <li> Put a reasonable price</li>
                    <li> Check the item before publish</li>

                  </ul>
                </div>
              </div>
            </div>
            
            
          </div>
        </div><!--/.reg-sidebar-->
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container --> 
  </div>
@stop