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
}
