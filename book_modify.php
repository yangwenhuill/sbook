<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>享书伴侣后台管理系统</title>
	<?php include("conn/conn.php") ?>
	<style>
		*{
			margin: 0;
			padding: 0;
		}
		a{
			text-decoration: none;
			color: #0f88eb;
		}
		body{
			font-family: "微软雅黑";
		}
		.header{
			height: 100px;
			background: #fff;
			border-bottom: 3px solid #e4e4e4;
		}
		.header .left{
			float: left;
		}
		.header .logo{
			width: 300px;
			height: 58px;
			background: url("image/book.png")no-repeat top center ;
		}
		.header h3{
			width: 300px;
			line-height: 40px;
			text-align: center;
		}
		.user{
			width: 115px;
			line-height: 28px;
			float: left;
			margin-left: 32px;
			margin-top: 8px;
			color: #0f88eb;
		}
		.line{
			list-style: none;
			float: right;
			width: 102px;
			font-size: 13px;
			text-align: center;
			line-height: 40px;
			margin-top: 58px;
		}
		.line img{
			width: 20px;
			text-align: center;
			position: relative;
			top: 4px;
		}
		.content .articletop{
			line-height: 30px;
			background: skyblue;
			text-indent: 2em;
		}
		.content .articlebottom{
            width: 560px;
            height: 373px;
            margin: 0 auto;
            margin-top: -30px;
        }
        .content .articlebottom .line{
            width: 560px;
            height: 0;
        }
        .content .articlebottom .line span{
            float: left;
            height: 28px;
            width: 125px;
            font-size: 14px;
            line-height: 28px;
            text-align: right;
        }
        .content .articlebottom .line .star{
            color: red;
            width: 0;
        }
        .content .articlebottom .line div{
            float: right;
            height: 28px;
            width: 434px;
        }
        .content .articlebottom .line .special{
			width: 200px;
			position: relative;
            left: -86px;
        }
        .content .articlebottom .line input{
            width: 370px;
            height: 24px;
            position: relative;
            top: -7px;
        }
        .content .articlebottom .line select{
            width: 230px;
            height: 28px;
            position: relative;
            top: -7px;
            left: -73px;
        }
	    .content .articlebottom input[type=submit]{
            width: 60px;
            height: 25px;
            font-size: 16px;
            margin: 0 auto;
            background: #0f88eb;
            color: #fff;
			border: none;
			border-radius: 3px;
			margin-left: -60px;
        }
		.content .articlebottom input[type=button]{
            width: 60px;
            height: 25px;
            font-size: 16px;
            background: #0f88eb;
            margin-left: 65px;
            color: #fff;
			border: none;
			border-radius: 3px;
        }
	</style>
</head>
	<script language="javascript">
		function check(form){
			if(form.isbn.value==""){
				alert("请输入条形码!");form.barcode.focus();return false;
			}
			if(form.bookName.value==""){
				alert("请输入图书姓名!");form.bookName.focus();return false;
			}
		    form.submit();
		}
	</script>
