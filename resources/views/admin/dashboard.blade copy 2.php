<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- HALO --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-semibold">
                    👋 Hallo Admin, {{ Auth::user()->name }}
                </h3>
            </div>

           {{-- STAT CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">

    {{-- MEMBER --}}
    <a href="{{route('admin.fnf.datafnf')}}">

        <div class="rounded-2xl p-5 text-white shadow-lg 
                    bg-gradient-to-r from-blue-500 to-cyan-500 
                    hover:scale-105 transition duration-300">
            <p class="text-sm opacity-80">Total Member FNF</p>
            <p class="text-3xl font-bold mt-2">
                {{ $totalMember }}
            </p>
        </div>
    </a>

    {{-- SUBMISSION --}}
    <a href="{{route('admin.fnf.index')}}">
    <div class="rounded-2xl p-5 text-white shadow-lg 
                bg-gradient-to-r from-indigo-500 to-purple-600 
                hover:scale-105 transition duration-300">
        <p class="text-sm opacity-80">Total Submission</p>
        <p class="text-3xl font-bold mt-2">
            {{ $totalSubmission }}
        </p>
    </div>
    </a>

    {{-- PENDING --}}
    <div class="rounded-2xl p-5 text-white shadow-lg 
                bg-gradient-to-r from-yellow-400 to-orange-500 
                hover:scale-105 transition duration-300">
        <p class="text-sm opacity-80">Pending Review FNF</p>
        <p class="text-3xl font-bold mt-2">
            {{ $pendingSubmission }}
        </p>
    </div>

    {{-- APPROVED --}}
    <div class="rounded-2xl p-5 text-white shadow-lg 
                bg-gradient-to-r from-green-400 to-emerald-600 
                hover:scale-105 transition duration-300">
        <p class="text-sm opacity-80">Approved Claims</p>
        <p class="text-3xl font-bold mt-2">
            {{ $approvedSubmission }}
        </p>
    </div>

    {{-- Pending Claim --}}
    <div class="rounded-2xl p-5 text-white shadow-lg 
                bg-gradient-to-r from-pink-500 to-rose-500 
                hover:scale-105 transition duration-300">
        <p class="text-sm opacity-80">Pending Claims</p>
        <p class="text-3xl font-bold mt-2">
            {{ $pendingClaim }}
        </p>
    </div>

</div>

        </div>
    </div>
</x-app-layout>