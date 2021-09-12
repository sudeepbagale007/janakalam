@extends('site.app')
<?php
	if ($detail->fb_image != '') {
		$fbimage = $detail->fb_image;
	}else {
		if ($detail->image != '') {
			$fbimage = $detail->fb_image;
		}else{
			$fbimage = $sitedetail->fb_image;
		}
	}
?>
@section('title', $detail->title)
@section('description', str_limit(strip_tags($detail->description), 200) )
@section('fb_url', Request::url())
@section('fb_published_date', $detail->published_date )
@section('fb_image', asset($fbimage))
@section('keywords', $sitedetail->meta_keywords)
@section('main-content')
<main>
	<section class="inner__content">
		<div class="detail__content">
			<div class="container">
				@include('site.components.pagedetail-ads')
				<div class="row">
					<div class="col* col-md-8 col-lg-8 col-xl-9">
						@include('site.components.pagedetail-sub-head-ads')
						@if(session('comment'))
							<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 1000)" class="alert alert-success" role="alert">
								{{session('comment')}}
						  	</div>
						@endif
						<div class="detail__post__infos">
							<!--<div class="top__title">-->
							<!--	<span class="theme__badge"></span>-->
							<!--</div>-->
							
							@if($detail->short_text != '')
							<div class="top__title">
                            <span class="theme__badge">{!! str_limit($detail->short_text,50) !!}</span>
                            </div>
                            @endif
                  
							<h2 class="detail__post__title">{{ $detail->title }}</h2>
							@if($detail->sub_heading != '')
                            <div class="breaking__shortInfos">
                            {!! str_limit($detail->sub_heading,50) !!}
                            </div>
                            @endif
							
							<div class="top__detail__post">
								<div class="top__detail__flex">
									<div class="media">
										<figure class="mr-2">
											<img src="{{asset('site/images/glob.jpg')}}" alt="{{ $detail->title }}" title="{{ $detail->title }}" style="max-height: 50px">
										</figure>
										<div class="author__Details d-flex flex-row mt-4">
											<h4 class="ml-4">{{ authorName($detail->author_name,$detail->author_id) }}</h4>
											<h4 class="ml-4 text-muted">{!! changeFullDateTimeToNepaliFormat($detail->published_date) !!}</h4>
										</div>
									</div>
            						<div class="post__share d-flex">
                                        <label class="post__title__label">शेयर गर्नुहोस :</label>
                                        <div class="addthis_inline_share_toolbox_j83u"></div>
                                  </div>
								</div>
							</div>
							
								@if($detail->show_image == '1' && $detail->image != '')
								<figure>
									<img src="{{ asset($detail->image) }}" class="img-responsive" alt="{{ $detail->title }}" title="{{ $detail->title }}">
								</figure>
								@else
								@endif

							<div id="rvfs-controllers" class="fontsize-controllers group"></div>
							
							
							<div id="detail__content" class="detail__infos__event">
								{!! $detail->description  !!}
								
							</div>

							<div class="prv_next_news">
								<div>
									<h3>< अघिल्लो समाचार </h3>
									<div>
									<a href="{{ route('post.detail',$previous->slug) }}">{{$previous->title}} </a>
									</div>
								</div>
								@if($next)
								<div>
								 <h3>	पछिल्लो समाचार > </h3>
									 <div>
									 <a href="{{ route('post.detail',$next->slug) }}">{{$next->title}}</a>
									 </div>
								</div>
								@endif
							</div>
							<div class="top__detail__post">
								<div class="top__detail__flex">
									<div class="media">
										
										<div class="author__Details">
											<h4>{{ authorName($detail->author_name,$detail->author_id) }}</h4>
											<span>{!! changeFullDateTimeToNepaliFormat($detail->published_date) !!}</span>
										</div>
									</div>
            						<div class="post__share d-flex">
                                        <label class="post__title__label">शेयर गर्नुहोस :</label>
                                        <div class="addthis_inline_share_toolbox_j83u"></div>
                                  </div>
								</div>
							</div>
						</div>
						
						@include('site.components.pagedetail-footer-ads')
						
						<div class="alert alert-success" id="emoji-alert" style="display: none"></div>
						<div class="post_reaction">
							<div class="reaction_title">
								<div>
									<h1>यो खबर पढेर तपाईलाई कस्तो महसुस भयो ?</h1>
								</div>
							</div>
							<div class="post_reaction_emo">
								<div class="emoji" id="laugh_id" data-id="laugh" data-post_id="{{$detail->id}}" data-reaction_id="@if(isset($post_reaction->id)){{$post_reaction->id}}  @endif" data-status="false" >
									<span class="reaction_score" id="laugh_score">@if(isset($post_reaction->laugh)) {{$post_reaction->laugh}}@else 0 @endif</span>
									<img class="emoji_reaction" id="laugh_img" src="{{asset('site/images/laugh.png')}}">
									<span class="emo_title">उत्साहित</span>
								</div>
								<div class="emoji" id="sad_id" data-id="sad" data-post_id="{{$detail->id}}" data-reaction_id="@if(isset($post_reaction->id)){{$post_reaction->id}}  @endif">
									<span class="reaction_score" id="sad_score" >@if(isset($post_reaction->sad)) {{$post_reaction->sad}}@else 0 @endif</span>
									<img class="emoji_reaction" src="{{asset('site/images/sad.png')}}">
									<span class="emo_title">दुःखी</span>
								</div>
								<div class="emoji" id="happy_id" data-id="happy" data-post_id="{{$detail->id}}" data-reaction_id="@if(isset($post_reaction->id)){{$post_reaction->id}}  @endif">
									<span class="reaction_score" id="happy_score">@if(isset($post_reaction->happy)) {{$post_reaction->happy}}@else 0 @endif</span>
									<img class="emoji_reaction" src="{{asset('site/images/happy.png')}}">
									<span class="emo_title">खुसी</span>
								</div>
								<div class="emoji" id="confused_id" data-id="confused" data-post_id="{{$detail->id}}" data-reaction_id="@if(isset($post_reaction->id)){{$post_reaction->id}}  @endif">
									<span class="reaction_score" id="confused_score">@if(isset($post_reaction->confused)) {{$post_reaction->confused}}@else 0 @endif</span>
									<img class="emoji_reaction" src="{{asset('site/images/confused.png')}}">
									<span class="emo_title">अचम्मित</span>
								</div>
								<div class="emoji" id="angry_id" data-id="angry" data-post_id="{{$detail->id}}" data-reaction_id="@if(isset($post_reaction->id)){{$post_reaction->id}}  @endif">
									<span class="reaction_score" id="angry_score">@if(isset($post_reaction->angry)) {{$post_reaction->angry}}@else 0 @endif</span>
									<img class="emoji_reaction" src="{{asset('site/images/angry.png')}}">
									<span class="emo_title">आक्रोशित</span>
								</div>
							</div>
						</div>

						<div class="response_section" x-data={first:true,second:false,third:false}>
							<div class="response_heading">
								<h1>प्रतिक्रिया</h1>
								<?php $comment_count = count($post_latest_cmts); ?>
								<span>
									<a href="#">{{$comment_count}}</a>
								</span>
							</div>
							
							<div class="d-flex flex-row text-muted response_menu my-4" style="font-size: 20px; cursor:pointer">
								<div x-on:click="first=true; second=false; third=false;" x-bind:class="first==true?'menu_active':'text-muted'">भर्खरै</div>
								<div class="ml-4" x-on:click="first=false; second=true; third=false;" x-bind:class="second==true?'menu_active':'text-muted'">लोकप्रिय</div>
								<div class="ml-4" x-on:click="first=false; second=false; third=true;" x-bind:class="third==true?'menu_active':'text-muted'">प्रतिक्रिया</div>
							</div>
							<div class="response_content" x-show="first">
								@foreach ($post_latest_cmts as $key=>$post_comment )
								<div class="response_content_warp">
									<div class="response_image">
										<img src="https://www.onlinekhabar.com/wp-content/themes/onlinekhabar-2018/img/userIcon.png">
									</div>
									<div class="response_comment">
										<div class="name">{{$post_comment->name}}</div>
										<div class="date">{!! changeFullDateTimeToNepaliFormat($post_comment->created_at) !!}</div>
										<div class="comments">
											{{$post_comment->comment}}
										</div>
										<div class="comments_ftr">
											<span class="icon_comment">
												<i class="fas fa-comment-alt"></i>
												<span class="react_number">0</span>
												<span>Comments</span>
											</span>
											<div class="like_warp">
												<span class="icon_comment">
													<a  class="interaction" id="like_id" data-cmt-id="like" data-comment_id="{{$post_comment->id}}"  data-cmt-status="false">
														<i class="fas fa-thumbs-up"></i>
													</a>
													<span class="react_number" id="like_score">{{$post_comment->comment_like}}</span>
													<span>Likes</span>
												</span>
											</div>
											<div class="dislike_warp">
												<span class="icon_comment">
													<a  class="interaction" id="dislike_id" data-cmt-id="dislike" data-comment_id="{{$post_comment->id}}">
														<i class="fas fa-thumbs-down"></i>
													</a>
													<span id="dislike_score" class="react_number">{{$post_comment->comment_dislike}}</span>
													<span>Dislikes</span>
												</span>
											</div>
											<div class="report_warp mr-4">
												<span class="icon_comment report_comment">
													<a  class="interaction" id="report_id" data-cmt-id="report" data-comment_id="{{$post_comment->id}}">
														<i class="fas fa-flag"></i>
													</a>
													<span>Report</span>
												</span>
											</div>

											<span class="reply_button mt-3" x-on:click="$refs.latest{{$key}}.style.display='block'" style="cursor: pointer">जवाफ दिनुहोस्</span>
										</div>
									</div>
									<div class="response_reply" style="display: none" x-ref="latest{{$key}}">
										<span class="comment_close" style="cursor: pointer" x-on:click="$refs.latest{{$key}}.style.display='none'">
											<i class="fas fa-times"></i>
										</span>
										<form class="reply_form" action="{{route('addComment')}}" method="POST">{{ csrf_field() }}
											<input type="hidden" name="post_id" value="{{$detail->id}}">
 											<div class="form_field">
												<div class="comment_form_row">
													<label>पुरानाम *</label>
													<input type="text" class="form-input" name="name">
													@error('name')
													<div class="text-danger error">{{ $message }}</div>
													@enderror
												</div>
												<div class="comment_form_row">
													<label>इमेल *</label>
													<input type="email" class="form-input" name="email">
													@error('email')
													<div class="text-danger error">{{ $message }}</div>
													@enderror
												</div>
												<div class="comment_form_row">
													<label>प्रतिकृया *</label>
													<textarea type="text" class="form-textarea" name="comment"></textarea>
													@error('comment')
													<div class="text-danger error">{{ $message }}</div>
													@enderror
												</div>
												<button type="submit" class="comment-submit-btn">पठाउनुहोस</button>
											</div>
										</form>
									</div>
								</div>
								@endforeach
							</div>

							<div class="response_content" x-show="second">
								@foreach ($most_liked_cmt as $index=>$post_comment )
								<div class="response_content_warp">
									<div class="response_image">
										<img src="https://www.onlinekhabar.com/wp-content/themes/onlinekhabar-2018/img/userIcon.png">
									</div>
									<div class="response_comment">
										<div class="name">{{$post_comment->name}}</div>
										<div class="date">{!! changeFullDateTimeToNepaliFormat($post_comment->created_at) !!}</div>
										<div class="comments">
											{{$post_comment->comment}}
										</div>
										<div class="comments_ftr">
											<span class="icon_comment">
												<i class="fas fa-comment-alt"></i>
												<span class="react_number">0</span>
												<span>Comments</span>
											</span>
											<div class="like_warp">
												<span class="icon_comment">
													<a  class="interaction" id="like_id" data-cmt-id="like" data-comment_id="{{$post_comment->id}}"  data-cmt-status="false">
														<i class="fas fa-thumbs-up"></i>
													</a>
													<span class="react_number" id="like_score">{{$post_comment->comment_like}}</span>
													<span>Likes</span>
												</span>
											</div>
											<div class="dislike_warp">
												<span class="icon_comment">
													<a  class="interaction" id="dislike_id" data-cmt-id="dislike" data-comment_id="{{$post_comment->id}}">
														<i class="fas fa-thumbs-down"></i>
													</a>
													<span id="dislike_score" class="react_number">{{$post_comment->comment_dislike}}</span>
													<span>Dislikes</span>
												</span>
											</div>
											<div class="report_warp mr-4">
												<span class="icon_comment report_comment">
													<a  class="interaction" id="report_id" data-cmt-id="report" data-comment_id="{{$post_comment->id}}">
														<i class="fas fa-flag"></i>
													</a>
													<span>Report</span>
												</span>
											</div>
											<span class="reply_button mt-4" x-on:click="$refs.favorite{{$index}}.style.display='block'" style="cursor:pointer">जवाफ दिनुहोस्</span>
										</div>
									</div>
									<div class="response_reply" style="display: none" x-ref="favorite{{$index}}">
										<span class="comment_close" style="cursor:pointer" x-on:click="$refs.favorite{{$index}}.style.display='none'">
											<i class="fas fa-times"></i>
										</span>
										<form class="reply_form" action="{{route('addComment')}}" method="POST">{{ csrf_field() }}
											<input type="hidden" name="post_id" value="{{$detail->id}}">
 											<div class="form_field">
												<div class="comment_form_row">
													<label>पुरानाम *</label>
													<input type="text" class="form-input" name="name">
													@error('name')
													<div class="text-danger error">{{ $message }}</div>
													@enderror
												</div>
												<div class="comment_form_row">
													<label>इमेल *</label>
													<input type="email" class="form-input" name="email">
													@error('email')
													<div class="text-danger error">{{ $message }}</div>
													@enderror
												</div>
												<div class="comment_form_row">
													<label>प्रतिकृया *</label>
													<textarea type="text" class="form-textarea" name="comment"></textarea>
													@error('comment')
													<div class="text-danger error">{{ $message }}</div>
													@enderror
												</div>
												<button type="submit" class="comment-submit-btn">पठाउनुहोस</button>
											</div>
										</form>
									</div>
								</div>
								@endforeach
							</div>
							
							<div x-show="third"> 
									<div class="comment_section">
										<form class="reply_form" action="{{route('addComment')}}" method="POST">{{ csrf_field() }}
											<input type="hidden" name="post_id" value="{{$detail->id}}">
											<div class="form_field">
												<div class="comment_form_row">
													<label>पुरानाम *</label>
													<input type="text" class="form-input" name="name">
													@error('name')
													<div class="text-danger error">{{ $message }}</div>
													@enderror
												</div>
												<div class="comment_form_row">
													<label>इमेल *</label>
													<input type="email" class="form-input" name="email">
													@error('name')
													<div class="text-danger error">{{ $message }}</div>
													@enderror
												</div>
												<div class="comment_form_row">
													<label>प्रतिकृया *</label>
													<textarea type="text" class="form-textarea" name="comment"></textarea>
													@error('comment')
													<div class="text-danger error">{{ $message }}</div>
													@enderror
												</div>
												<button type="submit" class="comment-submit-btn">पठाउनुहोस</button>
											</div>
										</form>
									</div>
							</div>
						</div>
						{{-- <div class="post__share__plugin">
							<div id="fb-root"></div>
							<div class="fb-comments" data-href="{{Request::url()}}" data-numposts="5" data-width="100%"></div>
						</div> --}}
						
						
						<div class="post__related post__mt-1">
							<div class="title__headFlex">
								<div class="news__title">
									<h2>सम्बन्धित खवर </h2>
								</div>
							</div>
							<div class="row no-gutters">
								@if(count($categorypostlist)>0)
								@foreach($categorypostlist as $kl =>$item)
								<div class="col* col-sm-6 col-md-4 col-lg-4 news__list1">
									<div class="news__md--1">
										<figure>
											<a href="{{ route('post.detail',$item->slug) }}">
												<img src="{{ getImage($item->image) }}" class="w-100" alt="{{ $item->title }}" title="{{ $item->title }}">
											</a>
										</figure>
										
										<div class="news__infos__md">
											<h3>
											<a href="{{ route('post.detail',$item->slug) }}">{{ str_limit($item->title,60) }}</a>
											</h3>
											<div class="post__time--1">
												<i class="las la-clock"></i> <span>{!! changeDateToNepaliFormat(Carbon\Carbon::parse($item->published_date)->format('Y-m-d')) !!}</span>
											</div>
										</div>
									</div>
								</div>
								@endforeach
								@endif
							</div>	
						</div>
					</div>
					<div class="col* col-md-4 col-lg-4 col-xl-3">
						@include('site.components.trending')
						@include('site.components.sidebar-ads')
						@include('site.components.mostpopular')
					</div>
				</div>
			</div>
		</div>	
	</section>
