<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Mail\ReservationReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


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
        // 現在時刻を取得
        $now = Carbon::now();
        Log::info("Current time: " . $now->toDateTimeString());

        // 現在の日付の開始時刻と終了時刻を設定
        $startOfDay = $now->copy()->startOfDay();
        $endOfDay = $now->copy()->endOfDay();
        Log::info("Start of day: " . $startOfDay->toDateTimeString());
        Log::info("End of day: " . $endOfDay->toDateTimeString());

        // 今日の予約を取得
        $reservations = Reservation::with('user')
            ->where('date', $now->toDateString())
            ->whereBetween('time', [$startOfDay, $endOfDay])
            ->get();

        Log::info("Found " . $reservations->count() . " reservations");

        foreach ($reservations as $reservation) {
            try {
                Log::info("Sending email to: " . $reservation->user->email);
                Mail::to($reservation->user->email)->send(new ReservationReminderMail($reservation));
                Log::info("Email sent successfully to: " . $reservation->user->email);
            } catch (\Exception $e) {
                Log::error("Failed to send email to: " . $reservation->user->email . ". Error: " . $e->getMessage());
            }
        }

        Log::info("All emails have been processed");
        return 0;
    }
}
