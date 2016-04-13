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
</script>
<?php $this->end('script'); ?>