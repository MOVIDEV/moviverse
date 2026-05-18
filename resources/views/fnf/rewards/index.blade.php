<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rewards') }}
        </h2>
    </x-slot>



    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- GREETING --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                   

                    @include('fnf.rewards.partials.tier-card', [
                    'tier' => 1,
                    'title' => 'Silver',
                    'submission' => $submissions,
                    'claims' => $claims
                    ])

                    @include('fnf.rewards.partials.tier-card', [
                    'tier' => 2,
                    'title' => 'Gold',
                    'submission' => $submissions,
                    'claims' => $claims
                    ])

                    @include('fnf.rewards.partials.tier-card', [
                    'tier' => 3,
                    'title' => 'Platinum',
                    'submission' => $submissions,
                    'claims' => $claims
                    ])

                </div>

            </div>


        </div>
    </div>
</x-app-layout>