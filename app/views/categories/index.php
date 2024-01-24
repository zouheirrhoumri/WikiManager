<?php require APPROOT . '/views/inc/header.php'; ?>

<?php require APPROOT . '/views/inc/nav.php'; ?>
<div class="p-8 bg-gray-200">
    <div class="flex justify-between items-center  my-8">
        <h1 class="text-xl md:text-2xl font-bold">Categories</h1>
        <div>
            <a onclick="openAddCategoryModal()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">+Add Category</a>

        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4">
        <?php foreach ($data['categories'] as $category) : ?>
            <div class="bg-indigo-300 rounded-lg shadow-md p-4">
                <h2 class="text-xl font-bold mb-2"><?php echo $category->name; ?></h2>

                <div class="flex space-x-2">
                    <span class="bg-green-400 text-white p-2 rounded hover:bg-green-500"><?php echo $category->date_categorie; ?></span>
                    <a href="<?php echo URLROOT; ?>/categories/delete/<?php echo $category->category_id; ?>" class="bg-red-500 text-white p-2 rounded hover:bg-red-600">Delete</a>
                    <a href="<?php echo URLROOT . '/categories/update/' . $category->category_id; ?>" class="bg-blue-500  text-white p-2 rounded hover:bg-blue-600">Update</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<div id="addCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-8 rounded-md shadow-md">
        <h2 class="text-2xl font-bold mb-4">Add Category</h2>

        <!-- Category Form -->
        <form id="addCategoryForm">
            <div class="mb-4">
                <label for="categoryName" class="block text-gray-700 font-semibold mb-2">Category Name</label>
                <input type="text" id="categoryName" name="categoryName" class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div class="flex justify-end">
                <button type="button" onclick="closeAddCategoryModal()" class="text-gray-500 hover:text-gray-700 mr-4">Cancel</button>
                <button type="button" onclick="submitCategoryForm()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Category</button>
            </div>
        </form>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    function openAddCategoryModal() {
        document.getElementById('addCategoryModal').classList.remove('hidden');
    }

    function closeAddCategoryModal() {
        document.getElementById('addCategoryModal').classList.add('hidden');
    }

    function submitCategoryForm() {
        var formData = $('#addCategoryForm').serialize();

        $.ajax({
            type: 'POST',
            url: '<?php echo URLROOT; ?>/categories/add',
            data: formData,
            success: function(response) {
             
                if (response.success) {

                    closeAddCategoryModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Your work has been saved",
                        showConfirmButton: false,
                        timer: 1000
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: response.error,

                    });

                }
            },
            error: function(error) {
                // Handle error
                console.error(error);
            }
        });
    }
</script>



<?php require APPROOT . '/views/inc/footer.php'; ?>