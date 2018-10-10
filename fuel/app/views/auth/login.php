<div class="col-xs-6 col-sm-offset-3" style="float: none">
    <?php echo \Fuel\Core\Form::open(array('class' => 'form-horizontal', 'onsubmit' => 'return false;')); ?>
    <h1>Login</h1>
    <div class="form-group">
        <?php echo \Fuel\Core\Form::label('Username', '', array('class' => 'control-label col-xs-2')); ?>
        <div class="col-xs-10">
            <?php echo \Fuel\Core\Form::input('username', $data['username'], array('class' => 'form-control', 'id' => 'username')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo \Fuel\Core\Form::label('Password', '', array('class' => 'control-label col-xs-2')); ?>
        <div class="col-xs-10">
            <?php echo \Fuel\Core\Form::input('password', $data['password'], array('type' => 'password', 'class' => 'form-control', 'id' => 'password')); ?>
        </div>
    </div>
    <div class="form-group text-center">
        <?php echo \Fuel\Core\Form::button('Login', 'Login', array('class' => 'btn btn-primary', 'id' => 'btnLogin')); ?>
    </div>
    <?php echo \Fuel\Core\Form::close(); ?>
</div>