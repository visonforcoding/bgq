/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function jsonToTpl(json,tpl){
	return tpl.replace(/{#(\\w+)#}/g,function(a,b){return json[b]===0?'0':(json[b]||\"\");});
}