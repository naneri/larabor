<div class="col-sm-3 page-sidebar">
  <aside>
    <div class="inner-box">
      <div class="user-panel-sidebar">
        <div class="collapse-box">
          <h5 class="collapse-title no-border"> Учётная запись <a class="pull-right" data-toggle="collapse"  href="#MyClassified"><i class="fa fa-angle-down"></i></a></h5>
          <div id="MyClassified" class="panel-collapse collapse in">
            <ul class="acc-list">
              <li class="{{ $page == 'main' ? 'active' : ''}}"><a href="{{route('profile.main')}}"><i class="icon-home"></i> Мои данные </a></li>
              <li>
                <a target="_blank" href="{{route('user.ads', Auth::id())}}">
                  <i class="icon-eye"></i> Публичный профиль 
                </a>
              </li>
              
            </ul>
          </div>
        </div>
        <!-- /.collapse-box  -->
        <div class="collapse-box">
          <h5 class="collapse-title"> Объявления <a class="pull-right" data-toggle="collapse"  href="#MyAds"><i class="fa fa-angle-down"></i></a></h5>
          <div id="MyAds" class="panel-collapse collapse in">
            <ul class="acc-list">
              <li class="{{ $page == 'ads' ? 'active' : ''}}"><a href="{{route('profile.ads')}}"><i class="icon-docs"></i> Мои объявления</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- /.inner-box  --> 
    
  </aside>
</div>