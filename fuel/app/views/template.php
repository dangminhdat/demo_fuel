<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <?php echo Asset::css('bootstrap.css'); ?>
    <?php echo Asset::js('jquery-3.2.1.min.js'); ?>
    <?php echo Asset::js('ajax.js'); ?>
    <style>
        body { margin: 40px; }
    </style>
</head>
<body>
<div class="container">
    <div class="col-md-12">
        <h1><?php echo $title; ?></h1>
        <hr>
        <?php if (Session::get_flash('success')): ?>
            <div class="alert alert-success">
                <strong>Success</strong>
                <p>
                    <?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
                </p>
            </div>
        <?php endif; ?>
        <div class="alert alert-danger" id="error" style="display: none">
            <strong>Error</strong>
            <p>
                <?php echo Session::get_flash('error'); ?>
            </p>
        </div>
    </div>
    <div class="col-md-12">
        <?php echo $content; ?>
    </div>
    <footer>
        <p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>
        <p>
            <a href="http://fuelphp.com">FuelPHP</a> is released under the MIT license.<br>
            <small>Version: <?php echo e(Fuel::VERSION); ?></small>
        </p>
    </footer>
</div>
</body>
</html>
