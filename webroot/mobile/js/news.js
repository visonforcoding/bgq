var news = function(){
    var opt={

    };

    $.extend(this, opt);
}

news.prototype.init = function(){
    this.setDet();
    this.bindEvent();
};

news.prototype.setDet = function(){

};

news.prototype.bindEvent = function(){
    $('body').on('tap', function(e){
        var target = e.srcElement || e.target, em=target, i=1;
        while(em && !em.id && i<=3){ em = em.parentNode; i++;}
        if(!em || !em.id) return;
        if(em.id.indexOf('common_')){
            //todo();
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

(new news()).init();