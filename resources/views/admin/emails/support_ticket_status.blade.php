<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ __('Suppor Ticket Status') }}</title>
</head>
<body>
	<p>
		{{ __('Hello') }} {{ ucfirst($ticketOwner->name) }},
	</p>
	<p>
		{{ __('Your support ticket with ID') }} #{{ $ticket->ticket_id }} {{ __('has been marked has resolved or closed') }}.
	</p>
</body>
</html>