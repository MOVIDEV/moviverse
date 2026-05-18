 @foreach($datafnf as $s)

                            <tr>

                                <!-- <td class="p-2 border">{{ $s->name ?? '-' }}</td> -->
                                <td class="p-2 border text-center">
                                    {{ ($datafnf->currentPage() - 1) * $datafnf->perPage() + $loop->iteration }}
                                </td>

                                <td class="p-2 border">{{ $s->name ?? '-' }}</td>

                                <td class="p-2 border"> <span class="px-2 py-1 rounded text-sm ">
                                        {{ $s->tier_badge['label'] }}
                                    </span></td>

                                <!-- <td class="p-2 border">{{ $s->no_wa ?? '-' }}</td> -->
                                <td class="p-2 border">
                                    @if($s->no_wa)
                                    @php
                                    // bersihin nomor (hapus spasi, +, -)
                                    $wa = preg_replace('/[^0-9]/', '', $s->no_wa);

                                    // pastiin format Indonesia
                                    if (str_starts_with($wa, '0')) {
                                    $wa = '62' . substr($wa, 1);
                                    }
                                    @endphp

                                    <a href="https://wa.me/{{ $wa }}"
                                        target="_blank"
                                        class="text-green-600 hover:underline font-medium">
                                        {{ $s->no_wa }}
                                    </a>
                                    @else
                                    -
                                    @endif
                                </td>


                                <td class="p-2 border">{{ $s->username_ig ?? '-' }}</td>
                                <td class="p-2 border">{{ $s->username_ig ?? '-' }}</td>
                                <td class="p-2 border">{{ $s->followers_ig ?? '-' }}</td>
                                <td class="p-2 border">{{ $s->followers_tiktok ?? '-' }}</td>
                                <td class="p-2 border">{{ $s->alamat ?? '-' }}</td>
                            </tr>
                            @endforeach