<nav class="menu" id="left-menu"  data-toggle="menu" >
    <ul class="nav nav-primary">
        <li><a href="/">
                <i class="icon-home"></i> 主面板<i style="float: right"  class="icon-undo"></i></a></li>
        <?php foreach ($menus as $menu): ?>
            <?php if ($menu['pid'] == '0'): ?>
                <li><a href="#"><i class="<?= $menu['class'] ?>"></i><?= $menu['name'] ?></a>
                    <?php if (isset($menu['children'])): ?>
                        <ul class="nav">
                            <?php foreach ($menu['children'] as $sub_menu): ?>
                                <li <?php if ($url == $sub_menu['node']): ?>class="active"
                                    <?php elseif ($active == $sub_menu['node']): ?>class="active"<?php endif; ?>>
                                    <a href="<?= $sub_menu['node'] ?>"><i class="<?= $sub_menu['class'] ?>">
                                        </i><?= $sub_menu['name'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
        <li>
            <a href=""><i class="icon-tasks"></i> 消息中心
                <span class="label label-badge label-danger pull-right">2</span>
            </a>
        </li>
    </ul>
</nav>