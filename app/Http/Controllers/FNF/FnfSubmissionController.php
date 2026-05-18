<?php

namespace App\Http\Controllers\FNF;

use App\Http\Controllers\Controller;
use App\Models\FnfSubmission;
use Illuminate\Http\Request;

class FnfSubmissionController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $submission = FnfSubmission::firstOrCreate(
            [
                'user_id' => $user->id,
                'tier' => $user->tier,
            ],
            [
                'current_step' => 1,
                'status' => 0
            ]
        );

        $rule = $this->submissionRule($user->tier);

        return view('fnf.submission', compact('submission', 'rule'));
    }


    // public function store(Request $request)
    // {
    //     $tier = auth()->user()->tier;

    //     $limit = match ($tier) {
    //         1 => 1,
    //         2 => 4,
    //         3 => 7,
    //         default => 0
    //     };

    //     // validasi
    //     $rules = [];
    //     for ($i = 1; $i <= $limit; $i++) {
    //         $rules["referal{$i}"] = 'required|string|max:255';
    //     }
    //     $request->validate($rules);

    //     // 🔑 PENTING: BUAT ROW BARU PER TIER
    //     $submission = FnfSubmission::firstOrCreate(
    //         [
    //             'user_id' => auth()->id(),
    //             'tier' => $tier,
    //         ],
    //         [
    //             'status' => 0,
    //         ]
    //     );

    //     // isi datanya
    //     $data = [];
    //     for ($i = 1; $i <= $limit; $i++) {
    //         $data["referal$i"] = $request->input("referal$i");
    //     }

    //     $submission->update($data);

    //     return back()->with('success', 'Data tersimpan');
    // }

    // public function store(Request $request)
    // {
    //     $submission = FnfSubmission::firstOrCreate(
    //         [
    //             'user_id' => auth()->id(),
    //             'tier' => auth()->user()->tier,
    //         ],
    //         [
    //             'status' => 0,
    //         ]
    //     );

    //     // simpan semua referal sesuai tier
    //     for ($i = 1; $i <= 7; $i++) {
    //         $field = 'referal' . $i;

    //         if ($request->has($field)) {
    //             $submission->$field = $request->$field;
    //         }
    //     }

    //     $submission->save();

    //     return back()->with('success', 'Data berhasil disimpan');
    // }

    public function store(Request $request)
{
    $submission = FnfSubmission::firstOrCreate(
        [
            'user_id' => auth()->id(),
            'tier' => auth()->user()->tier,
        ],
        [
            'status' => 0,
        ]
    );

    $data = [];

    foreach (range(1, 7) as $i) {
        $field = "referal{$i}";

        // Kalau ada input dan tidak kosong
        if ($request->filled($field)) {

            // Cek apakah field di database masih kosong
            if (empty($submission->$field)) {
                $data[$field] = $request->$field;
            }
        }
    }

    if (!empty($data)) {
        $submission->update($data);
    }

    return back()->with('success', 'Data berhasil disimpan');
}




    // upload screenshot
    public function upload(Request $request)
    {
        $request->validate([
            'screenshot' => 'required|image|max:2048',
        ]);


        $submission = FnfSubmission::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'tier' => auth()->user()->tier,
            ],
            [
                'status' => 0
            ]
        );


        $rule = $this->submissionRule(auth()->user()->tier);

        if ($submission->files()->count() >= $rule['max_files']) {
            return back()->with('error', 'Screenshot sudah lengkap');
        }

        $path = $request->file('screenshot')->store('fnf', 'public');

        $submission->files()->create([
            'file_path' => $path
        ]);

        return back()->with('success', 'Screenshot diupload');
    }


    // submit final
    public function submit()
    {


        $submission = FnfSubmission::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'tier' => auth()->user()->tier,

            ],
            [
                'status' => 0,
            ]
        );


        $rule = $this->submissionRule(auth()->user()->tier);

        // cek text wajib
        foreach ($rule['text'] as $field) {
            if (!$submission->$field) {
                return back()->with('error', 'Data diri belum lengkap');
            }
        }

        // cek screenshot
        if ($submission->files()->count() < $rule['max_files']) {
            return back()->with('error', 'Screenshot belum lengkap');
        }

        $submission->update(['status' => 1]);

        return back()->with('success', 'Submission dikirim 🎉');
    }


    private function submissionRule($tier)
    {
        return match ($tier) {
            1 => [
                'text' => ['referal1'],

                'max_files' => 6,
            ],
            2 => [
                'text' => ['referal1', 'referal2', 'referal3'],
                'links' => ['referal4'],
                'max_files' => 10,
            ],
            3 => [
                'text' => ['referal1', 'referal2', 'referal3', 'referal4', 'referal5'],
                'links' => ['referal6', 'referal7'],
                'max_files' => 14,
            ],
            default => [
                'text' => [],
                'max_files' => 0,
            ],
        };
    }

    private function tierLimit($tier)
    {
        return match ($tier) {
            1 => 1,
            2 => 4,
            3 => 7,
            default => 0
        };
    }

    
}
