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
use App\Models\Permission;
use App\Models\UsersPermission;
use App\Models\MasterCollections;


class CollectionsController extends Controller
{

    public function index()
    {
        $collections = MasterCollections::leftJoin('users', 'master_collections.created_by', '=', 'users.id')
                                        ->whereNull('master_collections.deleted_by')
                                        ->select('master_collections.*', 'users.name as creator_name')
                                        ->get();
                                        
        return view('backend.products.collections.index', compact('collections'));
    }

    public function create(Request $request)
    { 
        return view('backend.products.collections.create');
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'collection_name' => 'required|string|max:255',
        ], [
            'collection_name.required' => 'The Collection Name field is required.',
            'collection_name.string' => 'The Collection Name must be a valid string.',
            'collection_name.max' => 'The Collection Name cannot exceed 255 characters.',
        ]);
        
        try {
            $slug = Str::slug($request->collection_name, '-');

            MasterCollections::create([
                'collection_name' => $request->collection_name,
                'slug' => $slug,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('collections.index')->with('message', 'Collection created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create the collection. Please try again.'])->withInput();
        }
    }


    public function edit($id)
    {
        $collections = MasterCollections::findOrFail($id);

        return view('backend.products.collections.edit', compact('collections'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'collection_name' => 'required|string|max:255',
        ], [
            'collection_name.required' => 'The Collection Name field is required.',
            'collection_name.string' => 'The Collection Name must be a valid string.',
            'collection_name.max' => 'The Collection Name cannot exceed 255 characters.',
        ]);

        try {

            $collection = MasterCollections::findOrFail($id);
            $collection->update([
                'collection_name' => $request->collection_name,
                'modified_by' => Auth::user()->id, 
                'modified_at' => Carbon::now(),
            ]);
            return redirect()->route('collections.index')->with('message', 'Collection updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update the collection. Please try again.'])->withInput();
        }
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = MasterCollections::findOrFail($id);
            $industries->update($data);

            return redirect()->route('collections.index')->with('message', 'Collection deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}