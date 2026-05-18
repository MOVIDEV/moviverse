<div class="relative bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">

    {{-- HEADER --}}
    @php
    $tierColors = [
    1 => 'from-gray-300 via-gray-400 to-gray-500',
    2 => 'from-yellow-300 via-yellow-400 to-yellow-500',
    3 => 'from-stone-300 via-stone-400 to-stone-600',
    ];

    $gradient = $tierColors[$tier] ?? 'from-indigo-600 to-indigo-500';
    @endphp

    <div class="bg-gradient-to-r {{ $gradient }} px-6 py-4 shadow-inner">
        <h3 class="text-white text-lg font-semibold tracking-wide">
            Tier {{ $title }}
        </h3>
    </div>

    {{-- CONTENT --}}
    <div class="p-6 space-y-5">

        @php
        $submission = $submissions[$tier] ?? null;
        @endphp

        @for ($step = 1; $step <= 2; $step++)
            @php
            $key=$tier . '-' . $step;
            $claim=$claims->get($key);
            $claimed = $claim !== null;

            $tierUnlocked = $submission && $submission->tier >= $tier;

            $stepUnlocked = false;

            if ($submission) {
            if ($step === 1 && $submission->current_step >= 2) {
            $stepUnlocked = true;
            }

            if ($step === 2 && $submission->current_step >= 2 && $submission->status == 1) {
            $stepUnlocked = true;
            }
            }

            $eligible = $tierUnlocked && $stepUnlocked;
            @endphp

            <div class="p-4 rounded-2xl border border-gray-100 bg-gray-50 hover:shadow-md transition">

                <div class="flex justify-between items-center mb-3">
                    <p class="text-sm font-semibold text-gray-600 tracking-wide">
                        Step {{ $step }}
                    </p>

                    {{-- Status Indicator Dot --}}
                    @if($submission && $submission->status == 1)
                    <span class="h-3 w-3 bg-green-500 rounded-full animate-pulse"></span>
                    @elseif($claimed)
                    <span class="h-3 w-3 bg-gray-400 rounded-full"></span>
                    @elseif($eligible)
                    <span class="h-3 w-3 bg-indigo-500 rounded-full"></span>
                    @else
                    <span class="h-3 w-3 bg-gray-300 rounded-full"></span>
                    @endif
                </div>

                {{-- STATUS SUDAH DIKIRIM --}}
                @if($claim && $claim->status == 1)

                <div class="py-3 px-4 rounded-xl bg-green-100 text-green-700 text-center font-medium">
                    🚚 Claim kamu sudah dikirim,<br>
                    silahkan tunggu ya 🎉<br>
                    Code kamu:
                    <span class="font-mono font-medium text-gray-800">
                        {{ $claim->claim_code }}
                    </span>
                </div>


                {{-- CLAIMED --}}
                @elseif($claimed)

                <div class="py-3 px-4 rounded-xl bg-gray-200 text-gray-700 text-center">
                    <div class="font-semibold">Yeay kamu berhasil claim🥳 <br> Tunggu kami proses dan pastikan data kamu sudah sesuai yaa!</div>
                    <div class="text-sm mt-1">
                        Code kamu:
                        <span class="font-mono font-medium text-gray-800">
                            {{ $claim->claim_code }}
                        </span>
                    </div>
                </div>

                {{-- ELIGIBLE --}}
                @elseif($eligible)

                <button
                    type="button"
                    onclick="openClaimModal(
                            '{{ route('fnf.reward.claim', ':id') }}',
                            {{ $submission->id }},
                            {{ $tier }},
                            {{ $step }})"
                    class="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium transition shadow-sm">
                    Claim Step {{ $step }}
                </button>

                {{-- LOCKED --}}
                @else

                <div class="py-3 rounded-xl bg-gray-100 text-gray-400 text-center font-medium">
                    🔒 Locked
                </div>

                @endif

            </div>
            @endfor

    </div>
</div>

<!-- Modal -->
<div id="claimModal"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-md p-6 rounded-2xl shadow-xl">

        <h2 class="text-lg font-semibold text-gray-800 mb-4">
            Pastikan No. WA dan alamat sudah sesuai untuk pengiriman rewards
        </h2>

        <form id="claimForm" method="POST">
            @csrf

            <div class="space-y-4">

                <div>
                    <label class="block text-sm mb-1 text-gray-600">No. WA</label>
                    <input type="text"
                        name="no_wa"
                        value="{{ auth()->user()->no_wa }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm mb-1 text-gray-600">Alamat</label>
                    <textarea
                        name="alamat"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        rows="3">{{ auth()->user()->alamat }}</textarea>
                </div>

            </div>

            <input type="hidden" name="tier" id="modalTier">
            <input type="hidden" name="step" id="modalStep">

            <div class="flex justify-end gap-3 mt-6">
                <button type="button"
                    onclick="closeClaimModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                    Batal
                </button>

                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    OK
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openClaimModal(routeTemplate, submissionId, tier, step) {

        let modal = document.getElementById('claimModal');
        let form = document.getElementById('claimForm');

        let finalRoute = routeTemplate.replace(':id', submissionId);
        form.action = finalRoute;

        document.getElementById('modalTier').value = tier;
        document.getElementById('modalStep').value = step;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeClaimModal() {
        let modal = document.getElementById('claimModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>