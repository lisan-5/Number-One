

<?php $__env->startSection('title', 'Add New Shoe'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-semibold mb-6">Add New Shoe</h1>
        <?php if($errors->any()): ?>
            <div class="mb-4 text-red-600">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <form action="<?php echo e(route('admin.shoes.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"><?php echo e(old('description')); ?></textarea>
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" step="0.01" name="price" id="price" value="<?php echo e(old('price')); ?>" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>
            <div>
                <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                <input type="text" name="size" id="size" value="<?php echo e(old('size')); ?>" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>
            <div>
                <label for="tags" class="block text-sm font-medium text-gray-700">Tags (comma separated)</label>
                <input type="text" name="tags" id="tags" value="<?php echo e(old('tags')); ?>" placeholder="e.g. samba,play,master quality" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>
            <div>
                <label for="images" class="block text-sm font-medium text-gray-700">Images (up to 5)</label>
                <input type="file" name="images[]" id="images" accept="image/*" multiple class="mt-1 block w-full" />
                <p class="text-xs text-gray-500 mt-1">You can select multiple images to upload.</p>
            </div>
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Create Shoe</button>
                <a href="<?php echo e(route('admin.shoes.index')); ?>" class="ml-4 text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lisan\Herd\Number_one\resources\views/admin/shoes/create.blade.php ENDPATH**/ ?>