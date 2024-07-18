<table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
        <tr>

            <th scope="col" class="px-6 py-3">
                Product Name
            </th>
            <th scope="col" class="px-6 py-3">
                Price
            </th>
            <th scope="col" class="px-6 py-3">
                Discount
            </th>
            <th scope="col" class="px-6 py-3">
                Thumbnail
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
        </tr>
    </thead>
    <tbody id="productList">


    </tbody>
</table>

{{-- Ajax Calling --}}
<script>
    function showProduct() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://localhost:8000/api/products', true);
        xhr.onload = function() {
            if (xhr.status >= 200) {
                var data = JSON.parse(xhr.responseText);
                //console.log(data);
                var productsContainer = document.getElementById('productList');
                productsContainer.innerHTML = ''; // Clear any existing content
                let html = '';
                data.data.forEach(function(product) {
                    html += ` <tr class="bg-white border-b  ">

            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap ">
                <div class="ps-3">
                    <div class="text-base font-semibold">${product.name}</div>
                </div>
            </th>
            <td class="px-6 py-4">
            ${product.price/100}
            </td>
             <td class="px-6 py-4">
            ${product.discount/100}
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center">
                    <img class="w-10 h-10 rounded-full" src="{{ url('/product') }}/${product.thumbnail}" alt="${product.name}">
                </div>
            </td>
            <td class="px-6 py-4 flex items-center">
                <!-- Modal toggle -->
                <div  x-data={edit:false}>
                    <a  href="#" onclick="openEditModal(${product.id})" @click="edit=!edit"  title="edit product" data-modal-target="editUserModal" data-modal-show="editUserModal" class="font-bold text-[30px] text-gray-600  hover:underline"><i class="fa-regular fa-pen-to-square"></i></a>
                </div>


                <a href="#" title="View Product details" type="button" data-modal-target="editUserModal" data-modal-show="editUserModal" class="font-bold text-[30px] text-teal-600  hover:underline"><i class="fa-regular fa-eye"></i></a>

                <a href="#" title="Active Product" type="button" data-modal-target="editUserModal" data-modal-show="editUserModal" class="font-bold text-[30px] text-red-600  hover:underline"><i class="fa-regular fa-thumbs-up"></i></a>

                <a href="#" title="edit product" type="button" data-modal-target="editUserModal" data-modal-show="editUserModal" class="font-bold text-[30px] text-red-500  hover:underline"><i class="fa-solid fa-trash-can"></i></a>
            </td>
        </tr>`;


                });

                productsContainer.innerHTML = html; // Add new content to the container

            } else {
                console.error('Server reached but returned an error');
            }
        };
        xhr.onerror = function() {
            console.error('Request failed');
        };
        xhr.send();
    }
    showProduct();


    //Edit Product

    function openEditModal(productId) {

        document.getElementById("editModal").classList.remove("hidden");
    // Example: code to open the edit modal and populate fields
    fetch('http://localhost:8000/api/products/' + productId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.success == true) {
                let content = document.getElementById("editModalBody");
                content.innerHTML = '';
                let html = `
                    <div class="mt-2 bg-red-500 text-sm text-white rounded-lg p-4 hidden" role="alert" id="errorAlertEdit"></div>
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 sm:col-span-6">
                            <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900">Product Name</label>
                            <input type="text" name="name" value="${data.product.name}" id="nameEdit" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Headphone" required>
                            <span class="text-red-500" id="nameError"></span>
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                            <input type="text" name="price" value="${data.product.price / 100}" id="priceEdit" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="88.00" required>
                            <span class="text-red-500" id="priceError"></span>
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="discount" class="block mb-2 text-sm font-medium text-gray-900">Discount</label>
                            <input type="text" name="discount" value="${data.product.discount/100}" id="discountEdit" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="5.00" required>
                            <span class="text-red-500" id="discountError"></span>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="thumbnail" class="block mb-2 text-sm font-medium text-gray-900">Product Thumbnail Main Image</label>
                            <input type="file" name="thumbnail" accept=".jpg, .jpeg, .png, .webp" id="thumbnail" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" required>
                            <span class="text-red-500" id="thumbError"></span>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="product_images" class="block mb-2 text-sm font-medium text-gray-900">Product More Images</label>
                            <input type="file" accept=".jpg, .jpeg, .png, .webp" name="product_images[]" multiple id="product_images" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" required>
                            <span class="text-red-500" id="productImagesError"></span>
                        </div>
                        <div class="col-span-6 sm:col-span-6 flex items-center justify-start gap-4">
                            <label for="status" class="text-sm font-medium text-gray-900">Publish</label>
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" id="statusEdit" ${data.product.status == '1' ? 'checked' : ''} value="1">
                        </div>
                    </div>
                `;
                content.innerHTML = html;
            } else {
                alert(data.errors);
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });

    Alpine.store('editProduct', true);
}

</script>
