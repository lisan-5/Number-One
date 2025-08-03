

<?php $__env->startSection('title', 'Checkout'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-semibold mb-6">Checkout</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <!-- Checkout Form -->
        <div class="md:col-span-2">
            <h2 class="text-xl font-semibold mb-4">Shipping Details</h2>
            <form action="<?php echo e(route('checkout.store')); ?>" method="POST" x-data="{ delivery: false }" class="bg-white shadow rounded-lg p-6 space-y-6">
                <?php echo csrf_field(); ?>

                <?php if($errors->any()): ?>
                    <div class="mb-4 text-red-600">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo e(old('name', Auth::user()->name)); ?>" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo e(old('email', Auth::user()->email)); ?>" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" value="<?php echo e(old('phone')); ?>" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                </div>
                <div>
                    <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                    <input type="text" name="size" id="size" value="<?php echo e(old('size')); ?>" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                </div>
                <div class="flex items-center mt-6">
                    <input type="checkbox" name="delivery" id="delivery" x-model="delivery" value="1" class="h-4 w-4 text-blue-600" />
                    <label for="delivery" class="ml-2 text-sm text-gray-700">
                        Delivery (Additional charges apply outside Addis Ababa)
                    </label>
                </div>

                <div x-show="delivery" class="mt-6 space-y-6">
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Delivery Location</label>
                        <input type="text" name="location" id="location" value="<?php echo e(old('location')); ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                    </div>
                    <div>
                        <label for="instructions" class="block text-sm font-medium text-gray-700">Delivery Instructions</label>
                        <textarea name="instructions" id="instructions" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"><?php echo e(old('instructions')); ?></textarea>
                    </div>
                </div>

                <button type="submit" class="w-full mt-6 bg-green-600 text-white py-2 rounded-md">Place Order</button>
            </form>
        </div>

        <!-- Order Summary -->
        <div>
            <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
            <div class="bg-white shadow rounded-lg p-6 space-y-4">
                <?php if($items->isEmpty()): ?>
                    <p class="text-gray-600">Your cart is empty.</p>
                <?php else: ?>
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex justify-between">
                            <span><?php echo e($item->shoe->name); ?> x<?php echo e($item->quantity); ?></span>
                            <span>ETB <?php echo e(number_format($item->total, 2)); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="border-t pt-4">
                        <div class="flex justify-between font-semibold">
                            <span>Subtotal:</span>
                            <span>ETB <?php echo e(number_format($subtotal, 2)); ?></span>
                        </div>
                        <div class="flex justify-between font-bold text-lg mt-2">
                            <span>Total:</span>
                            <span>ETB <?php echo e(number_format($total, 2)); ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lisan\Herd\Number_one\resources\views/checkout.blade.php ENDPATH**/ ?>