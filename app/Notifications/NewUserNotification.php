<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
{
	use Queueable;

	private $usersReport;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($usersReport)
	{
		$this->usersReport = $usersReport;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['mail'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{

		$mailMessageLines = (new MailMessage)
			->line('Usuarios registrados por pais!.');

		foreach ($this->usersReport as $user) {
			$mailMessageLines->line($user->country . ': ' . $user->total . ' usuarios.');
		}

		return $mailMessageLines;
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function toArray($notifiable)
	{
		return [
			//
		];
	}
}
