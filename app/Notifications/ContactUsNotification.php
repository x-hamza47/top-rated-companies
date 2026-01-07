<?php

namespace App\Notifications;

use App\Models\ContactUs;
use Illuminate\Support\Str;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ContactUsNotification extends Notification 
{
    use Queueable;

    public $contact;
    /**
     * Create a new notification instance.
     */
    public function __construct(ContactUs $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the notification's database type.
     */
    public function databaseType(object $notifiable): string
    {
        return 'contact-message';
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // return ['mail', 'database'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("New Contact Message: {$this->contact->subject}")
            ->greeting("Hello {$notifiable->firstName},")
            ->line("You have received a new contact message from {$this->contact->name} ({$this->contact->email}).")
            ->line("Subject: {$this->contact->subject}")
            ->line("Message: {$this->contact->message}")
            ->action('View Message', url("/dashboard"))
            ->line('Please check the dashboard to manage this message.');
    }

    public function toDatabase(object $notifiable)
    {
        return [
            'contact_id' => $this->contact->id,
            'name' => $this->contact->name,
            'email' => $this->contact->email,
            'subject' => $this->contact->subject,
            'message' => Str::limit($this->contact->message, 100),
            'status' => $this->contact->status,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }
}
