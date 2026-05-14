<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Proposal;

class NewStatusNotification extends Notification
{
    use Queueable;
    public $proposal;

    /**
     * Create a new notification instance.
     */
    public function __construct(Proposal $proposal)
    {
        $this->proposal = $proposal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database']; //importante mudar isso
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $status = $this->proposal->status;

        $message = match ($status) {
            'accepted' => 'Sua proposta foi aceita!',
            'rejected' => 'Sua proposta foi rejeitada.',
            'cancelled' => 'Uma proposta foi cancelada.',
            default => 'O status da proposta foi atualizado.'
        };

        $link = match ($notifiable->role) {
            'caregiver' => route('caregiver.proposals'),
            'client' => route('client.hire-history'),
            default => '/',
        };

        return [
            'message' => $message,
            'link' => $link,
            'status' => $status
        ];
    }
}
