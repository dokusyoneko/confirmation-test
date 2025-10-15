<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class AdminController extends Controller
{
     public function admin(Request $request)
{
    $query = Contact::query();

    if ($request->filled('keyword')) {
        $query->where(function ($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('email', 'like', '%' . $request->keyword . '%');
        });
    }

    if ($request->filled('gender') && $request->gender !== 'all') {
    $query->where('gender', $request->gender);
}


    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $contacts = $query->with('category')->paginate(7)->appends($request->query());
    $categories = Category::all();

    return view('admin', compact('contacts', 'categories'));
}


    public function show($id)
{
    if (request()->ajax()) {
        $contact = Contact::with('category')->findOrFail($id);
        return view('admin.modal_detail', compact('contact'));
    }
    return redirect()->route('admin');
}

    public function destroy($id)
{
    $contact = Contact::findOrFail($id);
    $contact->delete();
    return response()->json(['message' => '']);
}



}