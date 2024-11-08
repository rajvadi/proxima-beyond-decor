<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database and send it via emailBackup the database and send it via email';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = 'backup-' . Carbon::now()->format('Y-m-d') . '.sql';
        $path = storage_path('app/' . $filename);

        // Update command syntax and add error handling
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $database = config('database.connections.mysql.database');
        $host = config('database.connections.mysql.host');

        // Construct the command
        // if password is empty, don't include it in the command
        if (empty($password)) {
            $command = "mysqldump -u {$username} -h {$host} {$database} > {$path}";
        } else {
            $command = "mysqldump -u {$username} -p{$password} -h {$host} {$database} > {$path}";
        }
        // Execute the command and capture any errors
        $output = null;
        $result_code = null;
        exec($command, $output, $result_code);

        if ($result_code !== 0) {
            $this->error('Database backup failed. Please check the command and credentials.');
            return;
        }

        $this->sendBackupEmail($filename, $path);

        // Delete the backup file after sending
        //unlink($path);

        $this->info('Database backup completed and sent via email.');
    }

    private function sendBackupEmail($filename, $path)
    {
        $toEmail = 'rajvadi68@gmail.com'; // Update to the recipient's email
        Mail::raw('Database backup attached.', function ($message) use ($toEmail, $filename, $path) {
            $message->to($toEmail)
                ->subject('Database Backup')
                ->attach($path, [
                    'as' => $filename,
                    'mime' => 'application/sql',
                ]);
        });
    }
}
