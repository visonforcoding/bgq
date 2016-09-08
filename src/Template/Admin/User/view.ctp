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
                            <div class="col-md-3">
                                <i><?= count($user->focus) ?></i>
                                <span>关注</span>
                            </div>
                            <div class="col-md-3">
                                <i><?= count($user->followers) ?></i>
                                <span>粉丝</span>
                            </div>
                            <div class="col-md-3">
                                <i><?= $newscom_count + $activitycom_count ?></i>
                                <span>评论</span>
                            </div>
                            <div class="col-md-3">
                                <i><?= $user->money ?></i>
                                <span>余额</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='container inner'>
            <div class='row mt20 bx'>
                <h6 class='row-title before-themeprimary no-margin-top'>工作经历</h6>
                <div class="row  p30">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>开始时间</th>
                                <th>结束时间</th>
                                <th>公司</th>
                                <th>职位</th>
                                <th>描述</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user->careers as $career): ?>
                                <tr>
                                    <td><?= $career->start_date ?></td>
                                    <td><?= $career->end_date ?></td>
                                    <td><?= $career->company ?></td>
                                    <td><?= $career->position ?></td>
                                    <td><?= $career->descb ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>   
            </div>
        </div>
        <div class='container inner'>
            <div class='row mt20 bx'>
                <h6 class='row-title before-themeprimary no-margin-top'>教育经历</h6>
                <div class="row  p30">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>开始时间</th>
                                <th>结束时间</th>
                                <th>学校</th>
                                <th>专业</th>
                                <th>学历</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $educationConf = \Cake\Core\Configure::read('educationType'); ?>
                            <?php foreach ($user->educations as $education): ?>
                                <tr>
                                    <td><?= $education->start_date ?></td>
                                    <td><?= $education->end_date ?></td>
                                    <td><?= $education->school ?></td>
                                    <td><?= $education->major ?></td>
                                    <td><?= $educationConf[$education->education] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>   
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
    </body>
</html>
