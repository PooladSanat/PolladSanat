<?php

namespace App\Console\Commands;

use App\Alternatives;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Console\Command;

class DeActiveRoleCronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'DeActiveRole';

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
     * @return mixed
     */
    public function handle()
    {
        $now_date = new Verta();
        $alternatives = Alternatives::whereNull('status')->get();
        foreach ($alternatives as $alternative)
            $to = Carbon::parse($alternative->to);
        if ($now_date->year == $to->year and $now_date->month == $to->month and $now_date->day == $to->day) {
            $role_user = \DB::table('role_user')
                ->where('user_id', $alternative->user_id)
                ->where('label', 1)->delete();
            if ($role_user) {
                $alternative->update([
                    'status' => 1,
                ]);
                activity('دسترسی های فرد جایگزین گرفته شد');
            }
        }
    }
}
