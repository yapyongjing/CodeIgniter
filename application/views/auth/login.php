<?php $this->load->view('templates/header'); ?>
<div id="container" class="lg:p-4 max-w-4xl md:mx-auto my-8 p-8">

    <h2 class="text-2xl font-bold mb-4">User Login</h2>
    <form action="<?php echo site_url('AuthController/login'); ?>" method="post">
        <div class="mb-4">
            <label for="username" class="block text-gray-700">Username</label>
            <input type="text" name="username" id="username" class="form-input mt-1 block w-full border border-gray-300 rounded-lg">
            <?php echo form_error('username', '<div class="text-red-500">', '</div>'); ?>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="form-input mt-1 block w-full border border-gray-300 rounded-lg">
            <?php echo form_error('password', '<div class="text-red-500">', '</div>'); ?>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Login</button>
    </form>
    <p class="mt-4 text-gray-600 text-center">New? <a href="<?php echo base_url('register'); ?>" class="text-blue-600 hover:underline">Register Account</a></p>
</div>
<?php $this->load->view('templates/footer'); ?>
