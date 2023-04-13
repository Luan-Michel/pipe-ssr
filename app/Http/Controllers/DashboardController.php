<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $projects = Project::all();
        // echo '<pre>'; var_dump($projects); echo '</pre>'; die;
        // return $projects[0]->status()->get();
        return view('dashboard', [
            'projects' => $projects,
        ]);
    }
}
