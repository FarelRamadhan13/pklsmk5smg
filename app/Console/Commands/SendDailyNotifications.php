<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class SendDailyNotifications extends Command
{
    protected $signature = 'send:daily-notifications {time}';
    protected $description = 'Kirim notifikasi harian ke OneSignal pada jam 07:00 dan 15:00';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        
        $time = $this->argument('time');
        
      
        $title = '';
        $message = '';

        if ($time === 'morning') {
            $title = 'Absen datang';
            $message = 'Selamat Pagi!, Jika kamu belum absen datang, jangan lupa untuk absen datang, sesuaikan dengan jadwal dan kedatanganmu di industri, jika sudah abaikan pesan ini.';
        } elseif ($time === 'afternoon') {
                     $title = 'Absen pulang';
            $message = 'Selamat sore!, Jika kamu belum absen pulang hari ini, jangan lupa untuk absen pulang, sesuaikan dengan jadwal dan kepulanganmu dari industri, jika sudah abaikan pesan ini.';
        }

       
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'NTZhMDZiYzMtMjJiZS00Nzk5LWI4YTgtZjJjOTkzMzNjZjQ0'
        ])->post('https://onesignal.com/api/v1/notifications', [
            'app_id' => '08c077e5-bbaa-43cd-9eb4-8fdf74e6cdab',
            'included_segments' => ['All'],
            'headings' => ['en' => $title],
            'contents' => ['en' => $message],
            'url' => 'https://magang.smkn3kendal.sch.id/',
            'small_icon' => 'https://magang.smkn3kendal.sch.id/logo/logo192x.png',
            'chrome_web_icon' => 'https://magang.smkn3kendal.sch.id/logo/logo.jpeg',
        ]);

        $this->info('Notifikasi dikirim: ' . $response->status());
    }
}