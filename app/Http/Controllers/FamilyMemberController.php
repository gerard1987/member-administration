<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyMember;
use App\Models\FiscalYear;
use App\Models\Contribution;
use App\Models\MemberType;


class FamilyMemberController extends Controller
{
    public function index(Request $request, $family_id = null, $member_id = null)
    {
        try 
        {
            $msg = '';

            // View
            if ($request->isMethod('get') && $member_id) 
            {
                $member = FamilyMember::findOrFail($member_id);
                $familyRoles = FamilyMember::getRoles();
                $fiscalYears = FiscalYear::select('id', 'year')->get();
                $memberTypes = MemberType::all();
        
                return view('familymembers.view', compact('member', 'familyRoles', 'memberTypes', 'fiscalYears'));
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
                    'date_of_birth' => 'required|string|max:255',
                    'family_id' => 'required|integer',
                    'family_role' => 'required|string|max:255'
                ]);
    
                if ($request->isMethod('put') && $member_id) {
                    $member = FamilyMember::findOrFail($member_id);
                    $msg = "updated";
                } else {
                    $member = new FamilyMember();
                    $msg = "created";
                }
    
                // Set the member attributes and save
                $member->name = $request->input('name');
                $member->date_of_birth =  date('Y-m-d', strtotime($request->input('date_of_birth')));
                $member->family_id = $request->input('family_id');
                $member->family_role = $request->input('family_role');
                $member->save();
            }

            // Delete
            if($request->isMethod('delete') && $member_id){
                $member = FamilyMember::findOrFail($member_id);
                $member->delete();
                $msg = "deleted";
            }

            // Flash success message
            session()->flash('status', ['type' => 'success', 'message' => 'Familymember ' . $msg ?? '' . ' successfully!']);
            return redirect()->back();
        }
        catch(Exception $ex)
        {
            session()->flash('status', ['type' => 'danger', 'message' => 'Internal server error']);
            return redirect()->back();
        }
    }
}
