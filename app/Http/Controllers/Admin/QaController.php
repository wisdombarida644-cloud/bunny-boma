<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qa;

class QaController extends Controller
{
    public function index()
    {
        $qas = Qa::orderBy('sort_order', 'asc')->get();
        return view('admin.qa', compact('qas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $data['sort_order'] = Qa::count() + 1;
        $data['is_published'] = true;
        Qa::create($data);

        return back()->with('success', 'Q&A added!');
    }

    public function update(Request $request, Qa $qa)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'is_published' => 'nullable|boolean',
        ]);

        $data['is_published'] = $request->has('is_published');
        $qa->update($data);

        return back()->with('success', 'Q&A updated!');
    }

    public function destroy(Qa $qa)
    {
        $qa->delete();
        return back()->with('success', 'Q&A removed!');
    }
}
