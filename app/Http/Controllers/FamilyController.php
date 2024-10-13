<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;

class FamilyController extends Controller
{
    public function index()
    {
        // Fetch all families with their associated family members
        $families = Family::with('familyMembers')->get();
        
        return view('families.index', compact('families'));
    }

    public function create(Request $request)
    {
        try 
        {
            // Check if the request method is POST
            if ($request->isMethod('post')) {
                // Validate the form inputs
                $validatedData = $request->validate([
                    'name' => 'required|string|max:255',
                    'adress' => 'required|string|max:255',
                ]);

                $family = new Family();
                $family['name'] = $request->input('name');
                $family['adress'] = $request->input('adress');
                $family->save();

                session()->flash('status', ['type' => 'success', 'message' => 'Family created successfully!']);
                
                return redirect()->route('families.index');
            }
        }
        catch (Exception $ex)
        {
            session()->flash('status', 'Internal server error');
                
            return redirect()->route('families.index');
        }
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
        try 
        {
            $family = Family::with('familyMembers')->find($id);
            if (!$family) {
                abort(404, 'Family not found');
            }
        
            $family->familyMembers()->delete();  // Delete family members if necessary
            $family->delete();
        
            session()->flash('status', ['type' => 'success', 'message' => 'Family has been successfully deleted!']);
        }
        catch(Exception $ex)
        {
            session()->flash('status', ['type' => 'danger', 'message' => 'Family could not be deleted!']);
        }

        // Redirect to the index page
        return redirect()->route('families.index');
    }

}
