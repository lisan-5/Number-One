

<?php $__env->startSection('title', 'Orders'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold">Orders</h1>
    </div>
    <?php if(session('success')): ?>
        <div class="mb-4 text-green-600"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <table class="w-full bg-white shadow rounded-lg">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Order #</th>
                <th class="px-4 py-2">Customer</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Total</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="<?php if($order->status === 'completed'): ?> bg-green-100 <?php elseif($order->status === 'rejected'): ?> bg-red-100 <?php endif; ?>">
                <td class="border px-4 py-2"><?php echo e($order->id); ?></td>
                <td class="border px-4 py-2"><?php echo e($order->name); ?></td>
                <td class="border px-4 py-2"><?php echo e($order->email); ?></td>
                <td class="border px-4 py-2"><?php echo e(number_format($order->total, 2)); ?> ETB</td>
                <td class="border px-4 py-2"><?php echo e($order->created_at->format('Y-m-d')); ?></td>
                <td class="border px-4 py-2">
                    <a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="px-2 py-1 bg-blue-600 text-white rounded-md">View</a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6" class="px-4 py-2 text-center text-gray-600">No orders found.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="mt-4">
        <?php echo e($orders->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lisan\Herd\Number_one\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>