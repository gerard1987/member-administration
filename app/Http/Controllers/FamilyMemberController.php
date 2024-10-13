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

                $member = new FamilyMember();
                $member['name'] = $request->input('name');
                $member['date_of_birth'] =  date('Y-m-d', strtotime($request->input('date_of_birth')));
                $member['member_type_id'] = $request->input('member_type_id');
                $member['family_id'] = $request->input('family_id');
                $member->save();

                session()->flash('status', ['type' => 'success', 'message' => 'Family member created successfully!']);
                
                return redirect()->route('families.view', ['id' => $member['family_id']]);
            }
        }
        catch (Exception $ex)
        {
            session()->flash('status', ['type' => 'danger', 'message' => 'Internal server error']);
                
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
                    'member_id' => 'required|integer',
                    'name' => 'required|string|max:255',
                    'date_of_birth' => 'required|string|max:255',
                    'member_type_id' => 'required|integer'
                ]);

                $member = FamilyMember::find($request->input('member_id'));
                $member['name'] = $request->input('name');
                $member['date_of_birth'] =  date('Y-m-d', strtotime($request->input('date_of_birth')));
                $member['member_type_id'] = $request->input('member_type_id');
                $member->save();

                session()->flash('status', ['type' => 'success', 'message' => 'Family member edited successfully!']);
                
                return redirect()->route('families.members.view', ['family_id' => $member['family_id'], 'member_id' => $member['id']]);
            }
        }
        catch (Exception $ex)
        {
            session()->flash('status', ['type' => 'danger', 'message' => 'Internal server error']);
                
            return redirect()->route('families.view', ['id' => $request->route('id')]);
        }
    }

    public function delete($family_id, $member_id)
    {
        try 
        {
            $member = FamilyMember::find($member_id);
            if (!$member) {
                abort(404, 'Family not found');
            }
        
            $member->delete();
        
            session()->flash('status', ['type' => 'success', 'message' => 'Family member has been successfully deleted!']);
        }
        catch(Exception $ex)
        {
            session()->flash('status', ['type' => 'danger', 'message' => 'Internal server error']);
        }
    
        // Redirect to the index page
        return redirect()->route('families.view', ['id' => $family_id]);
    }

}
