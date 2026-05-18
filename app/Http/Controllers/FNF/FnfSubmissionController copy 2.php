<?php

namespace App\Http\Controllers\FNF;

use App\Http\Controllers\Controller;
use App\Models\FnfSubmission;
use Illuminate\Http\Request;

class FnfSubmissionController extends Controller
{
    /**
     * Dashboard + Submission page
     */
    public function index()
    {
        $submission = FnfSubmission::firstOrCreate(
            ['user_id' => auth()->id()],
            [
                'tier' => 1,   // Silver
                'status' => 0 // Draft / Pending
            ]
        );

        return view('fnf.submission', compact('submission'));
    }

    /**
     * Simpan / update data diri (TEXT FORM)
     * Bisa diisi kapan saja
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'instagram' => 'required|string|max:255',
        ]);

        FnfSubmission::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'instagram' => $request->instagram,
            ]
        );

        return back()->with('success', 'Data diri berhasil disimpan ✅');
    }

    /**
     * Upload screenshot 1 per 1
     */
    public function upload(Request $request)
    {
        $request->validate([
            'screenshot' => 'required|image|max:2048',
        ]);

        $submission = FnfSubmission::where('user_id', auth()->id())->firstOrFail();

        // kalau sudah dikunci
        if ($submission->status == 1) {
            return back()->with('error', 'Submission sudah terkunci');
        }

        // cari slot kosong
        for ($i = 1; $i <= 6; $i++) {
            if (empty($submission->{'ss' . $i})) {
                $submission->{'ss' . $i} = $request->file('screenshot')
                    ->store('fnf', 'public');
                $submission->save();

                return back()->with('success', "Screenshot {$i} berhasil diupload 📸");
            }
        }

        return back()->with('error', 'Semua screenshot sudah lengkap');
    }

    /**
     * Submit FINAL (kunci submission)
     */
    public function submit()
    {
        $submission = FnfSubmission::where('user_id', auth()->id())->firstOrFail();

        // cek text
        if (!$submission->fullname || !$submission->phone || !$submission->instagram) {
            return back()->with('error', 'Data diri belum lengkap');
        }

        // cek screenshot
        for ($i = 1; $i <= 6; $i++) {
            if (empty($submission->{'ss' . $i})) {
                return back()->with('error', 'Screenshot belum lengkap');
            }
        }

        $submission->update([
            'status' => 1 // submitted / pending admin
        ]);

        return back()->with('success', 'Submission berhasil dikirim 🎉');
    }
}
