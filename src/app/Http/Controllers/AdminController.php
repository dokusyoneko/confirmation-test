<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class AdminController extends Controller
{
     public function admin()
{
    $contacts = Contact::with('category')->get()->map(function ($contact) {
        return [
            'id' => $contact->id,
            'name' => "{$contact->first_name}　{$contact->last_name}",
            'gender' => $contact->gender === 1 ? '男性' : ($contact->gender === 2 ? '女性' : 'その他'),
            'email' => $contact->email,
            'category' => $contact->category->content ?? '未分類',
        ];
    });

    return view('admin', compact('contacts'));
}

  public function show($id)
  {
    $contact = Contact::with('category')->findOrFail($id);
    $categories = Category::all(); 
    return view('admin_show', compact('contact'));
}



}