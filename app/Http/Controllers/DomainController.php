<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\MetaValue;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DomainController extends BaseController
{

    public function index()
    {
        $domains = Domain::all();
        return view('domains', compact('domains'));
    }

    public function store(Request $request)
    {
        $domain = $request->validate([
            'domain_name' => 'required'
        ]);
        $created_domain = Domain::create([
            'name'=> $domain['domain_name'],
        ]);
        $meta = new MetaValue();
        $meta->createEmptyFields($created_domain->id);
        Storage::disk('local')->put('public/' . $created_domain->name . '/1.txt', 'test');
        return redirect('/domain');
    }

    public function destroy($id)
    {
        $domains = Domain::destroy($id);
        return redirect('/domain');
    }

}
