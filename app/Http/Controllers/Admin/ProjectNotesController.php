<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Project;
use App\ProjectNote;
use Illuminate\Http\Request;
use DB;

class ProjectNotesController extends Controller
{
    public function index(Request $request)
    {
        $projectNotes = ProjectNote::select('project_id')->distinct()->pluck('project_id')->toArray();
        // dd($projectNotes);
        // $projects = Project::withcount('projectNotes')->with('projectNotes')->get();
        $projects = Project::whereIn('id', $projectNotes)->get();
        return view('admin.project-notes.index', compact('projects'));
    }

    public function create()
    {
        $projects    = Project::all();
        $projectnote = new ProjectNote();
        return view('admin.project-notes.create', compact('projects', 'projectnote'));
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        ProjectNote::create($requestData);

        return redirect('project-notes')->with('flashMessage', 'ProjectNote added!');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('admin.project-notes.show', compact('project'));
    }

    public function edit($id)
    {
        $projects = Project::all();
        $projectnote = ProjectNote::findOrFail($id);

        return view('admin.project-notes.edit', compact('projects', 'projectnote'));
    }

    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $projectnote = ProjectNote::findOrFail($id);
        $projectnote->update($requestData);

        return redirect('project-notes')->with('flashMessage', 'ProjectNote updated!');
    }

    public function destroy($id)
    {
        ProjectNote::destroy($id);

        return redirect('project-notes')->with('flashMessage', 'ProjectNote deleted!');
    }

    public function deleteAllNotesForParticularProject($id)
    {
        $project = Project::where('id', $id)->first();

        foreach($project->projectNotes as $item){
            DB::table('project_notes')
            ->where('id', '=', $item->id)
            ->where('project_id', '=', $item->project_id)
            ->delete();
        }
        return redirect('project-notes')->with('flashMessage', 'ProjectNote deleted!');
    }
}
