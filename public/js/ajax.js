var XMLHttpReq;
//创建XMLHttpRequest对象     
function createXMLHttpRequest() {
    if (window.XMLHttpRequest) { //Mozilla 浏览器
        XMLHttpReq = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) { // IE浏览器
        try {
            XMLHttpReq = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                XMLHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) { }
        }
    }
}

/*处理图书类别信息返回的函数*/
function processBookClassResponse() {
    if (XMLHttpReq.readyState == 4) { // 判断对象状态
        if (XMLHttpReq.status == 200) { // 信息已经成功返回，开始处理信息
            DisplayBookClassInfo();
            //setTimeout("sendRequest()", 1000);
        } else { //页面不正常
            alert(XMLHttpReq.status);
            window.alert("您所请求的页面有异常。");
        }
    }
} 
/*显示修改后的图书类别信息*/
function DisplayBookClassInfo() { 
    /*使用JSON数据格式*/  
    var bookClass = eval('(' + XMLHttpReq.responseText + ')');  
    var bookClassId = bookClass["bookClassId"];
    var bookClassName = bookClass["bookClassName"]; 
    document.getElementById("bookClassId_" + current_index).innerHTML = bookClassId;
    document.getElementById("bookClassName_" + current_index).innerHTML = bookClassName; 
}  
/*通过ajax获取图书类别信息*/
function Ajax_GetBookClass() { 
    createXMLHttpRequest();
    /*为了避免浏览器读取缓存数据，加一个时间戳*/
    var timestamp = (new Date()).getTime();
    var url = "/BookClass/GetBookClass.php?bookClassId=" + encodeURI(current_index) + "&timestamp=" + timestamp;
    
    XMLHttpReq.open("GET", url, true);
    XMLHttpReq.onreadystatechange = processBookClassResponse; //指定响应函数
    XMLHttpReq.send(null);  // 发送请求 
}


/*处理图书信息返回的函数*/
function processBookResponse() {
    if (XMLHttpReq.readyState == 4) { // 判断对象状态
        if (XMLHttpReq.status == 200) { // 信息已经成功返回，开始处理信息
            DisplayBookInfo();
            //setTimeout("sendRequest()", 1000);
        } else { //页面不正常
            alert(XMLHttpReq.status);
            window.alert("您所请求的页面有异常。");
        }
    }
} 
/*显示修改后的图书信息*/
function DisplayBookInfo() { 
    /*使用JSON数据格式*/  
	 
    var book = eval('(' + XMLHttpReq.responseText + ')');
    var barcode = book["barcode"];
    var bookName = book["bookName"];
    var bookType = book["bookType"];
    var price = book["price"];
    var count = book["count"];
    var publish = book["publish"];
    var publishDate = book["publishDate"];
    var photo = book["photo"];
    
    document.getElementById("barcode_" + current_index).innerHTML = barcode;
    document.getElementById("bookName_" + current_index).innerHTML = bookName; 
    document.getElementById("bookType_" + current_index).innerHTML = bookType; 
    document.getElementById("price_" + current_index).innerHTML = price; 
    document.getElementById("count_" + current_index).innerHTML = count; 
    document.getElementById("publish_" + current_index).innerHTML = publish; 
    document.getElementById("publishDate_" + current_index).innerHTML = publishDate; 
    document.getElementById("photo_" + current_index).innerHTML = "<img width='50px' height='50px' src=\"" + photo + "\" />"; 
    
}  
/*通过ajax获取图书信息*/
function Ajax_GetBook() { 
    createXMLHttpRequest();
    /*为了避免浏览器读取缓存数据，加一个时间戳*/
    var timestamp = (new Date()).getTime();
    var url = "../Book/GetBook.php?barcode=" + encodeURI(current_index) + "&timestamp=" + timestamp;
     
    XMLHttpReq.open("GET", url, true);
    XMLHttpReq.onreadystatechange = processBookResponse; //指定响应函数
    XMLHttpReq.send(null);  // 发送请求 
}

