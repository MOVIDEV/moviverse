<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">FNF Submissions</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="w-full overflow-x-auto">
                        <table class="w-full bg-white border ">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="p-2 border">No.</th>
                                    <th class="p-2 border">Name</th>
                                    <th class="p-2 border">Tier</th>
                                    <th class="p-2 border">Screenshot</th>
                                    <th class="p-2 border">Referal 1</th>
                                    <th class="p-2 border">Referal 2</th>
                                    <th class="p-2 border">Referal 3</th>
                                    <th class="p-2 border">Referal 4</th>
                                    <th class="p-2 border">Referal 5</th>
                                    <th class="p-2 border">Referal 6</th>
                                    <th class="p-2 border">Referal 7</th>
                                    <th class="p-2 border">Status</th>
                                    <th class="p-2 border">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($submissions as $s)

                                @php
                                $uploaded = $s->files->count();
                                @endphp

                                <tr>

                                <td class="p-2 border text-center">
                                    {{ ($submissions->currentPage() - 1) * $submissions->perPage() + $loop->iteration }}
                                </td>

                                    <td class="p-2 border">{{ $s->user->name ?? '-' }}</td>

                                    <td class="p-2 border"> <span class="px-2 py-1 rounded text-sm {{ $s->tier_badge['class'] }}">
                                            {{ $s->tier_badge['label'] }}
                                        </span></td>



                                    <td class="p-2 border"
                                        x-data="{
                                open:false,
                                viewer:false,
                                img:null
                            }">

                                        <!-- <button @click="open=true" class="text-blue-600 underline">
                        {{ $uploaded }} / 6
                    </button> -->

                                        @php
                                        $rule = [
                                        1 => 6,
                                        2 => 10,
                                        3 => 14
                                        ][$s->tier] ?? 6;
                                        @endphp


                                        <button @click="open=true"
                                            class="underline {{ $uploaded >= $s->maxFiles() ? 'text-green-600' : 'text-blue-600' }}">
                                            {{ $uploaded }} / {{ $s->maxFiles() }}
                                        </button>




                                        <!-- MODAL LIST SCREENSHOT -->
                                        <div
                                            x-show="open"
                                            x-cloak
                                            x-transition.opacity
                                            @click.self="open=false"
                                            class="fixed inset-0 z-50 bg-black/70 flex items-center justify-center">

                                            <div class="bg-white rounded-lg w-11/12 max-w-6xl h-[85vh] flex flex-col">

                                                <!-- HEADER -->
                                                <div class="flex justify-between items-center px-4 py-3 border-b">
                                                    <h3 class="font-semibold text-lg">Screenshot Preview</h3>
                                                    <button @click="open=false" class="text-xl text-gray-600">✕</button>
                                                </div>

                                                <!-- CONTENT -->
                                                <div class="flex-1 overflow-y-auto p-4">
                                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

                                                        @forelse($s->files as $file)
                                                        <div
                                                            class="w-full aspect-square overflow-hidden border rounded cursor-pointer bg-gray-100">

                                                            <img
                                                                src="{{ asset('storage/'.$file->file_path) }}"
                                                                class="w-full h-full object-cover hover:opacity-80"
                                                                @click="
                                    img='{{ asset('storage/'.$file->file_path) }}';
                                    viewer=true;
                                ">
                                                        </div>
                                                        @empty
                                                        <div class="col-span-3 text-center text-gray-400">
                                                            Belum ada screenshot
                                                        </div>
                                                        @endforelse

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- IMAGE VIEWER BESAR -->
                                        <div
                                            x-show="viewer"
                                            x-cloak
                                            x-transition.opacity
                                            @click.self="viewer=false"
                                            class="fixed inset-0 z-[60] bg-black/90 flex items-center justify-center">

                                            <img
                                                :src="img"
                                                class="max-w-full max-h-[90vh] object-contain rounded">

                                            <button
                                                @click="viewer=false"
                                                class="absolute top-4 right-4 text-white text-2xl">✕</button>
                                        </div>
                                    </td>

                                    <td class="p-2 border">{{ $s->referal1 ?? '-' }}</td>
                                    <td class="p-2 border">{{ $s->referal2 ?? '-' }}</td>
                                    <td class="p-2 border">{{ $s->referal3 ?? '-' }}</td>
                                    <td class="p-2 border">{{ $s->referal4 ?? '-' }}</td>
                                    <td class="p-2 border">{{ $s->referal5 ?? '-' }}</td>
                                    <td class="p-2 border">{{ $s->referal6 ?? '-' }}</td>
                                    <td class="p-2 border">{{ $s->referal7 ?? '-' }}</td>

                                    <td class="p-2 border">
                                        @if($s->status == 0) Pending
                                        @elseif($s->status == 1) Approved
                                        @else Rejected
                                        @endif
                                    </td>
                                    <td class="p-2 border space-x-1">
                                        {{-- MASIH PROSES --}}
                                        @if($s->status == 0)

                                        {{-- APPROVE --}}
                                        <div class="flex gap-2">


                                            <form action="{{ route('admin.fnf.approve', $s->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button class="bg-green-600 text-white px-3 py-1 rounded">
                                                    Approve
                                                </button>
                                            </form>

                                            {{-- REJECT --}}
                                            <form action="{{ route('admin.fnf.reject', $s->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button class="bg-red-600 text-white px-3 py-1 rounded">
                                                    Reject
                                                </button>
                                            </form>

                                        </div>

                                        {{-- NEXT STEP --}}
                                        @if($s->current_step == 1)
                                        <div class="flex justify-center">

                                            <form action="{{ route('admin.fnf.nextStep', $s->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button class="bg-blue-600 text-white px-3 py-1 m-2 rounded">
                                                    Next Step
                                                </button>
                                            </form>
                                        </div>
                                        @endif

                                        {{-- SUDAH SELESAI --}}
                                        @elseif($s->status == 1 && $s->tier == 3)
                                        <span class="text-green-600 font-semibold">Done</span>

                                        @else
                                        <span class="text-gray-400">-</span>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>