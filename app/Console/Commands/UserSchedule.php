<?php

namespace App\Console\Commands;

use App\Task\UserAllot;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UserSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Task User';

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
        $userAllot = new UserAllot();
        //新接口用户分配
        $userAllot->averageAllotByFivePolt();
        return true;
    }
}
