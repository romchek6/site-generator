<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class DomainController extends BaseController
{

    public function show()
    {
        $domains = Domain::all();
        return view('domains', compact('domains'));
    }

    public function store(Request $request)
    {
        $domain = $request->validate([
            'domain_name' => 'required'
        ]);
        Domain::create([
            'name'=> $domain['domain_name'],
        ]);
        $domains = Domain::all();
        return redirect('/domains');
    }

    public function destroy($id)
    {
        $domains = Domain::destroy($id);
        return redirect('/domains');
    }

}
