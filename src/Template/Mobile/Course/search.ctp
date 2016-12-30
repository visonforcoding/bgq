<div class="wraper">
    <div class='h-news-search'>
        <a href='javascript:void(0);' class='iconfont news-serch'>&#xe618;</a>
        <form id="searchForm">
            <h1><input type="text" name="keyword" placeholder="标题、描述、姓名、公司、头衔" value="<?= $keyword ?>"></h1>
        </form>
        <div class='h-regiser' id="doSearch">搜 索</div>
    </div>
    <div class="train-items-box bgff">
        <div class="con">
            <ul class="outerblock" id="course">
            </ul>
        </div>
    </div>
    <div id="buttonLoading" class="loadingbox"></div>
</div>
<script type="text/html" id="tpl">
    <li class="con-items">
        <a href="/course/detail/{#id#}">
            <div class="train-items">
                <div class="pic-news">
                    <img src="{#cover#}" class="responseimg"/>
                </div>
                <div class="con-right-info">
                    <h3 class="nav-title line2">{#title#}</h3>
                    <div class="nav-desc line1"><p>{#abstract#}</p></div>
                    <div class="foot flex flex_jusitify">
                        <div class="price color-items">{#fee#}</div>
                        <!--<div class="marks">并购重组</div>-->
                    </div>
                </div>
            </div>
        </a>
    </li>
</script>
<?php $this->start('script'); ?>
<script>
    $('input[name="keyword"]').focus();
    var page = 2;
    setTimeout(function () {
        $(window).on("scroll", function () {
            $.util.listScroll('items', function () {
                if (page === 9999) {
                    $('#buttonLoading').html('亲，没有更多搜索结果了');
                    return;
                }
                $.util.showLoading('buttonLoading');
                $.ajax({
                    type: 'post',
                    url: '/course/get-search-res/' + page,
                    data: $('#searchForm').serialize(),
                    dataType: 'json',
                    success: function (msg) {
                        console.log('page~~~' + page);
                        $.util.hideLoading('buttonLoading');
                        window.holdLoad = false;  //打开加载锁  可以开始再次加载
                        if (!msg.status) {  //拉不到数据了  到底了
                            page = 9999;
                            return;
                        }
                        if (typeof msg === 'object') {
                            if (msg.status === true) {
                                var html = dealData(res.data);
                                $('#course').append(html);
                                if(msg.data.length < 10){
                                    page = 9999;
                                } else {
                                    page++;
                                }
                            } else {
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
            });
        });
    }, 1000);
    
    $('#searchForm').on('submit', function(){
        search();
        return false;
    });
    
    $('#doSearch').on('tap', function(){
        search();
    });
    
    function search(){
        if(!$('input[name="keyword"]').val) {
            $.util.alert('请输入搜索内容');
            return false;
        }
        $.ajax({
            type: 'post',
            url: '/course/get-search-res/1',
            data: $('#searchForm').serialize(),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    console.log(msg.data);
                    if (msg.status === true) {
                        var html = dealData(msg.data);
                        $('#course').html(html);
                    } else {
                        $.util.hideLoading('buttonLoading');
                        $('#course').html('');
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
        $('input[name="keyword"]').blur();
    }
    
    function dealData(data){
        var html = $.util.dataToTpl('', 'tpl', data, function(d){
            d.fee = d.fee ? d.fee : '免费';
            return d;
        });
        return html;
    }
    
    search();
</script>
<?php $this->end('script');