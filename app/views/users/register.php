<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/svg+xml" href="/vite.svg" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>SignUp</title>
</head>

<body>
  <div class="min-h-screen py-20" style="background-image: linear-gradient(115deg, #143374, #6cb8f7)">
    <div class="container mx-auto">
      <div class="flex flex-col lg:flex-row w-10/12 lg:w-8/12 bg-white rounded-xl mx-auto shadow-lg overflow-hidden">
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-12 bg-no-repeat bg-cover bg-center" style="background-image: url('../img/Register-Background.png');">
          <h1 class="text-white text-2xl mb-auto mt-12">Welcome To <?php echo SITENAME; ?> </h1>
        </div>
        <div class="w-full lg:w-1/2 py-16 px-12">
          <h2 class="text-3xl mb-4">Register</h2>
          <p class="mb-4">
            Create your account. It’s free and only take a minute
          </p>
          <form action="<?php echo URLROOT; ?>/users/register" method="post">
            <div class="">
              <input type="text" name="name" placeholder="First Name" class="border border-gray-400 py-1 px-2 w-full<?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
              <span class="invalid-feedback text-red-500"><?php echo $data['name_err']; ?></span>
            </div>
            <div class="mt-5">
              <input class="border border-gray-400 py-1 px-2 w-full <?php echo (!empty($data['userlastname_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['userlastname']; ?>" type="text" id="user" name="userlastname" placeholder="Last Name ">
              <span class="invalid-feedback text-red-500"><?php echo $data['userlastname_err']; ?></span>
            </div>
            <div class="mt-5">
              <input class="border border-gray-400 py-1 px-2 w-full  <?php echo (!empty($data['phoneNumber_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phoneNumber']; ?>" type="text" id="user" name="phoneNumber" placeholder="Enter your phone number"></br></br>
              <span class="invalid-feedback text-red-500"><?php echo $data['phoneNumber_err']; ?></span>
            </div>

            <div class="">
              <input type="text" name="email" placeholder="Email" class="border border-gray-400 py-1 px-2 w-full <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
              <span class="invalid-feedback text-red-500"><?php echo $data['email_err']; ?></span>
            </div>
            <div class="mt-5">
              <input type="password" placeholder="Password" name="password" class="border border-gray-400 py-1 px-2 w-full <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
              <span class="invalid-feedback text-red-500"><?php echo $data['password_err']; ?></span>
            </div>
            <div class="mt-5">
              <input type="password" name="confirm_password" placeholder="Confirm Password" class="border border-gray-400 py-1 px-2 w-full <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
              <span class="invalid-feedback text-red-500"><?php echo $data['confirm_password_err']; ?></span>
            </div>
            <div class="mt-5">
              <span>
                Already have an account ? <a href="<?php echo URLROOT; ?>/users/login" class="text-purple-500 font-semibold">LogIn</a>
              </span>
            </div>
            <div class="mt-5">
              <button class="w-full bg-blue-500 py-3 text-center text-white">Register Now</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>