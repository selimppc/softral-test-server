<div class="col-lg-3 content-left">
          <h4>Search By</h4>
		  @if(!isset($category))
		  {{--*/ $category = null /*--}}
		  @endif  
		  @if(!isset($category_label))
		  {{--*/ $category_label = null /*--}}
		  @endif
		 
          <div class="well well-sm">
		   <form class="form" accept-charset="UTF-8" action="{!! URL::to('/') !!}/ad-lists" method="GET">
              <fieldset>
                <input type="text"  name="q" id='q' class="form-control" placeholder="Search by keyword" value='@if(Input::get('q')){!!Input::get('q')!!}@endif' required />
               <!-- <small><a href="#" class="btn-advanced-search">Advanced</a></small>-->
                <input type="submit" class="btn btn-danger btn-sm btn-search" value="Search"  />
              </fieldset>
            </form>
          </div>
		   <h4>Filter By : <select style="display: inline; width: 61%;" id="change_search" name="change_search" class="form-control">
		  <option value="country" @if($category!=null && $category_label=='Country'){!!'selected'!!}@endif>Country</option>
		  <option value="state" @if($category!=null && $category_label=='State'){!!'selected'!!}@endif>State</option>
		  <option value="city" @if($category!=null && $category_label=='City'){!!'selected'!!}@endif>City</option>
		  </select></h4>
		  
          <div class="well well-sm">
		   <form class="form" accept-charset="UTF-8" action="{!! URL::to('/') !!}/ad-lists" method="GET">
              <fieldset>
                <input type="text"  name="filter_text" id='filter_text' class="form-control" placeholder="Search by country" value='@if($category!=null && $category_label!=null){!! $category !!}@endif'  />
               <!-- <small><a href="#" class="btn-advanced-search">Advanced</a></small>-->
                <input type="submit" class="btn btn-danger btn-sm btn-search" value="Filter" id='submit_search' />
              </fieldset>
            </form>
          </div>
		  
		  @if(isset($categories) && $categories)
          <h4>Categories</h4>
          <div class="list-group categories panel">
		  <a href="{!! URL::to('/') !!}/ad-lists" class="list-group-item" >View All </a>
		   @foreach($categories as $category)
		    @if($category->parent==0)
				@if(count($category->children)>0)
					<a href="#{!! str_replace(' ','_',$category->category) !!}" class="list-group-item" data-toggle="collapse">{!! $category->category !!} <span class="glyphicon glyphicon-chevron-down"></span></a> 
				@else
					<a href="{!! URL::to('/ad-category/').'/'.$category->slug !!}" class="list-group-item" >{!! $category->category !!} </a>
				@endif
			 @endif
			 @if(count($category->children)>0)
			   <div class="collapse categories" id="{!! str_replace(' ','_',$category->category) !!}">
						   <a href="{!! URL::to('/ad-category/').'/'.$category->slug !!}" class="list-group-item"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View All </a>
					 @foreach($category->children as $submenu)
						  <a href="{!! URL::to('/ad-category/').'/'.$submenu->slug !!}" class="list-group-item" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! $submenu->category !!} </a>
					  @endforeach
			   </div>
			 @endif
		 @endforeach	
          </div>
		  @endif
		
			<div class="well well-sm">
			<h4>Search by Price</h4>
		   <form method="GET" action="{!! URL::to('/') !!}/ad-lists" accept-charset="UTF-8" class="form">
           <fieldset> <div class='col-lg-12'>
  <div class='col-md-1' style=' margin-top: 6px;padding-right: 0;'> $</div><div class='col-md-10'><input type="text" name="min" class="form-control" placeholder="Min" value="@if(isset($_GET['min']) && $_GET['min']!=''){!!Input::get('min')!!}@endif"></div></div>  <div class='col-lg-12' style='padding-top: 5px;'><div class='col-md-1' style=' margin-top: 6px;padding-right: 0;;'>$</div><div class='col-md-10'><input type="text" class="form-control" value="@if(isset($_GET['max']) && $_GET['max']!=''){!!Input::get('max')!!}@endif" placeholder="Max" name="max">
   <input type="hidden"  name="q" class="form-control" placeholder="Search keyword" value='@if(Input::get('q')){!!Input::get('q')!!}@endif' />
               <!-- <small><a href="#" class="btn-advanced-search">Advanced</a></small>-->
  </div> </div> <input type="submit" class="btn btn-danger btn-sm btn-search" value="Search" >
              </fieldset>
            </form>
          </div>
		  
		  <div class="well well-sm">
			<h4>Classified Status</h4>
			<a href='{!! URL::to('/ad-lists').'?status=open' !!}'>Classified Open</a>
			</div>
		  
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
          <h4>Newest classifieds</h4>
          <div class="newest-classifieds">
           
		  @foreach($new_ads as $new_ad)
		   <?php $images=unserialize($new_ad->images); ?>
            <div class="media">
              <a class="pull-left" href="{!! URL::to('/ad-detail/').'/'.$new_ad->slug !!}">
				@if(empty($images))
                <img class="media-object" style="width: 64px; height: 64px;" src="{!! URL::to('/') !!}/images/noImageAvailable.JPG" />
			  @else
				   <img class="media-object" style="width: 64px; height: 64px;" src="{!! URL::to('/') !!}/uploads/{!! $images[0] !!}"  />
			  @endif
              </a>
              <div class="media-body">
                <p><a href="{!! URL::to('/job/').'/'.$new_ad->slug !!}"><strong>{!! $new_ad->title!!}</strong></a></p>
                <p>{!! $new_ad->cut_sidebar_description!!}</p>
              </div>
            </div>
		  @endforeach
           
        </div>
            <p class="text-right show-more"><a href="{!! URL::to('ad-lists') !!}">More &rarr;</a></p>
         
        </div>
		{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
	<script>

		 $( document ).ready(function() {
			 $('#change_search').change( function(){
				 var change_value=$(this).val();
				 if(change_value!='keyword'){
					 $('#filter_text').attr('placeholder','Search by '+change_value);
				 }
			 });
			 
			 $('#submit_search').click( function(){
				  var filter_text=$('#filter_text').val();
				   var change_value=$('#change_search').val();
					if(filter_text==''){
						window.location="{!! URL::to('/') !!}/"+change_value;
					}
					else{
						window.location="{!! URL::to('/') !!}/"+change_value+'/'+filter_text;
					}
			
					return false;
				
			 });
		 });
		 
	</script>