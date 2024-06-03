@extends('layouts.app')

@section('css')
	<!-- Sweet Alert CSS -->
	<link href="{{URL::asset('plugins/sweetalert/sweetalert2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
	<div class="row mt-24">

		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card border-0 templates-nav-header">
				<div class="card-body">
					<div>
						<h3 class="card-title mb-3 ml-2 fs-20"><i class="fa-solid fa-microchip-ai mr-2 text-primary"></i>{{ __('Templates') }}</h3>
						<h6 class="text-muted mb-3 ml-2">{{ __('Seeking that perfect content? Look no further! Get ready to explore our fantastic lineup of templates') }}</h6>
						<div class="search-template">
							<div class="input-box">								
								<div class="form-group">							    
									<input type="text" class="form-control" id="search-template" placeholder="{{ __('Search for your template...') }}">
								</div> 
							</div> 
						</div>
					</div>

					<div class="templates-nav-menu">
						<div class="template-nav-menu-inner">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item" role="presentation">
									<button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">{{ __('All Templates') }}</button>
								</li>
								@foreach ($categories as $category)
									@if (strtolower($category->name) != 'other')
										<li class="nav-item category-check" role="presentation">
											<button class="nav-link" id="{{ $category->code }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $category->code }}" type="button" role="tab" aria-controls="{{ $category->code }}" aria-selected="false">{{ __($category->name) }}</button>
										</li>
									@endif									
								@endforeach	
								@foreach ($categories as $category)
								@if (strtolower($category->name) == 'other')
									<li class="nav-item category-check" role="presentation">
										<button class="nav-link" id="{{ $category->code }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $category->code }}" type="button" role="tab" aria-controls="{{ $category->code }}" aria-selected="false">{{ __($category->name) }}</button>
									</li>
								@endif									
							@endforeach				
							</ul>
						</div>
					</div>					
				</div>
			</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="pt-2">
				<div class="favorite-templates-panel">

					<div class="tab-content" id="myTabContent">

						<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
							<div class="row" id="templates-panel">
								@foreach ($categories as $category)
									@if (strtolower($category->name) != 'other')
										<div class="col-12 templates-panel-group @if($loop->first) @else  mt-3 @endif">
											<h6 class="fs-14 font-weight-bold text-muted">{{ __($category->name) }}</h6>
											<h4 class="fs-12 text-muted">{{ __($category->description) }}</h4>
										</div>						
									
										@foreach ($favorite_templates as $template)
											@if ($template->group == $category->code)
												<div class="col-lg-3 col-md-6 col-sm-12">
													<div class="template">
														<a id="{{ $template->template_code }}" @if($template->favorite) data-tippy-content="{{ __('Remove from favorite') }}" @else data-tippy-content="{{ __('Select as favorite') }}" @endif onclick="favoriteStatus(this.id)"><i id="{{ $template->template_code }}-icon" class="@if($template->favorite) fa-solid fa-stars @else fa-regular fa-star @endif star"></i></a>
														<div class="card @if($template->package == 'professional') professional @elseif($template->package == 'premium') premium @elseif($template->favorite) favorite @else border-0 @endif" id="{{ $template->template_code }}-card" onclick="window.location.href='{{ url('user/templates/original-template') }}/{{ $template->slug }}'">
															<div class="card-body pt-5">
																<div class="template-icon mb-4">
																	{!! $template->icon !!}												
																</div>
																<div class="template-title">
																	<h6 class="mb-2 fs-15 number-font">{{ __($template->name) }}</h6>
																</div>
																<div class="template-info">
																	<p class="fs-13 text-muted mb-2">{{ __($template->description) }}</p>
																</div>
																@if($template->package == 'professional') 
																	<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i>{{ __('Pro') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->package == 'free')
																	<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i>{{ __('Free') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->package == 'premium')
																	<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i>{{ __('Premium') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->new)
																	<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</span>
																@endif	
															</div>
														</div>
													</div>							
												</div>
											@endif
											
										@endforeach

										@foreach ($favorite_custom_templates as $template)
											@if ($template->group == $category->code)
												<div class="col-lg-3 col-md-6 col-sm-12">
													<div class="template">
														<a id="{{ $template->template_code }}" @if($template->favorite) data-tippy-content="{{ __('Remove from favorite') }}" @else data-tippy-content="{{ __('Select as favorite') }}" @endif onclick="favoriteStatusCustom(this.id)"><i id="{{ $template->template_code }}-icon" class="@if($template->favorite) fa-solid fa-stars @else fa-regular fa-star @endif star"></i></a>
														<div class="card @if($template->package == 'professional') professional @elseif($template->package == 'premium') premium @elseif($template->favorite) favorite @else border-0 @endif" id="{{ $template->template_code }}-card" onclick="window.location.href='{{ url('user/templates') }}/{{ $template->slug }}/{{ $template->template_code }}'">
															<div class="card-body pt-5">
																<div class="template-icon mb-4">
																	{!! $template->icon !!}												
																</div>
																<div class="template-title">
																	<h6 class="mb-2 fs-15 number-font">{{ __($template->name) }}</h6>
																</div>
																<div class="template-info">
																	<p class="fs-13 text-muted mb-2">{{ __($template->description) }}</p>
																</div>
																@if($template->package == 'professional') 
																	<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i>{{ __('Pro') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->package == 'free')
																	<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i>{{ __('Free') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->package == 'premium')
																	<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i>{{ __('Premium') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->new)
																	<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</span>
																@endif	
															</div>
														</div>
													</div>							
												</div>
											@endif
										@endforeach
				
										@foreach ($other_templates as $template)
											@if ($template->group == $category->code)
												<div class="col-lg-3 col-md-6 col-sm-12">
													<div class="template">
														<a id="{{ $template->template_code }}" @if($template->favorite) data-tippy-content="{{ __('Remove from favorite') }}" @else data-tippy-content="{{ __('Select as favorite') }}" @endif onclick="favoriteStatus(this.id)"><i id="{{ $template->template_code }}-icon" class="@if($template->favorite) fa-solid fa-stars @else fa-regular fa-star @endif star"></i></a>
														<div class="card @if($template->package == 'professional') professional @elseif($template->package == 'premium') premium @elseif($template->favorite) favorite @else border-0 @endif" id="{{ $template->template_code }}-card" onclick="window.location.href='{{ url('user/templates/original-template') }}/{{ $template->slug }}'">
															<div class="card-body pt-5">
																<div class="template-icon mb-4">
																	{!! $template->icon !!}												
																</div>
																<div class="template-title">
																	<h6 class="mb-2 fs-15 number-font">{{ __($template->name) }}</h6>
																</div>
																<div class="template-info">
																	<p class="fs-13 text-muted mb-2">{{ __($template->description) }}</p>
																</div>
																@if($template->package == 'professional') 
																	<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i>{{ __('Pro') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->package == 'free')
																	<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i>{{ __('Free') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->package == 'premium')
																	<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i>{{ __('Premium') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->new)
																	<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</span>
																@endif		
															</div>
														</div>
													</div>							
												</div>
											@endif
										@endforeach	
										
										@foreach ($custom_templates as $template)
											@if ($template->group == $category->code)
												<div class="col-lg-3 col-md-6 col-sm-12">
													<div class="template">
														<a id="{{ $template->template_code }}" @if($template->favorite) data-tippy-content="{{ __('Remove from favorite') }}" @else data-tippy-content="{{ __('Select as favorite') }}" @endif onclick="favoriteStatusCustom(this.id)"><i id="{{ $template->template_code }}-icon" class="@if($template->favorite) fa-solid fa-stars @else fa-regular fa-star @endif star"></i></a>
														<div class="card @if($template->package == 'professional') professional @elseif($template->package == 'premium') premium @elseif($template->favorite) favorite @else border-0 @endif" id="{{ $template->template_code }}-card" onclick="window.location.href='{{ url('user/templates') }}/{{ $template->slug }}/{{ $template->template_code }}'">
															<div class="card-body pt-5">
																<div class="template-icon mb-4">
																	{!! $template->icon !!}												
																</div>
																<div class="template-title">
																	<h6 class="mb-2 fs-15 number-font">{{ __($template->name) }}</h6>
																</div>
																<div class="template-info">
																	<p class="fs-13 text-muted mb-2">{{ __($template->description) }}</p>
																</div>
																@if($template->package == 'professional') 
																	<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i>{{ __('Pro') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->package == 'free')
																	<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i>{{ __('Free') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->package == 'premium')
																	<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i>{{ __('Premium') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->new)
																	<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</span>
																@endif	
															</div>
														</div>
													</div>							
												</div>
											@endif
										@endforeach
									@endif	
								@endforeach		

								@foreach ($categories as $category)
									@if (strtolower($category->name) == 'other')
										<div class="col-12 templates-panel-group @if($loop->first) @else  mt-3 @endif">
											<h6 class="fs-14 font-weight-bold text-muted">{{ __($category->name) }}</h6>
											<h4 class="fs-12 text-muted">{{ __($category->description) }}</h4>
										</div>					
									
										@foreach ($favorite_templates as $template)
											@if ($template->group == $category->code)
												<div class="col-lg-3 col-md-6 col-sm-12">
													<div class="template">
														<a id="{{ $template->template_code }}" @if($template->favorite) data-tippy-content="{{ __('Remove from favorite') }}" @else data-tippy-content="{{ __('Select as favorite') }}" @endif onclick="favoriteStatus(this.id)"><i id="{{ $template->template_code }}-icon" class="@if($template->favorite) fa-solid fa-stars @else fa-regular fa-star @endif star"></i></a>
														<div class="card @if($template->package == 'professional') professional @elseif($template->package == 'premium') premium @elseif($template->favorite) favorite @else border-0 @endif" id="{{ $template->template_code }}-card" onclick="window.location.href='{{ url('user/templates/original-template') }}/{{ $template->slug }}'">
															<div class="card-body pt-5">
																<div class="template-icon mb-4">
																	{!! $template->icon !!}												
																</div>
																<div class="template-title">
																	<h6 class="mb-2 fs-15 number-font">{{ __($template->name) }}</h6>
																</div>
																<div class="template-info">
																	<p class="fs-13 text-muted mb-2">{{ __($template->description) }}</p>
																</div>
																@if($template->package == 'professional') 
																	<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i>{{ __('Pro') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->package == 'free')
																	<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i>{{ __('Free') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->package == 'premium')
																	<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i>{{ __('Premium') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->new)
																	<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</span>
																@endif	
															</div>
														</div>
													</div>							
												</div>
											@endif
											
										@endforeach

										@foreach ($favorite_custom_templates as $template)
											@if ($template->group == $category->code)
												<div class="col-lg-3 col-md-6 col-sm-12">
													<div class="template">
														<a id="{{ $template->template_code }}" @if($template->favorite) data-tippy-content="{{ __('Remove from favorite') }}" @else data-tippy-content="{{ __('Select as favorite') }}" @endif onclick="favoriteStatusCustom(this.id)"><i id="{{ $template->template_code }}-icon" class="@if($template->favorite) fa-solid fa-stars @else fa-regular fa-star @endif star"></i></a>
														<div class="card @if($template->package == 'professional') professional @elseif($template->package == 'premium') premium @elseif($template->favorite) favorite @else border-0 @endif" id="{{ $template->template_code }}-card" onclick="window.location.href='{{ url('user/templates') }}/{{ $template->slug }}/{{ $template->template_code }}'">
															<div class="card-body pt-5">
																<div class="template-icon mb-4">
																	{!! $template->icon !!}												
																</div>
																<div class="template-title">
																	<h6 class="mb-2 fs-15 number-font">{{ __($template->name) }}</h6>
																</div>
																<div class="template-info">
																	<p class="fs-13 text-muted mb-2">{{ __($template->description) }}</p>
																</div>
																@if($template->package == 'professional') 
																	<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i>{{ __('Pro') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->package == 'free')
																	<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i>{{ __('Free') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->package == 'premium')
																	<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i>{{ __('Premium') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->new)
																	<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</span>
																@endif	
															</div>
														</div>
													</div>							
												</div>
											@endif
										@endforeach
				
										@foreach ($other_templates as $template)
											@if ($template->group == $category->code)
												<div class="col-lg-3 col-md-6 col-sm-12">
													<div class="template">
														<a id="{{ $template->template_code }}" @if($template->favorite) data-tippy-content="{{ __('Remove from favorite') }}" @else data-tippy-content="{{ __('Select as favorite') }}" @endif onclick="favoriteStatus(this.id)"><i id="{{ $template->template_code }}-icon" class="@if($template->favorite) fa-solid fa-stars @else fa-regular fa-star @endif star"></i></a>
														<div class="card @if($template->package == 'professional') professional @elseif($template->package == 'premium') premium @elseif($template->favorite) favorite @else border-0 @endif" id="{{ $template->template_code }}-card" onclick="window.location.href='{{ url('user/templates/original-template') }}/{{ $template->slug }}'">
															<div class="card-body pt-5">
																<div class="template-icon mb-4">
																	{!! $template->icon !!}												
																</div>
																<div class="template-title">
																	<h6 class="mb-2 fs-15 number-font">{{ __($template->name) }}</h6>
																</div>
																<div class="template-info">
																	<p class="fs-13 text-muted mb-2">{{ __($template->description) }}</p>
																</div>
																@if($template->package == 'professional') 
																	<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i>{{ __('Pro') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->package == 'free')
																	<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i>{{ __('Free') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->package == 'premium')
																	<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i>{{ __('Premium') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->new)
																	<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</span>
																@endif	
															</div>
														</div>
													</div>							
												</div>
											@endif
										@endforeach	
										
										@foreach ($custom_templates as $template)
											@if ($template->group == $category->code)
												<div class="col-lg-3 col-md-6 col-sm-12">
													<div class="template">
														<a id="{{ $template->template_code }}" @if($template->favorite) data-tippy-content="{{ __('Remove from favorite') }}" @else data-tippy-content="{{ __('Select as favorite') }}" @endif onclick="favoriteStatusCustom(this.id)"><i id="{{ $template->template_code }}-icon" class="@if($template->favorite) fa-solid fa-stars @else fa-regular fa-star @endif star"></i></a>
														<div class="card @if($template->package == 'professional') professional @elseif($template->package == 'premium') premium @elseif($template->favorite) favorite @else border-0 @endif" id="{{ $template->template_code }}-card" onclick="window.location.href='{{ url('user/templates') }}/{{ $template->slug }}/{{ $template->template_code }}'">
															<div class="card-body pt-5">
																<div class="template-icon mb-4">
																	{!! $template->icon !!}												
																</div>
																<div class="template-title">
																	<h6 class="mb-2 fs-15 number-font">{{ __($template->name) }}</h6>
																</div>
																<div class="template-info">
																	<p class="fs-13 text-muted mb-2">{{ __($template->description) }}</p>
																</div>
																@if($template->package == 'professional') 
																	<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i>{{ __('Pro') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->package == 'free')
																	<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i>{{ __('Free') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->package == 'premium')
																	<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i>{{ __('Premium') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
																@elseif($template->new)
																	<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</span>
																@endif	
															</div>
														</div>
													</div>							
												</div>
											@endif
										@endforeach
									@endif	
								@endforeach	
							</div>	
						</div>

						@foreach ($categories as $category)
							<div class="tab-pane fade" id="{{ $category->code }}" role="tabpanel" aria-labelledby="{{ $category->code }}-tab">
								<div class="row" id="templates-panel">
									@foreach ($favorite_templates as $template)
										@if ($template->group == $category->code)
											<div class="col-lg-3 col-md-6 col-sm-12">
												<div class="template">
													<a id="{{ $template->template_code }}" @if($template->favorite) data-tippy-content="{{ __('Remove from favorite') }}" @else data-tippy-content="{{ __('Select as favorite') }}" @endif onclick="favoriteStatus(this.id)"><i id="{{ $template->template_code }}-icon" class="@if($template->favorite) fa-solid fa-stars @else fa-regular fa-star @endif star"></i></a>
													<div class="card @if($template->package == 'professional') professional @elseif($template->package == 'premium') premium @elseif($template->favorite) favorite @else border-0 @endif" id="{{ $template->template_code }}-card" onclick="window.location.href='{{ url('user/templates/original-template') }}/{{ $template->slug }}'">
														<div class="card-body pt-5">
															<div class="template-icon mb-4">
																{!! $template->icon !!}												
															</div>
															<div class="template-title">
																<h6 class="mb-2 fs-15 number-font">{{ __($template->name) }}</h6>
															</div>
															<div class="template-info">
																<p class="fs-13 text-muted mb-2">{{ __($template->description) }}</p>
															</div>
															@if($template->package == 'professional') 
																<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i>{{ __('Pro') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
															@elseif($template->package == 'free')
																<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i>{{ __('Free') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
															@elseif($template->package == 'premium')
																<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i>{{ __('Premium') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
															@elseif($template->new)
																<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</span>
															@endif	
														</div>
													</div>
												</div>							
											</div>
										@endif									
									@endforeach

									@foreach ($favorite_custom_templates as $template)
										@if ($template->group == $category->code)
											<div class="col-lg-3 col-md-6 col-sm-12">
												<div class="template">
													<a id="{{ $template->template_code }}" @if($template->favorite) data-tippy-content="{{ __('Remove from favorite') }}" @else data-tippy-content="{{ __('Select as favorite') }}" @endif onclick="favoriteStatusCustom(this.id)"><i id="{{ $template->template_code }}-icon" class="@if($template->favorite) fa-solid fa-stars @else fa-regular fa-star @endif star"></i></a>
													<div class="card @if($template->package == 'professional') professional @elseif($template->package == 'premium') premium @elseif($template->favorite) favorite @else border-0 @endif" id="{{ $template->template_code }}-card" onclick="window.location.href='{{ url('user/templates') }}/{{ $template->slug }}/{{ $template->template_code }}'">
														<div class="card-body pt-5">
															<div class="template-icon mb-4">
																{!! $template->icon !!}												
															</div>
															<div class="template-title">
																<h6 class="mb-2 fs-15 number-font">{{ __($template->name) }}</h6>
															</div>
															<div class="template-info">
																<p class="fs-13 text-muted mb-2">{{ __($template->description) }}</p>
															</div>
															@if($template->package == 'professional') 
																<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i>{{ __('Pro') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
															@elseif($template->package == 'free')
																<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i>{{ __('Free') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
															@elseif($template->package == 'premium')
																<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i>{{ __('Premium') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
															@elseif($template->new)
																<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</span>
															@endif	
														</div>
													</div>
												</div>							
											</div>
										@endif
									@endforeach
			
									@foreach ($other_templates as $template)
										@if ($template->group == $category->code)
											<div class="col-lg-3 col-md-6 col-sm-12">
												<div class="template">
													<a id="{{ $template->template_code }}" @if($template->favorite) data-tippy-content="{{ __('Remove from favorite') }}" @else data-tippy-content="{{ __('Select as favorite') }}" @endif onclick="favoriteStatus(this.id)"><i id="{{ $template->template_code }}-icon" class="@if($template->favorite) fa-solid fa-stars @else fa-regular fa-star @endif star"></i></a>
													<div class="card @if($template->package == 'professional') professional @elseif($template->package == 'premium') premium @elseif($template->favorite) favorite @else border-0 @endif" id="{{ $template->template_code }}-card" onclick="window.location.href='{{ url('user/templates/original-template') }}/{{ $template->slug }}'">
														<div class="card-body pt-5">
															<div class="template-icon mb-4">
																{!! $template->icon !!}												
															</div>
															<div class="template-title">
																<h6 class="mb-2 fs-15 number-font">{{ __($template->name) }}</h6>
															</div>
															<div class="template-info">
																<p class="fs-13 text-muted mb-2">{{ __($template->description) }}</p>
															</div>
															@if($template->package == 'professional') 
																<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i>{{ __('Pro') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
															@elseif($template->package == 'free')
																<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i>{{ __('Free') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
															@elseif($template->package == 'premium')
																<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i>{{ __('Premium') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
															@elseif($template->new)
																<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</span>
															@endif	
														</div>
													</div>
												</div>							
											</div>	
										@endif									
									@endforeach		

									@foreach ($custom_templates as $template)
										@if ($template->group == $category->code)
											<div class="col-lg-3 col-md-6 col-sm-12">
												<div class="template">
													<a id="{{ $template->template_code }}" @if($template->favorite) data-tippy-content="{{ __('Remove from favorite') }}" @else data-tippy-content="{{ __('Select as favorite') }}" @endif onclick="favoriteStatusCustom(this.id)"><i id="{{ $template->template_code }}-icon" class="@if($template->favorite) fa-solid fa-stars @else fa-regular fa-star @endif star"></i></a>
													<div class="card @if($template->package == 'professional') professional @elseif($template->package == 'premium') premium @elseif($template->favorite) favorite @else border-0 @endif" id="{{ $template->template_code }}-card" onclick="window.location.href='{{ url('user/templates') }}/{{ $template->slug }}/{{ $template->template_code }}'">
														<div class="card-body pt-5">
															<div class="template-icon mb-4">
																{!! $template->icon !!}												
															</div>
															<div class="template-title">
																<h6 class="mb-2 fs-15 number-font">{{ __($template->name) }}</h6>
															</div>
															<div class="template-info">
																<p class="fs-13 text-muted mb-2">{{ __($template->description) }}</p>
															</div>
															@if($template->package == 'professional') 
																<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i>{{ __('Pro') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
															@elseif($template->package == 'free')
																<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i>{{ __('Free') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
															@elseif($template->package == 'premium')
																<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i>{{ __('Premium') }} @if($template->new) <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</p> @endif</p> 
															@elseif($template->new)
																<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</span>
															@endif	
														</div>
													</div>
												</div>							
											</div>
										@endif
									@endforeach	
								</div>
							</div>
						@endforeach	
					

					</div>
									
				</div>
			</div>
		</div>

	</div>
@endsection

@section('js')
	<script src="{{URL::asset('plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
	<script>
		function favoriteStatus(id) {

			let icon, card;
			let formData = new FormData();
			formData.append("id", id);

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'post',
				url: 'dashboard/favorite',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {

					if (data['status'] == 'success') {
						if (data['set']) {
							Swal.fire('{{ __('Template Removed from Favorites') }}', '{{ __('Selected template has been successfully removed from favorites') }}', 'success');
							icon = document.getElementById(id + '-icon');
							icon.classList.remove("fa-solid");
							icon.classList.remove("fa-stars");
							icon.classList.add("fa-regular");
							icon.classList.add("fa-star");

							card = document.getElementById(id + '-card');
							if(card.classList.contains("professional")) {
								// do nothing
							} else {
								card.classList.remove("favorite");
								card.classList.add('border-0');
							}							
						} else {
							Swal.fire('{{ __('Template Added to Favorites') }}', '{{ __('Selected template has been successfully added to favorites') }}', 'success');
							icon = document.getElementById(id + '-icon');
							icon.classList.remove("fa-regular");
							icon.classList.remove("fa-star");
							icon.classList.add("fa-solid");
							icon.classList.add("fa-stars");

							card = document.getElementById(id + '-card');
							if(card.classList.contains("professional")) {
								// do nothing
							} else {
								card.classList.add('favorite');
								card.classList.remove('border-0');
							}
						}
														
					} else {
						Swal.fire('{{ __('Favorite Setting Issue') }}', '{{ __('There as an issue with setting favorite status for this template') }}', 'warning');
					}      
				},
				error: function(data) {
					Swal.fire('Oops...','Something went wrong!', 'error')
				}
			})	
		}

		$(document).on('keyup', '#search-template', function () {

			$('#all-tab').click();

			var searchTerm = $(this).val().toLowerCase();
			$('#all #templates-panel').find('> div').each(function () {
				if ($(this).filter(function() {
					return $(this).find('h6').text().toLowerCase().indexOf(searchTerm) > -1;
				}).length > 0 || searchTerm.length < 1) {
					$(this).show();
				} else {
					$(this).hide();
					$('.templates-panel-group').hide();
				}
			});
		});

		$('.category-check').on('click', function (e) {
			e.preventDefault();
			$('#search-template').val('');
			$('.templates-panel-group').show();
			$('#all #templates-panel').find('> div').each(function () {
				$(this).show();
			});
		});

		function favoriteStatusCustom(id) {

			let icon, card;
			let formData = new FormData();
			formData.append("id", id);

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'post',
				url: 'dashboard/favoritecustom',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {

					if (data['status'] == 'success') {
						if (data['set']) {
							Swal.fire('{{ __('Template Removed from Favorites') }}', '{{ __('Selected template has been successfully removed from favorites') }}', 'success');
							icon = document.getElementById(id + '-icon');
							icon.classList.remove("fa-solid");
							icon.classList.remove("fa-stars");
							icon.classList.add("fa-regular");
							icon.classList.add("fa-star");

							card = document.getElementById(id + '-card');
							if(card.classList.contains("professional")) {
								// do nothing
							} else {
								card.classList.remove("favorite");
								card.classList.add('border-0');
							}							
						} else {
							Swal.fire('{{ __('Template Added to Favorites') }}', '{{ __('Selected template has been successfully added to favorites') }}', 'success');
							icon = document.getElementById(id + '-icon');
							icon.classList.remove("fa-regular");
							icon.classList.remove("fa-star");
							icon.classList.add("fa-solid");
							icon.classList.add("fa-stars");

							card = document.getElementById(id + '-card');
							if(card.classList.contains("professional")) {
								// do nothing
							} else {
								card.classList.add('favorite');
								card.classList.remove('border-0');
							}
						}
														
					} else {
						Swal.fire('{{ __('Favorite Setting Issue') }}', '{{ __('There as an issue with setting favorite status for this template') }}', 'warning');
					}      
				},
				error: function(data) {
					Swal.fire('Oops...','Something went wrong!', 'error')
				}
			})
		}
	</script>
@endsection
