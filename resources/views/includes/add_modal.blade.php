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

<script>
    // Ajax API calling for Add Product
</script>
