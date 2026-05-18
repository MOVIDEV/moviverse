<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Claim') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">



            {{-- HALO --}}
            <div class="bg-white shadow-sm rounded-lg p-6">

                <div class="p-6 text-gray-900">

                    

                        <!-- filter -->
                        <input
                            type="text"
                            id="search"
                            placeholder="Search Name"
                            class="border p-2 rounded w-lg mb-2">


                        <!-- end filter -->


                        <table class="w-full bg-white border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border">No</th>
                                    <th class="border">Nama</th>
                                    <th class="border">Alamat</th>
                                    <th class="border">No.WA</th>
                                    <th class="border">Claim Code</th>
                                    <th class="border">Status</th>
                                    <th class="border">Action</th>
                                </tr>
                            </thead>
                            <tbody id="claimTable">
                    

                                @include('admin.fnf.partials.table-claimsfnf')
                   
                            </tbody>
                        </table>
                    

                    <!-- pagination -->
                    <div class="flex justify-between items-center mt-6">
                        <div class="text-sm text-gray-500">
                            Showing {{ $claims->firstItem() }} - {{ $claims->lastItem() }} of {{ $claims->total() }}
                        </div>

                        <div>
                            {{ $claims->links() }}
                        </div>
                    </div>


                    <!-- end pagination -->

                </div>
            </div>



        </div>
    </div>
</x-app-layout>
<script>
    let timer;

    document.getElementById('search').addEventListener('keyup', function() {

        clearTimeout(timer);

        let search = this.value;

        timer = setTimeout(() => {

            fetch(`?search=${search}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(data => {
                    document.getElementById('claimTable').innerHTML = data;
                });

        }, 300);

    });
</script>