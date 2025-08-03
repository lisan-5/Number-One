

<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Banner -->
<div class="bg-green-50 py-8 mb-8">
    <div class="container mx-auto text-center">
        <h1 class="text-4xl font-bold text-green-800 mb-2"><?php echo e(isset($tag) ? ucfirst($tag) . ' Collection' : 'All Products'); ?></h1>
        <p class="text-gray-600"><?php echo e(isset($tag) ? 'Explore our best ' . $tag . ' products.' : 'Discover our latest arrivals and offers.'); ?></p>
    </div>
</div>
<div class="container mx-auto py-10 space-y-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-semibold mb-6">Products</h1>
    <?php $action = isset($tag) ? route('products.tag', $tag) : route('products'); ?>
    <div class="bg-white p-4 rounded shadow mb-6">
        <form method="GET" action="<?php echo e($action); ?>" class="flex flex-wrap items-center gap-4">
            <select name="sort" class="border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-600">
            <option value="newest" <?php echo e(request('sort')=='newest' ? 'selected' : ''); ?>>Newest</option>
            <option value="price_asc" <?php echo e(request('sort')=='price_asc' ? 'selected' : ''); ?>>Price: Low to High</option>
            <option value="price_desc" <?php echo e(request('sort')=='price_desc' ? 'selected' : ''); ?>>Price: High to Low</option>
        </select>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition">Sort</button>
    </form>

    <?php if(session('success')): ?>
        <div class="mb-4 text-green-600 text-lg">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($shoes->isEmpty()): ?>
        <p class="text-gray-600">No products found.</p>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $shoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shoe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transform hover:scale-105 transition duration-300">
                    <?php if(!empty($shoe->images) && count($shoe->images)): ?>
                        <a href="<?php echo e(route('products.show', $shoe)); ?>">
                            <img src="<?php echo e(asset('storage/' . $shoe->images[0])); ?>" alt="<?php echo e($shoe->name); ?>" class="w-full h-64 object-cover transform transition duration-300 hover:scale-105 hover:rotate-3">
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('products.show', $shoe)); ?>">
                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        </a>
                    <?php endif; ?>
                    <div class="p-6 grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <h2 class="text-lg font-semibold"><?php echo e($shoe->name); ?></h2>
                            <p class="text-gray-600"><?php echo e($shoe->description); ?></p>
                            <p class="text-gray-600">Size: <?php echo e($shoe->size); ?></p>
                            <?php if(!empty($shoe->tags)): ?>
                                <div class="flex flex-wrap gap-2">
                                    <?php $__currentLoopData = $shoe->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('products.tag', $tag)); ?>" class="inline-block bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded hover:bg-blue-200 transition">
                                            <?php echo e($tag); ?>

                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="flex flex-col justify-between items-end">
                            <p class="text-green-800 font-bold text-xl">ETB <?php echo e(number_format($shoe->price, 2)); ?></p>
                            <?php if (! (session('cart')[$shoe->id] ?? false)): ?>
                                <form action="<?php echo e(route('cart.add')); ?>" method="POST" class="w-full">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="shoe_id" value="<?php echo e($shoe->id); ?>">
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded transition-colors duration-200 flex items-center justify-center">
                                        <img src="<?php echo e(Vite::asset('resources/svg/cart-shopping-svgrepo-com.svg')); ?>" class="h-5 w-5 mr-2" alt="Cart" />
                                        Add to Cart
                                    </button>
                                </form>
                            <?php endif; ?>
                            <?php if(auth()->guard()->check()): ?>
                                <form action="<?php echo e(route('wishlist.toggle', $shoe)); ?>" method="POST" class="mt-2">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="text-xl text-red-500 hover:text-red-700 focus:outline-none">
                                        <?php if(auth()->user()->wishlist()->where('shoe_id', $shoe->id)->exists()): ?>
                                            &#10084; 
                                        <?php else: ?>
                                            &#9825; 
                                        <?php endif; ?>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lisan\Herd\Number_one\resources\views/products.blade.php ENDPATH**/ ?>