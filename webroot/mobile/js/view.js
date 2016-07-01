//// 动态计算根元素的font-size的值
//(function (doc, win) {
//	var docEl = doc.documentElement,
//	    resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
//	    recalc = function () {
//	      var clientWidth = docEl.clientWidth;
//	      if (!clientWidth) return;
//	      docEl.style.fontSize = 100 * (clientWidth / 750) + 'px';
//	    };
//
//	  if (!doc.addEventListener) return;
//	  win.addEventListener(resizeEvt, recalc, false);
//	  doc.addEventListener('DOMContentLoaded', recalc, false);
//})(document, window);
(function (win) {
    var h;
    var docEl = document.documentElement;
    function setUnitA() {
        win.rem = docEl.getBoundingClientRect().width / 20;
        docEl.style.fontSize = win.rem + 'px';
    }
    win.addEventListener('resize', function () {
        clearTimeout(h);
        h = setTimeout(setUnitA, 300);
    }, false);
    win.addEventListener('pageshow', function (e) {
        if (e.persisted) {
            clearTimeout(h);
            h = setTimeout(setUnitA, 300);
        }
    }, false);

    setUnitA();
})(window);
