<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Storage;

class DatabaseBackupNotification extends Notification
{
    use Queueable;

    protected $backupFilePath;

    public function __construct($backupFilePath)
    {
        $this->backupFilePath = $backupFilePath;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $mailMessage = (new MailMessage)
            ->subject('Database Backup')
            ->line('The database backup has been completed successfully. The backup file is attached.');

        // Attach the backup file
        if (Storage::exists($this->backupFilePath)) {
            $mailMessage->attach(Storage::path($this->backupFilePath));
        }

        return $mailMessage;
    }
}
