var meet = function(){
    var opt={

    };

    $.extend(this, opt);
}

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
        if(em.id.indexOf('sort_') != -1){
            var id = $(em).attr('sort');
            $.ajax({
                type: 'post',
                url: '/meet/getIndex',
                data: {'industry_id':id},
                dataType: 'json',
                success: function (msg) {
                    console.log(msg);
                    if (typeof msg === 'object') {
                        if (msg.status === true) {
                            $.util.dataToTpl('biggie', 'biggie_tpl', msg.data , function (d) {
                                d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
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
        }
        switch(em.id){
            case 'imageViewer': case 'fullImg':
                //do();
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