

<?php $__env->startSection('title', 'My Wishlist'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-semibold mb-6 text-green-800">My Wishlist</h1>
    <?php if($items->isEmpty()): ?>
        <p class="text-gray-600">Your wishlist is empty.</p>
        <a href="<?php echo e(route('products')); ?>" class="inline-block mt-4 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">Browse Products</a>
    <?php else: ?>
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-green-50 text-green-800 uppercase text-sm">
                        <th class="px-6 py-3 text-left">Product</th>
                        <th class="px-6 py-3 text-left">Price</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-4 flex items-center">
                                <?php if(!empty($item->shoe->images) && count($item->shoe->images)): ?>
                                    <img src="<?php echo e(asset('storage/' . $item->shoe->images[0])); ?>" alt="<?php echo e($item->shoe->name); ?>" class="h-12 w-12 object-cover rounded mr-4">
                                <?php else: ?>
                                    <div class="h-12 w-12 bg-gray-200 rounded mr-4"></div>
                                <?php endif; ?>
                                <span class="font-medium"><?php echo e($item->shoe->name); ?></span>
                            </td>
                            <td class="px-6 py-4">ETB <?php echo e(number_format($item->shoe->price, 2)); ?></td>
                            <td class="px-6 py-4 flex gap-2">
                                <form action="<?php echo e(route('wishlist.toggle', $item->shoe)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md transition">Remove</button>
                                </form>
                                <form action="<?php echo e(route('cart.add')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="shoe_id" value="<?php echo e($item->shoe->id); ?>">
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md transition">Add to Cart</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            <?php echo e($items->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lisan\Herd\Number_one\resources\views/wishlist/index.blade.php ENDPATH**/ ?>