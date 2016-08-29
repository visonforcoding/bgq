
<div class="head newshead">
    <h1 class="innerbox">
        <a href="/w/index/index" class="logo"><img src="/pc/img/logo1.png"/></a>
        <a href="#this" class="myhome"><img src="<?= $user->avatar ? $user->avatar : '/mobile/images/touxiang.png' ?>"/></a>
        <a href="#this" class="upload"><img src="/pc/img/upload.png"/></a>
    </h1>
</div>
<div class="containner inner">
    <h4 class="pagetitle">发布活动列表<a href="javascript:void(0)" class="active">发布活动</a><a href="submit-news.html">发布资讯</a><a href="submit-job.html">发布招聘</a></h4>
    <?= $this->Form->create($activity) ?>
    <ul class="formlist clearfix">
<!--        <li class="slectform">
            <label for="series_id">系列：</label>
            <div>
                <span></span>
                <select name="series_id">
                    <option value="" selected="selected">请选择系列</option>
                    <?php foreach($series as $k=>$v): ?>
                    <option value="<?= $k ?>"><?= $v ?></option>
                    <?php endforeach; ?>
                </select>
                <?php echo $this->Form->input('series_id', ['label'=>false, 'type'=>'select']) ?>
            </div>
        </li>-->
<!--        <li class="slectform">
            <label for="">行业标签：</label>
            <div>
                <span></span>
                <select name="industry_id">
                    <option value="" selected="selected">请选择行业</option>
                    <?php foreach ($industries as $k=>$v): ?>
                    <option value="<?= $v['id'] ?>"><?= $v['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <?php echo $this->Form->input('indestries', ['label'=>false, 'type'=>'select']) ?>
            </div>
        </li>-->
        <li class="inputform">
            <label for="company">主办单位：</label>
            <div>
                <!--<input type="text" name="company" id="company" value="" placeholder="请输入主办单位" />-->
                <?php echo $this->Form->input('company', ['label'=>false, 'placeholder'=>'请输入主办单位']) ?>
            </div>
        </li>
        <li class="inputform">
            <label for="scale">规模：</label>
            <div>
                <!--<input type="number" name="scale" id="scale" value="" placeholder="请输入大概人数" />-->
                <?php echo $this->Form->input('scale', ['label'=>false, 'placeholder'=>'请输入大概人数']) ?>
            </div>
        </li>

    </ul>
    <ul class="formlist clearfix">
        <li class="s-inputform">
            <label for="title">标题：<em>50字以下</em></label>
            <div class="change-wd">
                <!--<input type="text" name='title' id="title" placeholder="请输入标题" />-->
                <?php echo $this->Form->input('title', ['label'=>false, 'placeholder'=>'请输入标题']) ?>
            </div>
        </li>
        <li class="inputform">
            <label for="time">活动时间：</label>
            <div>
                <!--<input type="date" name="time" id="time" placeholder="请输入活动时间" />-->
                <?php echo $this->Form->input('time', ['label'=>false, 'type'=>'text', 'placeholder'=>'请输入活动时间', 'class'=>'datepicker']) ?>
            </div>
        </li>

    </ul>
    <ul class="formlist clearfix">
        <li class="s-inputform">
            <label for="summary">活动摘要：</label>
            <div class="change-wd">
                <!--<input type="text" name='summary' id="summary" placeholder="请输入标题" />-->
                <?php echo $this->Form->input('summary', ['label'=>false, 'placeholder'=>'请输入活动摘要']) ?>
            </div>
        </li>
        <li class="inputform">
            <label for="address">主办地点：</label>
            <div>
                <!--<input type="text" name='address' id="address" placeholder="原作者" />-->
                <?php echo $this->Form->input('address', ['label'=>false, 'placeholder'=>'请输入主办地点']) ?>
            </div>
        </li>

    </ul>
    <div class="editcon">
        <h3>活动需求：<em>在这里填写详细的活动需求</em></h3>
        <div class="editbtn">
            <textarea name='body' id='content' ></textarea>
        </div>
        <h2>点击提交后,我们将在三个工作日之内处理您的申请！<a href="javascript:void(0);" id="submit">提  交</a></h2>
    </div>
</div>
<!--footer-->
<div class="footer">
    <div class="innerbox">
        <img src="/pc/img/flogo.png" alt="" />
        <p>Powered by © 2008-2016 chinama.club</p>
    </div>
</div>
<?php $this->start('script'); ?>
<script>
    $('#time').datetimepicker({
        lang: 'ch',
        format:"Y-m-d",
        timepicker:false
    });
    
    $('#submit').click(function(){
        if($('#title').val() == ''){
            layer.alert('请输入标题');
            return false;
        }
        if($('#summary').val() == ''){
            layer.alert('请输入摘要');
            return false;
        }
        if($('#body').val() == ''){
            layer.alert('请输入详细需求');
            return false;
        }
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "",
            data: $('form').serialize(),
            success: function (res) {
                layer.alert(res.msg);
            }
        });
    });
</script>
<?php $this->end('script');
