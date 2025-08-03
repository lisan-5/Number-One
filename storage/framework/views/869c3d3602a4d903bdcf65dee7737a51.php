

<?php $__env->startSection('title', 'Manage Shoes'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mx-auto py-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold">Shoes</h1>
            <a href="<?php echo e(route('admin.shoes.create')); ?>" class="px-4 py-2 bg-blue-600 text-white rounded-md">Add New Shoe</a>
        </div>
        <?php if(session('success')): ?>
            <div class="mb-4 text-green-600"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <table class="w-full bg-white shadow rounded-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $shoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shoe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="border px-4 py-2"><?php echo e($shoe->id); ?></td>
                        <td class="border px-4 py-2"><?php echo e($shoe->name); ?></td>
                        <td class="border px-4 py-2">$<?php echo e(number_format($shoe->price, 2)); ?></td>
                        <td class="border px-4 py-2">
                            <?php if($shoe->image): ?>
                                <img src="<?php echo e(asset('storage/'.$shoe->image)); ?>" class="h-12 w-12 object-cover rounded"> 
                            <?php endif; ?>
                        </td>
                        <td class="border px-4 py-2 space-x-2">
                            <a href="<?php echo e(route('admin.shoes.edit', $shoe)); ?>" class="text-blue-600 hover:underline">Edit</a>
                            <form action="<?php echo e(route('admin.shoes.destroy', $shoe)); ?>" method="POST" class="inline" onsubmit="return confirm('Delete this shoe?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="border px-4 py-2 text-center">No shoes found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lisan\Herd\Number_one\resources\views/admin/shoes/index.blade.php ENDPATH**/ ?>