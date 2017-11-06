/*向文档中输出n个空格*/
function writeSpaces(n) {
    for (var i = 0; i < n; i++) {
        document.write("&nbsp;");
    }
}
/*打印预览*/
function preview() {
    bdhtml = window.document.body.innerHTML;
    sprnstr = "<!--startprint-->";
    eprnstr = "<!--endprint-->";
    prnhtml = bdhtml.substr(bdhtml.indexOf(sprnstr) + 17);
    prnhtml = prnhtml.substring(0, prnhtml.indexOf(eprnstr));
    window.document.body.innerHTML = prnhtml;
    window.print();
    window.document.body.innerHTML = bdhtml;
}

/*弹出日期选择页面*/
function seltime(inputName)
{
	window.open('seltime.aspx?InputName='+inputName+'','','width=250,height=220,left=360,top=250,scrollbars=yes');  
}

/*计算电费*/
function CalElectric()
{
    /*获取单价*/
    var price,count,totalPrice;
    price = document.getElementById("Price").value; 
    /*获取数量*/
    count = document.getElementById("Count").value; 
    /*计算总价*/
    totalPrice = price * count; 
    /*显示总价*/
    //document.getElementById("TotalPrice").value = roundFun(totalPrice,2); 
    document.getElementById("TotalPrice").value = fomatFloat(totalPrice,2);
}

/*计算水费*/
function CalWater()
{
    /*获取单价*/
    var price,count,totalPrice;
    price = document.getElementById("Price").value; 
    /*获取数量*/
    count = document.getElementById("Count").value; 
    /*计算总价*/
    totalPrice = price * count; 
    /*显示总价*/
    //document.getElementById("TotalPrice").value = roundFun(totalPrice,2); 
    document.getElementById("TotalPrice").value = fomatFloat(totalPrice,2);
}

/* 四舍五入，保留位数为roundDigit*/
function   roundFun(numberRound,roundDigit)  
{
  if   (numberRound>=0)  
  {
    var   tempNumber   =   parseInt((numberRound   *   Math.pow(10,roundDigit)+0.5))/Math.pow(10,roundDigit);   
    return   tempNumber;   
  }   
  else     
  {   
    numberRound1=-numberRound   
    var   tempNumber   =   parseInt((numberRound1   *   Math.pow(10,roundDigit)+0.5))/Math.pow(10,roundDigit);   
    return   -tempNumber;   
  }   
}   

/*保留pos位小数*/
function fomatFloat(src,pos){ return Math.round(src*Math.pow(10, pos))/Math.pow(10, pos); } 


