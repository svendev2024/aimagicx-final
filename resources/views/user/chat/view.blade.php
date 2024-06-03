@extends('layouts.app')
@section('css')
	<!-- Sweet Alert CSS -->
	<link href="{{URL::asset('plugins/sweetalert/sweetalert2.min.css')}}" rel="stylesheet" />
@endsection

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __($chat->name) }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{route('user.dashboard')}}"><i class="fa-solid fa-messages-question mr-2 fs-12"></i>{{ __('User') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{route('user.chat')}}"> {{ __('AI Chat Assistants') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __($chat->name) }}</a></li>
			</ol>
		</div>
		<div class="page-rightheader">
			<div id="balance-status">
				<span class="fs-11 text-muted pl-3"><i class="fa-sharp fa-solid fa-bolt-lightning mr-2 text-primary"></i>{{ __('Your Balance is') }} <span class="font-weight-semibold" id="balance-number">{{ number_format(auth()->user()->available_words + auth()->user()->available_words_prepaid) }}</span> {{ __('Words') }}</span>
			</div>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')
	<form id="openai-form" action="" method="GET" enctype="multipart/form-data">		
		@csrf
		<div class="row justify-content-md-center">	
			
			<div class="chat-main-container">
				<div class="chat-sidebar-container">
					<div class="chat-sidebar-messages">
						@foreach ($messages as $key => $message)

							<div class="chat-sidebar-message @if ($loop->first) selected-message @endif" id="{{ $message->message_code }}">
								<div class="chat-title" id="title-{{ $message->message_code }}">
									{{ __($message->title) }}
								</div>
								<div class="chat-info">
									<div class="chat-count"><span>{{ $message->messages }}</span> {{ __('messages') }}</div>
									<div class="chat-date">{{ \Carbon\Carbon::parse($message->updated_at)->diffForhumans() }}</div>
								</div>
								<div class="chat-actions d-flex">
									<a href="#" class="chat-edit fs-12" id="{{ $message->message_code }}"><i class="fa-sharp fa-solid fa-pen-to-square" data-tippy-content="{{ __('Edit Name') }}"></i></a>
									<a href="#" class="chat-delete fs-12 ml-2" id="{{ $message->message_code }}"><i class="fa-sharp fa-solid fa-trash" data-tippy-content="{{ __('Delete Chat') }}"></i></a>
								</div>
							</div>
						
						@endforeach						
					</div>
					<div class="card-footer">
						<div class="row text-center">						
							<div class="col-sm-12">									
								<a class="btn btn-primary pl-5 pr-5 mt-1" id="new-chat-button">{{ __('New Chat') }}</a>
							</div>
						</div>
					</div>
				</div>

				<div class="chat-message-container" id="chat-system">
					<div class="card-header">
						<div class="w-100 pt-2 pb-2">
							<div class="d-flex">
								<div class="overflow-hidden mr-4"><img alt="Avatar" class="chat-avatar" src="{{ URL::asset($chat->logo) }}"></div>
								<div class="widget-user-name"><span class="font-weight-bold">{{ __($chat->name) }}</span><br><span class="text-muted">{{ __($chat->sub_name) }}</span></div>
							</div>
						</div>
						<div class="w-50 text-right pt-2 pb-2">				
							<a id="expand" class="template-button" href="#"><i class="fa-solid fa-bars table-action-buttons table-action-buttons-big edit-action-button" data-tippy-content="{{ __('Show Chat Conversations') }}"></i></a>
							<a id="export-word" class="template-button mr-2" onclick="exportWord();" href="#"><i class="fa-solid fa-file-word table-action-buttons table-action-buttons-big edit-action-button" data-tippy-content="{{ __('Export Chat Conversation as Word File') }}"></i></a>
							<a id="export-pdf" class="template-button mr-2" onclick="exportPDF();" href="#"><i class="fa-solid fa-file-pdf table-action-buttons table-action-buttons-big edit-action-button" data-tippy-content="{{ __('Export Chat Conversation as PDF File') }}"></i></a>
							<a id="export-txt" class="template-button mr-2" onclick="exportTXT();" href="#"><i class="fa-solid fa-file-lines table-action-buttons table-action-buttons-big edit-action-button" data-tippy-content="{{ __('Export Chat Conversation Text File') }}"></i></a>
							{{-- <a id="clear" class="template-button" onclick="return clearConversation();" href="#"><i class="fa-solid fa-message-xmark table-action-buttons table-action-buttons-big delete-action-button" data-tippy-content="{{ __('Clear Chat Conversation') }}"></i></a> --}}
						</div>
					</div>
					<div class="card-body pl-0 pr-0">
						<div class="row">						
							<div class="col-md-12 col-sm-12" >
								{{-- <div class="msg left-msg ml-">
									<div class="message-img" style="background-image: url('/img/brand/favicon.png')"></div>
									<div class="message-bubble">
										<div class="msg-text">Some useful text</div>
									</div>
								</div>	 --}}
								<div id="chat-container"></div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="row">						
							<div class="col-sm-12">	
								
								<div class="input-box mb-0">								
									<div class="input-group file-browser">							    
										<input type="message" class="form-control @error('message') is-danger @enderror border-right-0" style="margin-right: 80px;" id="message" name="message" autocomplete="off" placeholder="{{ __('Enter your question here...') }}">
										<label class="input-group-btn">
											<button class="btn btn-primary special-btn" id="chat-button">
												{{ __('Send') }}
											</button>
										</label>
									</div> 
									@error('message')
										<p class="text-danger">{{ $errors->first('message') }}</p>
									@enderror
								</div> 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection

