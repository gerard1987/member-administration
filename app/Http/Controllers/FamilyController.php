<?php 

namespace App\Http\Controllers;

use App\Models\Family;

class FamilyController extends Controller
{
    public function index()
    {
        // Fetch all families with their associated family members
        $families = Family::with('familyMembers')->get();
        
        return view('families.index', compact('families'));
    }

    public function view($id)
    {
        $family = Family::with('familyMembers')->find($id);

        if (!$family) {
            abort(404, 'Family not found');
        }

        // Return the view with the family data
        return view('families.view', compact('family'));
    }

    public function delete($id)
    {
        $family = Family::with('familyMembers')->find($id);
        if (!$family) {
            abort(404, 'Family not found');
        }
    
        $family->familyMembers()->delete();  // Delete family members if necessary
        $family->delete();  // Delete the family itself
    
        // Set a flash message
        // $request->session()->flash('status', 'Family has been successfully deleted!');?
        session()->flash('status', 'Family has been successfully deleted!');
    
        // Redirect to the index page
        return redirect()->route('families.index');
    }

}
