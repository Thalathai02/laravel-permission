<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class InvoicePaid extends Notification
{
    use Queueable;
    protected $data_form;
    protected $data_form_id;
    protected $Title_form;
    protected $userseed;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($form ,$form_id,$Title_form,$userseed)
    {
        $this->data_form =$form;
        $this->data_form_id =$form_id;
        $this->data_Title_form = $Title_form;
        $this->userseed = $userseed;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'form'=> $this->data_form,
            'form_id'=>$this->data_form_id,
            'Title_form' => $this->data_Title_form,
            'userseed'=>$this->userseed
        ];
    }
    
}
