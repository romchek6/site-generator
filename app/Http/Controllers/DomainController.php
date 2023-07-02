<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class DomainController extends BaseController
{

    public function show()
    {
        return view('domains');
    }

}
