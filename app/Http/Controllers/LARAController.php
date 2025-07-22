<?php

namespace App\Http\Controllers;

use App\Models\LARA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Controller untuk mengelola surat digital LARA
 * 
 * Controller ini menangani semua operasi terkait surat digital, termasuk:
 * - Pembuatan surat digital baru
 * - Penampilan daftar surat
 * - Pengubahan surat
 * - Penghapusan surat
 * - Manajemen lampiran gambar
 * - Pengelolaan hak akses surat
 */
class LARAController extends Controller
{
    use AuthorizesRequests; // Trait untuk otorisasi akses

    /**
     * Menampilkan daftar surat digital milik pengguna yang sedang login
     * 
     * @return \Illuminate\View\View Tampilan daftar surat digital
     */
    public function index()
    {
        // Mengambil surat digital milik pengguna yang sedang login
        // Diurutkan dari yang terbaru dan ditampilkan 10 per halaman
        $laras = LARA::where('pemilik_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('laras.index', compact('laras'));
    }

    /**
     * Menampilkan formulir untuk membuat surat digital baru
     * 
     * @return \Illuminate\View\View Tampilan formulir pembuatan surat
     */
    public function create()
    {
        return view('laras.create');
    }

    /**
     * Menyimpan surat digital baru ke database
     * 
     * @param Request $request Request berisi data surat digital
     * @return \Illuminate\Http\RedirectResponse Redirect ke halaman daftar surat
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'title' => 'required|string|max:255',      // Judul surat (wajib)
            'content' => 'required|string',            // Isi surat (wajib)
            'recipient_email' => 'required|email|max:255', // Email penerima (wajib)
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar (opsional)
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'pemilik_id' => Auth::id(),
            'recipient_email' => $request->recipient_email,
            'is_released' => false,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('will-images', 'public');
            $data['image_path'] = $imagePath;
        }

        LARA::create($data);

        return redirect()->route('laras.index')->with('success', 'Digital will created successfully.');
    }

    /**
     * Display the specified digital will.
     */
    public function show(LARA $lara)
    {
        // Allow viewing if user is the owner or the recipient (when released)
        if ($lara->pemilik_id === Auth::id() || 
            ($lara->recipient_email === Auth::user()->email && $lara->is_released)) {
            return view('laras.show', compact('lara'));
        }

        abort(403, 'Unauthorized action.');
    }

    /**
     * Show the form for editing the specified digital will.
     */
    public function edit(LARA $lara)
    {
        $this->authorize('update', $lara);
        return view('laras.edit', compact('lara'));
    }

    /**
     * Update the specified digital will in storage.
     */
    public function update(Request $request, LARA $lara)
    {
        $this->authorize('update', $lara);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'recipient_email' => 'required|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'recipient_email' => $request->recipient_email,
        ];

        // Handle image removal
        if ($request->has('remove_image') && $request->remove_image == '1') {
            if ($lara->image_path) {
                Storage::disk('public')->delete($lara->image_path);
            }
            $data['image_path'] = null;
        }
        // Handle new image upload
        elseif ($request->hasFile('image')) {
            // Delete old image if exists
            if ($lara->image_path) {
                Storage::disk('public')->delete($lara->image_path);
            }
            
            $imagePath = $request->file('image')->store('will-images', 'public');
            $data['image_path'] = $imagePath;
        }

        $lara->update($data);

        return redirect()->route('laras.index')->with('success', 'Digital will updated successfully.');
    }

    /**
     * Remove the specified digital will from storage.
     */
    public function destroy(LARA $lara)
    {
        $this->authorize('delete', $lara);

        // Delete the associated image if it exists
        if ($lara->image_path) {
            Storage::disk('public')->delete($lara->image_path);
        }

        $lara->delete();

        return redirect()->route('laras.index')->with('success', 'Digital letter deleted successfully.');
    }

    /**
     * Get the user's received letters and sent wills for the dashboard.
     */
    public function getDashboard()
    {
        $receivedLetters = LARA::where('recipient_email', Auth::user()->email)
            ->where('is_released', true)
            ->latest()
            ->paginate(10);

        $sentLetters = LARA::where('pemilik_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pages.dashboard', compact('receivedLetters', 'sentLetters'));
    }
}
