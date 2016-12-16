<div class="wraper bgff">
    <div class="train-entroll-type">
        <div class="flex flex_center entroll-box">
            <div class="aligncenter">
                <i class="iconfont ico-tips">&#xe6a9;</i>
                <p>你已完成充值并报名成功</p>
            </div>
        </div>
        <div class="train-btn-group flex flex_center mt20">
            <a href="/course/detail/<?= $course_id ?>" class="btn-active">查看课程</a>
            <a href="/course/index" class="btn-common">返回首页</a>
        </div>
        <div class="more-train">
            <h3 class="nav-title aligncenter">更多课程</h3>
            <ul class="list-line inner">
                <?php foreach ($course as $k=>$v): ?>
                <li>
                    <a href="/course/detail/<?= $v->id ?>" class="eleblock">
                        <div class="train-news">
                            <img src="<?= $v->avatar ?>" class="responseimg" />
                        </div>
                        <h3 class="title"><?= $v->title ?></h3>
                        <span class="color-items"><?= $v->fee ? '￥'.$v->fee : '免费' ?></span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>