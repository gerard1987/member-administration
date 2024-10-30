<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyMember;
use App\Models\FiscalYear;
use App\Models\Contribution;
use App\Models\MemberType;

class ContributionController extends Controller
{
    public function index(Request $request, $family_id = null, $member_id = null, $contribution_id = null)
    {
        try 
        {
            $msg = '';

            if (\Auth::user()->name !== 'treasurer') {
                abort(403, 'Unauthorized action.');
            }

            // Create || Update
            if ($request->isMethod('post')) 
            {
                // Validate the form inputs
                $validatedData = $request->validate([
                    'member_id' => 'required|integer',
                    'fiscal_year' => 'required|integer',
                    'member_type' => 'required|integer'
                ]);
    
                $member = FamilyMember::findOrFail($member_id);
                $memberType = MemberType::findOrFail($request->input('member_type'));

                // Check if a contribution already exists for the member in the specified fiscal year
                $contributionForFiscalYear = Contribution::where('family_member_id', $member->id)
                    ->where('fiscal_year', $request->input('fiscal_year'))
                    ->first();
                
                if (!empty($contributionForFiscalYear)) {
                    session()->flash('status', ['type' => 'danger', 'message' => 'Family member contribution already added for fiscal year']);
                    return redirect()->back();
                }

                $age = $member->getAge();
                $type = $memberType->type ?? null;
                $contributionAmount = Contribution::calculateContributionForMember($age, $type);

                // Add contribution for member
                $contribution = new Contribution();
                $contribution->age = $member->getAge();
                $contribution->member_type_id = $memberType->id;
                $contribution->amount = $contributionAmount;
                $contribution->fiscal_year = $request->input('fiscal_year');
                $contribution->family_member_id = $member->id;

                // Save the contribution
                $contribution->save();

                $msg = "added";
            }

            // Delete
            if($request->isMethod('delete') && $member_id && $contribution_id){
                $member = FamilyMember::findOrFail($member_id);
                $contribution = Contribution::findOrFail($contribution_id);
                $contribution->delete();
                $msg = "deleted";
            }

            // Flash success message
            session()->flash('status', ['type' => 'success', 'message' => 'Contribution ' . $msg ?? '' . ' successfully!']);
            return redirect()->back();
        }
        catch (\InvalidArgumentException $ex)
        {
            session()->flash('status', ['type' => 'danger', 'message' => $ex->getMessage()]);       
            return redirect()->back();
        }
        catch(Exception $ex)
        {
            session()->flash('status', ['type' => 'danger', 'message' => 'Internal server error']);
            return redirect()->back();
        }
    }
}
