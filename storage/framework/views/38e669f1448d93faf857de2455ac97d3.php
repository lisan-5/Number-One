

<?php $__env->startSection('title', 'Edit User'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-semibold mb-6">Edit User</h1>
    <?php if($errors->any()): ?>
        <div class="mb-4 text-red-600">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="<?php echo e(route('admin.users.update', $user)); ?>" method="POST" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="<?php echo e(old('name', $user->name)); ?>" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="<?php echo e(old('email', $user->email)); ?>" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>
        <div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update User</button>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="ml-4 text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lisan\Herd\Number_one\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>