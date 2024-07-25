<?php $this->load->view('templates/header'); ?>
<div id="container" class="lg:p-4 border border-gray-300 rounded-lg max-w-2xl md mx-auto my-8 p-8">
    <h2 class="text-2xl font-bold mb-4">Edit Phone Record</h2>
    <hr>
    <div class="px-6 py-3">
        <?php echo validation_errors('<div class="text-red-500">', '</div>'); ?>
        <?php echo form_open_multipart('update/' . $record->id, 'class="max-w-md"'); ?>
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="<?php echo set_value('name', $record->name); ?>" class="form-input mt-1 block w-full border border-gray-300 rounded-lg">
            </div>

            <div class="mb-4">
                <label for="phone_number" class="block text-gray-700">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" value="<?php echo set_value('phone_number', $record->phone_number); ?>" class="form-input mt-1 block w-full border border-gray-300 rounded-lg">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="text" name="email" id="email" value="<?php echo set_value('email', $record->email); ?>" class="form-input mt-1 block w-full border border-gray-300 rounded-lg">
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700">Image</label>
                <input type="file" name="image" id="image" class="form-input mt-1 block w-full border border-gray-300 rounded-lg">
                <?php if ($record->image): ?>
                    <img src="<?php echo base_url('uploads/' . $record->image); ?>" alt="Image" width="100">
                <?php endif; ?>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                <a href="<?php echo base_url('home'); ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded ml-2">Back</a>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
