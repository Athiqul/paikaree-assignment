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
