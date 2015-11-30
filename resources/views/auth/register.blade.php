@extends('misc._layout')

@section('content')
<div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2 page-content">
          <div class="inner-box category-content">
            <h2 class="title-2"> <i class="icon-user-add"></i> Create your account, Its free </h2>
            <div class="row">
              <div class="col-sm-12">
                <form class="form-horizontal">
                  <fieldset>
                    
                    <!-- Text input-->
                    <div class="form-group required">
                      <label class="col-md-4 control-label" >First Name <sup>*</sup></label>
                      <div class="col-md-6">
                        <input  name="" placeholder="First Name" class="form-control input-md" required="" type="text">
                      </div>
                    </div>
                    
                    <!-- Text input-->
                    <div class="form-group required">
                      <label class="col-md-4 control-label" >Last Name <sup>*</sup></label>
                      <div class="col-md-6">
                        <input  name="textinput" placeholder="Last Name" class="form-control input-md" type="text">
                      </div>
                    </div>
                    
                    <!-- Text input-->
                    <div class="form-group required">
                      <label class="col-md-4 control-label" >Phone Number <sup>*</sup></label>
                      <div class="col-md-6">
                        <input  name="textinput" placeholder="Phone Number" class="form-control input-md" type="text">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="">
                            <small> Hide the phone number on the published ads.</small> </label>
                        </div>
                      </div>
                    </div>
                    
                    <!-- Multiple Radios -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" >Gender</label>
                      <div class="col-md-6">
                        <div class="radio">
                          <label for="Gender-0">
                            <input name="Gender" id="Gender-0" value="1" checked="checked" type="radio">
                            Male </label>
                        </div>
                        <div class="radio">
                          <label for="Gender-1">
                            <input name="Gender" id="Gender-1" value="2" type="radio">
                            Female </label>
                        </div>
                      </div>
                    </div>
                    
                    <!-- Textarea -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textarea">About Yourself</label>
                      <div class="col-md-6">
                        <textarea class="form-control" id="textarea" name="textarea">About Yourself</textarea>
                      </div>
                    </div>
                    <div class="form-group required">
                      <label for="inputEmail3" class="col-md-4 control-label">Email <sup>*</sup></label>
                      <div class="col-md-6">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group required">
                      <label for="inputPassword3" class="col-md-4 control-label">Password </label>
                      <div class="col-md-6">
                        <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                        <p class="help-block">At least 5 characters <!--Example block-level help text here.--></p>
                      </div>
                    </div>
                    <div class="form-group">
                      <label  class="col-md-4 control-label"></label>
                      <div class="col-md-8">
                        <div class="termbox mb10">
                          <label class="checkbox-inline" for="checkboxes-1">
                            <input name="checkboxes" id="checkboxes-1" value="1" type="checkbox">
                            I have read and agree to the <a href="terms-conditions.html">Terms & Conditions</a> </label>
                        </div>
                        <div style="clear:both"></div>
                        <a class="btn btn-primary" href="account-home.html">Register</a> </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /.page-content -->
        
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.main-container -->
@stop