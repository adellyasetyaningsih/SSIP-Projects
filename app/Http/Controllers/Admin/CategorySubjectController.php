<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subject;

class CategorySubjectController extends Controller
{
    // Menampilkan daftar kategori dan mata pelajaran
    public function index()
    {
        $categories = Category::all();
        $subjects = Subject::with('category')->get();
        return view('admin.categories.index', compact('categories', 'subjects'));
    }

    // Menampilkan form untuk menambahkan kategori baru
    public function createCategory()
    {
        $categories = Category::all();
        $subjects = Subject::with('category')->get(); // Ambil semua subject (jika dibutuhkan di form)

        return view('admin.categories.create', compact('categories', 'subjects'));// Tampilkan form tambah kategori
    }

    // Menyimpan data kategori baru ke database
    public function storeCategory(Request $request)
    {
        // Validasi input kategori
        $request->validate([
            'category_id' => 'required|string|unique:categories,category_id',
            'price' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:1',
        ]);
        // Simpan ke database
        Category::create([
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quota' => $request->quota,
        ]);

        // Redirect kembali ke index dengan pesan sukses
        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully!');
    }

    // Menampilkan form edit kategori berdasarkan ID
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);// Ambil data berdasarkan ID, jika tidak ditemukan maka 404
        return view('admin.categories.edit', compact('category'));// Kirim ke view
    }

    // Menyimpan perubahan kategori yang diedit
    public function updateCategory(Request $request, $id)
    {
        // Validasi input dengan pengecualian unique untuk data sendiri
        $request->validate([
            'category_id' => 'required|string|max:255|unique:categories,category_id,' . $id . ',category_id',
            'price' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:1',
        ]);

        $category = Category::findOrFail($id);// Ambil data
        $category->update([
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quota' => $request->quota,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    // Menghapus kategori Berdasarkan ID
    public function destroyCategory($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }

    // Menampilkan form tambah mata pelajaran
    public function createSubject()
    {
        $categories = Category::all();
        $subjects = Subject::with('category')->get(); // Ambil semua subject dengan kategori
        return view('admin.subject.create', compact('categories', 'subjects')); //Kirim ke view
    }

    // Menyimpan subject baru ke database
    public function storeSubject(Request $request)
{
    $request->validate([ // Validasi data input
        'subject_id' => 'required',
        'title' => 'required',
        'category_id' => 'required|exists:categories,category_id',
        'desc' => 'required',
        'file_path' => 'nullable|string', // validasi sebagai link
    ]);

    // Simpan data subject ke database
    Subject::create([
        'subject_id' => $request->subject_id,
        'title' => $request->title,
        'category_id' => $request->category_id,
        'desc' => $request->desc,
        'file_path' => $request->file_path, // hanya simpan link
    ]);

    return redirect()->route('admin.categories.index')->with('success', 'Subject added successfully!');
}



    // Menampilkan form edit mata pelajaran
    public function editSubject($id)
    {
        $subject = Subject::findOrFail($id); // Ambil subject berdasarkan id
        $categories = Category::all();      // Ambil semua kategori untuk pilihan dropdown

        return view('admin.subject.edit', compact('subject', 'categories')); // Kirim ke blade
    }


    // Menyimpan perubahan mata pelajaran
    public function updateSubject(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required|exists:categories,category_id',
            'desc' => 'required',
            'file_path' => 'nullable|url', // Harus Link valid
        ]);

        $subject = Subject::findOrFail($id); //ambil data
        $subject->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'desc' => $request->desc,
            'file_path' => $request->file_path, 
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Subject updated successfully!');
    }



    // Menghapus subject berdasarkan kombinasi subject_id dan category_id
    public function destroySubject(Request $request)
    {
        $subject_id = $request->subject_id;
        $category_id = $request->category_id;

        // Menghapus hanya satu data berdasarkan kombinasi subject_id + category_id
        Subject::where('subject_id', $subject_id)
            ->where('category_id', $category_id)
            ->limit(1) // opsional, untuk memastikan hanya 1 baris
            ->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Subject deleted successfully!');
    }
}
