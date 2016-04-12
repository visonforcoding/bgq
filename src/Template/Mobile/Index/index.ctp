<ul class="mui-table-view" id="articles-list">
    <li class="mui-table-view-cell mui-collapse" v-for="item in items">
        <a class="mui-navigate-right" href="#">{{item.title}}</a>
        <div class="mui-collapse-content">
            <!-- 第1个面板中的内容 -->
            {{item.body}}
        </div>
    </li>
</ul>
<?php $this->start('script'); ?>
<script>
    var vm = new Vue({
        el: '#articles-list',
        data: {
            items: <?= $articles ?>
        }
    });
    mui(".mui-table-view").on('tap', '.mui-table-view-cell', function () {
        //获取id
        alert('test');
//        var id = this.getAttribute("id");
//        //传值给详情页面，通知加载新数据
//        mui.fire(detail, 'getDetail', {id: id});
//        //打开新闻详情
//        mui.openWindow({
//            id: 'detail',
//            url: 'detail.html'
//        });
    });
</script>
<?php $this->end('script'); ?>