<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyMember;

class FamilyMemberController extends Controller
{
    public function view($id)
    {
        $member = FamilyMember::find($id);

        if (!$member) {
            abort(404, 'Family not found');
        }

        // Return the view with the family data
        return view('familymembers.view', compact('member'));
    }
}
