<?php require APPROOT . '/views/inc/header.php'; ?>

<?php require APPROOT . '/views/inc/nav.php'; ?>

<!-- Topic Nav -->


<div class="container mx-auto flex flex-wrap py-6">


    <!-- Posts Section -->
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">
        <?php
        foreach ($data['wikis'] as $wiki) : ?>

            <article class="flex flex-col shadow my-4">
                <a href="#" class="hover:opacity-75">
                    <img src="https://source.unsplash.com/collection/1346951/1000x500?sig=1">
                </a>
                <div class="bg-white flex flex-col justify-start p-6">
                    <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4"><?php echo $wiki->name; ?></a>
                    <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4"><?php echo $wiki->title; ?></a>
                    <p href="#" class="text-sm pb-3">
                        By <a href="#" class="font-semibold hover:text-gray-800"><?php echo  $wiki->nom . ' ' . $wiki->prenom . ' | at ' . $wiki->created_at; ?>
                    </p>
                    <a href="#" class="pb-6"><?php echo (strlen($wiki->content) > 100) ? substr($wiki->content, 0, 50) . '...' : $wiki->content; ?></a>
                    <p href="#" class="text-sm pb-3">
                        <a href="#" class="font-semibold hover:text-gray-800"><?php echo  $wiki->name ?>
                    </p>
                    <a href="<?= URLROOT . '/wikis/read_more/' . $wiki->wiki_id; ?>" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="flex flex-col">
                    <div class="flex justify-around my-4">
                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') : ?>
                            <a href="<?= URLROOT . '/wikis/archiver_wiki/' . $wiki->wiki_id; ?>" class="p-2 text-[12px] bg-indigo-500 rounded cursor-pointer "><i class="fa-solid fa-folder-open">Archiver</i></a>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role'])   && $wiki->user_id == $_SESSION['user_id']) : ?>
                            <a href="<?= URLROOT . '/wikis/delete_wiki/' . $wiki->wiki_id; ?>" class="p-2 bg-red-300 text-[12px] rounded cursor-pointer "><i class="fa-solid fa-box-archive "> DELETE</i></a>
                            <a href="<?= URLROOT . '/wikis/update_wiki/' . $wiki->wiki_id; ?>" class="p-2 bg-indigo-400 text-[12px] rounded cursor-pointer "><i class="fa-regular fa-pen-to-square "> UPDATE</i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </section>

    <!-- Sidebar Section -->
    <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

        <div class="w-full bg-white shadow flex flex-col my-4 p-6">
            <p class="text-xl font-semibold pb-5">What is Wiki Article</p>
            <p class="pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio
                sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio
                sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio
                sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio
                sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio
                sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio
                sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio
                sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio
                sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.</p>
            <a href="#" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                Get to know us
            </a>
        </div>

    </aside>


</div>

<footer class="w-full border-t bg-white pb-12">
    <div class="relative w-full flex items-center invisible md:visible md:pb-12" x-data="getCarouselData()">

        <template x-for="image in images.slice(currentIndex, currentIndex + 6)" :key="images.indexOf(image)">
            <img class="w-1/6 hover:opacity-75" :src="image">
        </template>

    </div>
    <div class="w-full container mx-auto flex flex-col items-center">
        <div class="flex flex-col md:flex-row text-center md:text-left md:justify-between py-6">
            <a href="#" class="uppercase px-3">About Us</a>
            <a href="#" class="uppercase px-3">Privacy Policy</a>
            <a href="#" class="uppercase px-3">Terms & Conditions</a>
            <a href="#" class="uppercase px-3">Contact Us</a>
        </div>
        <div class="uppercase pb-6">&copy; Wiki Article</div>
    </div>
</footer>

<script>
    let searchbar = document.getElementById('searchbar');
    searchbar.addEventListener('input', search);
    function search() {
        let search = searchbar.value;
        let searchresult = document.getElementById('searchresult');
        const xhr = new XMLHttpRequest();
        var formData = new FormData();
        formData.append('search', search);
        xhr.open('POST', 'http://localhost/Wikis-sites/Users/search', true);
        xhr.onload = function() {
            if (xhr.status == 200 && xhr.readyState == 4) {
                let data = JSON.parse(xhr.response);
                data.forEach(element => {
                    searchresult.innerHTML = '';
                    searchresult.innerHTML += `
                        <a href = "http://localhost/Wikis-sites/wikis/read_more/${element.wiki_id}">${element.title}</a>`;
                });
                if (search.length == 0) {
                    searchresult.innerHTML = '';
                }
            }
        };
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(new URLSearchParams(formData));
    }

    

    function getCarouselData() {
        return {
            currentIndex: 0,
            images: [
                'https://source.unsplash.com/collection/1346951/800x800?sig=1',
                'https://source.unsplash.com/collection/1346951/800x800?sig=2',
                'https://source.unsplash.com/collection/1346951/800x800?sig=3',
                'https://source.unsplash.com/collection/1346951/800x800?sig=4',
                'https://source.unsplash.com/collection/1346951/800x800?sig=5',
                'https://source.unsplash.com/collection/1346951/800x800?sig=6',

            ],

        }
    }
</script>

</body>

</html>