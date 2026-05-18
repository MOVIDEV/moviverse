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



      <!-- <td class="p-2 border">{{ $s->referal1 ?? '-' }}</td> -->

      <td class="p-2 border">
    @if($s->tier == 1)
        {{ $s->user->referal ?? '-' }}
    @else
        {{ $s->referal1 ?? '-' }}
    @endif
</td>

      <td class="p-2 border">{{ $s->referal2 ?? '-' }}</td>
      <td class="p-2 border">{{ $s->referal3 ?? '-' }}</td>
      <td class="p-2 border">
          @if(Str::startsWith($s->referal4, ['http://', 'https://']))
          <a href="{{ $s->referal4 }}"
              target="_blank"
              class="text-blue-600 hover:underline">
              Link
          </a>
          @else
          {{ $s->referal4 ?? '-' }}
          @endif
      </td>

      <td class="p-2 border">
          @if(Str::startsWith($s->referal5, ['http://', 'https://']))
          <a href="{{ $s->referal4 }}"
              target="_blank"
              class="text-blue-600 hover:underline">
              Link
          </a>
          @else
          {{ $s->referal5 ?? '-' }}
          @endif
      </td>

      <td class="p-2 border">
          @if(Str::startsWith($s->referal6, ['http://', 'https://']))
          <a href="{{ $s->referal4 }}"
              target="_blank"
              class="text-blue-600 hover:underline">
              Link
          </a>
          @else
          {{ $s->referal6 ?? '-' }}
          @endif
      </td>

      <td class="p-2 border">
          @if(Str::startsWith($s->referal7, ['http://', 'https://']))
          <a href="{{ $s->referal4 }}"
              target="_blank"
              class="text-blue-600 hover:underline">
              Link
          </a>
          @else
          {{ $s->referal7 ?? '-' }}
          @endif
      </td>



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


              <form action="{{ route('admin.fnf.datafnf.approve', $s->id) }}" method="POST" class="inline">
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