<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Record</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-gray-700 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <a href="#" class="text-xl font-bold">Phone Record</a>
            <nav>
                <a href="home" class="text-gray-300 hover:text-white mx-2">Home</a>
                <a href="<?php echo base_url('logout'); ?>" class="text-gray-300 hover:text-white mx-2">Logout</a>
            </nav>
        </div>
    </header>

    <?php if($this->session->flashdata('success')): ?>
        <div class="m-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline"><?php echo $this->session->flashdata('success'); ?></span>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
        <div class="m-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline"><?php echo $this->session->flashdata('error'); ?></span>
        </div>
    <?php endif; ?>
