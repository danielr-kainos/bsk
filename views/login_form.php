<?php if (User::getCurrentUser() == null) { ?>
    <?php $uniqid = uniqid(); ?>
    <form id="<?= $uniqid ?>" class="navbar-form navbar-right"
          action="?controller=auth&action=login" method="post">
        <li>
            <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_prefix" name="login" type="text" class="validate">
                <label for="icon_prefix">Login</label>
            </div>
        </li>
        <li>
            <div class="input-field">
                <i class="material-icons prefix">vpn_key</i>
                <input id="icon_prefix" name="password" type="password" class="validate">
                <label for="icon_prefix">Password</label>
            </div>
        </li>
        <li>
            <a href="javascript:document.getElementById('<?= $uniqid ?>').submit();" class="btn">Login</a>
        </li>
    </form>
<?php } else { ?>
    <li><a href="?controller=auth&action=logout" class="btn">Logout</a></li>
<?php } ?>
