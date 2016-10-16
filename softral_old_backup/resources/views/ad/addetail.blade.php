@extends('laravel-authentication-acl::client.layouts.base')

@section('title')

Softral Classified - {!! $ad_detail->title !!}

@stop

@section('content')

<div class="row content">

    

        <div class="container-fluid main_content view-job">

	

	<div class="row-fluid">

		 @include('laravel-authentication-acl::client.layouts.sidebar_classifieds')

		<div class="col-lg-9">

		

      {{-- successful message --}}

        <?php $message = Session::get('message'); ?>

        @if( isset($message) )

        <div class="alert alert-success">{!! $message !!}</div>

        @endif

       @if($errors->any())

			<div class="alert alert-danger">

				@foreach($errors->all() as $error)

					<p>{{ $error }}</p>

				@endforeach

			</div>

		@endif

        

		<ol class="breadcrumb">

            <li><span class="glyphicon glyphicon-home"></span> <a href="{!! URL::to('/') !!}">Home</a></li>

			@if(!empty($ad_detail->categories->parent_get))

				<li><a href="{!! URL::to('/ad-category/').'/'.$ad_detail->categories->parent_get->slug !!}">{!! $ad_detail->categories->parent_get->category !!}</a></li>

			@endif

            @if(isset($ad_detail->categories->category))

				<li><a href="{!! URL::to('/ad-category/').'/'.$ad_detail->categories->slug !!}">{!!  $ad_detail->categories->category !!}</a></li>

			@endif

            <li>{!! $ad_detail->title !!}</li>

          </ol>

		

          <h3>{!! $ad_detail->title !!} <span class='detail_price_city'>- ${!!$ad_detail->price!!} ({!!$ad_detail->city!!}, {!!$ad_detail->state!!})</span></h3>

          <div class="row">

            <div class="col-md-8">

              <div class="row">

                <div class="col-md-12" id="slider">

                  <div class="col-md-12" id="carousel-bounding-box" style="padding: 0;">

                    <div id="detailCarousel" class="carousel slide">

                      <div class="carousel-inner">

					  <?php $images=unserialize($ad_detail->images); ?>

					  @if(!empty($images))

						  @foreach($images as $i=>$image)

                        <div class="item @if($i==0)active @endif" data-slide-number="{{$i}}">

                          <img src="{!! URL::to('/') !!}/uploads/{!! $image!!}" class="img-responsive" />

                        </div>

						  @endforeach

					  @else

						 {!! $ad_detail->description !!}<br/><br/>
						  <table class="table table-condensed table-hover">

                <thead>

                  <th colspan="2">Details:</th>

                </thead>

                <tbody style="font-size: 12px;">

                  <tr>

                    <td>Classified ID</td>

                    <td>{!!$ad_detail->id!!}</td>

                  </tr>


                  <tr>

                    <td>Status</td>

                    <td>@if($ad_detail->sold==1) Sold @else Active @endif</td>

                  </tr>

                  <!--<tr>

                    <td>Brand</td>

                    <td>Samsung</td>

                  </tr>-->
				 @if(isset($ad_detail->categories->category))
                  <tr>

                    <td>Type</td>

                    <td>{!!  $ad_detail->categories->category !!}</td>

                  </tr>
				@endif
				
				 <tr>

                    <td>Posted</td>

                    <td>{!!  $ad_detail->modified_created_at !!}</td>

                  </tr>
                   <!--<tr>

                    <td>Shipping</td>

                    <td>US, UK, CZ</td>

                  </tr>

                  <tr>

                    <td>Returns</td>

                    <td>14 days money back</td>

                  </tr>

                  <tr>

                    <td>Payments</td>

                    <td>PayPal, Credit Card</td>

                  </tr>-->

                </tbody>

              </table>

					  @endif

                      </div>

					  @if(!empty($images))

                      <a class="carousel-control left" href="#detailCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>

                      <a class="carousel-control right" href="#detailCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>

					  @endif

                    </div>

                  </div>

                </div>

              </div>

			   @if(!empty($images))

              <div class="row">

                <div class="col-md-12 hidden-sm hidden-xs" id="slider-thumbs">

                  <ul class="list-inline">

				  @foreach($images as $i=>$image)

                    <li><a id="carousel-selector-{{$i}}" @if($i==0) class="selected" @endif><img src="{!! URL::to('/') !!}/uploads/{!! $image!!}" class="img-responsive" /></a></li>

				 @endforeach

                  </ul>    

                </div> 

              </div> 

			   @endif

            </div>

            <div class="col-md-4">
			 @if(!empty($images))
              <table class="table table-condensed table-hover">

                <thead>

                  <th colspan="2">Details:</th>

                </thead>

                <tbody style="font-size: 12px;">

                  <tr>

                    <td>Classified ID</td>

                    <td>{!!$ad_detail->id!!}</td>

                  </tr>


                  <tr>

                    <td>Status</td>

                    <td>@if($ad_detail->sold==1) Sold @else Active @endif</td>

                  </tr>

                  <!--<tr>

                    <td>Brand</td>

                    <td>Samsung</td>

                  </tr>-->
				 @if(isset($ad_detail->categories->category))
                  <tr>

                    <td>Type</td>

                    <td>{!!  $ad_detail->categories->category !!}</td>

                  </tr>
				@endif
				
				 <tr>

                    <td>Posted</td>

                    <td>{!!  $ad_detail->modified_created_at !!}</td>

                  </tr>
                   <!--<tr>

                    <td>Shipping</td>

                    <td>US, UK, CZ</td>

                  </tr>

                  <tr>

                    <td>Returns</td>

                    <td>14 days money back</td>

                  </tr>

                  <tr>

                    <td>Payments</td>

                    <td>PayPal, Credit Card</td>

                  </tr>-->

                </tbody>

              </table>
				@endif
              <div class="row">

                <div class="col-md-12">

                  <span style="padding-left: 5px;"><strong>Seller:</strong></span>

                  <div class="well">

                    <div class="row">

                      <div class="col-sm-12">

                        <h4><a href='{!! URL::to('/user/profile').'/'.$ad_detail->user->user_profile[0]->slug !!}'>{!! ucwords($ad_detail->user->user_profile[0]->first_name )!!}</a></h4>

                       <!-- <small>Rating: <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star-empty"></span></small>-->

                        <small><span class="glyphicon glyphicon-map-marker"></span>  Location: <cite title="{!! ucwords($ad_detail->user->user_profile[0]->city )!!}, {!! ucwords($ad_detail->user->user_profile[0]->state )!!}">{!! ucwords($ad_detail->user->user_profile[0]->city )!!}, {!! ucwords($ad_detail->user->user_profile[0]->state )!!} </cite></small><br />

                        <span class="glyphicon glyphicon-envelope"></span> {!! $ad_detail->email !!}<br />

						@if($ad_detail->phone_no!='')

							<span class="glyphicon glyphicon-phone-alt"></span> {!! $ad_detail->phone_no !!}<br />

						@endif

                      </div>

                    </div>

                  </div>

                </div>

              </div>  

            </div>

          </div>

		    @if(!empty($images))
          <div class="row">

            <div class="col-md-12">

            
             {!! $ad_detail->description !!}

            </div>

          </div>
			@endif
          <hr>

          <div class="row">

            <div class="col-md-12">

              <h4>Send message to seller</h4>

              <div class="panel panel-default">

                <div class="panel-body">                

				  {!! Form::open(array('route' => 'ad.savemessage', 'class' => 'form','method' => 'POST')) !!}

				  <input type="hidden" name="ad_id" value="{!! $ad_detail->id !!}" />

				  <input type="hidden" name="ad_slug" value="{!! $ad_detail->slug !!}" />

				   <div class="form-group">

                      <label for="InputEmail">Your name *</label>

                      <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" required>

                    </div>

                    <div class="form-group">

                      <label for="InputEmail">Email address *</label>

                      <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>

                    </div>

                    <div class="form-group">

                      <label for="InputText">Your message *</label>

                      <textarea class="form-control" id="message" name="message" placeholder="Type in your message" rows="5" style="margin-bottom:10px;" required></textarea>

                    </div>

                    <button class="btn btn-info" type="submit">Send</button>

                  </form>

                </div>

              </div>

            </div>

          </div>

       

		</div>

		

	

	</div>

	

	

</div>

      </div>

		 {!! HTML::style('css/czsale-carousel.css') !!}

		 {!! HTML::style('css/czsale-responsive.css') !!}

	   {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}

	    {!! HTML::script('js/respond.min.js') !!}

	   {!! HTML::script('js/jquery.slides.min.js') !!}

	<script>

		 $( document ).ready(function() {

      // Carousel (slider)

      $('#detailCarousel').carousel({

        interval: 4000

      });

      $('[id^=carousel-selector-]').click( function(){

        var id_selector = $(this).attr("id");

        var id = id_selector.substr(id_selector.length -1);

        id = parseInt(id);

        $('#detailCarousel').carousel(id);

        $('[id^=carousel-selector-]').removeClass('selected');

        $(this).addClass('selected');

      });

      $('#detailCarousel').on('slid', function (e) {

        var id = $('.item.active').data('slide-number');

        id = parseInt(id);

        $('[id^=carousel-selector-]').removeClass('selected');

        $('[id^=carousel-selector-'+id+']').addClass('selected');

      });

    });

		

		

	</script>

	

	  @stop