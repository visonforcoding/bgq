<footer class="footer" id="footer" style="display: none">
    <ul class="navfooter clearfix">
        <li>
            <a href="/news/index" class="news_icon"><span class="iconfont">&#xe609;</span>资讯</a>
        </li>
        <li>
            <a href="/activity/index" class="activity_icon"><span class="iconfont">&#xe601;</span>活动</a>
        </li>
        <li>
            <a href="/meet/index" class="meet_icon"><span class="iconfont">&#xe60b;</span>约见</a>
        </li>
        <li>
            <a href="/home/index" class="home_icon"><span class="iconfont">&#xe60d;</span>我</a>
        </li>
    </ul>
</footer>
<script>

    if(!/smartlemon/.test(navigator.userAgent.toLowerCase())) {
        if (window.location.href.indexOf('activity') != -1) {
            $('.activity_icon').css({color: '#dd204b'});
            $('.activity_icon span').css({color: '#dd204b'});
        }
        else if (window.location.href.indexOf('meet') != -1) {
            $('.meet_icon').css({color: '#dd204b'});
            $('.meet_icon span').css({color: '#dd204b'});
        }
        else if (window.location.href.indexOf('home') != -1) {
            $('.home_icon').css({color: '#dd204b'});
            $('.home_icon span').css({color: '#dd204b'});
        }
        else {
            $('.news_icon').css({color: '#dd204b'});
            $('.news_icon span').css({color: '#dd204b'});
        }
        if (window.location.href.indexOf('index') != -1) {
            $('.toback').hide();
        }
    }
</script>