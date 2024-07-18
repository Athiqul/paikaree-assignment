<div id="editModal" tabindex="-1" aria-hidden="true"
    class="container hidden fixed top-20 left-40 right-0 z-50 items-center justify-center  w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <form class="relative bg-white rounded-lg shadow " id="productEdit" >
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t ">
                <h3 class="text-xl font-semibold text-gray-900 ">
                    Edit Product
                </h3>
                <button type="button" onclick="removeEditModal()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                    data-modal-hide="editUserModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6" id="editModalBody">

            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b ">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save
                    all</button>
            </div>
        </form>
    </div>
</div>


<script>
    function removeEditModal() {
        document.getElementById("editModal").classList.add("hidden");
    }


    document.getElementById('productEdit').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    const productId = document.getElementById('productId').value;

    try {
        const response = await fetch('http://localhost:8000/api/product/update/'+productId, {
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
            let alert=document.getElementById("errorAlertEdit");
            alert.innerHtml='';
            let html=`<span class="font-bold">Danger</span> alert! ${data.message}`
            alert.innerHTML=html;
            alert.classList.remove('hidden');



        } else {
            // Successfully added product
            console.log(data);
            //modal close


            alert('Product updated successfully!');

             removeEditModal();
             showProduct();

        }
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
        alert('An error occurred, please try again.');
    }
});



</script>
