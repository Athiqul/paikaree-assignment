<div id="editModal"   tabindex="-1" aria-hidden="true" class="container hidden fixed top-20 left-40 right-0 z-50 items-center justify-center  w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <form class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t ">
                <h3 class="text-xl font-semibold text-gray-900 ">
                    Edit Product
                </h3>
               <button type="button" onclick="removeEditModal()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="editUserModal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6" id="editModalBody">

            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b ">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save all</button>
            </div>
        </form>
    </div>
</div>
<script>
    function removeEditModal()
    {
        document.getElementById("editModal").classList.add("hidden");
    }

    function updateProduct() {
    const productId = document.getElementById('productId').value;
    const formData = new FormData();

    formData.append('name', document.getElementById('nameEdit').value);
    formData.append('price', document.getElementById('priceEdit').value * 100); // Assuming the price is input as dollars
    formData.append('discount', document.getElementById('discountEdit').value);
    formData.append('status', document.getElementById('statusEdit').checked ? 1 : 0);

    const thumbnail = document.getElementById('thumbnail').files[0];
    if (thumbnail) {
        formData.append('thumbnail', thumbnail);
    }

    const productImages = document.getElementById('product_images').files;
    for (let i = 0; i < productImages.length; i++) {
        formData.append('product_images[]', productImages[i]);
    }

    fetch(`http://localhost:8000/api/products/${productId}`, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        if (data.errors) {
            console.error(data.errors);
            let alert = document.getElementById("errorAlertEdit");
            alert.innerHTML = '';
            let html = `<span class="font-bold">Danger</span> alert! ${data.message}`;
            alert.innerHTML = html;
            alert.classList.remove('hidden');
        } else {
            console.log(data);
            alert('Product updated successfully!');
            Alpine.store('editProduct', false);
            // Optionally, refresh the product list or perform other actions
        }
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
        alert('An error occurred, please try again.');
    });
}

</script>
