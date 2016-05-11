/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//表单验证
function is_mobile(str) {
    var reg = /^0?1[3|4|5|7|8][0-9]\d{8}$/;
    return reg.test(str);
}

$(function(){
//   $('.toback').on('click',function(){
//       window.history.go(-1);
//   }) ;
});