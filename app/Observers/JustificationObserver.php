<?php

namespace App\Observers;

use App\Justification;
use App\Mail\SendNotification;
use App\User;
use Illuminate\Support\Facades\Mail;

class JustificationObserver
{
    /**
     * Handle the justification "created" event.
     *
     * @param  \App\Justification  $justification
     * @return void
     */
    public function created(Justification $justification)
    {
        /*$user = $justification->user()->first();
        $user_course = $user->studentCourse();*/
        //dd($justification);
        $tema = 'Hola Profe voy a faltar unos dias';
        $mensaje = ['from'=>'student@tomillo.com',
                'to'=> 'admin@tomillo.com',
                'subject'=> 'Ausencia',
                'mensaje'=> $tema
               ];

        Mail::to('admin@tomillo.com')->send(new SendNotification($mensaje));
        return 'Justificación Creada';
    }

    /**
     * Handle the justification "updated" event.
     *
     * @param  \App\Justification  $justification
     * @return void
     */
    public function updated(Justification $justification)
    {

    }

    /**
     * Handle the justification "deleted" event.
     *
     * @param  \App\Justification  $justification
     * @return void
     */
    public function deleted(Justification $justification)
    {
        //
    }

    /**
     * Handle the justification "restored" event.
     *
     * @param  \App\Justification  $justification
     * @return void
     */
    public function restored(Justification $justification)
    {
        //
    }

    /**
     * Handle the justification "force deleted" event.
     *
     * @param  \App\Justification  $justification
     * @return void
     */
    public function forceDeleted(Justification $justification)
    {
        //
    }
}
