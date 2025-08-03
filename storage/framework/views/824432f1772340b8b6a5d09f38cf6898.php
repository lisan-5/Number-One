

<?php $__env->startSection('title', 'Manage Users'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold">Users</h1>
    </div>
    <?php if(session('success')): ?>
        <div class="mb-4 text-green-600"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <table class="w-full bg-white shadow rounded-lg">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="border px-4 py-2"><?php echo e($user->id); ?></td>
                    <td class="border px-4 py-2"><?php echo e($user->name); ?></td>
                    <td class="border px-4 py-2"><?php echo e($user->email); ?></td>
                    <td class="border px-4 py-2 space-x-2">
                        <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="text-blue-600 hover:underline">Edit</a>
                        <form action="<?php echo e(route('admin.users.destroy', $user)); ?>" method="POST" class="inline" onsubmit="return confirm('Delete this user?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="border px-4 py-2 text-center">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="mt-4">
        <?php echo e($users->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lisan\Herd\Number_one\resources\views/admin/users/index.blade.php ENDPATH**/ ?>