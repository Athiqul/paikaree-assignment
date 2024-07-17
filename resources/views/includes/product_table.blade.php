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

    function showProduct()
    {
        var xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://localhost:8000/api/products', true);
            xhr.onload = function() {
                if (xhr.status >= 200) {
                    var data = JSON.parse(xhr.responseText);
                   //console.log(data);
                    var productsContainer = document.getElementById('productList');
                    productsContainer.innerHTML = ''; // Clear any existing content
                    let html='';
                    data.data.forEach(function(product) {
                        html+=` <tr class="bg-white border-b  ">

            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap ">
                <div class="ps-3">
                    <div class="text-base font-semibold">${product.name}</div>
                </div>
            </th>
            <td class="px-6 py-4">
            ${product.price}
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center">
                    <img class="w-10 h-10 rounded-full" src="/products/${product.thumbnail}" alt="${product.name}">
                </div>
            </td>
            <td class="px-6 py-4 flex items-center">
                <!-- Modal toggle -->
                <div  x-data={edit:false}>
                    <a href="#" @click=" edit= !edit" title="edit product" type="button" data-modal-target="editUserModal" data-modal-show="editUserModal" class="font-bold text-[30px] text-gray-600  hover:underline"><i class="fa-regular fa-pen-to-square"></i></a>
                      @include('includes.edit_modal')
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
</script>
