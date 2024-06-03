<?php

namespace App\Mailers;

use App\Models\SupportTicket;
use Illuminate\Contracts\Mail\Mailer;

class AppMailer {

	protected $mailer;           

	/**
	 * from email address
	 * @var string
	 */
	protected $fromAddress;

	/**
	 * from name
	 * @var string
	 */
	protected $fromName = 'Support Ticket';

	/**
	 * email to send to
	 * @var [type]
	 */
	protected $to;

	/**
	 * Subject of the email
	 * @var [type]
	 */
	protected $subject;

	/**
	 * view template for email
	 * @var [type]
	 */
	protected $view;

	/**
	 * data to be sent alone email
	 * @var array
	 */
	protected $data = [];


	public function __construct(Mailer $mailer)
	{
		$this->mailer = $mailer;
	}
	
	/**
	 * Send Ticket information to user
	 * 
	 * @param  User   $user
	 * @param  Support  $ticket
	 * @return method deliver()
	 */
	public function sendSupportTicketInformation($user, SupportTicket $ticket)
	{
		$this->to = $user->email;
		$this->subject = "[Ticket ID: $ticket->ticket_id] $ticket->subject";
		$this->view = 'admin.emails.support_ticket_info';
		$this->data = compact('user', 'ticket');

		if (config('settings.support_email') == 'enabled') {
			return $this->deliver();
		}
		
	}

	/**
	 * Send Ticket Comments/Replies to Ticket Owner
	 *
	 * @param  User   $ticketOwner
	 * @param  User   $user
	 * @param  Support  $ticket
	 * @param  Comment  $comment
	 * @return method deliver()
	 */
	public function sendSupportTicketComments($ticketOwner, $user, SupportTicket $ticket, $comment)
	{
		$this->to = $ticketOwner->email;
		$this->subject = "RE: $ticket->subject (Ticket ID: $ticket->ticket_id)";
		$this->view = 'admin.emails.support_ticket_comments';
		$this->data = compact('ticketOwner', 'user', 'ticket', 'comment');

		if (config('settings.support_email') == 'enabled') {
			return $this->deliver();
		}
	}

	/**
	 * Send ticket status notification
	 * 
	 * @param  User   $ticketOwner
	 * @param  Support  $ticket
	 * @return method deliver()
	 */
	public function sendSupportTicketStatusNotification($ticketOwner, SupportTicket $ticket)
	{
		$this->to = $ticketOwner->email;
		$this->subject = "RE: $ticket->subject (Ticket ID: $ticket->ticket_id)";
		$this->view = 'admin.emails.support_ticket_status';
		$this->data = compact('ticketOwner', 'ticket');

		if (config('settings.support_email') == 'enabled') {
			return $this->deliver();
		}
	}

	/**
	 * Do the actual sending of the mail
	 */
	public function deliver()
	{
		$this->mailer->send($this->view, $this->data, function($message) {
			$message->from(config('mail.from.address'), $this->fromName)
					->to($this->to)->subject($this->subject);
		});
	}
}