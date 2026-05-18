<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Submission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12">
                    <div class="w-full bg-white ">


                        <p>

                            @php
                            $uploaded = $submission ? $submission->files->count() : 0;
                            $stepLimit = 0;


                            if ($submission) {
                            if ($submission->tier == 1) {
                            if ($submission->current_step == 1) {
                            $stepLimit = 3;
                            } elseif ($submission->current_step == 2) {
                            $stepLimit = 6;
                            }
                            }

                            elseif ($submission->tier == 2) {
                            if ($submission->current_step == 1) {
                            $stepLimit = 5; // contoh tier 2 step 1
                            } elseif ($submission->current_step == 2) {
                            $stepLimit = 10;
                            }
                            }

                            elseif ($submission->tier == 3) {
                            if ($submission->current_step == 1) {
                            $stepLimit = 7; // contoh tier 2 step 1
                            } elseif ($submission->current_step == 2) {
                            $stepLimit = 14;
                            }
                            }
                            }




                            $canUpload =
                            $submission->status == 0 && // ⬅️ BELUM APPROVED
                            $stepLimit > 0 &&
                            $uploaded < $stepLimit;
                                @endphp

                                <!-- tier -->
                                @php
                                $tierStyle = match($submission->tier) {
                                1 => 'bg-gray-200 text-gray-700', // Silver
                                2 => 'bg-yellow-200 text-yellow-800', // Gold
                                3 => 'bg-slate-300 text-slate-800', // Platinum
                                default => 'bg-gray-100 text-gray-600'
                                };
                                @endphp


                                <div class=" border rounded-xl p-6 shadow-sm">

                                    <h1 class="font-semibold">

                                        <span class="px-3 py-1 mb-2 rounded-full text-sm {{ $tierStyle }}">

                                            {{ $submission->tier_badge['label'] }}
                                        </span>
                                    </h1>

                                    {{-- HEADER --}}
                                    <div class="flex justify-between items-center mb-3">
                                        <h3 class="font-semibold text-gray-700 flex items-center gap-2">
                                            Upload Screenshot
                                        </h3>

                                        <span class="text-sm text-gray-500">
                                            {{ $uploaded }} / {{ $stepLimit }} file
                                        </span>
                                    </div>

                                    {{-- PROGRESS BAR --}}
                                    <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                                        <div
                                            class="h-2 rounded-full transition-all duration-300
                {{ $submission->status == 1 ? 'bg-green-500' : 'bg-blue-600' }}"
                                            style="width: {{ $stepLimit > 0 ? min(100, ($uploaded / $stepLimit) * 100) : 0 }}%">
                                        </div>
                                    </div>

                                    {{-- FORM UPLOAD --}}
                                    @if($canUpload)
                                    <form
                                        method="POST"
                                        action="{{ route('fnf.submission.upload') }}"
                                        enctype="multipart/form-data"
                                        class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
                                        @csrf

                                        <input
                                            type="file"
                                            name="screenshot"
                                            required
                                            class="w-full text-sm
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100">

                                        <button
                                            class="px-5 py-2 bg-blue-600 hover:bg-blue-700
                       text-white rounded-lg transition">
                                            Upload
                                        </button>
                                    </form>

                                    <p class="text-xs text-gray-400 mt-2">
                                        * Upload hanya 1x tidak bisa di ulang, Pastikan screenshot jelas dan benar. 
                                    </p>
                                    @else
                                    @if($submission->status == 1)
                                    <div class="flex items-center gap-2 text-green-600 font-semibold text-sm">
                                        ✅ Submission telah disetujui, upload ditutup
                                    </div>
                                    @else
                                    <div class="flex items-center gap-2 text-gray-500 text-sm">
                                        ⏳ Upload ditutup, menunggu step berikutnya
                                    </div>
                                    @endif
                                    @endif

                                </div>

                                <hr class="my-8">




                                {{-- FORM INPUT TEXT --}}
                                <div>
                                    <h3 class="font-semibold mb-2">Referal</h3>

                                    <form method="POST" action="{{ route('fnf.submission.store') }}">
                                        @csrf

                                        @php
                                        $fields = match($submission->tier) {
                                        1 => [
                                        ['name' => 'referal1', 'type' => 'text', 'label' => $submission->referal1],
                                        ],

                                        2 => [
                                        ['name' => 'referal1', 'type' => 'text', 'label' => $submission->referal1],
                                        ['name' => 'referal2', 'type' => 'text', 'label' => $submission->referal2],
                                        ['name' => 'referal3', 'type' => 'text', 'label' => $submission->referal3],
                                        ['name' => 'referal4', 'type' => 'url', 'label' => $submission->referal4],
                                        ],
                                        3 => [
                                        ['name' => 'referal1', 'type' => 'text', 'label' => $submission->referal1],
                                        ['name' => 'referal2', 'type' => 'text', 'label' => $submission->referal2],
                                        ['name' => 'referal3', 'type' => 'text', 'label' => $submission->referal3],
                                        ['name' => 'referal4', 'type' => 'text', 'label' => $submission->referal4],
                                        ['name' => 'referal5', 'type' => 'text', 'label' => $submission->referal5],
                                        ['name' => 'referal6', 'type' => 'url', 'label' => $submission->referal6],
                                        ['name' => 'referal7', 'type' => 'url', 'label' => $submission->referal7],
                                        ],
                                        default => []
                                        };
                                        @endphp

                                        @foreach($fields as $field)

                                        @if(!($submission->tier == 1 && $field['name'] == 'referal1'))
                                        <div class="mb-3">
                                            <label class="block text-sm font-medium">
                                                {{ $field['label'] }}
                                            </label>

                                            <input
                                                type="{{ $field['type'] }}"
                                                name="{{ $field['name'] }}"
                                                class="border rounded p-2 w-full"
                                                value="{{ $submission->{$field['name']} }}"
                                                @if(!empty($submission->{$field['name']})) readonly @endif
                                            >
                                        </div>
                                        @endif

                                        @endforeach

                                        @if($submission->tier != 1)
                                        <button
                                            type="submit"
                                            class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
                                            Submit
                                        </button>
                                        @endif


                                    </form>

                                </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
</x-app-layout>