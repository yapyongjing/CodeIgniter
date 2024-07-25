<?php $this->load->view('templates/header'); ?>
<div id="container" class="lg:p-4 max-w-4xl md mx-auto my-8 p-8">
<h2 class="text-2xl font-bold mb-4">Register</h2>
    <?php echo validation_errors(); ?>
    <?php echo form_open('register'); ?>
        <label for="username" class="block text-gray-700">Username</label>
        <input type="text" name="username" class="form-input mt-1 block w-full border border-gray-300 rounded-lg" value="<?php echo set_value('username'); ?>"><br>

        <label for="email" class="block text-gray-700">Email</label>
        <input type="text" name="email" class="form-input mt-1 block w-full border border-gray-300 rounded-lg" value="<?php echo set_value('email'); ?>"><br>

        <label for="password" class="block text-gray-700">Password</label>
        <input type="password" class="form-input mt-1 block w-full border border-gray-300 rounded-lg" name="password"><br>

        <label for="password_confirm" class="block text-gray-700">Confirm Password</label>
        <input type="password" class="form-input mt-1 block w-full border border-gray-300 rounded-lg" name="password_confirm"><br>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Register</button>
    <?php echo form_close(); ?>
    <p class="mt-4 text-gray-600 text-center">Already have an account? <a href="<?php echo base_url('login'); ?>" class="login-link">Login</a></p>
</div>
<?php $this->load->view('templates/footer'); ?>
