const kAppKey = 'y8880eas';
const kAppSecret = 'db426a9829e4b49a0dcac7b4162da6b6';

function getData(data) {
    //=>DATA:就是请求主体中需要传递给服务器的内容（对象）
    let str = ``;
    for (let attr in data) {
        if (data.hasOwnProperty(attr)) {
            str += `${attr}=${data[attr]}&`;
        }
    }
    return str.substring(0, str.length - 1);
}

function video(source) {
    var player = new Aliplayer({
        "id": "player-con",
        "source": source,
        "width": "100%",
        "height": "400px",
        "autoplay": true,
        "isLive": false,
        "rePlay": false,
        "playsinline": true,
        "preload": true,
        "controlBarVisibility": "hover",
        "useH5Prism": true
    }, function(player) {
        player._switchLevel = 0;
        console.log("播放器创建了。");
    });
}

/** 
 * 获取指定的URL参数值 
 * URL:http://www.quwan.com/index?name=tyler 
 * 参数：paramName URL参数 
 * 调用方法:getParam("name") 
 * 返回值:tyler 
 */
function getParam(paramName) {
    paramValue = "", isFound = !1;
    if (this.location.search.indexOf("?") == 0 && this.location.search.indexOf("=") > 1) {
        arrSource = unescape(this.location.search).substring(1, this.location.search.length).split("&"), i = 0;
        while (i < arrSource.length && !isFound) arrSource[i].indexOf("=") > 0 && arrSource[i].split("=")[0].toLowerCase() == paramName.toLowerCase() && (paramValue = arrSource[i].split("=")[1], isFound = !0), i++
    }
    return paramValue == "" && (paramValue = null), paramValue
}