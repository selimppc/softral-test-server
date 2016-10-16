@extends('laravel-authentication-acl::admin.layouts.base-2cols')
@section('title')
Admin area: Add page
@stop

@section('content')
{!! HTML::style('packages/jacopo/laravel-authentication-acl/css/summernote.css') !!}
<div class="row">
    <div class="col-md-12">
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
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                         <h3 class="panel-title bariol-thin">{!! isset($page->id) ? '<i class="fa fa-pencil"></i> Edit' : '<i class="fa fa-user"></i> Create' !!} page:</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                      
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <h4>Add page</h4>
				
					
				 {!! Form::model($page,['route'=>'page.save', 'enctype' => 'multipart/form-data', 'method' => 'post', 'class' => 'post-form','files' => true, 'id'=> 'post-form']) !!}
				
				 {!! isset($page->id)?Form::hidden('id'):'' !!}	
					
				<div class="form-group">
					{!! Form::label('title', 'Title: *', ['class' => 'control-label']) !!}
					{!! Form::text('title', null, ['class' => 'form-control']) !!}
				</div>
		
		
		
				<div class="form-group">
				<div id="formdiv">
                            <div id="filediv">
                              <input type="file" id="file" name="image[]" multiple="multiple" accept="image/*" title="Select Images To Be Uploaded">
                              <br>
                            </div>
                       
                          </div>
				<!--{!! Form::label('Add Image (Optional)') !!}
				{!! Form::file('image[]',array('multiple'=>true)) !!}-->
				
				<?php
				
					$input1=@unserialize($page['image']);
				
				?>	
				
				@if($page['image']!='' && $input1!==false)
					@foreach($input1 as $key=>$input)
				 <a href="{!! URL::route('page.deleteimage',['id' => $key, 'page_id'=>$page->id, '_token' => csrf_token()]) !!}">
					<div class="img-wrap">
					  <span class="close">&times;</span>
					<img src="{!! URL::to('/') !!}/uploads/{!! $input !!}" width='100px' data-id="123" />
						<input type='hidden' name='image_text[]' value='<?php echo $input;?>' />
						 
						</a>
							</div>
				
					@endforeach
				
				@endif
				
			
			</div>
			
			
		<div class="form-group">
				<label for="files">Add Video 1: </label>
				<input type="file" id="file" name="vedio1"  accept="vedio/*">
				
				<p>
				@if(isset($page->vedio1))
				<div id="video1">
				<a href="{!! URL::route('page.deleteVideo1',['page_id'=>$page->id, 'type'=>1, '_token' => csrf_token()]) !!}">
				 <span class="close">&times;</span>
				{{ $page->vedio1}} </a> 
				</div>
				@endif
				</p>
					<output id="result" />
				</div>
				
				<div class="form-group">
				<label for="files">Add Video 2: </label>
				<input type="file" id="file" name="vedio2"   accept="vedio/*">
				<p>
				@if(isset($page->vedio2))
				<a href="{!! URL::route('page.deleteVideo1',['page_id'=>$page->id, 'type'=>2, '_token' => csrf_token()]) !!}">	
				<span class="close">&times;</span>
				{{ $page->vedio2}} </a>
				@endif
				</p>
					<output id="result" />
				</div>
				
				<div class="form-group">
				<label for="files">Add Video 3: </label>
				<input type="file" id="file" name="vedio3"  accept="vedio/*">
				<p>
				@if(isset($page->vedio2))
				<a href="{!! URL::route('page.deleteVideo1',['page_id'=>$page->id, 'type'=>3, '_token' => csrf_token()]) !!}">	
				<span class="close">&times;</span>
				{{ $page->vedio3}} </a>
				@endif
				</p>
					<output id="result" />
				</div>
				
				
				<div class="form-group">
					{!! Form::label('content', 'Content: *', ['class' => 'control-label']) !!}
					{!! Form::textarea('content', null, ['class' => 'form-control summernote']) !!}
				</div>
				
				<div class="form-group">
					{!! Form::label('parent', 'Select parent page:', ['class' => 'control-label']) !!}
					 {!! Form::select('parent', $parents, (isset($page->parent) && $page->parent) ?$page->parent : "", ["class"=> "form-control"] ) !!}
				</div>
				
				<div class="form-group">
					{!! Form::label('active', 'Status', ['class' => 'control-label']) !!}
					{!! Form::select('active', array('1' => 'Active', '0' => 'Inactive'), (isset($page->active)) ?$page->active : "", ['id' => 'active','class' => 'form-control']) !!}
				</div>
			
				{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
				 
				{!! Form::close() !!}
                    </div>
                   
                </div>
            </div>
      </div>
</div>


<script type='text/javascript'>
$(document).ready(function() {
 $('#content').summernote({
  height: 300,                 // set editor height

  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor
                 // set focus to editable area after initializing summernote
});
});
</script>
<!--by piyush-->
<style>
.img-wrap {
    position: relative;
    display: inline-block;
    border: 1px red solid;
    font-size: 0;
}
.img-wrap .close {
    position: absolute;
    top: 2px;
    right: 2px;
    z-index: 100;
    background-color: #FFF;
    padding: 5px 2px 2px;
    color: #000;
    font-weight: bold;
    cursor: pointer;
    opacity: .2;
    text-align: center;
    font-size: 22px;
    line-height: 10px;
    border-radius: 50%;
}
.img-wrap:hover .close {
    opacity: 1;
}
</style>
<style>
 #formdiv {
      text-align: center;
    }
    #file {
      color: green;
      padding: 5px;
      border: 1px dashed #123456;
      background-color: #f9ffe5;
    }
    #img {
      width: 17px;
      border: none;
      height: 17px;
      margin-left: -20px;
      margin-bottom: 191px;
    }
    .upload {
      width: 100%;
      height: 30px;
    }
    .previewBox {
      text-align: center;
      position: relative;
      width: 150px;
      height: 150px;
      margin-right: 10px;
      margin-bottom: 20px;
      float: left;
    }
    .previewBox img {
      height: 150px;
      width: 150px;
      padding: 5px;
      border: 1px solid rgb(232, 222, 189);
    }
    .delete {
      color: red;
      font-weight: bold;
      position: absolute;
      top: 0;
      cursor: pointer;
      width: 20px;
      height:  20px;
      border-radius: 50%;
      background: #ccc;
    }
	</style>
