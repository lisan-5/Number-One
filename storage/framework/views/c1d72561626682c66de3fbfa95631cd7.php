

<?php $__env->startSection('title', 'Order Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-semibold mb-6">Order #<?php echo e($order->id); ?></h1>
    <div class="bg-white shadow rounded-lg p-6 divide-y divide-gray-200">
        <div class="pb-4">
            <h2 class="text-xl font-semibold">Customer Details</h2>
            <p>Name: <?php echo e($order->name); ?></p>
            <p>Email: <?php echo e($order->email); ?></p>
            <p>Phone: <?php echo e($order->phone); ?></p>
            <p>Size: <?php echo e($order->size); ?></p>
            <?php if($order->delivery): ?>
                <p>Delivery Address: <?php echo e($order->location); ?></p>
            <?php endif; ?>
+        <div class="py-4">
+            <h2 class="text-xl font-semibold">Items</h2>
+            <ul class="list-disc list-inside">
+                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
+                    <li><?php echo e($item['quantity']); ?>× <?php echo e($item['name']); ?> at ETB <?php echo e(number_format($item['price'],2)); ?> each</li>
+                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
+            </ul>
+        </div>
        <div class="py-4">
            <h2 class="text-xl font-semibold">Totals</h2>
            <p>Subtotal: ETB <?php echo e(number_format($order->subtotal,2)); ?></p>
            <p>Total: ETB <?php echo e(number_format($order->total,2)); ?></p>
            <p>Status: <span class="capitalize"><?php echo e($order->status); ?></span></p>
        </div>
    </div>
    <div class="mt-6">
        <a href="<?php echo e(route('orders.history')); ?>" class="text-blue-600 hover:underline">Back to orders</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lisan\Herd\Number_one\resources\views/orders/show.blade.php ENDPATH**/ ?>