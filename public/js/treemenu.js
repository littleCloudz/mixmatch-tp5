var openImg = new Image();
var closedImg = new Image();

function showBranch(branch) {
    var objBranch = document.getElementById(branch).style;
    if (objBranch.display == "block")
        objBranch.display = "none";
    else
        objBranch.display = "block";
    swapFolder('I' + branch);
}

function swapFolder(img) {
    objImg = document.getElementById(img);
    if (objImg.src.indexOf('closed.gif') > -1)
        objImg.src = openImg.src;
    else
        objImg.src = closedImg.src;
}
function tree() {
    this.branches = new Array();
    this.add = addBranch;
    this.write = writeTree;

    this.GetBranchSize = GetBranchSize;
}

function GetBranchSize() {
    return this.branches.length;
}

function addBranch(branch) {
    this.branches[this.branches.length] = branch;
}

function writeTree() {
    var treeString = '';
    var numBranches = this.branches.length;
    for (var i = 0; i < numBranches; i++)
        treeString += this.branches[i].write();
    document.write(treeString);
}
function branch(id, text) {
    this.id = id;
    this.text = text;
    this.write = writeBranch;
    this.add = addLeaf;
    this.leaves = new Array();
}
function addLeaf(leaf) {
    this.leaves[this.leaves.length] = leaf;
}

function writeBranch() {
    var branchString = '<span  class="branch"' + 'onClick="showBranch(\'' + this.id + '\')"';
    branchString += '><img width=15 height=15 src="images/closed.gif" id="I' + this.id + '" />&nbsp;&nbsp;' + this.text;

    branchString += '</span>';
    branchString += '<span class="leaf" id="';
    branchString += this.id + '">';
    var numLeaves = this.leaves.length;
    for (var j = 0; j < numLeaves; j++) branchString += this.leaves[j].write();
    branchString += '</span>';
    return branchString;
}
function leaf(text, link) {
    this.text = text;
    this.link = link;
    this.write = writeLeaf;
}
function writeLeaf() {
    var leafString = '<img src="images/doc.gif" border="0" />&nbsp;&nbsp;<a onmouseover="ChangeBackColor(this,true)" onmouseout="ChangeBackColor(this,false)" href="' + this.link + '" target="OfficeMain">';
    leafString += this.text;
    leafString += '</a><br/>';
    return leafString;
}

/*此函数用于当用户选择顶部的菜单导航时展开某个菜单*/
function ShowTreeNode(index) {
    var branches_length = myTree.GetBranchSize();
    for (var i = 1; i < branches_length; i++) {
        var objBranch = document.getElementById("branch" + i).style;
        objImg = document.getElementById("Ibranch" + i);
        if (index == i) {
            objBranch.display = "block";
            objImg.src = openImg.src;
        }
        else {
            objBranch.display = "none";
            objImg.src = closedImg.src;
        }
    }
}

/*当鼠标移进或移出某个菜单上面时改变背景颜色*/
function ChangeBackColor(object, flag) {
    if (flag) {
        object.style.backgroundColor = "#FF0000";
        object.style.color = "#30F";
    }
    else {
        object.style.backgroundColor = "";
        object.style.color = "#F0F";
    }
}

var myTree = new tree();

/*向html页面写入菜单导航树*/
function WriteTreeInfo() {
    openImg.src =  "images/open.gif";
    closedImg.src =  "images/closed.gif"; 

    var branches = new Array();
    branches[1] = new branch('branch1', '图书类别管理');
    var branch1_leaf1 = new leaf('图书类别登记',  'BookClass/bookClassAdd.php');
    var branch1_leaf2 = new leaf('图书类别维护',  'controller/BookClassAction.php?action=query');
    branches[1].add(branch1_leaf1);
    branches[1].add(branch1_leaf2);

    branches[2] = new branch('branch2', '图书信息管理');
    var branch2_leaf1 = new leaf('图书信息登记', 'Book/bookAdd.php');
    var branch2_leaf2 = new leaf('图书信息维护', 'controller/BookAction.php?action=query'); 
    branches[2].add(branch2_leaf1);
    branches[2].add(branch2_leaf2); 
 

    branches[3] = new branch('branch3', '系统管理');
    var branch3_leaf1 = new leaf('修改密码', '/changePassword.php'); 
    var branch3_leaf2 = new leaf('系统说明',  'desk.php');
    var branch3_leaf3 = new leaf('关于系统',  'about.html');
    branches[3].add(branch3_leaf1)
    branches[3].add(branch3_leaf2);
    branches[3].add(branch3_leaf3); 

    myTree.add(branches[1]);
    myTree.add(branches[2]);
    myTree.add(branches[3]); 

    myTree.add(new leaf('退出系统',  'logout.php'));

    myTree.write();
}




 