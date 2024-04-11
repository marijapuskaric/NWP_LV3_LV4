<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ProjectController;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //funkcija za spremanje novog projekta u bazu podataka
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:32',
            'description' => 'required|string|required|max:255',
            'price' => 'required',
            'finished_jobs' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        $project = new Project();
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->price = $request->input('price');
        $project->finished_jobs = $request->input('finished_jobs');
        $project->start_date = $request->input('start_date');
        $project->end_date = $request->input('end_date');
        $project->user_id_manager = $request->user()->id;
        $project->save();

        return redirect()->back()->with('success', 'Project created successfully!');
        
    }

    //funkcija za dohvacanje projekata iz baze prema statusu korisnika na projektu
    public function show() 
    {
        $user = Auth::user();
        $userProjectsManager = Project::where('user_id_manager', $user->id)->get();
        $userProjectsMember = Project::whereHas('users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->get();        

        return view('projects.profile', compact('userProjectsManager', 'userProjectsMember'));
    }

    //funkcija za dohvacanje svih registriranih korisnika kako bi se mogli odabrati korisnici za projekt
    public function getUsers($id)
    {
        $project = \App\Models\Project::findOrFail($id);
        $users = \App\Models\User::all();
        return view('projects.addUser', compact('project', 'users'));
    }

    //funkcija za dodavanje korisnika na projekt
    public function addUserProject(Request $request, $projectId)
    {
       $user = Auth::user();
       $project = Project::findOrFail($projectId);
       if ($user->id == $project->user_id_manager)
       {
        $users = $request->input('users');
        $project->users()->attach($users);
        return redirect()->back()->with('success', 'Users added successfully!');
       }
       else
       {
        return redirect()->back()->with('error', 'Adding users failed.');
       }
       
    }

    //funkcija za prikaz stranice za uredivanje projekta kao voditelj projekta - dohvaca podatke o odabranom projektu
    public function editProjectManager($id)
    {
        $project = \App\Models\Project::findOrFail($id);
        return view('projects.editProjectManager', compact('project'));
    }

    //funkcija za prikaz stranice za uredivanje projekta kao clan tima - dohvaca podatke o odabranom projektu
    public function editProjectUser($id)
    {
        $project = \App\Models\Project::findOrFail($id);
        return view('projects.editProjectUser', compact('project'));
    }

    //funkcija za promijenu podataka o projektu kao voditelj projekta
    public function updateProjectManager(Request $request, $id)
    {
        $user = Auth::user();
        $project = Project::findOrFail($id);
        if ($user->id == $project->user_id_manager)
        {
            $request->validate([
                'name' => 'required|max:32',
                'description' => 'required|string|required|max:255',
                'price' => 'required',
                'finished_jobs' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);
            $project->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'finished_jobs' => $request->finished_jobs,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
            $project->save();

            return redirect()->back()->with('success', 'Project updated successfully!');
        }
        else
        {
            return redirect()->back()->with('error', 'Updating project failed.');
        }
    }

    //funkcija za promijenu podataka o projektu kao clan tima
    public function updateProjectUser(Request $request, $id)
    {
        $user = Auth::user();
        $project = Project::findOrFail($id);
        if ($project->users->contains('id', $user->id)) 
        {
            $request->validate([
                'finished_jobs' => 'required|string',
            ]);
            $project->update([
                'finished_jobs' => $request->finished_jobs,
            ]);
            $project->save();

            return redirect()->back()->with('success', 'Project updated successfully!');
        }
        else
        {
            return redirect()->back()->with('error', 'Updating project failed.');
        }
    }

}
