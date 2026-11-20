<?php $__env->startSection('content'); ?>
<h2>Customer Accounts</h2>
<p><a href="<?php echo e(route('customers.create')); ?>">Create Customer</a></p>

<table>
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($customer['full_name']); ?></td>
                <td><?php echo e($customer['email']); ?></td>
                <td><?php echo e($customer['phone']); ?></td>
                <td><a href="<?php echo e(route('customers.edit', $customer)); ?>">Edit</a></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel\TFA7\resources\views/customers/index.blade.php ENDPATH**/ ?>