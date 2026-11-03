<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Web\AccessController;

class access extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'access:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronasi akses dari route terdaftar di server';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Sinkronasi akses dimulai...');
        try {
            $access_controller = new AccessController();
            $access_controller->sync();
            $this->info('Sinkronasi data akses berhasil!');
        } catch (\Throwable $th) {
            $this->info('Sinkronasi data akses gagal!');
        }
    }
}
