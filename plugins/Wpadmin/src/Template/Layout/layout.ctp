<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=templateDefault(getPluginConfig('project.name').'后台管理系统','wpadmin后台管理系统')?></title>
        <!-- zui -->
        <link href="/wpadmin/lib/zui/css/zui.min.css" rel="stylesheet">
        <link href="/wpadmin/lib/datetimepicker/jquery.datetimepicker.css" rel="stylesheet">
        <link href="/wpadmin/css/base.css" rel="stylesheet">
        <?= $this->fetch('static') ?>
    </head>
    <body>
        <!-- header -->
        <header>
            <nav class="navbar navbar-inverse " role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <?=  templateDefault(getPluginConfig('project.name'),'wpadmin')?>后台管理系统
                    </a>
                </div>
                <div class="collapse navbar-collapse navbar-collapse-example">
                    <ul class="nav navbar-nav navbar-avatar navbar-right">
                        <li>
                            <a href="/shop/order/orderList" class="header-tooltip"  style="margin-top:8px;" data-toggle="tooltip"
                               data-placement="bottom" data-container="body" title="" data-original-title= "4条未处理订单">
                                <i style="font-size: 25px;" class="icon-shopping-cart icon-xlarge text-default"></i>
                                <b style="display: block;" class="badge badge-notes bg-default count-n">4</b>
                            </a>
                        </li>
                        <li>
                            <a href="/shop/user/message" class="header-tooltip" style="margin-top:8px;" data-toggle="tooltip"
                               data-placement="bottom" data-container="body" title="" data-original-title= "2条未读信息">
                                <i  style="font-size: 25px;" class="icon-comment-alt icon-xlarge text-default"></i>
                                <b style="display: block;" class="badge badge-notes bg-danger count-n">2</b>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?=$this->request->session()->read('User.admin.username');?>
                                <span class="thumb-small avatar inline">
                                    <img src="/wpadmin/img/avatar/avatar.jpg" alt="Mika Sokeil" class="img-circle">
                                </span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a>修改个人信息</a></li>
                                <li class="divider"></li>
                                <li><a href="/wpadmin/admin/logout"><i class="icon icon-off"></i> 注销</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </header>
        <div id="left-bar" style="width: 200px">
           <?=$this->cell('Wpadmin.menu')?>
        </div>
        <div id="main-content">
            <div id="breadcrumb">
                <?=$this->cell('Wpadmin.menu::bread')?>
            </div>
            <div id="page-content">
                <div class="page-header" >
                    <?=$this->cell('Wpadmin.menu::title')?>
                </div>
                <div class="page-main" style="margin-top: 10px;">
                    <?php if(isset($NO_PERMISSION)): ?>
                    <?= $this->Flash->render('acl') ?>
                    <?php else:?>
                    <?= $this->fetch('content') ?>
                    <?php endif;?>
                </div>
            </div>
        </div>

        <!-- 在此处挥洒你的创意 -->
        <!-- jQuery (ZUI中的Javascript组件依赖于jQuery) -->
        <script src="/wpadmin/js/jquery.js"></script>
        <!-- ZUI Javascript组件 -->
        <script src="/wpadmin/lib/zui/js/zui.min.plus.js"></script>
        <script src="/wpadmin/lib/datetimepicker/jquery.datetimepicker.js"></script>
        <script src="/wpadmin/lib/layer/layer.js"></script>
        <script src="/wpadmin/js/global.js"></script>
        <script>
            $(function () {
                $('#left-bar').add('#main-content').height($(window).height() - $('header').height());
                $('.header-tooltip').tooltip();
                $('#left-menu ul.nav-primary ul.nav li.active').parents('li').addClass('active show');
                $('#switch-left-bar').on('click',function(){
                    $('#left-bar').toggleClass('hide');
                    var width = 200;
                    if($('#left-bar').hasClass('hide')){
                        width = 0;
                    }
                    console.log($(window).width()-width);
//                    $('#main-content').width($(window).width() - width);
                });
            });
        </script>
        <?= $this->fetch('script') ?>
    </body>
</html>