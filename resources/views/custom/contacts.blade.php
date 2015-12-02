@extends('_misc._layout')

@section('content')
	<div class="main-container">
    <div class="container">
      <div class="row clearfix">
          
          <div class="col-md-offset-2 col-md-8">
                <div class="contact-form">
                    <h5 class="list-title gray">
                    	<strong>Contact us</strong>
                    </h5>
                    <form class="form-horizontal" method="post">
	                    <fieldset>
							<div class="row">
	                            <div class="col-sm-6">
	                            <div class="form-group">
	                                <div class="col-md-12">
	                                    <input id="firstname" name="name" type="text" placeholder="First Name" class="form-control">
	                                </div>
	                            </div>
	                            </div>
	                            
	                             <div class="col-sm-6">
	                            <div class="form-group">
	                                <div class="col-md-12">
	                                    <input id="lastname" name="name" type="text" placeholder="Last  Name" class="form-control">
	                                </div>
	                            </div>
	                            </div>
	                            
	                             <div class="col-sm-6">
	                            <div class="form-group">
	                                <div class="col-md-12">
	                                    <input id="companyname" name="name" type="text" placeholder="Company Name" class="form-control">
	                                </div>
	                            </div>
	                            </div>
	                            
	                             <div class="col-sm-6">
		                            <div class="form-group">
			                            <div class="col-md-12">
			                                <input id="email" name="email" type="text" placeholder="Email Address" class="form-control">
			                            </div>
			                        </div>
	                            </div>
	                        </div>    
                            
	                         <div class="row">
	                            <div class="col-lg-12">
		                            <div class="form-group">
			                            <div class="col-md-12">
			                                <textarea class="form-control" id="message" name="message" placeholder="Enter your massage for us here. We will get back to you within 2 business days." rows="7"></textarea>
			                            </div>
			                        </div>
		                            
		                            
		                            <div class="form-group">
		                            <div class="col-md-12 ">
		                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
		                            </div>
		                        </div>
	                        </div>
	                    </fieldset>
                	</form>
               </div>
          </div>
      </div>
    </div>
  </div>
@stop