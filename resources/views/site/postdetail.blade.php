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
											<img src="{{ getImage($sitedetail->logo) }}" alt="{{ $detail->title }}" title="{{ $detail->title }}">
										</figure>
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
							
							
						</div>
						
						@include('site.components.pagedetail-footer-ads')
						
						<div class="post_reaction">
							<div class="reaction_title">
								<div>
									<h1>यो खबर पढेर तपाईलाई कस्तो महसुस भयो ?</h1>
								</div>
							</div>
							<div class="post_reaction_emo">
								<div class="emoji" data-id="laugh" data-post_id="{{$detail->id}}" data-reaction_id="@if(isset($post_reaction->id)){{$post_reaction->id}}  @endif" >
									<span class="reaction_score">@if(isset($post_reaction->laugh)) {{$post_reaction->laugh}}@else 0 @endif</span>
									<img src="{{asset('site/images/laugh.png')}}">
									<span class="emo_title">उत्साहित</span>
								</div>
								<div class="emoji" data-id="sad" data-post_id="{{$detail->id}}" data-reaction_id="@if(isset($post_reaction->id)){{$post_reaction->id}}  @endif">
									<span class="reaction_score">@if(isset($post_reaction->sad)) {{$post_reaction->sad}}@else 0 @endif</span>
									<img src="{{asset('site/images/sad.png')}}">
									<span class="emo_title">दुःखी</span>
								</div>
								<div class="emoji" data-id="happy" data-post_id="{{$detail->id}}" data-reaction_id="@if(isset($post_reaction->id)){{$post_reaction->id}}  @endif">
									<span class="reaction_score">@if(isset($post_reaction->happy)) {{$post_reaction->happy}}@else 0 @endif</span>
									<img src="{{asset('site/images/happy.png')}}">
									<span class="emo_title">खुसी</span>
								</div>
								<div class="emoji"  data-id="confused" data-post_id="{{$detail->id}}" data-reaction_id="@if(isset($post_reaction->id)){{$post_reaction->id}}  @endif">
									<span class="reaction_score">@if(isset($post_reaction->confused)) {{$post_reaction->confused}}@else 0 @endif</span>
									<img src="{{asset('site/images/confused.png')}}">
									<span class="emo_title">अचम्मित</span>
								</div>
								<div class="emoji"  data-id="angry" data-post_id="{{$detail->id}}" data-reaction_id="@if(isset($post_reaction->id)){{$post_reaction->id}}  @endif">
									<span class="reaction_score">@if(isset($post_reaction->angry)) {{$post_reaction->angry}}@else 0 @endif</span>
									<img src="{{asset('site/images/angry.png')}}">
									<span class="emo_title">आक्रोशित</span>
								</div>
							</div>
						</div>


						<div class="response_section" x-data={first:true,second:false,third:false}>
							<div class="response_heading">
								<h1>प्रतिक्रिया</h1>
								<?php $comment_count = count($post_comments); ?>
								<span>
									<a href="#">{{$comment_count}}</a>
								</span>
							</div>
							<div class="d-flex flex-row text-muted response_menu my-4" style="font-size: 20px; cursor:pointer">
								<div x-on:click="first=true; second=false; third=false" x-bind:class="first==true?'menu_active':'text-muted'">भर्खरै</div>
								<div class="ml-4" x-on:click="first=false; second=true; third=false" x-bind:class="second==true?'menu_active':'text-muted'">लोकप्रिय</div>
								<div class="ml-4" x-on:click="first=false; second=false; third=true" x-bind:class="third==true?'menu_active':'text-muted'">प्रतिक्रिया</div>
							</div>
							<div class="response_content" x-show="first">
								@foreach ($post_comments as $post_comment )
								<div class="response_content_warp">
									<div class="response_image">
										<img src="https://www.onlinekhabar.com/wp-content/themes/onlinekhabar-2018/img/userIcon.png">
									</div>
									<div class="response_comment">
										<div class="name">{{$post_comment->name}}</div>
										<div class="date">२०७८ भदौ १६ गते २३:२७</div>
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
													<a href="">
														<i class="fas fa-thumbs-up"></i>
													</a>
													<span class="react_number">0</span>
													<a href="">Likes</a>
												</span>
											</div>
											<div class="dislike_warp">
												<span class="icon_comment">
													<a href="">
														<i class="fas fa-thumbs-down"></i>
													</a>
													<span class="react_number">0</span>
													<a href="">Likes</a>
												</span>
											</div>
											<span class="report_comment">
												<i class="fas fa-flag"></i>
												<a href="">Report</a>
											</span>
											<a href="" class="reply_button">जवाफ दिनुहोस्</a>
										</div>
									</div>
									<div class="response_reply"></div>
								</div>
								@endforeach
							</div>
							<div class="response_content" x-show="second">
								@foreach ($post_comments as $post_comment )
								<div class="response_content_warp">
									<div class="response_image">
										<img src="https://www.onlinekhabar.com/wp-content/themes/onlinekhabar-2018/img/userIcon.png">
									</div>
									<div class="response_comment">
										<div class="name">{{$post_comment->name}}</div>
										<div class="date">२०७८ भदौ १६ गते २३:२७</div>
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
													<a href="">
														<i class="fas fa-thumbs-up"></i>
													</a>
													<span class="react_number">0</span>
													<a href="">Likes</a>
												</span>
											</div>
											<div class="dislike_warp">
												<span class="icon_comment">
													<a href="">
														<i class="fas fa-thumbs-down"></i>
													</a>
													<span class="react_number">0</span>
													<a href="">Likes</a>
												</span>
											</div>
											<span class="report_comment">
												<i class="fas fa-flag"></i>
												<a href="">Report</a>
											</span>
											<a href="" class="reply_button">जवाफ दिनुहोस्</a>
										</div>
									</div>
									<div class="response_reply"></div>
								</div>
								@endforeach
							</div>
							
							<div x-show="third"> 
								<form action="{{route('addComment')}}" method="POST">{{ csrf_field() }}
									<div class="form_fields">
										<input type="hidden" name="post_id" value="{{$detail->id}}">
										<div class="form-group">
											<label for="exampleInputEmail1" style="font-size: 20px">पुरानाम *</label>
											<input type="text" class="form-control" style="height: 50px" name="name">
											@error('name')
												<div class="text-danger error">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group" >
											<label for="exampleInputEmail1" style="font-size: 20px">इमेल *</label>
											<input type="email" class="form-control" style="height: 50px" name="email">
											@error('email')
												<div class="text-danger error">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1" style="font-size: 20px">प्रतिकृया *</label>
											<textarea class="form-control" style="height: 100px" name="comment"></textarea>
											@error('comment')
												<div class="text-danger error">{{ $message }}</div>
											@enderror
										</div>

										<input type="submit" class="btn btn-primary px-5 py-2" value="पठाउनुहोस" style="font-size: 15px; border-radius:50px"/>
									</div>
								</form>		
							</div>
						</div>
						<div class="post__share__plugin">
							<div id="fb-root"></div>
							<div class="fb-comments" data-href="{{Request::url()}}" data-numposts="5" data-width="100%"></div>
						</div>
						
						
						<div class="post__related post__mt-1">
							<div class="title__headFlex">
								<div class="news__title">
									<h2>सम्बन्धित खवर </h2>
								</div>
							</div>
							<div class="row no-gutters">
								@if(count($categorypostlist)>0)
								@foreach($categorypostlist as $kl =>$item)
								<div class="col* col-sm-6 col-md-4 col-lg-3 news__list1">
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
						@include('site.components.taja')
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
		var selected_emoji=$(this).attr("data-id");
		var post_id=$(this).attr("data-post_id");
		var reaction_id=$(this).attr("data-reaction_id");
		$.ajax({
          url: "/updatereaction",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            selected_emoji:selected_emoji,
			post_id:post_id,
			reaction_id:reaction_id,

          },
          success:function(response){
            console.log(response);
          },
         });
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