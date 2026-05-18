<div class="p-6 border rounded-lg bg-white shadow">
    <h3 class="text-lg font-bold mb-4">
        Tier {{ $title }}
    </h3>

    @php
    $submission = $submissions[$tier] ?? null;
    @endphp


    @for ($step = 1; $step <= 2; $step++)
        @php

        $key=$tier . '-' . $step;
        $claim=$claims->get($key); // <-- object RewardClaim atau null
            $claimed=$claim !==null;

            $tierUnlocked=$submission && $submission->tier >= $tier;

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



            <div class="mb-3">
                <p class="text-sm mb-1">Step {{ $step }}</p>


                @if($claimed)
                <button disabled
                    class="w-full py-2 bg-gray-300 text-gray-600 rounded">
                    Claimed
                    <br>
                    Ini code kamu
                    {{$claim->claim_code}}
                </button>

                @elseif($eligible)
                <button
                    type="button"
                    onclick="openClaimModal(
        '{{ route('fnf.reward.claim', ':id') }}',
        {{ $submission->id }},
        {{ $tier }},
        {{ $step }})"
                    class="w-full py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">
                    Claim Step {{ $step }}
                </button>

                <!-- Modal -->
                <div id="claimModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
                    <div class="bg-white p-6 rounded w-96">

                        <h2 class="text-lg font-semibold mb-2">
                            Pastikan No. Wa dan alamat sudah sesuai untuk pengiriman rewards
                        </h2>

                        <form id="claimForm" method="POST">
                            @csrf

                            <div class="mb-3">

                                <input type="text" name="no_wa" id="no_wa" value="{{ auth()->user()->no_wa }}">

                                <label class="block text-sm">Alamat</label>
                                <textarea
                                    name="alamat"
                                    id="addressField"
                                    class="border rounded p-2 w-full">{{ auth()->user()->alamat }}</textarea>
                            </div>

                            <input type="hidden" name="tier" id="modalTier">
                            <input type="hidden" name="step" id="modalStep">

                            <div class="flex justify-end gap-2">
                                <button
                                    type="button"
                                    onclick="closeClaimModal()"
                                    class="bg-gray-400 text-white px-3 py-1 rounded">
                                    Batal
                                </button>

                                <button
                                    type="submit"
                                    class="bg-green-600 text-white px-3 py-1 rounded">
                                    OK
                                </button>
                            </div>
                        </form>

                    </div>
                </div>


                @else
                <button disabled
                    class="w-full py-2 bg-gray-200 text-gray-400 rounded">
                    Locked
                </button>
                @endif
            </div>
            @endfor
</div>

<script>
    function openClaimModal(routeTemplate, submissionId, tier, step) {

        let modal = document.getElementById('claimModal');
        let form = document.getElementById('claimForm');

        // ganti :id dengan submission id asli
        let finalRoute = routeTemplate.replace(':id', submissionId);

        form.action = finalRoute;

        document.getElementById('modalTier').value = tier;
        document.getElementById('modalStep').value = step;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
     function closeClaimModal() {
        document.getElementById('claimModal').classList.add('hidden');
    }
</script>