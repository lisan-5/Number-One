

<?php $__env->startSection('title', 'Categories'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Banner -->
<div class="bg-green-50 py-8 mb-8 text-center">
    <h1 class="text-4xl font-bold text-green-800">Shop by Category</h1>
    <p class="text-gray-600 mt-2">Find the perfect style for every occasion</p>
</div>
<div class="container mx-auto py-10">
    <h2 class="sr-only">Categories</h2>

    <?php if($categories->isEmpty()): ?>
        <p class="text-gray-600">No categories found.</p>
    <?php else: ?>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('categories.show', $category)); ?>" class="block p-6 bg-white rounded-lg shadow hover:shadow-lg transform hover:scale-105 transition text-center">
                    <span class="text-lg font-medium text-gray-800"><?php echo e(ucfirst($category)); ?></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lisan\Herd\Number_one\resources\views/categories/index.blade.php ENDPATH**/ ?>