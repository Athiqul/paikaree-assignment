<div id="productAdd" x-show="addProduct"  tabindex="-1" aria-hidden="true" class="container fixed top-20 left-40 right-0 z-50 items-center justify-center  w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->

        <form class="relative bg-white rounded-lg shadow " id="productForm" enctype="multipart/form-data">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t ">
                <h3 class="text-xl font-semibold text-gray-900 ">
                    Add Product
                </h3>
               <button type="button" @click="addProduct = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="editUserModal" id="addCloseModal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div class="mt-2 bg-red-500 text-sm text-white rounded-lg p-4 hidden" role="alert" id="errorAlert">

                  </div>
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 ">Product Name</label>
                        <input type="text" name="name" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="Headphone" required="">
                        <span class="text-red-500" id="nameError"></span>
                    </div>
                    <div class="col-span-6 sm:col-span-6">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Price</label>
                        <input type="text" name="price" id="price" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="88.00" required="">
                        <span class="text-red-500" id="priceError"></span>
                    </div>
                    <div class="col-span-6 sm:col-span-6">
                        <label for="discount" class="block mb-2 text-sm font-medium text-gray-900 ">Discount</label>
                        <input type="text" name="discount" id="discount" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="5.00" required="">
                        <span class="text-red-500" id="discountError"></span>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="thumbnail" class="block mb-2 text-sm font-medium text-gray-900 ">Product Thumbnail Main Image</label>
                        <input type="file" name="thumbnail" accept=".jpg, .jpeg, .png, .webp" id="thumbnail" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="e.g. +(12)3456 789" required="">
                        <span class="text-red-500" id="thumbError"></span>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="product_images" class="block mb-2 text-sm font-medium text-gray-900 ">Product More Images</label>
                        <input type="file" accept=".jpg, .jpeg, .png, .webp" name="product_images[]" multiple id="product_images" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    " placeholder="Development" required="">
                        <span class="text-red-500" id="productImagesError"></span>
                    </div>
                    <div class="col-span-6 sm:col-span-6 flex items-center justify-start gap-4">
                        <label for="status" class=" text-sm font-medium text-gray-900 ">Publish</label>
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" name="status" id="status" checked value="1" >
                    </div>

                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b ">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add Product</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Ajax API calling for Add Product

        document.getElementById('productForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    try {
        const response = await fetch('http://localhost:8000/api/products', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        });

        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }

        const data = await response.json();

        if (data.errors) {
            // Display validation errors
            console.error(data.errors);
            let alert=document.getElementById("errorAlert");
            alert.innerHtml='';
            let html=`<span class="font-bold">Danger</span> alert! ${data.message}`
            alert.innerHTML=html;
            alert.classList.remove('hidden');



        } else {
            // Successfully added product
            console.log(data);
            //modal close


            alert('Product added successfully!');
            Alpine.store('addProduct', false);
            document.getElementById("addCloseModal").click();
             showProduct();

        }
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
        alert('An error occurred, please try again.');
    }
});

</script>
