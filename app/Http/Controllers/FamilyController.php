<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\FamilyMember;

class FamilyController extends Controller
{
    public function index(Request $request, $id = null)
    {
        try 
        {
            // View
            if ($request->isMethod('get')) 
            {
                if ($id) {
                    $family = Family::with('familyMembers')->findOrFail($id);
                    $familyRoles = FamilyMember::getRoles();
            
                    return view('families.view', compact('family', 'familyRoles'));
                }

                $families = Family::with('familyMembers');
                $families = $families->get();
                
                return view('families.index', compact('families'));
            }

            // Create || Update
            if ($request->isMethod('post') || $request->isMethod('put')) 
            {
                if (\Auth::user()->name !== 'secretary') {
                    abort(403, 'Unauthorized action.');
                }
    
                // Validate the form inputs
                $validatedData = $request->validate([
                    'name' => 'required|string|max:255',
                    'adress' => 'required|string|max:255',
                ]);
    
                if ($request->isMethod('put') && $id) {
                    $family = Family::findOrFail($id);
                    $msg = "updated";
                } else {
                    $family = new Family();
                    $msg = "created";
                }
    
                // Set the family attributes and save
                $family->name = $validatedData['name'];
                $family->adress = $validatedData['adress'];
                $family->save();
            }

            // Delete
            if($request->isMethod('delete') && $id){
                $family = Family::with('familyMembers')->findOrFail($id);
                $family->familyMembers()->delete();
                $family->delete();
                $msg = "deleted";
            }

            // Flash success message
            session()->flash('status', ['type' => 'success', 'message' => 'Family ' . $msg ?? '' . ' successfully!']);
            return redirect()->back();
        }
        catch(Exception $ex)
        {
            session()->flash('status', ['type' => 'danger', 'message' => 'Internal server error']);
            return redirect()->back();
        }
    }
}
