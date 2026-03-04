<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyClaimRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $claim;
    /**
     * Create a new notification instance.
     */
    public function __construct($claim)
    {
        $this->claim = $claim;
    }

    public function databaseType(object $notifiable): string
    {
        return 'company-claim-request';
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $claim = $this->claim->load('company');;
    
        return (new MailMessage)
            ->subject("New Company Claim Request: {$claim->company->name}")
            ->greeting("Hello {$notifiable->firstName},")
            ->line("A new claim request has been submitted for the company **{$claim->company->name}**.")
            ->line("Submitted by: {$claim->submitted_name}")
            ->line("Corporate Email: {$claim->submitted_email}")
            ->line("System User Email: {$claim->user->email}")
            ->line("Job Title: {$claim->job_title}")
            ->action('View Claim', url("/dashboard/claims/{$claim->id}"))
            ->line('Please review this claim and approve or reject it as necessary.');
    }


    public function toDatabase(object $notifiable)
    {
        $this->claim->load('company');
        return [
            'claim_id' => $this->claim->id,
            'company_name' => $this->claim->company->name,
            'submitted_name' => $this->claim->submitted_name,
            'submitted_email' => $this->claim->submitted_email,
            'job_title' => $this->claim->job_title,
            'status' => $this->claim->status,
        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
