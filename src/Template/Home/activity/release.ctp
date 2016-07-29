<div class="head newshead">
    <h1 class="innerbox">
        <a href="/w/index/index" class="logo"><img src="/pc/img/logo1.png"/></a>
        <a href="#this" class="myhome"><img src="<?= $user->avatar ? $user->avatar : '/mobile/images/touxiang.png' ?>"/></a>
        <a href="#this" class="upload"><img src="/pc/img/upload.png"/></a>
    </h1>
</div>
<div class="containner inner">
    <h4 class="pagetitle">发布活动列表<a href=""  class="active">发布活动</a><a href="submit-news.html">发布资讯</a><a href="submit-job.html">发布招聘</a></h4>
    <ul class="formlist clearfix">
        <li class="slectform">
            <label for="">系列：</label>
            <div>
                <span></span>
                <select name="series_id">
                    <option value="" selected="selected">请选择系列</option>
                    <?php foreach($series as $k=>$v): ?>
                    <option value="<?= $k ?>"><?= $v ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </li>
        <li class="slectform">
            <label for="">行业标签：</label>
            <div>
                <span></span>
                <select name="industry_id">
                    <option value="" selected="selected">请选择行业</option>
                    <?php foreach ($industries as $k=>$v): ?>
                    <option value="<?= $v['id'] ?>"><?= $v['name'] ?></option>
                    <?php endforeach; ?>
                </select>

            </div>
        </li>
        <li class="inputform">
            <label for="company">主办单位：</label>
            <div><input type="text" name="company" id="company" value="" placeholder="请输入主办单位" /></div>
        </li>
        <li class="inputform">
            <label for="scale">规模：</label>
            <div>
                <input type="text" name="scale" id="scale" value="" placeholder="请输入大概人数" />
            </div>
        </li>

    </ul>
    <ul class="formlist clearfix">
        <li class="s-inputform">
            <label for="title">标题：<em>3-30字</em></label>
            <div class="change-wd"><input type="text" name='title' id="title" placeholder="请输入标题" /></div>
        </li>
        <li class="inputform">
            <label for="time">活动时间：<em>3.21-4.20</em></label>
            <div><input type="text" name="time" id="time" placeholder="请输入活动时间" /></div>
        </li>

    </ul>
    <ul class="formlist clearfix">
        <li class="s-inputform">
            <label for="summary">活动介绍：<em>3-30字</em></label>
            <div class="change-wd"><input type="text" name='summary' id="summary" placeholder="请输入标题" /></div>
        </li>
        <li class="inputform">
            <label for="address">主办地点：</label>
            <div><input type="text" name='address' id="address" placeholder="原作者" /></div>
        </li>

    </ul>
    <ul class="formlist clearfix">
        <li class="inputform">
            <label for="">活动流程：<em>10-80字</em> </label>
            <div><input type="text"  placeholder="请选择时间" /><input type="text"  placeholder="请选择时间" /></div>
            <div class="mt10"><input type="text"  placeholder="输入内容" /><a href="#this">添加</a><a href="#this">取消</a></div>
        </li>
        <li class="inputform">
            <label for="">已创建流程<i class="colore01">2</i>个：</label>
            <div class="change-wd">
                <textarea name="" rows="" cols=""></textarea>
                <div class="choosemark"><a href="">互联网</a><a href="">IT</a></div>
            </div>
        </li>
    </ul>
    <div class="editcon">
        <h3>文章正文：<em>在这里填写详细的文章内容分享给大家</em></h3>
        <div class="editbtn">
            <img src="/pc/img/edit.jpg"/>
        </div>
        <h2>点击发布后,其它用户方可看到您的内容!<a href="javascript:void(0);">提  交</a></h2>
    </div>
</div>
<!--footer-->
<div class="footer">
    <div class="innerbox">
        <img src="/pc/img/flogo.png" alt="" />
        <p>Powered by © 2008-2016 chinama.club</p>
    </div>
</div>
