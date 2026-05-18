<?php

namespace App\Http\Controllers\FNF;

use App\Http\Controllers\Controller;
use App\Models\FnfSubmission;
use Illuminate\Http\Request;

class FnfSubmissionController extends Controller
{
    // public function index()
    // {
    //     $submission = FnfSubmission::where('user_id', auth()->id())->first();
    //     return view('fnf.submission', compact('submission'));
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'fullname' => 'required|string|max:255',
    //         'phone' => 'required|string|max:50',
    //         'instagram' => 'required|string|max:255',

    //         'ss1' => 'required|image|max:2048',
    //         'ss2' => 'required|image|max:2048',
    //         'ss3' => 'required|image|max:2048',
    //         'ss4' => 'required|image|max:2048',
    //         'ss5' => 'required|image|max:2048',
    //         'ss6' => 'required|image|max:2048',
    //     ]);

    //     $data = [
    //         'user_id'   => auth()->id(),
    //         'fullname'  => $request->fullname,
    //         'phone'     => $request->phone,
    //         'instagram' => $request->instagram,
    //         'tier'      => 1, // Silver
    //         'status'    => 0, // Pending
    //     ];

    //     // upload file
    //     for ($i = 1; $i <= 6; $i++) {
    //         $data['ss'.$i] = $request->file('ss'.$i)->store('fnf', 'public');
    //     }

    //     FnfSubmission::updateOrCreate(
    //         ['user_id' => auth()->id()],
    //         $data
    //     );

    //     return redirect()->back()->with('success', 'Submission berhasil dikirim 🎉');
    // }

    public function index()
    {
        $submission = FnfSubmission::firstOrCreate(
            ['user_id' => auth()->id()],
            [
                'tier' => 1,
                'status' => 0,
            ]
        );

        return view('fnf.submission', compact('submission'));
    }


    public function store(Request $request)
    {
        $submission = FnfSubmission::where('user_id', auth()->id())->firstOrFail();

        if ($submission->status > 0) {
            return back()->with('error', 'Submission sudah terkunci');
        }

        // cek screenshot lengkap
        for ($i = 1; $i <= 6; $i++) {
            if (empty($submission->{'ss' . $i})) {
                return back()->with('error', 'Screenshot belum lengkap');
            }
        }

        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'instagram' => 'required|string|max:255',
        ]);

        $submission->update([
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'instagram' => $request->instagram,
            'status' => 1, // pending
        ]);

        return back()->with('success', 'Submission berhasil dikirim 🎉');
    }

    private function nextAvailableSlot(FnfSubmission $submission)
    {
        for ($i = 1; $i <= 6; $i++) {
            if (empty($submission->{'ss' . $i})) {
                return 'ss' . $i;
            }
        }
        return null; // sudah penuh
    }

    public function upload(Request $request)
    {
        $request->validate([
            'screenshot' => 'required|image|max:2048',
            'fullname' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'instagram' => 'nullable|string|max:255',
        ]);

        $submission = FnfSubmission::where('user_id', auth()->id())->first();

        // update text setiap submit (biar kesimpan terus)
        $submission->update([
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'instagram' => $request->instagram,
        ]);

        // cari slot kosong
        for ($i = 1; $i <= 6; $i++) {
            if (empty($submission->{'ss' . $i})) {
                $submission->{'ss' . $i} = $request->file('screenshot')->store('fnf', 'public');
                break;
            }
        }

        $submission->save();

        return back()->with('success', 'Screenshot berhasil diupload');
    }



    //         public function upload(Request $request)
    // {
    //     $request->validate([
    //         'screenshot' => 'required|image|max:2048',
    //     ]);

    //     $submission = FnfSubmission::firstOrCreate(
    //         ['user_id' => auth()->id()],
    //         [
    //             'fullname' => auth()->user()->name,
    //             'tier' => 1,
    //             'status' => 0,
    //         ]
    //     );

    //     $slot = $this->nextAvailableSlot($submission);

    //     if (!$slot) {
    //         return back()->with('error', 'Semua screenshot sudah diupload');
    //     }

    //     $submission->$slot = $request->file('screenshot')->store('fnf', 'public');
    //     $submission->save();

    //     return back()->with('success', 'Screenshot berhasil diupload');
    // }


}
