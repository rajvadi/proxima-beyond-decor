<?php

namespace App\Listeners;

use Spatie\Backup\Events\BackupWasSuccessful;
use App\Notifications\DatabaseBackupNotification;

class SendDatabaseBackupNotification
{
    public function handle(BackupWasSuccessful $event)
    {
        // Get the path to the database backup file
        $backupDestination = $event->backupDestination;
        $newestBackup = $backupDestination->newestBackup();
        $backupFilePath = $newestBackup->path();

        \Log::info('Custom notification triggeredsss:', ['file' => $backupFilePath]);

        // Ensure it's a database backup
        // Notify via email
        foreach (config('backup.notifications.mail.to') as $email) {
            \Log::info('Email:', ['email' => $email]);
            \Notification::route('mail', $email)
                ->notify(new DatabaseBackupNotification($backupFilePath));
        }

    }
}
