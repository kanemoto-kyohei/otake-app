<?php

namespace App\Listeners;

use App\Events\AppointCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Appoint;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointNotification;
use App\Models\User;
use App\Mail\AppointUserNotification;




class SendAppointNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AppointCreated $event): void
    {
        //
        $carender_link = $event->appoint->carender_link;
        $admin_user = Appoint::where('carender_link',$carender_link)->firstOrFail();
        $admin_id = $admin_user->user_id;
        $admin_info = User::findOrFail($admin_id);
        $admin_email = $admin_info->email;

        $appoint_user = Appoint::where('carender_link',$carender_link)->latest()->firstOrFail();
        $appoint_id = $appoint_user->user_id;
        $appoint_info = User::findOrFail($appoint_id);
        $user_email = $appoint_info->email;

        Mail::to($admin_email)
            ->send(new AppointNotification($event->appoint,$appoint_info));

        Mail::to($user_email)
            ->send(new AppointUserNotification($event->appoint,$appoint_info,$appoint_user));
           }   

}
