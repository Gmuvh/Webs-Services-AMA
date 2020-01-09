<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sat;

class SatController extends Controller {

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id) {
        $sat = Sat::find($id);
        return response()->json(array('Sat' => $sat));
    }

    public function getall() {
        $sat = Sat::all();
        return response()->json(array('Sat' => $sat));
    }

}
