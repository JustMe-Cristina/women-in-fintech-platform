<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // READ + Search + Filter + Pagination
    public function index(Request $request)
    {
        $query = Member::query();

        // Căutare după nume sau email
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filtrare
        if ($request->filled('profession')) {
            $query->where('profession', 'like', '%' . $request->profession . '%');
        }

        if ($request->filled('company')) {
            $query->where('company', 'like', '%' . $request->company . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $members = $query->paginate(10);

        return view('members.index', compact('members'));
    }

    // CREATE form
    public function create()
    {
        return view('members.create');
    }

    // STORE (Create)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:members',
            'profession' => 'required',
            'company' => 'nullable',
            'linkedin_url' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ]);

        Member::create($request->all());

        return redirect()->route('members.index')
            ->with('success', 'Member added successfully!');
    }

    // EDIT form
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:members,email,' . $id,
            'profession' => 'required',
            'company' => 'nullable',
            'linkedin_url' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ]);

        $member->update($request->all());

        return redirect()->route('members.index')
            ->with('success', 'Member updated successfully!');
    }

    // DELETE
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Member deleted successfully!');
    }

    // metoda export()
    public function export()
    {
        $members = \App\Models\Member::all();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="members.csv"',
        ];

        $callback = function () use ($members) {
            $file = fopen('php://output', 'w');

            // Header CSV
            fputcsv($file, ['Name', 'Email', 'Profession', 'Company', 'Status']);

            foreach ($members as $member) {
                fputcsv($file, [
                    $member->name,
                    $member->email,
                    $member->profession,
                    $member->company,
                    $member->status,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
