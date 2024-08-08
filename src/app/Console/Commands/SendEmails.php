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
        $now = Carbon::now();

        // 当日の6時から24時までの予約を取得
        $startOfDay = $now->copy()->startOfDay()->addHours(6);
        $endOfDay = $now->copy()->endOfDay();

        // Eager Loadingでuserリレーションをロード 予約の取得
        $reservations = Reservation::with('user')->whereBetween('time', [$startOfDay, $endOfDay])->get();

        // 予約件数の表示
        $this->info("Found " . $reservations->count() . " reservations");

        // 各予約に対してメール送信
        foreach ($reservations as $reservation) {
            $this->info("Sending email to " . $reservation->user->email);
            Mail::to($reservation->user->email)->send(new ReservationReminder($reservation));
        }

        // 処理完了メッセージ表示
        $this->info("Emails have been sent");

        // コマンド終了
        return 0;
    }
}
