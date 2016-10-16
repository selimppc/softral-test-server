<div class="col-lg-3 content-left">
          <h4>Search</h4>
          <div class="well well-sm">
		   <form class="form" accept-charset="UTF-8" action="{!! URL::to('/') !!}/shome" method="GET">
              <fieldset>
                <input type="text"  name="q" class="form-control" placeholder="Search keyword" value='@if(Input::get('q')){!!Input::get('q')!!}@endif' />
               <!-- <small><a href="#" class="btn-advanced-search">Advanced</a></small>-->
			    <input type="hidden" name="search_type" value="{!!Input::get('search_type')!!}" />
                <input type="submit" class="btn btn-danger btn-sm btn-search" value="Search"  />
              </fieldset>
            </form>
          </div>
		  
		  
		  <div class="well well-sm">
			<h4>Search by</h4>
		   <form method="GET" action="{!! URL::to('/') !!}/shome" accept-charset="UTF-8" class="form">
           <fieldset> <div class='col-lg-12'>
 <div class='col-md-10'> <select name='search_type' class='form-control'>
 <option value='jobs' @if(Input::get('search_type')=='jobs')selected="selected"@endif >Jobs</option>
 <option value='freelancer' @if(Input::get('search_type')=='freelancer')selected="selected"@endif>Freelancers</option>
 </select></div></div> <input type="submit" class="btn btn-danger btn-sm btn-search" value="Search">
 <input type="hidden" name="q" value="{!!Input::get('q')!!}" />
              </fieldset>
            </form>
          </div>
		  
		  
		  @if(isset($categories) && $categories)
          <h4>Categories</h4>
          <div class="list-group categories panel">
		  <a href="{!! URL::to('/') !!}" class="list-group-item" >View All </a>
		   @foreach($categories as $category)
		    @if($category->parent==0)
            @if(count($category->children)>0)
					<a href="#{!! str_replace(' ','_',$category->category) !!}" class="list-group-item" data-toggle="collapse">{!! $category->category !!} <span class="glyphicon glyphicon-chevron-down"></span></a> 
				@else
					<a href="{!! URL::to('/category/').'/'.$category->slug !!}" class="list-group-item" >{!! $category->category !!} </a>
				@endif
			 @endif
			 @if(count($category->children)>0)
			   <div class="collapse categories" id="{!! str_replace(' ','_',$category->category) !!}">
						   <a href="{!! URL::to('/category/').'/'.$category->slug !!}" class="list-group-item"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View All </a>
					 @foreach($category->children as $submenu)
						  <a href="{!! URL::to('/category/').'/'.$submenu->slug !!}" class="list-group-item" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! $submenu->category !!} </a>
					  @endforeach
			   </div>
			 @endif
		 @endforeach	
          </div>
		  @endif
		
			<div class="well well-sm">
			<h4>Search by Budget</h4>
		   <form method="GET" action="{!! URL::to('/') !!}/shome" accept-charset="UTF-8" class="form">
           <fieldset> <div class='col-lg-12'>
  <div class='col-md-1' style=' margin-top: 6px;padding-right: 0;'> $</div><div class='col-md-10'><input type="text" name="min" class="form-control" placeholder="Min" value="@if(isset($_GET['min']) && $_GET['min']!=''){!!Input::get('min')!!}@endif"></div></div>  <div class='col-lg-12' style='padding-top: 5px;'><div class='col-md-1' style=' margin-top: 6px;padding-right: 0;;'>$</div><div class='col-md-10'><input type="text" class="form-control" value="@if(isset($_GET['max']) && $_GET['max']!=''){!!Input::get('max')!!}@endif" placeholder="Max" name="max">
   <input type="hidden"  name="q" class="form-control" placeholder="Search keyword" value='@if(Input::get('q')){!!Input::get('q')!!}@endif' />
               <!-- <small><a href="#" class="btn-advanced-search">Advanced</a></small>-->
  </div> </div> <input type="submit" class="btn btn-danger btn-sm btn-search" value="Search">
              </fieldset>
            </form>
          </div>
		  
		  <!--<div class="well well-sm">
			<h4>Job Status</h4>
			<a href="{!! URL::to('/').'/?status=closed' !!}">Hiring Closed</a>
			</div>-->
		  
		  <!--<div id="MainMenu">
  <div class="list-group panel">
    <a href="#demo3" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">Item 3</a>
    <div class="collapse" id="demo3">
      <a href="#SubMenu1" class="list-group-item" data-toggle="collapse" data-parent="#SubMenu1">Subitem 1 <i class="fa fa-caret-down"></i></a>
      <div class="collapse list-group-submenu" id="SubMenu1">
        <a href="#" class="list-group-item" data-parent="#SubMenu1">Subitem 1 a</a>
        <a href="#" class="list-group-item" data-parent="#SubMenu1">Subitem 2 b</a>
        <a href="#SubSubMenu1" class="list-group-item" data-toggle="collapse" data-parent="#SubSubMenu1">Subitem 3 c <i class="fa fa-caret-down"></i></a>
        <div class="collapse list-group-submenu list-group-submenu-1" id="SubSubMenu1">
          <a href="#" class="list-group-item" data-parent="#SubSubMenu1">Sub sub item 1</a>
          <a href="#" class="list-group-item" data-parent="#SubSubMenu1">Sub sub item 2</a>
        </div>
        <a href="#" class="list-group-item" data-parent="#SubMenu1">Subitem 4 d</a>
      </div>
      <a href="javascript:;" class="list-group-item">Subitem 2</a>
      <a href="javascript:;" class="list-group-item">Subitem 3</a>
    </div>
    <a href="#demo4" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">Item 4</a>
    <div class="collapse" id="demo4">
      <a href="" class="list-group-item">Subitem 1</a>
      <a href="" class="list-group-item">Subitem 2</a>
      <a href="" class="list-group-item">Subitem 3</a>
    </div>
  </div>
</div>-->
          <h4>Newest Jobs</h4>
          <div class="newest-classifieds">
		  @foreach($new_jobs as $new_job)
		   <?php $images=unserialize($new_job->images); ?>
            <div class="media">
              <a class="pull-left" href="{!! URL::to('/job/').'/'.$new_job->slug !!}">
				@if(empty($images))
                <img class="media-object" style="width: 64px; height: 64px;" src="{!! URL::to('/') !!}/images/noImageAvailable.JPG" />
			  @else
				   <img class="media-object" style="width: 64px; height: 64px;" src="{!! URL::to('/') !!}/uploads/{!! $images[0] !!}"  />
			  @endif
              </a>
              <div class="media-body">
                <p><a href="{!! URL::to('/job/').'/'.$new_job->slug !!}"><strong>{!! $new_job->project_name!!}</strong></a></p>
                <p>{!! $new_job->cut_sidebar_description!!}</p>
              </div>
            </div>
		  @endforeach
            <p class="text-right show-more"><a href="{!! URL::to('') !!}">More &rarr;</a></p>
          </div>
        </div>