</main>

@endsection
{{-- @push('script') --}}
@section('js')
<script>
	$('.emoji').on('click',function(){
		var clicked=$('#laugh_id').attr("data-status");
		var selected_emoji=$(this).attr("data-id");
		var post_id=$(this).attr("data-post_id");
		var reaction_id=$(this).attr("data-reaction_id");

		if(clicked=="false"){
			$.ajax({
				url: "/updatereaction",
				type:"POST",
				data:{
					"_token": "{{ csrf_token() }}",
					selected_emoji:selected_emoji,
					post_id:post_id,
					reaction_id:reaction_id
				},
				success:function(response){      
					(response.data.laugh!=null)?$('#laugh_score').text(response.data.laugh):$('#laugh_score').text(0);
					(response.data.angry!=null)?$('#angry_score').text(response.data.angry):$('#angry_score').text(0);
					(response.data.confused!=null)?$('#confused_score').text(response.data.confused):$('#confused_score').text(0);
					(response.data.sad!=null)?$('#sad_score').text(response.data.sad):$('#sad_score').text(0);
					(response.data.happy!=null)?$('#happy_score').text(response.data.happy):$('#happy_score').text(0);

					$("#laugh_id").attr('data-reaction_id',response.data.id);
					$("#angry_id").attr('data-reaction_id',response.data.id);
					$("#confused_id").attr('data-reaction_id',response.data.id);
					$("#sad_id").attr('data-reaction_id',response.data.id);
					$("#happy_id").attr('data-reaction_id',response.data.id);

					$("#laugh_id").attr('data-status',"true");

					$("#emoji-alert").css("display", "block");

					$('#emoji-alert').text("Thank You For The Response");

					setTimeout(function(){
						$("#emoji-alert").fadeOut(2000);
					}, 2000);
				},
         	});	
		}
	});
</script>

<script>
	$('.interaction').on('click',function(){
		var interclicked=$('#like_id').attr("data-cmt-status");
		var selected_interaction=$(this).attr("data-cmt-id");
		var comment_id=$(this).attr("data-comment_id");
		var interclicked=$('#like_id').attr("data-cmt-status");
		if(interclicked=="false"){
			$.ajax({
				url: "/updateinteraction",
				type:"POST",
				data:{
					"_token": "{{ csrf_token() }}",
					selected_interaction:selected_interaction,
					comment_id:comment_id,
				},
				success:function(response){     
					(response.response.comment_like!=null)?$('#like_score').text(response.response.comment_like):$('#like_score').text(0);
					(response.response.comment_dislike!=null)?$('#dislike_score').text(response.response.comment_dislike):$('#dislike_score').text(0);
					$("#like_id").attr('data-cmt-status',"true");

				},
         	});	
		}
	});
</script>

<script type="text/javascript" src="{{ asset('site/js/rv-jquery-fontsize-2.0.3.js')}}"></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0" nonce="77BXNwxQ"></script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f252f920a246dd4"></script>
<script type="text/javascript" src="{{ asset('site/js/detail.js')}}"></script>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
{{-- @endpush
--}}
@endsection