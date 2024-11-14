<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticelController extends Controller
{
    public function index(){
        return view('admin.articel.data');
    }

    public function create(){
        $data = [
            'form' => 'Tambah',
            'action' => route('articel.store')
        ];
        return view('admin.articel.form', compact('data'));
    }

    public function edit($id){
        // Mengambil data artikel berdasarkan id
        $article = Articel::findOrFail($id);

        // Mengirimkan data artikel ke view form edit
        return view('admin.articel.form_edit', [
            'form' => 'Edit',
            'action' => route('articel.update', $id), // Menggunakan route update dengan parameter id
            'articel' => $articel
        ]);
    }

    public function update(Request $request, $id){
        // Validasi data input
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Mengambil artikel yang akan diupdate
        $article = Articel::findOrFail($id);

        // Mengupdate artikel
        $article->title = $request->title;
        $article->slug = $request->slug;
        $article->description = $request->description;
        $article->date = $request->date;

        // Jika ada gambar yang diupload
        if ($request->hasFile('image')) {
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('images', 'public');
            $article->image = $imagePath;
        }

        // Simpan perubahan
        $article->save();

        // Redirect ke halaman artikel setelah berhasil diperbarui
        return redirect()->route('admin/articel')->with('success', 'Artikel berhasil diperbarui');
    }

}

