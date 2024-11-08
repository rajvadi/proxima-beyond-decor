<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
        $path = storage_path('app/backups/' . $filename);

        $database = config('database.connections.mysql.database');
        $backupSql = "";
        $backupSql .= "CREATE DATABASE IF NOT EXISTS `$database`;\n";
        $backupSql .= "USE `$database`;\n\n";
        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            $tableArray = get_object_vars($table);
            $tableName = reset($tableArray);

            // Get create statement for each table
            $createTable = DB::select("SHOW CREATE TABLE $tableName");
            $createStatement = $createTable[0]->{'Create Table'} . ";\n\n";
            $backupSql .= $createStatement;

            // Get table data
            $rows = DB::table($tableName)->get();

            foreach ($rows as $row) {
                $rowArray = (array) $row;
                $columns = implode('`, `', array_keys($rowArray));
                $values = implode("', '", array_map('addslashes', array_values($rowArray)));
                $backupSql .= "INSERT INTO `$tableName` (`$columns`) VALUES ('$values');\n";
            }

            $backupSql .= "\n\n";
        }

        // Store the backup in the storage path
        $backupFilePath = 'backups/'.'backup-' . Carbon::now()->format('Y-m-d') . '.sql';
        Storage::put($backupFilePath, $backupSql);

        $this->sendBackupEmail($filename, $path);

        // Delete the backup file after sending
        unlink($path);

        $this->info('Database backup completed and sent via email.');
    }

    private function sendBackupEmail($filename, $path)
    {
        $toEmail = ['rajvadi68@gmail.com','vrajeshsavaliya98@gmail.com'];
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
