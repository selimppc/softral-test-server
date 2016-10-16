<?php 
use App\Http\Models\Skill;
use Illuminate\Support\Str;
?>
@foreach($proposals as $proposal)
            <div class="col-lg-12">
			@if($logged_id==$proposal['user']['id'])
              <div class="thumbnail" style='border:1px solid #CDEEF4; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);'>
			@else
			  <div class="thumbnail" >
			@endif	
			@if($proposal['user_profile']['avatar']!=NULL)
			                  <img src="data:image/jpeg;base64,{!! ( $proposal['user_profile']['avatar']) !!}">
			@else
					 <span class='glyphicon glyphicon-user proposal-user'></span>
				@endif
			                  <div class="caption">
                  <h4>
				  @if($logged_id!=$proposal['user']['id'])
					<a href="{!! URL::to('/user/profile').'/'.$proposal['user_profile']['slug'] !!}">{{ $proposal['user_profile']['first_name']}}</a>
				  @else
					<a href="javascript:void(0)">Your Proposal</a>
				  @endif
				</h4>
				 <div class="price"><span class="glyphicon glyphicon-map-marker"></span> @if($proposal['user_profile']['city']!=null){!! $proposal['user_profile']['city'].',' !!}@endif
							@if($proposal['user_profile']['state']!=null){!! $proposal['user_profile']['state'].',' !!}@endif
							{!! $proposal['user_profile']['country'] !!}</div><div class="pull-right posted_by"><span style="color: #AFAFAF; ">Submitted:</span> {!!  $proposal['created_at'] !!}</div><br>
							
							<?php $about_me = 'Nothing Specified Yet'; ?>
				  <?php $skills='No skills selected'; ?>
				  @foreach($proposal['user_profile']['profile_field'] as $profile_field)
					@if( $profile_field['profile_field_type_id']==2)
						<div class="description">
						<?php $about_me = Str::limit($profile_field['value'], 150); ?>
						</div>
							<?php break; ?>
					@else
						<?php $about_me = 'Nothing Specified Yet'; ?>
					@endif
				  @endforeach
				  
				   @foreach($proposal['user_profile']['profile_field'] as $profile_field)
					@if( $profile_field['profile_field_type_id']==3)
						<div class="description">
						<?php $skills = unserialize($profile_field['value']);
							 $skill_data=array();
							for($i=0;$i<count($skills);$i++):
								$skill = Skill::find($skills[$i]);
								$skill_data[$skill['slug']] = $skill['skill']; 
							  endfor;
							 $data=implode(' ', array_map(function ($v, $k) { return "<a href='".url()."/skill/".$k."'>".$v."</a>,"; }, $skill_data, array_keys($skill_data)));
							 $skills=rtrim($data,',');
						?>
						</div>
							<?php break; ?>
					@else
						<?php $skills = 'No skills selected'; ?>
					@endif
					 @endforeach
					 
				  <div class="description">{!!$about_me!!}</div>
				
				   				  <div class="pull-right skills"><span style="color: #AFAFAF; ">Skills:</span>{!!$skills!!}</div>
				                   </div>
								   
								   @if($logged_id==$proposal['job']['id'] && empty($proposal_selected))
									   <div class="pull-left" style='width:100%'>
								<a href="{!! URL::route('job.selectProposal',['id' => $proposal['id'],'job_id' => $proposal['job_id'],'_token' => csrf_token()]) !!}" title="Select a proposal"  class='select_proposal'><strong>Select Proposal</strong></a>
							   </div>
									@elseif(!empty($proposal_selected) && $proposal_selected['id']==$proposal['id'])
										 <div class="pull-left" style='width:100%;color:#3276B1'>
								<strong>Proposal Selected!</strong>
							   </div>
									@endif
              </div>
            </div>
				@endforeach