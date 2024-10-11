<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyMember;

class FamilyMemberController extends Controller
{
    public function view($family_id, $member_id)
    {
        $member = FamilyMember::find($member_id);

        if (!$member) {
            abort(404, 'Family not found');
        }

        // Return the view with the family data
        return view('familymembers.view', compact('member'));
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
                    'date_of_birth' => 'required|string|max:255',
                    'member_type_id' => 'required|integer',
                    'family_id' => 'required|integer'
                ]);

                $family = new FamilyMember();
                $family['name'] = $request->input('name');
                $family['date_of_birth'] =  date('Y-m-d', strtotime($request->input('date_of_birth')));
                $family['member_type_id'] = $request->input('member_type_id');
                $family['family_id'] = $request->input('family_id');
                $family->save();

                session()->flash('status', 'Family created successfully!');
                
                return redirect()->route('families.view', ['id' => $request->route('id')]);
            }
        }
        catch (Exception $ex)
        {
            session()->flash('status', 'Internal server error');
                
            return redirect()->route('families.view', ['id' => $request->route('id')]);
        }
    }

    public function edit(Request $request)
    {
        try 
        {
            // Check if the request method is POST
            if ($request->isMethod('post')) {

                // Validate the form inputs
                $validatedData = $request->validate([
                    'id' => 'required|integer',
                    'name' => 'required|string|max:255',
                    'date_of_birth' => 'required|string|max:255',
                    'member_type_id' => 'required|integer',
                    'family_id' => 'required|integer'
                ]);

                $family = FamilyMember::find($request->input('id'));
                $family['name'] = $request->input('name');
                $family['date_of_birth'] =  date('Y-m-d', strtotime($request->input('date_of_birth')));
                $family['member_type_id'] = $request->input('member_type_id');
                $family['family_id'] = $request->input('family_id');
                $family->save();

                session()->flash('status', 'Family created successfully!');
                
                return redirect()->route('families.view', ['id' => $request->route('id')]);
            }
        }
        catch (Exception $ex)
        {
            session()->flash('status', 'Internal server error');
                
            return redirect()->route('families.view', ['id' => $request->route('id')]);
        }
    }

    public function delete($family_id, $member_id)
    {
        $member = FamilyMember::find($member_id);
        if (!$member) {
            abort(404, 'Family not found');
        }
    
        $member->delete();
    
        // Set a flash message
        session()->flash('status', 'Family member has been successfully deleted!');
    
        // Redirect to the index page
        return redirect()->route('families.view', ['id' => $family_id]);
    }

}
