<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Genome;
use App\Models\Organism;
use App\Models\File;
use App\Models\LibraryType;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return "View all projects";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $organisms = Organism::all();
        $genomes = Genome::all();
        return view('projects.create', compact('organisms', 'genomes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'organism' => 'required',
            'genome' => 'required',
        ]);

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'status_id' => 1,
            'organism_id' => $request->organism,
            'genome_id' => $request->genome,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('projects.step2', $project->id)->with('success', 'Project created successfully.');
    }

    public function step2(string $id)
    {
        return view('projects.step2', compact('id'));
    }

    public function uploadFile(Request $request, string $id)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $index = $request->index;
            $fileName = $file->getClientOriginalName().str_pad($index, 5, "0", STR_PAD_LEFT);
            $path = public_path('uploads').'/'.$id;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file->move($path, $fileName);

            if($request->final == 'false'){
                return "Arquivo carregado com sucesso!";
            }else{
                $this->joinFiles($file->getClientOriginalName(), $path, true);
                $new_file = File::create([
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'project_id' => $id,
                ]);
                return "Arquivo final com sucesso!";
            }
        } else {    
            return "Nenhum arquivo selecionado.";
        }
    }

    private function joinFiles($name, $path, $delete_files = false)
    {
        $escaped_name = preg_quote($name, '/');
        $pattern = '/^'.$name.'[0-9]+$/';
        $files = scandir($path);
        $destination = $path.'/'.$name;
        $selected_files = [];

        $output = fopen($destination, 'wb');
        foreach ($files as $key => $filename) {
            # code...
            if (preg_match($pattern, $filename)) {
                $origin = $path.'/'.$filename;
                $input = fopen($origin, 'rb');
                while (!feof($input)) {
                    fwrite($output, fread($input, 1024));
                }
                fclose($input);

                if($delete_files){
                    unlink($origin);
                }
                // O nome do arquivo corresponde ao padrão.
                $selected_files[] = $filename;
            }
        }
        return $selected_files;
    }

    public function step3(string $id)
    {
        $library_types = LibraryType::all();
        return view('projects.step3', compact('id', 'library_types'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $organisms = Organism::all();
        $genomes = Genome::all();
        $project = Project::find($id);
        return view('projects.edit', compact('project', 'organisms', 'genomes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'organism' => 'required',
            'genome' => 'required',
        ]);

        $project = Project::find($id);

        $project->title         = $request->title;
        $project->description   = $request->description;
        $project->status_id     = 1;
        $project->organism_id   = $request->organism;
        $project->genome_id     = $request->genome;
        $project->user_id       = auth()->user()->id;

        $project->save();

        return redirect()->route('projects.step2', $project->id)->with('success', 'Project created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
