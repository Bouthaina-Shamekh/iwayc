<?php

namespace App\Console\Commands;

use Log;
use Notification;
use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Events\MakeTask;
use App\Models\Reminder_task;
use Illuminate\Console\Command;
use App\Notifications\NewLessonNotification;

class SendTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendTask';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Reminders later task';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $Reminder_tasks = Reminder_task::all();
        if($Reminder_tasks){
            foreach ($Reminder_tasks as $Reminder_task){

        $hours = now()->diffInMinutes($Reminder_task->created_at);

                  if($hours > 5 ){
                    $task =Task::where('id',$Reminder_task->task_id)->first();
                    if($task){
                        $user = User::where('id','=',$task->receiver)->first();
                        Notification::send($user,new NewLessonNotification($task->id,$task->sender,$task->title));
                        MakeTask::dispatch($task->receiver);
                        $Reminder_task->delete();
                    }

                 }
            }
        }
        return Command::SUCCESS;
    }
}
