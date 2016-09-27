<footer class="footer" id="footer" style="display: none">
    <ul class="navfooter clearfix">
        <li>
            <a href="/news/index" class="news_icon"><span class="iconfont">&#xe69f;</span>资讯</a>
        </li>
        <li>
            <a href="/activity/index" class="activity_icon"><span class="iconfont">&#xe69d;</span>活动</a>
        </li>
        <li>
            <a href="/meet/index" class="meet_icon"><span class="iconfont">&#xe6a0;</span>约见</a>
        </li>
        <li>
            <a href="/home/index" class="home_icon"><span class="iconfont">&#xe69e;</span>我</a>
        </li>
    </ul>
</footer>
<script>

    if(!/smartlemon/.test(navigator.userAgent.toLowerCase())) {
        if (window.location.href.indexOf('activity') != -1) {
            $('.activity_icon').css({color: '#b71c2d'});
            $('.activity_icon span').html('&#xe693;').css({color: '#b71c2d'});
        }
        else if (window.location.href.indexOf('meet') != -1) {
            $('.meet_icon').css({color: '#b71c2d'});
            $('.meet_icon span').html('&#xe6a2;').css({color: '#b71c2d'});
        }
        else if (window.location.href.indexOf('home') != -1) {
            $('.home_icon').css({color: '#b71c2d'});
            $('.home_icon span').html('&#xe6a1;').css({color: '#b71c2d'});
        }
        else {
            $('.news_icon').css({color: '#b71c2d'});
            $('.news_icon span').html('&#xe6a3;').css({color: '#b71c2d'});
        }
        if (window.location.href.indexOf('index') != -1) {
            $('.toback').hide();
        }
    }
</script>