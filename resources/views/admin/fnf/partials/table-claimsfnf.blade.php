@forelse ($claims as $index => $claim)
<tr>
    <td class="p-2 border text-center">{{ ($claims->currentPage() - 1) * $claims->perPage() + $loop->iteration }}</td>
    <td class="p-2 border text-center">{{ $claim->user->name }}</td>
    <td class="p-2 border text-center">{{ $claim->user->alamat }}</td>
    <td class="p-2 border">
        @if($claim->user->no_wa)
        @php
        // bersihin nomor (hapus spasi, +, -)
        $wa = preg_replace('/[^0-9]/', '', $claim->user->no_wa);

        // pastiin format Indonesia
        if (str_starts_with($wa, '0')) {
        $wa = '62' . substr($wa, 1);
        }
        @endphp

        <a href="https://wa.me/{{ $wa }}"
            target="_blank"
            class="text-green-600 hover:underline font-medium">
            {{ $claim->user->no_wa }}
        </a>
        @else
        -
        @endif
    </td>
    <td class="p-2 border text-center">
        <span class="badge bg-white">
            {{ $claim->claim_code }}
        </span>
    </td>
    <td class="p-2 border text-center">
        @if ($claim->status === 0)
        <span class="badge ">Processed</span>
        @else
        <span class="badge text-dark">
            Done
        </span>
        @endif
    </td>



    <td class="p-2 text-center border">
        @if($claim->status == 0)
        <form action="{{ route('admin.fnf.claims.claimsfnf.approved', $claim->id) }}" method="POST">
            @csrf

            <button class="bg-green-600 text-white px-3 py-1 rounded">
                Approve
            </button>
        </form>
        @else

        <span class="badge text-green-700">
            Done
        </span>

        @endif
    </td>


</tr>
@empty
<tr>
    <td colspan="5" class="text-center">
        Belum ada data claim
    </td>
</tr>
@endforelse