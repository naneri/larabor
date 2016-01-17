@extends('_misc._layout')

@section('content')
<div class="main-container">
    <div class="container">
      <div class="row">
        @include('profile._sidebar')
        <!--/.page-sidebar-->
        
        <div class="col-sm-9 page-content">
          <div class="inner-box">
            <h2 class="title-2"><i class="icon-docs"></i> My Ads </h2>
            <div class="table-responsive">
              <div class="table-action">
                <label for="checkAll">
                  <input type="checkbox" onclick="checkAll(this)" id="checkAll">
                  Select: All | <a href="#" class="btn btn-xs btn-danger">Delete <i class="glyphicon glyphicon-remove "></i></a> </label>
                <div class="table-search pull-right col-xs-7">
                  <div class="form-group">
                    <label  class="col-xs-5 control-label text-right">Search <br>
                      <a title="clear filter" class="clear-filter" href="#clear">[clear]</a> </label>
                    <div class="col-xs-7 searchpan">
                      <input type="text" class="form-control" id="filter">
                    </div>
                  </div>
                </div>
              </div>
              <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                  <tr>
                    <th data-type="numeric" data-sort-initial="true"> </th>
                    <th> Photo </th>
                    <th data-sort-ignore="true"> Adds Details </th>
                    <th data-type="numeric" > Price </th>
                    <th> Option </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="width:2%" class="add-img-selector"><div class="checkbox">
                        <label>
                          <input type="checkbox">
                        </label>
                      </div></td>
                    <td style="width:14%" class="add-img-td"><a href="ads-details.html"><img  class="thumbnail  img-responsive" src="images/item/FreeGreatPicture.com-46407-nexus-4-starts-at-199.jpg" alt="img"></a></td>
                    <td style="width:58%" class="ads-details-td"><div>
                        <p><strong> <a href="ads-details.html" title="Brend New Nexus 4">Brend New Nexus 4</a> </strong></p>
                        <p> <strong> Posted On </strong>:
                          02-Oct-2014, 04:38 PM </p>
                        <p> <strong>Visitors </strong>: 221 <strong>Located In:</strong> New York </p>
                      </div></td>
                    <td style="width:16%" class="price-td"><div><strong> $199</strong></div></td>
                    <td style="width:10%" class="action-td"><div>
                        <p><a class="btn btn-primary btn-xs"> <i class="fa fa-edit"></i> Edit </a></p>
                        <p> <a class="btn btn-info btn-xs"> <i class="fa fa-mail-forward"></i> Share </a></p>
                        <p> <a class="btn btn-danger btn-xs"> <i class=" fa fa-trash"></i> Delete </a></p>
                      </div></td>
                  </tr>
                  <tr>
                    <td style="width:2%" class="add-img-selector"><div class="checkbox">
                        <label>
                          <input type="checkbox">
                        </label>
                      </div></td>
                    <td style="width:14%" class="add-img-td"><a href="ads-details.html"><img  class="thumbnail  img-responsive" src="images/item/tp/Image00020.jpg" alt="img"></a></td>
                    <td style="width:58%" class="ads-details-td"><div>
                        <p><strong> <a href="ads-details.html" title="I pod 16 gb">I pod 16 gb </a> </strong></p>
                        <p> <strong> Posted On </strong>:
                          02-Oct-2014, 04:38 PM </p>
                        <p> <strong>Visitors </strong>: 680 <strong>Located In:</strong> New York </p>
                      </div></td>
                    <td style="width:16%" class="price-td"><div><strong> $90</strong></div></td>
                    <td style="width:10%" class="action-td"><div>
                        <p><a class="btn btn-primary btn-xs"> <i class="fa fa-edit"></i> Edit </a></p>
                        <p> <a class="btn btn-info btn-xs"> <i class="fa fa-mail-forward"></i> Share </a></p>
                        <p> <a class="btn btn-danger btn-xs"> <i class=" fa fa-trash"></i> Delete </a></p>
                      </div></td>
                  </tr>
                  <tr>
                    <td style="width:2%" class="add-img-selector"><div class="checkbox">
                        <label>
                          <input type="checkbox">
                        </label>
                      </div></td>
                    <td style="width:14%" class="add-img-td"><a href="ads-details.html"><img  class="thumbnail  img-responsive" src="images/item/tp/Image00014.jpg" alt="img"></a></td>
                    <td style="width:58%" class="ads-details-td"><div>
                        <p><strong> <a href="ads-details.html" title="SAMSUNG GALAXY S CORE Duos ">SAMSUNG GALAXY S CORE Duos </a> </strong></p>
                        <p> <strong> Posted On </strong>:
                          02-Oct-2014, 04:38 PM </p>
                        <p> <strong>Visitors </strong>: 221 <strong>Located In:</strong> New York </p>
                      </div></td>
                    <td style="width:16%" class="price-td"><div><strong> $150</strong></div></td>
                    <td style="width:10%" class="action-td"><div>
                        <p><a class="btn btn-primary btn-xs"> <i class="fa fa-edit"></i> Edit </a></p>
                        <p> <a class="btn btn-info btn-xs"> <i class="fa fa-mail-forward"></i> Share </a></p>
                        <p> <a class="btn btn-danger btn-xs"> <i class=" fa fa-trash"></i> Delete </a></p>
                      </div></td>
                  </tr>
                  <tr>
                    <td style="width:2%" class="add-img-selector"><div class="checkbox">
                        <label>
                          <input type="checkbox">
                        </label>
                      </div></td>
                    <td style="width:14%" class="add-img-td"><a href="ads-details.html"><img  class="thumbnail  img-responsive" src="images/item/tp/Image00002.jpg" alt="img"></a></td>
                    <td style="width:58%" class="ads-details-td"><div>
                        <p><strong> <a href="ads-details.html" title="HTC one x 32 GB intact Seal box For sale">HTC one x 32 GB intact Seal box For sale</a> </strong></p>
                        <p> <strong> Posted On </strong>:
                          02-Sept-2014, 09:00 PM </p>
                        <p> <strong>Visitors </strong>: 896 <strong>Located In:</strong> New York </p>
                      </div></td>
                    <td style="width:16%" class="price-td"><div><strong> $210</strong></div></td>
                    <td style="width:10%" class="action-td"><div>
                        <p><a class="btn btn-primary btn-xs"> <i class="fa fa-edit"></i> Edit </a></p>
                        <p> <a class="btn btn-info btn-xs"> <i class="fa fa-mail-forward"></i> Share </a></p>
                        <p> <a class="btn btn-danger btn-xs"> <i class=" fa fa-trash"></i> Delete </a></p>
                      </div></td>
                  </tr>
                  <tr>
                    <td style="width:2%" class="add-img-selector"><div class="checkbox">
                        <label>
                          <input type="checkbox">
                        </label>
                      </div></td>
                    <td style="width:14%" class="add-img-td"><a href="ads-details.html"><img  class="thumbnail  img-responsive" src="images/item/tp/Image00011.jpg" alt="img"></a></td>
                    <td style="width:58%" class="ads-details-td"><div>
                        <p><strong> <a href="ads-details.html" title="Sony Xperia TX ">Sony Xperia TX </a> </strong></p>
                        <p> <strong> Posted On </strong>:
                          02-Oct-2014, 04:38 PM </p>
                        <p> <strong>Visitors </strong>: 221 <strong>Located In:</strong> New York </p>
                      </div></td>
                    <td style="width:16%" class="price-td"><div><strong> $260</strong></div></td>
                    <td style="width:10%" class="action-td"><div>
                        <p><a class="btn btn-primary btn-xs"> <i class="fa fa-edit"></i> Edit </a></p>
                        <p> <a class="btn btn-info btn-xs"> <i class="fa fa-mail-forward"></i> Share </a></p>
                        <p> <a class="btn btn-danger btn-xs"> <i class=" fa fa-trash"></i> Delete </a></p>
                      </div></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!--/.row-box End--> 
            
          </div>
        </div>
        <!--/.page-content--> 
      </div>
      <!--/.row--> 
    </div>
    <!--/.container--> 
  </div>
@stop