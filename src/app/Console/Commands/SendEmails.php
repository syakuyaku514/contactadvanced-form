<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Mail\ReservationReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reservation reminder emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
     public function handle()
    {
        // $nowを現在時刻のまま使う
        $now = Carbon::now();

        // 現在の日付の開始時刻と終了時刻を設定
        $startOfDay = $now->copy()->startOfDay();
        $endOfDay = $now->copy()->endOfDay();

        // 今日の予約を取得
        $reservations = Reservation::with('user')
            ->where('date', $now->toDateString())
            ->whereBetween('time', [$startOfDay, $endOfDay])
            ->get();

        // メール送信ロジック
        $this->info("Found " . $reservations->count() . " reservations");
    
        foreach ($reservations as $reservation) {
            try {
                $this->info("Sending email to " . $reservation->user->email);
                Mail::to($reservation->user->email)->send(new ReservationReminderMail($reservation));
            } catch (\Exception $e) {
                $this->error("Failed to send email to " . $reservation->user->email . ". Error: " . $e->getMessage());
            }
        }

        $this->info("Emails have been sent");
        return 0;
    }
}
