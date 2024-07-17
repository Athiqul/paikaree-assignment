
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
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 ">Low to High Price</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 ">High to Low price</a>
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
                <input type="text" id="table-search-users" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500     " placeholder="Search for Product">
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                <tr>
                    <th scope="col" class="p-4">

                    </th>
                    <th scope="col" class="px-6 py-3">
                        Product Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Thumbnail
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b  ">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500   ">
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap ">
                        <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                        <div class="ps-3">
                            <div class="text-base font-semibold">Neil Sims</div>
                            <div class="font-normal text-gray-500">neil.sims@flowbite.com</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                        React Developer
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <!-- Modal toggle -->
                        <div  x-data={edit:false}>
                            <a href="#" @click=" edit= !edit" title="edit product" type="button" data-modal-target="editUserModal" data-modal-show="editUserModal" class="font-bold text-[30px] text-gray-600  hover:underline"><i class="fa-regular fa-pen-to-square"></i></a>
                              @include('includes.edit_modal')
                        </div>


                        <a href="#" title="View Product details" type="button" data-modal-target="editUserModal" data-modal-show="editUserModal" class="font-bold text-[30px] text-teal-600  hover:underline"><i class="fa-regular fa-eye"></i></a>

                        <a href="#" title="Active Product" type="button" data-modal-target="editUserModal" data-modal-show="editUserModal" class="font-bold text-[30px] text-red-600  hover:underline"><i class="fa-regular fa-thumbs-up"></i></a>

                        <a href="#" title="edit product" type="button" data-modal-target="editUserModal" data-modal-show="editUserModal" class="font-bold text-[30px] text-red-500  hover:underline"><i class="fa-solid fa-trash-can"></i></a>
                    </td>
                </tr>

            </tbody>
        </table>
        <!-- Edit user modal -->

    </div>

</main>

@endsection
