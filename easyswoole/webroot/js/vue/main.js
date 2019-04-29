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