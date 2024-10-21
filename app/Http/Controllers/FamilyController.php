<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\FamilyMember;

class FamilyController extends Controller
{
    public function index()
    {
        try 
        {
            $families = Family::with('familyMembers')->get();
            
            return view('families.index', compact('families'));
        }
        catch(Exception $ex)
        {
            return redirect()->back();
        }
    }

    public function create(Request $request)
    {
        try 
        {
            if (\Auth::user()->name !== 'secretary') {
                abort(403, 'Unauthorized action.');
            }

            if ($request->isMethod('post')) 
            {
                // Validate the form inputs
                $validatedData = $request->validate([
                    'name' => 'required|string|max:255',
                    'adress' => 'required|string|max:255',
                ]);

                $family = new Family();
                $family->name = $request->input('name');
                $family->adress = $request->input('adress');
                $family->save();

                session()->flash('status', ['type' => 'success', 'message' => 'Family created successfully!']);
                
                return redirect()->route('families.index');
            }
        }
        catch (Exception $ex)
        {
            session()->flash('status', ['type' => 'danger', 'message' => 'Internal server error']);
                
            return redirect()->route('families.index');
        }
    }    

    public function view($id)
    {
        try 
        {
            $family = Family::with('familyMembers')->findOrFail($id);
            $familyRoles = FamilyMember::getRoles();
    
            return view('families.view', compact('family', 'familyRoles'));
        }
        catch(Exception $ex)
        {
            session()->flash('status', ['type' => 'danger', 'message' => 'Internal server error']);
            return redirect()->back();
        }
    }

    public function edit(Request $request)
    {
        try 
        {
            if (\Auth::user()->name !== 'secretary') {
                abort(403, 'Unauthorized action.');
            }

            // Check if the request method is POST
            if ($request->isMethod('post')) {

                // Validate the form inputs
                $validatedData = $request->validate([
                    'name' => 'required|string|max:255',
                    'adress' => 'required|string|max:255',
                ]);

                $family = Family::findOrFail($request->input('family_id'));
                $family->name = $request->input('name');
                $family->adress =  $request->input('adress');
                $family->save();

                session()->flash('status', ['type' => 'success', 'message' => 'Family member edited successfully!']);
                
                return redirect()->back();
            }
        }
        catch (Exception $ex)
        {
            session()->flash('status', ['type' => 'danger', 'message' => 'Internal server error']);
                
            return redirect()->back();
        }
    }    

    public function delete($id)
    {
        try 
        {
            if (\Auth::user()->name !== 'secretary') {
                abort(403, 'Unauthorized action.');
            }

            $family = Family::with('familyMembers')->findOrFail($id);        
            $family->familyMembers()->delete();
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
