
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

                <div id="productAdd" x-show="addProduct"  tabindex="-1" aria-hidden="true" class="container fixed top-20 left-40 right-0 z-50 items-center justify-center  w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <form class="relative bg-white rounded-lg shadow " enctype="multipart/form-data">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t ">
                                <h3 class="text-xl font-semibold text-gray-900 ">
                                    Add Product
                                </h3>
                               <button type="button" @click="addProduct = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="editUserModal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-12 gap-6">
                                    <div class="col-span-12 sm:col-span-3">
                                        <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 ">Product Name</label>
                                        <input type="text" name="name" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="Headphone" required="">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Price</label>
                                        <input type="text" name="price" id="price" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="88.00" required="">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="discount" class="block mb-2 text-sm font-medium text-gray-900 ">Discount</label>
                                        <input type="text" name="discount" id="discount" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="5.00" required="">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="thumbnail" class="block mb-2 text-sm font-medium text-gray-900 ">Product Thumbnail Main Image</label>
                                        <input type="file" name="thumbnail" accept=".jpg, .jpeg, .png, .webp" id="thumbnail" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="e.g. +(12)3456 789" required="">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="product_images" class="block mb-2 text-sm font-medium text-gray-900 ">Product More Images</label>
                                        <input type="file" accept=".jpg, .jpeg, .png, .webp" name="product_images[]" multiple id="product_images" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="Development" required="">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3 flex items-center justify-start gap-4">
                                        <label for="status" class=" text-sm font-medium text-gray-900 ">Publish</label>
                                        <input type="hidden" name="status" value="0">
                                        <input type="checkbox" name="status" id="status" checked value="1"  required="">
                                    </div>

                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b ">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save all</button>
                            </div>
                        </form>
                    </div>
                </div>
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
                            <div id="editUserModal" x-show="edit"  tabindex="-1" aria-hidden="true" class="container fixed top-20 left-40 right-0 z-50 items-center justify-center  w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <form class="relative bg-white rounded-lg shadow ">
                                        <!-- Modal header -->
                                        <div class="flex items-start justify-between p-4 border-b rounded-t ">
                                            <h3 class="text-xl font-semibold text-gray-900 ">
                                                Edit Product
                                            </h3>
                                           <button type="button" @click="edit = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="editUserModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-6 space-y-6">
                                            <div class="grid grid-cols-6 gap-6">
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 ">First Name</label>
                                                    <input type="text" name="first-name" id="first-name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="Bonnie" required="">
                                                </div>
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Last Name</label>
                                                    <input type="text" name="price" id="price" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="Green" required="">
                                                </div>
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="discount" class="block mb-2 text-sm font-medium text-gray-900 ">discount</label>
                                                    <input type="discount" name="discount" id="discount" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="example@company.com" required="">
                                                </div>
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="thumbnail" class="block mb-2 text-sm font-medium text-gray-900 ">Phone Number</label>
                                                    <input type="number" name="thumbnail" id="thumbnail" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="e.g. +(12)3456 789" required="">
                                                </div>
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="product_images" class="block mb-2 text-sm font-medium text-gray-900 ">product_images</label>
                                                    <input type="text" name="product_images" id="product_images" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="Development" required="">
                                                </div>
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="company" class="block mb-2 text-sm font-medium text-gray-900 ">Company</label>
                                                    <input type="number" name="company" id="company" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="123456" required="">
                                                </div>
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="current-password" class="block mb-2 text-sm font-medium text-gray-900 ">Current Password</label>
                                                    <input type="password" name="current-password" id="current-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="••••••••" required="">
                                                </div>
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="new-password" class="block mb-2 text-sm font-medium text-gray-900 ">New Password</label>
                                                    <input type="password" name="new-password" id="new-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="••••••••" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b ">
                                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save all</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
