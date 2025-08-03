

<?php $__env->startSection('title', 'Shopping Cart'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mx-auto py-10">
        <?php if(session('success')): ?>
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                 class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg transition-opacity duration-500">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline"> <?php echo e(session('success')); ?> </span>
            </div>
        <?php endif; ?>

        <h1 class="text-3xl font-semibold mb-6">Shopping Cart</h1>

        <!-- Cart Items -->
        <div class="overflow-x-auto bg-white shadow rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4 text-green-800 border-b pb-2">Shopping Cart</h2>
            <?php if($items->isEmpty()): ?>
                <p class="text-center text-gray-600">Your cart is empty. Add some products to get started.</p>
            <?php else: ?>
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-green-50 text-green-800 uppercase text-sm">
                            <th class="px-6 py-3">Product</th>
                            <th class="px-6 py-3">Quantity</th>
                            <th class="px-6 py-3">Price</th>
                            <th class="px-6 py-3">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium"><?php echo e($item->shoe->name); ?></td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <form action="<?php echo e(route('cart.remove')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="shoe_id" value="<?php echo e($item->shoe->id); ?>">
                                            <button type="submit" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">-</button>
                                        </form>
                                        <span><?php echo e($item->quantity); ?></span>
                                        <form action="<?php echo e(route('cart.add')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="shoe_id" value="<?php echo e($item->shoe->id); ?>">
                                            <button type="submit" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">+</button>
                                        </form>
                                    </div>
                                </td>
                                <td class="px-6 py-4">ETB <?php echo e(number_format($item->shoe->price, 2)); ?></td>
                                <td class="px-6 py-4">ETB <?php echo e(number_format($item->total, 2)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div><!-- Products will appear here when added --></div>

            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>ETB <?php echo e(number_format($subtotal, 2)); ?></span>
                    </div>
                    <div class="flex justify-between font-semibold text-lg">
                        <span>Total</span>
                        <span>ETB <?php echo e(number_format($total, 2)); ?></span>
                    </div>
                </div>
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="w-full mt-6 block bg-blue-600 text-white py-2 rounded-md text-center">Proceed to Checkout</a>
                <?php else: ?>
                    <a href="<?php echo e(route('checkout.create')); ?>" class="w-full mt-6 block bg-blue-600 text-white py-2 rounded-md text-center">Proceed to Checkout</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-8 p-6 bg-gray-100 rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Need Help? Contact Me</h2>
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <span class="text-xl">📱</span>
                    <span>Telegram: <a href="https://t.me/Numberonebrandfashion" class="text-blue-600 hover:underline">@Numberonebrandfashion</a></span>
                </div>
                
            </div>
            <p class="mt-4 text-gray-600">Feel free to reach out for any questions about your order or our products!</p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lisan\Herd\Number_one\resources\views/cart.blade.php ENDPATH**/ ?>