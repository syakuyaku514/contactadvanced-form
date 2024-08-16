<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Mail\ReservationReminder;
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
        // 現在時刻の取得
        $now = Carbon::now()->startOfDay()->addHours(6);

        $startOfDay = $now->copy()->startOfDay()->addHours(6);
        $endOfDay = $now->copy()->endOfDay();

        $reservations = Reservation::with('user')
            ->where('date', $now->toDateString())
            ->whereBetween('time', [$startOfDay, $endOfDay])
            ->get();

        // 予約件数の表示
        $this->info("Found " . $reservations->count() . " reservations");

        // 各予約に対してメール送信
        foreach ($reservations as $reservation) {
          try {
              $this->info("Sending email to " . $reservation->user->email);
              Mail::to($reservation->user->email)->send(new ReservationReminder($reservation));
            } catch (\Exception $e) {
              $this->error("Failed to send email to " . $reservation->user->email . ". Error: " . $e->getMessage());
            }
        }

        // 処理完了メッセージ表示
        $this->info("Emails have been sent");

        // コマンド終了
        return 0;
    }
}
