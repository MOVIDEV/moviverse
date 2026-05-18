<div class="p-6 bg-white rounded-2xl shadow-lg border border-gray-100">

    <h3 class="text-xl font-semibold mb-6 text-gray-800">
        Tier {{ $title }}
    </h3>

    @php
        $submission = $submissions[$tier] ?? null;
    @endphp

    @for ($step = 1; $step <= 2; $step++)
        @php
            $key = $tier . '-' . $step;
            $claim = $claims->get($key);
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

        <div class="mb-5 p-4 rounded-xl border border-gray-100 bg-gray-50">

            <div class="flex justify-between items-center mb-3">
                <p class="text-sm font-medium text-gray-600">
                    Step {{ $step }}
                </p>

                
                
            </div>

            {{-- CLAIMED --}}

            @if($claim && $claim->status == 1)
                    <span class="text-xs px-3 py-1 bg-green-100 text-green-700 rounded-full">
                        Claim kamu sudah dikirim, silahkan tunggu ya 🎉
                    </span>

            @elseif($claimed)
                <div class="w-full py-3 px-4 rounded-xl bg-gray-200 text-gray-600 text-center">
                    <div class="font-semibold">Claimed ✅</div>
                    <div class="text-sm mt-1">
                        Code kamu:
                        <span class="font-mono font-medium text-gray-800">
                            {{ $claim->claim_code }}
                        </span>
                    </div>
                    <div class="text-sm mt-1">
                        Admin akan proses pengiriman rewards ke kamu, ditunggu yah!
                       
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
                    class="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium transition duration-200 shadow-sm">
                    Claim Step {{ $step }}
                </button>

            {{-- LOCKED --}}
            @else
                <div class="w-full py-3 rounded-xl bg-gray-100 text-gray-400 text-center font-medium">
                    🔒 Locked
                </div>
            @endif

        </div>
    @endfor
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