<body>
	<div class="header">
		<div class="left">
			<h1 class="logo"></h1>
			<h3 class="subtitle">享书伴侣后台管理系统</h3>
		</div>
		<div class="nav">
			<ul>
				<li class="line" title="注销">
					<img src="image/exit.png" alt="" width="20px">
					<a href="#" target="_self">注销</a>
				</li>
				<li class="line" title="系统设置">
					<img src="image/setting.png" alt="" width="20px">
					<a href="#" target="_self">系统设置</a>
				</li>
				<li class="line" title="图书借还">
					<img src="image/borrow.png" alt="">
					<a href="#" target="_self">图书借还</a>
				</li>
				<li class="line" title="图书档案">
					<img src="image/bookmanage.png" alt="">
					<a href="#" target="_self">图书档案</a>
				</li>
				<li class="line" title="图书管理">
					<img src="image/book1.png" alt="">
					<a href="#" target="_self">图书管理</a>
				</li>
				<li class="line" title="首页">
					<img src="image/homepage.png" alt="" >
					<a href="#" target="_self">首页</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="content">
		<div class="articletop">
			<p>图书档案——修改图书信息</p>
		</div>
		<form name="form1" method="post" action="<?php echo "book_modify_ok.php?id=".$_GET['id']?>">
			<div class="articlebottom">
				<?php 
					include("conn/conn.php");
					$sql=$pdo->query("select book.*,bc.*,ph.*,bs.* from book_info book join book_cate bc on book.cate_id=bc.id join publishing_house ph on book.pub_id=ph.id join book_shelf bs on book.shelf_id=bs.id where book.id=$_GET[id]");
					$info=$sql->fetch(PDO::FETCH_ASSOC);
				 ?>
                <div class="line">
                    <span>ISBN</span><span class="star">*</span>
                    <div>
                        <input name="isbn" type="text" id="barcode" value="<?php echo $info['isbn'];?>">
                    </div>
                </div>
                <div class="line">
                    <span>图书名称</span><span class="star">*</span>
                    <div>
                        <input name="bookName" type="text" id="bookName" value="<?php echo $info['bookName'];?>">
                    </div>
                </div>
				<div class="line">
					<span>图书类型</span>
					<select name="bookCate" id="">
						<option value="<?php echo $info['cate_id'];?>"selected><?php echo $info['cate_name'];?></option>
                        <?php 
				            include("Conn/conn.php");
				    		$sql=$pdo->query("select *from book_cate");
				    		$cateinfos=$sql->fetchAll(PDO::FETCH_ASSOC);
				    		foreach($cateinfos as $cateinfo){
				    			if($cateinfo['id']==$info['cate_id'])
				    				continue;
						?> 		
				        <option value="<?php echo $cateinfo['id'];?>"><?php echo $cateinfo['cate_name'];?></option>
						<?php }?> 
                    </select>
				</div>
                <div class="line">
                    <span>作者</span>
                    <div>
                        <input type="text" class="special" name="author" value="<?php echo $info['author'];?>">
                    </div>
                </div>
                <div class="line">
                    <span>译者</span>
                    <div>
                        <input type="text" class="special" name="translator" value="<?php echo $info['translator'];?>">
                    </div>
                </div>
           		<div class="line">
					<span>出版社</span>					
					<select name="publishingHouse">
						<option value="<?php echo $info['pub_id'];?>"selected><?php echo $info['pub_name'];?></option>
                        <?php 
				            include("Conn/conn.php");
				    		$sql=$pdo->query("select * from publishing_house");
				    		$pubinfos=$sql->fetchAll(PDO::FETCH_ASSOC);
				    		foreach($pubinfos as $pubinfo){
				    			if($pubinfo['id']==$info['pub_id'])
				    				continue;
						?> 		
				        <option value="<?php echo $pubinfo['id'];?>"><?php echo $pubinfo['pub_name'];?></option>
						<?php }?> 
                    </select>
				</div>
				<div class="line">
                    <span>价格（元）</span>
                    <div>
                        <input type="text" class="special" name="price" value="<?php echo $info['price'];?>">
                    </div>
                </div>
                <div class="line">
					<span>书架</span>
					<select name="bookShelf" id="">
						<option value="<?php echo $info['shelf_id'];?>"selected><?php echo $info['shelf_name'];?></option>
                        <?php 
				            include("Conn/conn.php");
				    		$sql=$pdo->query("select * from book_shelf");
				    		$sheinfos=$sql->fetchAll(PDO::FETCH_ASSOC);
				    		foreach($sheinfos as $sheinfo){
				    			if($sheinfo['id']==$info['shelf_id'])
				    				continue;
						?> 		
				        	<option value="<?php echo $sheinfo['id'];?>"><?php echo $sheinfo['shelf_name'];?></option>
						<?php }?> 
                    </select>
				</div>
				<div class="line">
					<input type="submit" value="保存" onClick="return check(form1)">
					<input type="button" value="返回" onClick="history.back();">
				</div>
	        </div>
	    </form>
	</div>
</body>
</html>