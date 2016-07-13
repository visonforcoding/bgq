<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <title>查看个人信息</title>
        <link rel="stylesheet" href="/wpadmin/lib/zui/css/zui.min.css" />
        <link rel="stylesheet" href="/wpadmin/css/profile.css" />

    </head>
    <body>
        <div class='container inner'>
            <div class='row'>
                <div class='bx t-info  mt20'>
                    <div class='col-md-12 profile-header row'>
                        <div class='text-center fl profile-info'>
                            <img src="<?= $user->avatar ?>" alt="" class='header-pic'/>
                        </div>
                        <div class='profile-info fl'>
                            <div class="header-fullname"><?= $user->truename ?></div>
                            <div class="header-information"><?= $user->company ?> <?= $user->position ?></div>
                        </div>
                    </div>
                    <div class='col-md-12 row mt20'>
                        <div class='numlist'>
                            <div>
                                <i><?= count($user->focus) ?></i>
                                <span>关注</span>
                            </div>
                            <div>
                                <i><?= count($user->followers) ?></i>
                                <span>粉丝</span>
                            </div>
                            <div>
                                <i><?= $newscom_count + $activitycom_count ?></i>
                                <span>评论</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class='container inner'>
            <div class='row mt20'>
                <table class="table table-bordered bx text-center">
                    <tr class="active"><td>手机号</td><td>报名人数</td><td>报名人数</td><td>报名人数</td></tr>
                    <tr><td><?=$user->phone?></td><td>报名人数</td><td>报名人数</td><td>报名人数</td></tr>
                    <tr class="warning"><td>报名人数</td><td>报名人数</td><td>报名人数</td><td>报名人数</td></tr>
                    <tr><td>报名人数</td><td>报名人数</td><td>报名人数</td><td>报名人数</td></tr>
                    <tr class="info"><td>报名人数</td><td>报名人数</td><td>报名人数</td><td>报名人数</td></tr>
                </table>

            </div>
        </div>
        <div class='container inner'>
            <div class='row mt20 bx'>
                <h6 class='row-title before-themeprimary no-margin-top'>关注</h6>
                <div class="row  p30">
                    <?php foreach ($user->focus as $item): ?>
                        <div class="col-sm-2 col-md-2">
                            <div class="thumbnail">
                                <img src="<?= $item->following->avatar ?>" alt="头像找不到了" class='header-pi'/>
                                <div class="caption">
                                    <h5><?= $item->following->truename ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>   
            </div>
        </div>
        <div class='container inner'>
            <div class='row mt20 bx'>
                <h6 class='row-title before-themeprimary no-margin-top'>粉丝</h6>
                <div class="row  p30">
                    <?php foreach ($user->followers as $follower): ?>
                        <div class="col-sm-2 col-md-2">
                            <div class="thumbnail">
                                <img src="<?= $follower->user->avatar ?>" alt="头像找不到了" class='header-pi'/>
                                <div class="caption">
                                    <h5><?= $follower->user->truename ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
        <div class='container inner'>
            <div class='row mt20  bx'>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">已报名活动</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr><td>活动名称</td><td>付款</td><td>确认</td><td>备注</td></tr>
                            <tr><td>22</td><td>222</td><td>22</td><td>222</td></tr>
                            <tr><td>22</td><td>222</td><td>22</td><td>222</td></tr>
                            <tr><td>22</td><td>222</td><td>22</td><td>222</td></tr>
                            <tr><td>22</td><td>222</td><td>22</td><td>222</td></tr>
                            <tr><td>22</td><td>222</td><td>22</td><td>222</td></tr>
                        </table>
                    </div>
                    <div class="panel-footer">*注意。。。。</div>
                </div>
            </div>
        </div>
    </body>
</html>
