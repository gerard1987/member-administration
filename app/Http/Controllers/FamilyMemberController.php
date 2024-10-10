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
        return redirect()->route('families.index');
    }

}
