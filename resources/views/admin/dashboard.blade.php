<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- HALO --}}
            <div class="bg-white border border-gray-200 shadow-sm rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800">
                    👋 Hallo Admin, {{ Auth::user()->name }}
                </h3>
            </div>

            {{-- STAT CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">

                {{-- MEMBER --}}
                <a href="{{route('admin.fnf.datafnf')}}">
                    <div class="bg-white border-l-4 border-blue-500 border border-gray-200 rounded-xl p-6 shadow-sm 
                                hover:shadow-md hover:-translate-y-1 transition duration-300">

                        <p class="text-sm text-gray-500">Total Member FNF</p>

                        <div class="flex items-center justify-between mt-3">
                            <p class="text-3xl font-bold text-blue-600">
                                {{ $totalMember }}
                            </p>

                            <div class="bg-blue-50 text-blue-600 p-2 rounded-lg">
                                👥
                            </div>
                        </div>
                    </div>
                </a>

                {{-- SUBMISSION --}}
                <a href="{{route('admin.fnf.index')}}">
                    <div class="bg-white border-l-4 border-indigo-500 border border-gray-200 rounded-xl p-6 shadow-sm 
                                hover:shadow-md hover:-translate-y-1 transition duration-300">

                        <p class="text-sm text-gray-500">Total Submission</p>

                        <div class="flex items-center justify-between mt-3">
                            <p class="text-3xl font-bold text-indigo-600">
                                {{ $totalSubmission }}
                            </p>

                            <div class="bg-indigo-50 text-indigo-600 p-2 rounded-lg">
                                📄
                            </div>
                        </div>
                    </div>
                </a>

                {{-- PENDING --}}
                <div class="bg-white border-l-4 border-yellow-400 border border-gray-200 rounded-xl p-6 shadow-sm 
                            hover:shadow-md hover:-translate-y-1 transition duration-300">

                    <p class="text-sm text-gray-500">Pending Review FNF</p>

                    <div class="flex items-center justify-between mt-3">
                        <p class="text-3xl font-bold text-yellow-500">
                            {{ $pendingSubmission }}
                        </p>

                        <div class="bg-yellow-50 text-yellow-500 p-2 rounded-lg">
                            ⏳
                        </div>
                    </div>
                </div>

                {{-- APPROVED --}}
                <div class="bg-white border-l-4 border-green-500 border border-gray-200 rounded-xl p-6 shadow-sm 
                            hover:shadow-md hover:-translate-y-1 transition duration-300">

                    <p class="text-sm text-gray-500">Approved Claims</p>

                    <div class="flex items-center justify-between mt-3">
                        <p class="text-3xl font-bold text-green-600">
                            {{ $approvedSubmission }}
                        </p>

                        <div class="bg-green-50 text-green-600 p-2 rounded-lg">
                            ✅
                        </div>
                    </div>
                </div>

                {{-- Pending Claim --}}
                <div class="bg-white border-l-4 border-rose-500 border border-gray-200 rounded-xl p-6 shadow-sm 
                            hover:shadow-md hover:-translate-y-1 transition duration-300">

                    <p class="text-sm text-gray-500">Pending Claims</p>

                    <div class="flex items-center justify-between mt-3">
                        <p class="text-3xl font-bold text-rose-600">
                            {{ $pendingClaim }}
                        </p>

                        <div class="bg-rose-50 text-rose-600 p-2 rounded-lg">
                            💰
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>