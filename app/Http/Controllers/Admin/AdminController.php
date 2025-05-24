<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    // Tampilkan daftar admin
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    // Tampilkan form tambah admin
    public function create()
    {
        return view('admin.admins.create');
    }

    // Simpan data admin baru
public function store(Request $request)
{
    $validated = $request->validate([
        'admin_name' => 'required|string|max:255',
        'admin_email' => 'required|email|unique:admins,admin_email',
        'admin_password' => 'required|string|min:6|confirmed',
    ]);

    $validated['admin_password'] = bcrypt($validated['admin_password']);

    Admin::create($validated);

    return redirect()->route('admin.admins.index')->with('success', 'Admin created successfully.');
}

  // Tampilkan form edit admin
public function edit($admin_email)
{
    $admin = Admin::where('admin_email', $admin_email)->firstOrFail();
    return view('admin.admins.edit', compact('admin'));
}


// Update data admin
public function update(Request $request, $admin_email)
{
    $rules = [
        'admin_email' => 'required|email|unique:admins,admin_email,' . $admin_email . ',admin_email',
        'admin_name' => 'required|string|max:255',
    ];

    if ($request->filled('admin_password')) {
        $rules['admin_password'] = 'string|min:6|confirmed';
    }

    $validated = $request->validate($rules);

    $admin = Admin::where('admin_email', $admin_email)->firstOrFail();
    $admin->admin_name = $validated['admin_name'];
    $admin->admin_email = $validated['admin_email'];

    if ($request->filled('admin_password')) {
        $admin->admin_password = Hash::make($validated['admin_password']);
    }

    $admin->save();

    return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully.');
}



    // Hapus admin
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully.');
    }
}
