
@extends('layout')

@section('main')

<main class="container mx-auto my-8 p-6 bg-white rounded-lg shadow-md">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white">
            <div x-data="{action:false}">
                <button   @click="action = ! action" id="dropdownActionButton" data-dropdown-toggle="dropdownAction" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5   " type="button">
                    <span class="sr-only">Action button</span>
                    Action
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <!-- Dropdown menu -->

                    <div id="dropdownAction" x-show="action" @click.outside="action = false"  class="z-10  bg-white divide-y divide-gray-100 rounded-lg shadow w-44  dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownActionButton">
                            <li>
                                <a href="#" onclick="showProduct(10,'asc')" class="block px-4 py-2 hover:bg-gray-100 ">Low to High Price</a>
                            </li>
                            <li>
                                <a href="#" onclick="showProduct(10,'desc')" class="block px-4 py-2 hover:bg-gray-100 ">High to Low price</a>
                            </li>

                        </ul>

                    </div>


            </div>
            <div x-data="{addProduct:false}">
                <button @click="addProduct =! addProduct" class="bg-blue-500 px-3 py-2 text-white border rounded" id="productAdd">Add Product</button>

                {{-- Include Add Product Modal --}}
                 @include('includes.add_modal')
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" id="searchTable" id="table-search-users" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500     " placeholder="Search for Product">
            </div>

            <script>
                const searchInput = document.getElementById('searchTable');
    searchInput.addEventListener('input', function(event) {
        const searchTerm = event.target.value.trim();// Trim whitespace from input
        if(searchTerm.length>2)
    {
        showProduct(10,'asc',searchTerm);
    }else{
        showProduct();
    }
         // Call showProduct with search term
    });
                </script>
        </div>
          @include('includes.product_table')
          @include('includes.edit_modal')
          @include('includes.view_modal')
        <!-- Edit user modal -->

    </div>

</main>

@endsection
