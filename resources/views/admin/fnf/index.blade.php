 @php use Illuminate\Support\Str; @endphp


 <x-app-layout>
     <x-slot name="header">
         <h2 class="text-xl font-semibold">FNF Submissions</h2>
     </x-slot>

     <div class="py-12">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 text-gray-900">

                     <div class="w-full overflow-x-auto">

                         <!-- filter -->
                         <input
                             type="text"
                             id="search"
                             placeholder="Search Name"
                             class="border p-2 rounded w-lg mb-2">


                         <!-- end filter -->


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
                             <tbody id="table-body">
                                 @include('admin.fnf.partials.table', ['submissions' => $submissions])


                             </tbody>
                         </table>

                         <!-- pagination -->
                         <div class="flex justify-between items-center mt-6">
                             <div class="text-sm text-gray-500">
                                 Showing {{ $submissions->firstItem() }} - {{ $submissions->lastItem() }} of {{ $submissions->total() }}
                             </div>

                             <div>
                                 {{ $submissions->links() }}
                             </div>
                         </div>


                         <!-- end pagination -->

                     </div>

                 </div>
             </div>
         </div>
     </div>
 </x-app-layout>

 <script>
     let timeout = null;

     document.getElementById('search').addEventListener('keyup', function() {
         clearTimeout(timeout);

         timeout = setTimeout(() => {
             fetch(`?search=${this.value}`, {
                     headers: {
                         'X-Requested-With': 'XMLHttpRequest'
                     }
                 })
                 .then(res => res.text())
                 .then(html => {
                     document.getElementById('table-body').innerHTML = html;
                 });
         }, 400); // delay biar gak spam query
     });
 </script>