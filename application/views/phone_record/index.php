<?php $this->load->view('templates/header'); ?>
<div id="container" class="lg:p-4 max-w-4xl md:mx-auto my-8 p-8">
    <a href="<?php echo base_url('create'); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add New Record</a>

    <table class="min-w-full bg-white border-collapse border border-gray-200">
        <thead>
            <tr>
                <th class="border border-gray-200 px-4 py-2">Name</th>
                <th class="border border-gray-200 px-4 py-2">Phone Number</th>
                <th class="border border-gray-200 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($phone_records): ?>
                <?php foreach ($phone_records as $record): ?>
                    <tr>
                        <td class="border border-gray-200 px-4 py-2"><?php echo $record->name; ?></td>
                        <td class="border border-gray-200 px-4 py-2"><?php echo $record->phone_number; ?></td>
                        <td class="border border-gray-200 px-4 py-2 text-center">
                            <a href="<?php echo base_url('edit/' . $record->id); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block">Edit</a>
                            <a href="<?php echo base_url('delete/' . $record->id); ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-block ml-2">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="border border-gray-200 px-4 py-2 text-center">No Record</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="pagination mt-4">
        <?php echo $pagination; ?>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
