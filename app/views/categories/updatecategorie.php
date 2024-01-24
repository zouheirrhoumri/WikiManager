<?php require APPROOT . '/views/inc/header.php'; ?>


<nav x-data="{ isOpen: false }" class="relative bg-white shadow dark:bg-gray-800">
    <div class="container bg-white px-6 py-3 mx-auto md:flex">
        <div class="flex items-center justify-between">
            <a href="#">
                <img class="w-auto h-12 w-8 " src="<?php echo URLROOT; ?>/img/logo.png" alt="">
            </a>

            <!-- Mobile menu button -->
            <div class="flex  lg:hidden">
                <button x-cloak @click="isOpen = !isOpen" type="button" class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400" aria-label="toggle menu">
                    <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                    </svg>

                    <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
        <div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']" class="absolute bg-white md:bg-transparent inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out   md:mt-0 md:p-0 md:top-0 md:relative md:opacity-100 md:translate-x-0 md:flex md:items-center md:justify-between">
            <div class="flex flex-col px-2 -mx-4 md:flex-row md:mx-10 md:py-0">
                <a href="<?= URLROOT; ?>/pages/index" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 md:mx-2">Home</a>
                <a href="<?= URLROOT; ?>/tags/index" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 md:mx-2">TAGS</a>
                <a href="<?= URLROOT; ?>/categories/index" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 md:mx-2">Categorys</a>
                <a id="create_wiki" href="<?= URLROOT; ?>/wikis/formWiki" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 md:mx-2">Create a wiki</a>
            </div>

      

        </div>
    </div>
</nav>
<div id="updateCategoryModal" class=" fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-8 rounded-md shadow-md">
            <h2 class="text-2xl font-bold mb-4">Update Category</h2>
            <form action="<?php echo URLROOT .'/categories/update/'. $data['CategoryID']?>" method="post">
                <input type="hidden" id="updateCategoryId" name="categoryId" value="">
                <div class="mb-4">
                    <label for="updateCategoryName" class="block text-gray-700 font-semibold mb-2">Category Name</label>
                    <input type="text" id="updateCategoryName" name="categoryName" class="w-full p-2 border border-gray-300 rounded-md" value="<?php echo $data['categorie_name'];?>">
                    <span class="invalid-feedback text-red-500"><?php echo $data['categorie_name_error']; ?></span>
                </div>

                <div class="flex justify-end">
                    <a href="<?php echo URLROOT .'/categories/index/'?>" class="text-gray-500 hover:text-gray-700 mr-4">Cancel</a>
                    <button type="submit" name="Submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Category</button>
                </div>
            </form>
        </div>
    </div>


<!-- Add Category Modal -->






<script>
    // function openAddCategoryModal() {
    //     document.getElementById('addCategoryModal').classList.remove('hidden');
    // }
    // function openAddtagModal(){
    //     document.getElementById('addTagModal').classList.remove('hidden'); 
    // }

    // function closeAddCategoryModal() {
    //     document.getElementById('addCategoryModal').classList.add('hidden');
    // }
    // function closeaddTagModal() {
    //     document.getElementById('addTagModal').classList.add('hidden');
    // }
    
    
    // function openUpdateCategoryModal(categoryId, categoryName) {
    //     document.getElementById('updateCategoryId').value = categoryId;
    //     document.getElementById('updateCategoryName').value = categoryName;
    //     document.getElementById('updateCategoryModal').classList.remove('hidden');
    // }
    // function openUpdateTagModal(categoryId, categoryName) {
    //     document.getElementById('updateCategoryId').value = categoryId;
    //     document.getElementById('updateCategoryName').value = categoryName;
    //     document.getElementById('updateCategoryModal').classList.remove('hidden');
    // }

    // function closeUpdateCategoryModal() {
    //     document.getElementById('updateCategoryModal').classList.add('hidden');
    // }
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>