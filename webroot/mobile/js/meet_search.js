var meet = function(){
    var opt={

    };

    $.extend(this, opt);
};

meet.prototype.init = function(){
    this.setDet();
    this.bindEvent();
};

meet.prototype.setDet = function(){

};

meet.prototype.bindEvent = function(){
    $('body').on('tap', function(e){
        var target = e.srcElement || e.target, em=target, i=1;
        while(em && !em.id && i<=3){ em = em.parentNode; i++;}
        if(!em || !em.id) return;
        if(em.id.indexOf('common_')){
            console.log($(em));
        }
        switch(em.id){
            case 'doSearch':
                if(!$('input[name="keyword"]').val)
                {
                    $.util.alert('请输入搜索内容');
                    return false;
                }
                $.ajax({
                    type: 'post',
                    url: '/meet/getSearchRes',
                    data: $('#searchForm').serialize(),
                    dataType: 'json',
                    success: function (msg) {
                        if (typeof msg === 'object') {
                            console.log(msg.data);
                            if (msg.status === true) {
                                $.util.dataToTpl('biggie', 'biggie_tpl', msg.data , function (d) {
                                    d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
                                    d.city = d.city ? '<div class="l-place"><i class="iconfont">&#xe660;</i>' + d.city + '</div>' : '';
                                    d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
                                    return d;
                                });
                            } else {
                                $('#biggie').html('');
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
                break;
            break;
            case 'blackCover':
                //do();
                break;
            case 'detailClosePC':
                //do();
                break;
            case 'goTop':
                window.scroll(0,0);
                e.preventDefault();
                break;
        }
    });
};

(new meet()).init();