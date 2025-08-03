

<?php $__env->startSection('title', ucfirst($category)); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-semibold mb-6">Category: <?php echo e(ucfirst($category)); ?></h1>

    <?php if($shoes->isEmpty()): ?>
        <p class="text-gray-600">No products found in this category.</p>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php $__currentLoopData = $shoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shoe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="border rounded-lg overflow-hidden shadow-sm">
                    <?php if(!empty($shoe->images) && count($shoe->images)): ?>
                        <img src="<?php echo e(asset('storage/' . $shoe->images[0])); ?>" alt="<?php echo e($shoe->name); ?>" class="w-full h-48 object-cover">
                    <?php else: ?>
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    <?php endif; ?>
                    <div class="p-4">
                        <h2 class="text-lg font-semibold"><?php echo e($shoe->name); ?></h2>
                        <p class="text-gray-700 mt-1">ETB <?php echo e(number_format($shoe->price, 2)); ?></p>
                        <p class="text-gray-600 mt-1"><?php echo e($shoe->description); ?></p>
                        <p class="text-gray-600 mt-1">Size: <?php echo e($shoe->size); ?></p>
                        <?php if(!empty($shoe->tags)): ?>
                            <div class="mt-2">
                                <?php $__currentLoopData = $shoe->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="inline-block bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded mr-1"><?php echo e($tag); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="mt-6">
            <?php echo e($shoes->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lisan\Herd\Number_one\resources\views/categories/show.blade.php ENDPATH**/ ?>