@section('js')
<script src="{{URL::asset('plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
<script src="{{URL::asset('plugins/pdf/html2canvas.min.js')}}"></script>
<script src="{{URL::asset('plugins/pdf/jspdf.umd.min.js')}}"></script>
<script src="{{URL::asset('js/export-chat.js')}}"></script>
<script type="text/javascript">
	const main_form = get("#openai-form");
	const input_text = get("#message");
	const msgerChat = get("#chat-container");
	const msgerSendBtn = get("#chat-button");
	const bot_avatar = "{{ $chat->logo }}";
	const user_avatar = "{{ URL::asset(auth()->user()->profile_photo_path) }}";	
	let chat_code = "{{ $chat->chat_code }}";	
	let active_id;
	let default_message;

	// Process deault chat message	
	$(document).ready(function() {
		$(".chat-sidebar-message").first().focus().trigger('click');

		let check_messages = document.querySelectorAll('.chat-sidebar-message').length;
		if (check_messages == 0) {
			let id = makeid(10);
			$('#chat-container').html('');
			
			$('.chat-sidebar-messages').prepend(`<div class="chat-sidebar-message selected-message" id=${id}>
					<div class="chat-title" id="title-${id}">
						{{ __('New Chat') }}
					</div>
					<div class="chat-info">
						<div class="chat-count"><span>0</span> {{ __('messages') }}</div>
						<div class="chat-date">{{ __('Now') }}</div>
					</div>
					<div class="chat-actions d-flex">
						<a href="#" class="chat-edit id=${id} fs-12"><i class="fa-sharp fa-solid fa-pen-to-square" data-tippy-content="{{ __('Edit Name') }}"></i></a>
						<a href="#" class="chat-delete  id=${id} fs-12 ml-2"><i class="fa-sharp fa-solid fa-trash" data-tippy-content="{{ __('Delete Chat') }}"></i></a>
					</div>
				</div>`);
			active_id = id;
		}
	});
	

	// Change message box styles
	$(document).on('click', ".chat-sidebar-message", function (e) { 

		$('.chat-sidebar-message').removeClass('selected-message');
		$(this).addClass('selected-message');
		active_id = this.id;

		$('.chat-sidebar-container').removeClass('extend');

		$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'POST',
				url: '/user/chat/messages',
				data: { 'code': active_id,},
				success: function (data) {
					$('#chat-container').html('');

					let messages = document.querySelectorAll('.chat-sidebar-message').length;
					if (messages >= 1) {
						let json = isJson(data)
						if (json) {
							let result = JSON.parse(data);
							if (result['chat']) {
								let chat = result['chat'];

								for(const key in chat) {
									if (chat[key]['role'] == 'user') {
										appendMessage(user_avatar, "right", chat[key]['content']);
									} else if (chat[key]['role'] == 'assistant') {
										appendMessage(bot_avatar, "left", chat[key]['content']);
									}
								}
							}
						}
					} else {
						let id = makeid(10);
						$('#chat-container').html('');

						$('.chat-sidebar-messages').prepend(`<div class="chat-sidebar-message selected-message" id=${id}>
								<div class="chat-title" id="title-${id}">
									{{ __('New Chat') }}
								</div>
								<div class="chat-info">
									<div class="chat-count"><span>0</span> {{ __('messages') }}</div>
									<div class="chat-date">{{ __('Now') }}</div>
								</div>
								<div class="chat-actions d-flex">
									<a href="#" class="chat-edit id=${id} fs-12"><i class="fa-sharp fa-solid fa-pen-to-square" data-tippy-content="{{ __('Edit Name') }}"></i></a>
									<a href="#" class="chat-delete  id=${id} fs-12 ml-2"><i class="fa-sharp fa-solid fa-trash" data-tippy-content="{{ __('Delete Chat') }}"></i></a>
								</div>
							</div>`);
						active_id = id;
					}
								
				},
				error: function(data) {
					toastr.warning('{{ __('There was an issue while retrieving chat history') }}');
				}
			});
	});

	// Create new chat message box
	$("#new-chat-button").on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
		let id = makeid(10);
		var element = document.getElementById(active_id);
		if (element) {
			element.classList.remove("selected-message");
		}
  		
		$('#chat-container').html('');

        $('.chat-sidebar-messages').prepend(`<div class="chat-sidebar-message selected-message" id=${id}>
				<div class="chat-title" id="title-${id}">
					{{ __('New Chat') }}
				</div>
				<div class="chat-info">
					<div class="chat-count"><span>0</span> {{ __('messages') }}</div>
					<div class="chat-date">{{ __('Now') }}</div>
				</div>
				<div class="chat-actions d-flex">
					<a href="#" class="chat-edit id=${id} fs-12"><i class="fa-sharp fa-solid fa-pen-to-square" data-tippy-content="{{ __('Edit Name') }}"></i></a>
					<a href="#" class="chat-delete id=${id} fs-12 ml-2"><i class="fa-sharp fa-solid fa-trash" data-tippy-content="{{ __('Delete Chat') }}"></i></a>
				</div>
			</div>`);
		active_id = id;
    });

	$(function () {
		
		main_form.addEventListener("submit", event => {
			event.preventDefault();
			const message = input_text.value;
			if (!message) return;

			appendMessage(user_avatar, "right", message);
			input_text.value = "";
			process(message)
		});

	});


	// Send chat message
	function process(message) {
		msgerSendBtn.disabled = true
		let formData = new FormData();
		formData.append('message', message);
		formData.append('chat_code', chat_code);
		formData.append('message_code', active_id);
		let code = makeid(10);
		appendMessage(bot_avatar, "left", "", code);
		fetch('/user/chat/process', {
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method: 'POST', 
				body: formData
			})		
			.then(response => response.json())
			.then(function(result){
				
				if (result['old'] && result['current']) {
					animateValue("balance-number", result['old'], result['current'], 300);
				}
		
				if (result['status'] == 'error') {
					Swal.fire('{{ __('Chat Notification') }}', result['message'], 'warning');
					clearConversationInvalid();
				}
			})	
			.then(data => {
				
				const eventSource = new EventSource("/user/chat/generate?message_code=" + active_id);				
				const response = document.getElementById(code);
				const chatbubble = document.getElementById('chat-bubble-' + code);
				
				eventSource.onopen = function(e) {
					response.innerHTML = '';
				};

				eventSource.onmessage = function (e) {

					if (e.data == "[DONE]") {
						msgerSendBtn.disabled = false
						eventSource.close();

					} else {
						let txt = JSON.parse(e.data).choices[0].delta.content
						if (txt !== undefined) {
							response.innerHTML += txt.replace(/(?:\r\n|\r|\n)/g, '<br>');
						}
						msgerChat.scrollTop += 100;
					}
				};
				eventSource.onerror = function (e) {
					msgerSendBtn.disabled = false
					console.log(e);
					eventSource.close();
				};
				
			})
			.catch(function (error) {
				console.log(error);
				msgerSendBtn.disabled = false
			});

	}

	function clearConversation() {
		document.getElementById("chat-container").innerHTML = "";

		fetch('/user/chat/clear', {
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method: 'POST', 
			})		
			.then(response => response.json())
			.then(function(result){

				if (result.status == 'success') {
					toastr.success('{{ __('Chat conversation has been cleared successfully') }}');
				}

			})	
			.catch(function (error) {
				console.log(error);
				msgerSendBtn.disabled = false
			});
	}

	function clearConversationInvalid() {
		document.getElementById("chat-container").innerHTML = "";

		fetch('/user/chat/clear', {
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method: 'POST', 
			})		
			.then(response => response.json())
			.then(function(result){})	
			.catch(function (error) {
				console.log(error);
				msgerSendBtn.disabled = false
			});
	}

	// RENAME TITLE
	$(document).on('click', '.chat-edit', function(e) {

		e.preventDefault();

		Swal.fire({
			title: '{{ __('Rename Chat Title') }}',
			showCancelButton: true,
			confirmButtonText: '{{ __('Rename') }}',
			reverseButtons: true,
			input: 'text',
		}).then((result) => {
			if (result.value) {
				var formData = new FormData();
				formData.append("name", result.value);
				formData.append("code", $(this).attr('id'));
				$.ajax({
					headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
					method: 'post',
					url: '/user/chat/rename',
					data: formData,
					processData: false,
					contentType: false,
					success: function (data) {
						if (data['status'] == 'success') {
							Swal.fire('{{ __('Title Updated') }}', '{{ __('Chat title has been updated successfully') }}', 'success');
							document.getElementById("title-"+data['code']).innerHTML =  result.value;
						} else {
							Swal.fire('{{ __('Update Error') }}', '{{ __('Chat title was not updated correctly') }}', 'error');
						}      
					},
					error: function(data) {
						Swal.fire('Update Error', data.responseJSON['error'], 'error');
					}
				})
			} else if (result.dismiss !== Swal.DismissReason.cancel) {
				Swal.fire('{{ __('No Title Entered') }}', '{{ __('Make sure to provide a new chat title before updating') }}', 'error')
			}
		})
	});

	// DELETE PLAN
	$(document).on('click', '.chat-delete', function(e) {

		e.preventDefault();

		Swal.fire({
			title: '{{ __('Confirm Chat Deletion') }}',
			text: '{{ __('It will permanently delete this chat history') }}',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: '{{ __('Delete') }}',
			reverseButtons: true,
		}).then((result) => {
			if (result.isConfirmed) {
				var formData = new FormData();
				formData.append("code", $(this).attr('id'));
				$.ajax({
					headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
					method: 'post',
					url: '/user/chat/delete',
					data: formData,
					processData: false,
					contentType: false,
					success: function (data) {
						console.log(data)
						if (data['status'] == 'success') {
							Swal.fire('{{ __('Chat Deleted') }}', '{{ __('Chat history has been successfully deleted') }}', 'success');	
							$("#" + active_id).remove();	
							$('#chat-container').html('');	
							$(".chat-sidebar-message").first().focus().trigger('click');
							let check_messages = document.querySelectorAll('.chat-sidebar-message').length;
							if (check_messages == 0) {
								let id = makeid(10);
								$('#chat-container').html('');
								
								$('.chat-sidebar-messages').prepend(`<div class="chat-sidebar-message selected-message" id=${id}>
										<div class="chat-title" id="title-${id}">
											{{ __('New Chat') }}
										</div>
										<div class="chat-info">
											<div class="chat-count"><span>0</span> {{ __('messages') }}</div>
											<div class="chat-date">{{ __('Now') }}</div>
										</div>
										<div class="chat-actions d-flex">
											<a href="#" class="chat-edit id=${id} fs-12"><i class="fa-sharp fa-solid fa-pen-to-square" data-tippy-content="{{ __('Edit Name') }}"></i></a>
											<a href="#" class="chat-delete  id=${id} fs-12 ml-2"><i class="fa-sharp fa-solid fa-trash" data-tippy-content="{{ __('Delete Chat') }}"></i></a>
										</div>
									</div>`);
								active_id = id;
							}						
						} else if (data['status'] == 'empty') { 
							$('#chat-container').html('');	
								
						}else {
							Swal.fire('{{ __('Delete Failed') }}', '{{ __('There was an error while deleting this chat history') }}', 'error');
						}      
					},
					error: function(data) {
						Swal.fire('Oops...','Something went wrong!', 'error')
					}
				})
			} 
		})
	});

	// Counter for words
	function animateValue(id, start, end, duration) {
		if (start === end) return;
		var range = end - start;
		var current = start;
		var increment = end > start? 1 : -1;
		var stepTime = Math.abs(Math.floor(duration / range));
		var obj = document.getElementById(id);
		var timer = setInterval(function() {
			current += increment;
			if (current > 0) {
				obj.innerHTML = current;
			} else {
				obj.innerHTML = 0;
			}
			
			if (current == end) {
				clearInterval(timer);
			}
		}, stepTime);
	}

	// Display chat messages (bot and user)
	function appendMessage(img, side, text, code) {
		let msgHTML;
		text = nl2br(text);

		if (side == 'left' && text == '') {
			msgHTML = `
			<div class="msg ${side}-msg">
			<div class="message-img" style="background-image: url(${img})"></div>
			<div class="message-bubble" id="chat-bubble-${code}">
				<div class="msg-text" id="${code}"><img src='{{ URL::asset("/img/svgs/chat.svg") }}'></div>
			</div>
			</div>`;
		} else {
			msgHTML = `
			<div class="msg ${side}-msg">
			<div class="message-img" style="background-image: url(${img})"></div>
			<div class="message-bubble" id="chat-bubble-${code}">
		

				<div class="msg-text" id="${code}">${text}</div>
			</div>
			</div>`;
		}

		msgerChat.insertAdjacentHTML("beforeend", msgHTML);
		msgerChat.scrollTop += 500;
	}

	function get(selector, root = document) {
		return root.querySelector(selector);
	}

	// Generate a random value
	function makeid(length) {
		let result = '';
		const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		const charactersLength = characters.length;
		let counter = 0;
		while (counter < length) {
		result += characters.charAt(Math.floor(Math.random() * charactersLength));
		counter += 1;
		}
		return result;
	}

	function nl2br (str, is_xhtml) {
     	var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
     	return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
  	} 

	$("#expand").on('click', function (e) {
        $('.chat-sidebar-container').toggleClass('extend');
    });

	// Check if it is a json
	function isJson(str) {
		try {
			JSON.parse(str);
		} catch (e) {
			return false;
		}
		return true;
	}

</script>
@endsection