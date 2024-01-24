<body class="bg-white font-family-karla">

    <!-- Top Bar Nav -->
    <nav class="w-full py-4 bg-blue-800 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between">

            <nav>
                <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">
                    <li><a class="hover:text-gray-200 hover:underline px-4" href="<?= URLROOT; ?>/pages/index">Home</a></li>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'admin') : ?>
                        <li><a class="hover:text-gray-200 hover:underline px-4" href="<?= URLROOT; ?>/tags/index">Tags</a></li>
                        <li><a class="hover:text-gray-200 hover:underline px-4" href="<?= URLROOT; ?>/wikis/stats">Stats</a></li>
                        <li> <a class="flex items-center  hover:bg-gray-400 hover:underline rounded py-2 px-4" href="<?= URLROOT; ?>/categories/index">
                                <i class="fa-solid fa-screwdriver-wrench mr-2"></i> Manage categories
                            </a></li>
                    <?php endif ?>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'admin') {
                    } else { ?>

                        <li><a class="hover:text-gray-200 hover:underline px-4" href="<?= URLROOT; ?>/wikis/formWiki">Create wiki</a></li>
                    <?php } ?>
                </ul>
            </nav>
            <!-- search bar -->
            <div class="relative mt-2 ml-12 md:mt-0">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                        <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
                <input id="searchbar" type="text" class="w-full py-2 pl-10 pr-4 mr-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-blue-300" placeholder="Search">
            </div>
            <a href="<?php echo URLROOT; ?>/users/logout" class="bg-indigo-700 hover:bg-indigo-400 text-white-700 font-semibold hover:text-white py-2 px-2 border border-white-500 hover:border-transparent rounded">LOG OUT</a>

        </div>

    </nav>
    <div id="searchresult">

</div>
    <!-- Text Header -->
    <header class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="#">
                WIKI ARTICLE
            </a>
            <p class="text-lg text-gray-600">
                Streamlining Wiki Management and Collaboration for Seamless Content Creation and Sharing.
            </p>
        </div>

        <div class="flex my-4 py-4 bg-indigo-700 items-center justify-center    cursor-pointer rounded-md overflow-hidden shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] hover:scale-105 transition-all duration-300">
            <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && isset($wiki) && $wiki->user_id == $_SESSION['user_id']) : ?>
                <div class="group flex space-y-2 cursor-pointer rounded-md ">
                    <a class="bg-indigo-200 text-yellow-700 group-hover:text-indigo-800 group-hover:smooth-hover flex w-20 h-20 rounded-full items-center justify-center" href="<?= URLROOT; ?>/wikis/formWiki">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </header>

    