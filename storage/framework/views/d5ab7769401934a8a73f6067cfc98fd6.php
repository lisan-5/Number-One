

<?php $__env->startSection('title', 'My Orders'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-semibold mb-6">My Order History</h1>
    <?php if($orders->isEmpty()): ?>
        <p>You have not placed any orders yet.</p>
    <?php else: ?>
        <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-6 py-3">Order #</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Total</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-t">
                    <td class="px-6 py-4">#<?php echo e($order->id); ?></td>
                    <td class="px-6 py-4"><?php echo e($order->created_at->format('M d, Y')); ?></td>
                    <td class="px-6 py-4 capitalize"><?php echo e($order->status); ?></td>
                    <td class="px-6 py-4">ETB <?php echo e(number_format($order->total,2)); ?></td>
                    <td class="px-6 py-4">
                        <a href="<?php echo e(route('orders.show', $order)); ?>" class="text-blue-600 hover:underline">View</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="mt-6">
            <?php echo e($orders->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lisan\Herd\Number_one\resources\views/orders/history.blade.php ENDPATH**/ ?>