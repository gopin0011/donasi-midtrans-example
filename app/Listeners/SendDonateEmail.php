<?php

namespace App\Listeners;

use App\Events\UserDonated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendDonateEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserDonated  $event
     * @return void
     */
    public function handle(UserDonated $event)
    {
        //
        try{
            Mail::send('email', ['nama' => $event->request->donor_name, 'pesan' => '$request->pesan'], function ($message) use ($event)
            {
                $message->subject('Donasi anda sangat berarti');
                $message->from('donotreply@kiddy.com', 'Kiddy');
                $message->to($event->request->donor_email);
            });
            // return back()->with('alert-success','Berhasil Kirim Email');
            return response (['status' => true]);
        }
        catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }
}
