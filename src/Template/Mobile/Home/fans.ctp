<div class="wraper">
    <div class="h20">
    </div>
    <section class="newscomment-box no-t-border" id="users">
        
    </section>
</div>
<script type="text/html" id="usersTpl">
    <div class="entrollist">
        <a href="/user/home-page/{#id#}">
            <div class="comm-info etrol_con_des clearfix">
                <span class='etrol_pic'><img src="{#avatar#}"/></span>
                <div class="infor-comm">
                    <i class="username">{#truename#} </i>
                    <i class="job">{#company#} {#position#}</i>
                </div>
            </div>
        </a>
    </div>
</script>
<?php $this->start('script'); ?>
<script>
    $.util.dataToTpl('users', 'usersTpl', <?= $userjson; ?>, function(d){
        d.id = d.user.id;
        d.avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
        d.truename = d.user.truename;
        d.company = d.user.company;
        d.position = d.user.position;
        return d;
    });
</script>
<?php $this->end('script');
