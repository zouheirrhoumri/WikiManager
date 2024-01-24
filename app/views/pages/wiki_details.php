<?php require APPROOT . '/views/inc/header.php'; ?>

<?php require APPROOT . '/views/inc/nav.php'; ?>

<?php
$wiki = $data['wiki'];
$user = $data['user'];
$category = $data['category'];
$tags = $data['tags'];


?>

<div class="container mx-auto flex flex-wrap py-6">

  <!-- Post Section -->
  <section class="w-full md:w-2/3 flex flex-col items-center px-3">

    <article class="flex flex-col shadow my-4">
      <!-- Article Image -->
      <a href="#" class="hover:opacity-75">
        <img src="https://source.unsplash.com/collection/1346951/1000x500?sig=1">
      </a>
      <div class="bg-white flex flex-col justify-start p-6">
        <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4"><?php echo $category ? $category->name : "general"; ?></a>
        <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4"><?php echo $wiki->title; ?></a>
        <p href="#" class="text-sm pb-3">
          By <a href="#" class="font-semibold hover:text-gray-800"> <?= $user->nom . ' ' . $user->prenom . ' | at ' . $wiki->created_at; ?>
        </p>
        <p class="pb-3"> <?= $wiki->content; ?></p>

      </div>
    </article>

  </section>

  <!-- Sidebar Section -->
  <aside class="w-full md:w-1/3 flex flex-col items-center  px-3">
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

</html>e




<script>
  $(document).ready(function() {

  });
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>