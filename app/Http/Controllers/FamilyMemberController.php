<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyMember;
use App\Models\FiscalYear;
use App\Models\Contribution;
use App\Models\MemberType;


class FamilyMemberController extends Controller
{
    public function view($family_id, $member_id)
    {
        $member = FamilyMember::find($member_id);
        if (!$member) {
            abort(404, 'Family not found');
        }

        $familyRoles = FamilyMember::getRoles();
        $fiscalYears = FiscalYear::select('id', 'year')->get();
        $memberTypes = MemberType::all();

        return view('familymembers.view', compact('member', 'familyRoles', 'memberTypes', 'fiscalYears'));
    }

    public function create(Request $request)
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
                    'date_of_birth' => 'required|string|max:255',
                    'family_id' => 'required|integer',
                    'family_role' => 'required|string|max:255'
                ]);

                $member = new FamilyMember();
                $member['name'] = $request->input('name');
                $member['date_of_birth'] =  date('Y-m-d', strtotime($request->input('date_of_birth')));
                $member['family_id'] = $request->input('family_id');
                $member['family_role'] = $request->input('family_role');
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
            if (\Auth::user()->name !== 'secretary') {
                abort(403, 'Unauthorized action.');
            }

            // Check if the request method is POST
            if ($request->isMethod('post')) {

                // Validate the form inputs
                $validatedData = $request->validate([
                    'member_id' => 'required|integer',
                    'name' => 'required|string|max:255',
                    'date_of_birth' => 'required|string|max:255',
                ]);

                $member = FamilyMember::find($request->input('member_id'));
                $member['name'] = $request->input('name');
                $member['date_of_birth'] =  date('Y-m-d', strtotime($request->input('date_of_birth')));
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
            if (\Auth::user()->name !== 'secretary') {
                abort(403, 'Unauthorized action.');
            }

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

    public function add_contribution(Request $request)
    {
        try 
        {
            if (\Auth::user()->name !== 'treasurer') {
                abort(403, 'Unauthorized action.');
            }

            // Check if the request method is POST
            if ($request->isMethod('post')) {

                // Validate the form inputs
                $validatedData = $request->validate([
                    'member_id' => 'required|integer',
                    'fiscal_year' => 'required|integer',
                    'member_type' => 'required|integer'
                ]);

                $member = FamilyMember::findOrFail($request->input('member_id'));
                $memberType = MemberType::findOrFail($request->input('member_type'));

                $age = $member->getAge();
                $type = $memberType["type"] ?? null;

                $contributionAmount = Contribution::calculateContributionForMember($age, $type);

                // Check if a contribution already exists for the member in the specified fiscal year
                $contributionForFiscalYear = Contribution::where('family_member_id', $member['id'])
                    ->where('fiscal_year', $request->input('fiscal_year'))
                    ->first();
                
                if (!empty($contributionForFiscalYear)) {
                    session()->flash('status', ['type' => 'danger', 'message' => 'Family member contribution already added for fiscal year']);
                    return redirect()->route('families.members.view', ['family_id' => $member->family_id, 'member_id' => $member['id']]);
                }

                // Add contribution for member
                $contribution = new Contribution();
                $contribution['age'] = $member->getAge();
                $contribution['member_type_id'] = $memberType["id"];
                $contribution['amount'] = $contributionAmount;
                $contribution['fiscal_year'] = $request->input('fiscal_year');
                $contribution['family_member_id'] = $member["id"];

                // Save the contribution record to the database
                $contribution->save();

                // Set a success flash message and redirect to the view page
                session()->flash('status', ['type' => 'success', 'message' => 'Contribution added successfully!']);
                
                return redirect()->route('families.members.view', ['family_id' => $member['family_id'], 'member_id' => $member['id']]);
            }
        }
        catch (\InvalidArgumentException $ex)
        {
            session()->flash('status', ['type' => 'danger', 'message' => $ex->getMessage()]);
                
            return redirect()->route('families.members.view', ['family_id' => $member['family_id'], 'member_id' => $member['id']]);
        }
        catch (\Exception $ex)
        {
            session()->flash('status', ['type' => 'danger', 'message' => 'Internal server error']);
                
            return redirect()->route('families.members.view', ['family_id' => $member['family_id'], 'member_id' => $member['id']]);
        }
    }

    public function delete_contribution($family_id, $member_id, $contribution_id)
    {
        try 
        {
            if (\Auth::user()->name !== 'treasurer') {
                abort(403, 'Unauthorized action.');
            }

            $member = FamilyMember::findOrFail($member_id);
    
            // Find and delete the contribution
            $contribution = Contribution::findOrFail($contribution_id);
            $contribution->delete();

            // Set a success flash message
            session()->flash('status', ['type' => 'success', 'message' => 'Contribution deleted successfully!']);
        }
        catch(Exception $ex)
        {
            session()->flash('status', ['type' => 'danger', 'message' => 'Internal server error']);
        }
    
        // Redirect to the index page
        return redirect()->route('families.members.view', ['family_id' => $member['family_id'], 'member_id' => $member['id']]);
    }

}
