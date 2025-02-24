<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Carbon\Carbon;
use App\Models\User;
use App\Models\FabricsComposition;


class FabricCompositionController extends Controller
{

    public function index()
    {
        $fabrics_composition = FabricsComposition::leftJoin('users', 'master_fabrics_composition.created_by', '=', 'users.id')
                                            ->whereNull('master_fabrics_composition.deleted_by')
                                            ->select('master_fabrics_composition.*', 'users.name as creator_name')
                                            ->get();
        return view('backend.products.fabrics-composition.index', compact('fabrics_composition'));
    }

    public function create(Request $request)
    { 
        return view('backend.products.fabrics-composition.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'composition_name' => 'required|string|max:255',
        ], [
            'composition_name.required' => 'The Fabrics Composition Name field is required.',
            'composition_name.string' => 'The Fabrics Composition Name must be a valid string.',
            'composition_name.max' => 'The Fabrics Composition Name cannot exceed 255 characters.',
        ]);
        
        try {
            $slug = Str::slug($request->composition_name, '-');

            FabricsComposition::create([
                'composition_name' => $request->composition_name,
                'slug' => $slug,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('fabric-composition.index')->with('message', 'Fabrics Composition created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create the Fabrics Composition. Please try again.'])->withInput();
        }
    }

    public function edit($id)
    {
        $fabrics_composiiton = FabricsComposition::findOrFail($id);

        return view('backend.products.fabrics-composition.edit', compact('fabrics_composiiton'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'composition_name' => 'required|string|max:255',
        ], [
            'composition_name.required' => 'The Fabrics Composition Name field is required.',
            'composition_name.string' => 'The Fabrics Composition Name must be a valid string.',
            'composition_name.max' => 'The Fabrics Composition Name cannot exceed 255 characters.',
        ]);
        

        try {
            $category = FabricsComposition::findOrFail($id);

            $category->update([
                'composition_name' => $request->composition_name,
                'modified_by' => Auth::user()->id, 
                'modified_at' => Carbon::now(),
            ]);

            return redirect()->route('fabric-composition.index')->with('message', 'Fabrics Composition updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update the Fabrics Composition updated. Please try again.'])->withInput();
        }
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = FabricsComposition::findOrFail($id);
            $industries->update($data);

            return redirect()->route('fabric-composition.index')->with('message', 'Fabrics Composition deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}