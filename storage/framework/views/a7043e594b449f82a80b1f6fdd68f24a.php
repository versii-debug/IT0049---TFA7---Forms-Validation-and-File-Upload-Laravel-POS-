<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title); ?> | POS System</title>
</head>
<body>
    <header>
        <h1>POS System</h1>
        <nav>
            <a href="<?php echo e(route('home')); ?>">Home</a>
            <a href="<?php echo e(route('about')); ?>">About</a>
            <a href="<?php echo e(route('customers')); ?>">Customers</a>
            <a href="<?php echo e(route('users')); ?>">Users</a>
        </nav>
    </header>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer>
        <p>Basic POS System</p>
    </footer>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Laravel\TFA7\resources\views/layouts/app.blade.php ENDPATH**/ ?>