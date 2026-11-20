<?php $__env->startSection('content'); ?>
<h2>Welcome to the POS System</h2>

<h3>Pages</h3>
<ul>
    <li><a href="<?php echo e(route('customers')); ?>">Customer Accounts</a></li>
    <li><a href="<?php echo e(route('users')); ?>">User Accounts</a></li>
    <li><a href="<?php echo e(route('about')); ?>">About</a></li>
</ul>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel\TFA7\resources\views/pages/landing.blade.php ENDPATH**/ ?>