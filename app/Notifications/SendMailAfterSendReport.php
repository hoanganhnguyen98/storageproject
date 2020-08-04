<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendMailAfterSendReport extends Notification
{
    use Queueable;

    protected $new_report;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($new_report)
    {
        $this->new_report = $new_report;
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
        return (new MailMessage)
                ->subject('New Report from Laos Bank')
                ->from('laosbanksystem@noreply.com', 'Laos Bank')
                ->line('You have a new report from Laos Bank:')
                ->line('Report Number: '.$this->new_report->report_number)
                ->line('Report Title: '.$this->new_report->title)
                ->line('Sign Date: '.$this->new_report->sign_date)
                ->line('Report Type: '.$this->new_report->type)
                ->action('Click here to see more detail about report', url('/index'))
                ->line('Thank you!');
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
