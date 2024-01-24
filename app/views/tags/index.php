<?php require APPROOT . '/views/inc/header.php'; ?>


<?php require APPROOT . '/views/inc/nav.php'; ?>
<div class="p-8 bg-gray-200">
    <div class="flex justify-between items-center  my-8">
        <h1 class="text-xl md:text-2xl font-bold">Categories</h1>


        <a onclick="openAddtagModal()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">+Add Tag</a>

    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4">
        <?php foreach ($data['tags'] as $tag) : ?>
            <div class="bg-indigo-200 rounded-lg shadow-md p-4">
                <h2 class="text-xl font-bold mb-2"><?php echo $tag->name; ?></h2>

                <div class="flex space-x-4">
                    <a href="<?php echo URLROOT; ?>/tags/delete_tag/<?php echo $tag->tag_id; ?>" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</a>
                    <a href="<?php echo URLROOT; ?>/tags/update_tag/<?php echo $tag->tag_id; ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>



<div id="addTagForm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-8 rounded-md shadow-md">
        <h2 class="text-2xl font-bold mb-4">Add Tag</h2>

        <!-- Category Form -->
        <form action="<?php echo URLROOT; ?>/tags/addTag" method="post">
            <div class="mb-4">
                <label for="categoryName" class="block text-gray-700 font-semibold mb-2">Tag Name</label>
                <input type="text" id="categoryName" name="tagName" class="w-full p-2 border border-gray-300 rounded-md">
                <p id="error_tag" class="text-red w-[25vw=]"></p>
            </div>

            <div class="flex justify-end">
                <button type="button" onclick="closeaddTagModal()" class="text-gray-500 hover:text-gray-700 mr-4">Cancel</button>
                <button type="submit" name="Submit" value="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Tag</button>
            </div>
        </form>
    </div>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addTagForm = document.getElementById('addTagForm');
 
        addTagForm.addEventListener('submit', function(event) {
          
            const tagName = document.getElementById('categoryName').value;
            const tagRegex = /^[a-zA-Z0-9_]+$/;

            if (!tagRegex.test(tagName)) {
       
                $('#error_tag').text('Tag Name is invalid. It should contain only letters, numbers, and underscores.');
                event.preventDefault();
                     
                return;
            }else{
                
            }

        });

    });
    function openAddtagModal() {
            document.getElementById('addTagForm').classList.remove('hidden');

        }

        function closeaddTagModal() {
            document.getElementById('addTagForm').classList.add('hidden');
            $('#error_tag').text('');        }

  
    /************** */
    
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>