<!--by piyush-->
<script>
$('.img-wrap .close').on('click', function() {
    var id = $(this).closest('.img-wrap').find('img').data('id');
    //alert('remove picture: ' + id);
});
</script>
<!--by piyush-->
<script>
 $('#add_more').click(function() {
          "use strict";
          $(this).before($("<div/>", {
            id: 'filediv'
          }).fadeIn('slow').append(
            $("<input/>", {
              name: 'file[]',
              type: 'file',
              id: 'file',
              multiple: 'multiple',
              accept: 'image/*'
            })
          ));
        });

        $('#upload').click(function(e) {
          "use strict";
          e.preventDefault();

          if (window.filesToUpload.length === 0 || typeof window.filesToUpload === "undefined") {
            alert("No files are selected.");
            return false;
          }

          // Now, upload the files below...
          // https://developer.mozilla.org/en-US/docs/Using_files_from_web_applications#Handling_the_upload_process_for_a_file.2C_asynchronously
        });

        deletePreview = function (ele, i) {
          "use strict";
          try {
            $(ele).parent().remove();
            window.filesToUpload.splice(i, 1);
          } catch (e) {
            console.log(e.message);
          }
        }

        $("#file").on('change', function() {
          "use strict";

          // create an empty array for the files to reside.
          window.filesToUpload = [];

          if (this.files.length >= 1) {
            $("[id^=previewImg]").remove();
            $.each(this.files, function(i, img) {
              var reader = new FileReader(),
                newElement = $("<div id='previewImg" + i + "' class='previewBox'><img /></div>"),
                deleteBtn = $("<span class='delete' onClick='deletePreview(this, " + i + ")'>X</span>").prependTo(newElement),
                preview = newElement.find("img");

              reader.onloadend = function() {
                preview.attr("src", reader.result);
                preview.attr("alt", img.name);
              };

              try {
                window.filesToUpload.push(document.getElementById("file").files[i]);
              } catch (e) {
                console.log(e.message);
              }

              if (img) {
                reader.readAsDataURL(img);
              } else {
                preview.src = "";
              }

              newElement.appendTo("#filediv");
            });
          }
        });
</script>

@stop
{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
@section('footer_scripts')

{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/summernote.min.js') !!}
@stop