<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="py-10 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

                {{-- GREETING CARD --}}
                <div class="bg-white rounded-3xl shadow-lg p-8 border border-gray-100">
                    <h3 class="text-3xl font-bold text-gray-800">
                        👋 Hallo {{ Auth::user()->name }}
                    </h3>
                    <p class="text-gray-500 mt-3 text-lg">
                        Terima kasih sudah menjadi bagian dari <span class="font-semibold text-indigo-600">MOVI</span>.
                        Yuk selesaikan submission dan naikkan tier kamu 🚀
                    </p>
                </div>

                {{-- PROGRESS CARD --}}
                <div class="bg-white rounded-3xl shadow-lg p-8 border border-gray-100">

                    @php
                    $uploaded = $submission ? $submission->files->count() : 0;
                    $max = $rule['max_files'] ?? 0;
                    $percent = $max > 0 ? round(($uploaded / $max) * 100) : 0;
                    @endphp

                    @php
                    $tierStyle = match($submission?->tier) {
                    1 => 'bg-gray-200 text-gray-700',
                    2 => 'bg-yellow-200 text-yellow-800',
                    3 => 'bg-slate-300 text-slate-800',
                    default => 'bg-gray-100 text-gray-600'
                    };
                    @endphp

                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">📤</span>

                            <span class="px-4 py-1 rounded-full text-sm font-semibold {{ $tierStyle }}">
                                @if($submission)
                                {{ $submission->tier_badge['label'] }}
                                @else
                                Belum Ada Tier
                                @endif
                            </span>
                        </div>

                        <span class="text-sm text-gray-500 font-medium">
                            {{ $uploaded }} / {{ $max }} file
                        </span>
                    </div>

                    {{-- Progress Bar --}}
                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                        <div
                            class="h-4 rounded-full transition-all duration-700 ease-out
                    {{ $percent == 100 ? 'bg-green-500' : 'bg-indigo-600' }}"
                            style="width: {{ $percent }}%">
                        </div>
                    </div>

                    <div class="flex justify-between mt-3 text-sm">
                        <span class="text-gray-500">
                            Progress {{ $percent }}%
                        </span>

                        <span>
                            @if($submission && $submission->status == 1)
                            <span class="text-green-600 font-semibold">Approved ✅</span>
                            @else
                            <span class="text-yellow-600 font-semibold">In Progress ⏳</span>
                            @endif
                        </span>
                    </div>
                </div>

                {{-- TIER CARDS --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    {{-- TIER 1 --}}
                    <div class="group bg-white rounded-3xl shadow-lg p-6 border border-gray-100 hover:shadow-2xl transition">
                        <div class="mb-4">
                            <span class="text-3xl">🥈</span>
                            <h4 class="text-xl font-bold text-gray-700 mt-2">Tier Silver</h4>
                        </div>
                        <ul class="text-gray-600 space-y-2 text-sm">
                            <li>• 1 referal text</li>
                            <li>• Upload 6 screenshot</li>
                            <li>• 2 step upload</li>
                        </ul>
                    </div>

                    {{-- TIER 2 --}}
                    <div class="group bg-white rounded-3xl shadow-lg p-6 border border-gray-100 hover:shadow-2xl transition">
                        <div class="mb-4">
                            <span class="text-3xl">🥇</span>
                            <h4 class="text-xl font-bold text-gray-700 mt-2">Tier Gold</h4>
                        </div>
                        <ul class="text-gray-600 space-y-2 text-sm">
                            <li>• 3 referal text</li>
                            <li>• 1 link posting</li>
                            <li>• Upload 10 Screenshot</li>
                            <li>• 2 step upload</li>
                        </ul>
                    </div>

                    {{-- TIER 3 --}}
                    <div class="group bg-white rounded-3xl shadow-lg p-6 border border-gray-100 hover:shadow-2xl transition">
                        <div class="mb-4">
                            <span class="text-3xl">💎</span>
                            <h4 class="text-xl font-bold text-gray-700 mt-2">Tier Platinum</h4>
                        </div>
                        <ul class="text-gray-600 space-y-2 text-sm">
                            <li>• 5 referal text</li>
                            <li>• 2 link posting</li>
                            <li>• Upload 14 Screenshot</li>
                            <li>• 2 step upload</li>
                        </ul>
                    </div>

                </div>

                {{-- TERMS --}}
                <div class="bg-white rounded-3xl shadow-lg p-8 border border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">
                        Terms & Conditions 📝
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Kenaikan tingkat dalam sistem ini berlangsung selama periode dua bulan...
                        Setiap langkah yang Anda ambil akan memiliki dampak signifikan terhadap pertumbuhan Anda dalam tingkat tersebut.
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>