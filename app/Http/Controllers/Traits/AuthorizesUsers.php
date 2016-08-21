<?php

namespace App\Http\Controllers\Traits;

trait AuthorizesUsers
{

    /**
     * Determine if flyer was created by logged in user
     * 
     * @param  Request $request
     * @return boolean
     */
    protected function userCreatedFlyer(Request $request)
    {
        return Flyer::where([
            'zip' => $request->zip,
            'street' => $request->street,
            'user_id' => \Auth::id()
        ])->exists();
    }

    /**
     * User is not authorized
     * 
     * @return redirect
     */
    protected function unauthorized(Request $request)
    {
        if ($request->ajax()) {
            return response(['message' => 'No Way!'], 403);
        }

        flash('No Way!');

        return redirect('/');
    }
}