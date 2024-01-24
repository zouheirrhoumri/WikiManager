<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/nav.php'; ?>


<div id="formWiki" class=" lg:mt-16 grid max-w-screen-xl grid-cols-1 gap-8 px-8 py-16 mx-auto rounded-lg md:grid-cols-2 md:px-12 lg:px-16 xl:px-32 items-center">
    <div class="flex flex-col justify-between">
        <div class="space-y-2">
            <h2 class="text-4xl font-bold leadi lg:text-5xl">Let's share knowledge!</h2>
        </div>
        <img src="<?= URLROOT; ?>/img/doodle.svg" alt="" class="p-6 h-52 md:h-64">
    </div>
    <form method="post" action="<?= URLROOT . '/wikis/update_wiki/' . $data['wiki']->wiki_id ?>" class="space-y-6 border h-fit p-4 rounded border-black">
        <div class="w-full">
            <label class="block uppercase tracking-wide text-black text-lg font-bold mb-2" for="grid-state">
                Choose categories
            </label>
            <div class="relative">
                <select name="categorie" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required id="grid-state">
                    <option value="">Sélectionnez de nouveau une catégorie</option>


                    <?php foreach ($data['categories'] as $categorie) : ?>
                        <option value="<?= $categorie->category_id; ?>" <?php echo ($categorie->category_id == $data['mycategory']->category_id) ? 'selected'  : ''; ?>>
                            <?= $categorie->name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>
        </div>



        <!-- ... Existing code ... -->



        <!-- ... Existing code ... -->

        <!-- Ajoutez ces lignes à votre formulaire -->
        <input type="hidden" id="selected-tag-id" name="selected_tag_id" value="">
        <div id="selected-tag-names">

        </div>


        <div>
            <label class="block uppercase tracking-wide text-black text-lg font-bold mb-2" for="grid-state-tags">
                Choose your Tags
            </label>
            <div class="relative">
                <select name="tagname" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state-tags">
                    <option value="" selected>Sélectionnez de nouveaux des tag</option>
                    <?php foreach ($data['tags'] as $tag) : ?>
                        <option value="<?= $tag->tag_id; ?>">
                            <?= $tag->name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- ... Existing code ... -->
        <div>
            <label class="text-sm">Titre</label>
            <input type="titre" name="titre" class="w-full p-3 border rounded border-black dark:bg-gray-800" value="<?php echo $data['wiki']->title; ?>">
        </div>
        <div>
            <label for="message" class="text-sm">DESCRIPTION</label>
            <textarea id="message" name="message" rows="3" class="w-full p-3 border rounded border-black dark:bg-gray-800"><?php echo $data['wiki']->content; ?></textarea>
        </div>
        <button type="submit" class="w-full bg-indigo-700  text-sm font-bold p-4   uppercase rounded text-white">update your wiki</button>
    </form>

    </form>
</div>


<script>
    /************************* */

    //************************************* */

    document.addEventListener("DOMContentLoaded", function(event) {
        var selectedTagIds = [];
        <?php
        foreach ($data['mytags'] as $tag) { ?>
            selectedTagIds.push(JSON.stringify(<?php echo ($tag->tag_id); ?>))
            updateDisplayedTags()
        <?php  } ?>
        function updateDisplayedTags() {
            event.preventDefault();
            var tagsContainer = document.getElementById("selected-tag-names");
            var selectedTagIdInput = document.getElementById("selected-tag-id");
            tagsContainer.innerHTML = "";

            selectedTagIds.forEach(function(tagId) {
                var tagName = getTagNameById(tagId); // Fonction pour récupérer le nom du tag
                var tag = document.createElement("span");
                tag.className = "selected-tag";
                tag.innerHTML = "<span class='bg-blue-500 text-white p-1 rounded-md m-1'>" + tagName + "</span><button  type='button' class='text-red-500' data-tag-id=\"" + tagId + "\">Remove</button>";

                tagsContainer.appendChild(tag);


                // Attach the click event to the Remove button
                var removeButton = tag.querySelector("button");
                removeButton.addEventListener("click", removeTag);
            });

            selectedTagIdInput.value = JSON.stringify(selectedTagIds);
            console.log(selectedTagIdInput.value);
        }


        /************************* */



        /************** */
        function getTagNameById(tagId) {
            // Fonction pour récupérer le nom du tag à partir du tableau de données des tags
            var tag = <?php echo json_encode($data['tags']); ?>;
            for (var i = 0; i < tag.length; i++) {
                if (tag[i].tag_id == tagId) {
                    return tag[i].name;
                }
            }
            return "";
        }




        function removeTag(event) {
            var tagId = event.target.dataset.tagId;
            var index = selectedTagIds.indexOf(tagId);
            if (index !== -1) {
                selectedTagIds.splice(index, 1);
                updateDisplayedTags();
            }
        }

        // Event listener for the select element
        var selectElement = document.getElementById("grid-state-tags");
        selectElement.addEventListener("change", function() {
            var selectedTagId = selectElement.value;
            if (selectedTagId && !selectedTagIds.includes(selectedTagId)) {
                selectedTagIds.push(selectedTagId);
                updateDisplayedTags();
            }
        });


    });
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>