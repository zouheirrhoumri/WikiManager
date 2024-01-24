<?php require APPROOT . '/views/inc/header.php'; ?>


<div id="updateCategoryModal" class=" fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-8 rounded-md shadow-md">
            <h2 class="text-2xl font-bold mb-4">Update Tag</h2>
            <form action="<?php echo URLROOT .'/tags/update_tag/'. $data['tag_id']?>" method="post">
                <input type="hidden" id="updateCategoryId" name="categoryId" value="">
                <div class="mb-4">
                    <label  class="block text-gray-700 font-semibold mb-2">Tag Name</label>
                    <input type="text" name="tagName" class="w-full p-2 border border-gray-300 rounded-md" value="<?php echo $data['tag_name'];?>">
                    <span class="invalid-feedback text-red-500"><?php echo $data['tag_name_error']; ?></span>
                </div>

                <div class="flex justify-end">
                    <a href="<?php echo URLROOT .'/tags/index/'?>" class="text-gray-500 hover:text-gray-700 mr-4">Cancel</a>
                    <button type="submit" name="Submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Tag</button>
                </div>
            </form>
        </div>
    </div>



<?php require APPROOT . '/views/inc/footer.php'; ?>