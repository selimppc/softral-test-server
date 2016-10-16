<div class="col-lg-9 content-right">
           <div class="row selected-classifieds">
		  <form class="form" accept-charset="UTF-8" action="{!! URL::to('/') !!}" method="GET" style='display:inline'>
				<div class="form-group pull-right" style='width: 36%;'>
			  <label class="control-label col-sm-4" for="Sort By" style='padding:5px 0px 0px 47px'>Sort By:</label>
			  <div class="col-sm-6 col-md-8">
				<select id="sorting" class="form-control" name="sorting" onchange='this.form.submit()'>
				  <option value=''>-Select Sorting-</option>
				  <option value='created-at-desc' @if(isset($_GET['sorting']) && $_GET['sorting']=='created-at-desc') {!!'selected'!!}@endif >Posted date Desc</option>
				  <option value='created-at-asc' @if(isset($_GET['sorting']) && $_GET['sorting']=='created-at-asc') {!!'selected'!!}@endif>Posted date Asc</option>
				  <option value='budget-desc' @if(isset($_GET['sorting']) && $_GET['sorting']=='budget-desc') {!!'selected'!!}@endif>Budget High</option>
				  <option value='budget-asc' @if(isset($_GET['sorting']) && $_GET['sorting']=='budget-asc') {!!'selected'!!}@endif>Budget Low</option>
				  <option value='project-name-desc' @if(isset($_GET['sorting']) && $_GET['sorting']=='project-name-desc') {!!'selected'!!}@endif>Job name Desc</option>
				  <option value='project-name-asc' @if(isset($_GET['sorting']) && $_GET['sorting']=='project-name-asc') {!!'selected'!!}@endif>Job name Asc</option>
				</select> 
			  </div>
			</div>
		  </form>
		
		  @if(count($jobs) != 0) 
		   @foreach($jobs as $job)
		   <?php $images=unserialize($job->images); ?>
		 
            <div class="col-lg-12">
              <div class="thumbnail">
				  @if(empty($images))
					<img src="{!! URL::to('/') !!}/images/noImageAvailable.JPG" />
				  @else
					   <img src="{!! URL::to('/') !!}/uploads/{!! $images[0] !!}"  />
				  @endif
                <div class="caption">
                  <h4><a href="{!! URL::to('/job/').'/'.$job->slug !!}">{!! $job->project_name !!}</a></h4>
				 <div class='price'>Budget: ${!! $job->budget !!} - Posted {!!  $job->created_at !!} | Total Proposals <strong>({!! count($job->proposals)!!})</strong></div><div class="pull-right posted_by"><span style="color: #AFAFAF; ">Posted By:</span> <a href="{!! URL::to('/user/profile').'/'.$job->user->user_profile[0]->slug !!}"   >{!!  ucwords($job->user->user_profile[0]->first_name) !!}</a></div><br/>
				  <div class="description">{!! $job->cut_description !!}</div>
				  @if(isset($job->categories->category))
				  <div class="categories"><span style="color: #AFAFAF; ">Category:</span> <a href="{!! URL::to('/category/').'/'.$job->categories->slug !!}"   >{!!  $job->categories->category !!}</a> </div>
				  @endif
				   @if(!empty($job->modified_skill_id))
				  <div class="pull-right skills"><span style="color: #AFAFAF; ">Skills:</span> {!! $job->modified_skill_id !!}</div>
				   @endif
                </div>
              </div>
            </div>
			@endforeach 
			<div class="col-lg-12">{!! $jobs->render() !!}</div>
			@else
				  <div class="col-lg-12">Sorry, No Jobs Found</div>
			@endif
          </div>
        </div>