

<?php $__env->startSection('title', 'Order Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-semibold mb-6">Order #<?php echo e($order->id); ?></h1>
    <div class="bg-white shadow rounded-lg p-6">
        <p><strong>Name:</strong> <?php echo e($order->name); ?></p>
        <p><strong>Email:</strong> <?php echo e($order->email); ?></p>
        <p><strong>Phone:</strong> <?php echo e($order->phone); ?></p>
        <p><strong>Size:</strong> <?php echo e($order->size); ?></p>
        <p><strong>Delivery:</strong> <?php echo e($order->delivery ? 'Yes' : 'No'); ?></p>
        <?php if($order->delivery): ?>
            <p><strong>Location:</strong> <?php echo e($order->location); ?></p>
            <p><strong>Instructions:</strong> <?php echo e($order->instructions); ?></p>
        <?php endif; ?>
        <h2 class="text-2xl font-semibold mt-6 mb-4">Items</h2>
        <ul class="list-disc pl-6">
            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($item['name']); ?> x<?php echo e($item['quantity']); ?> — <?php echo e(number_format($item['total'], 2)); ?> ETB</li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <p class="mt-4"><strong>Subtotal:</strong> <?php echo e(number_format($order->subtotal, 2)); ?> ETB</p>
        <p><strong>Total:</strong> <?php echo e(number_format($order->total, 2)); ?> ETB</p>
        <p><strong>Status:</strong>
            <span class="<?php if($order->status === 'completed'): ?> text-green-600 <?php elseif($order->status === 'rejected'): ?> text-red-600 <?php else: ?> text-gray-600 <?php endif; ?>">
                <?php echo e(ucfirst($order->status)); ?>

            </span>
        </p>
    </div>
    <div class="mt-4 space-x-2">
        <form method="POST" action="<?php echo e(route('admin.orders.update', $order)); ?>" class="inline">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <input type="hidden" name="status" value="completed">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md">Mark Completed</button>
        </form>
        <form method="POST" action="<?php echo e(route('admin.orders.update', $order)); ?>" class="inline">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <input type="hidden" name="status" value="rejected">
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">Mark Rejected</button>
        </form>
    </div>
    <div class="mt-6">
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-gray-600 hover:underline">Back to Orders</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lisan\Herd\Number_one\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>