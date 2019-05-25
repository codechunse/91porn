<?php
require_once 'functions.php';

#获取URL
if($_REQUEST["domain"]){
	$domain = urldecode($_REQUEST["domain"]);
}
if($_COOKIE['91url']){
    $domain =$_COOKIE['91url'];
}
if($domain == ''){
    !function_exists('getConfig')?$domain="http://430.dxtx-sordera.org":$domain="http://www.91porn.com";
}
setcookie('91url',$domain);

$page=1;
if($_REQUEST["page"]){
	$page = $_REQUEST["page"];
}
if($_GET['category']){
    setcookie('category',$_GET['category']);
}
$list = getList($domain,$page);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <title>视频列表-91视频预览</title>
        <!--<script type="text/javascript" src="http://tajs.qq.com/stats?sId=37342703" charset="UTF-8"></script>-->
        <link rel="stylesheet" href="frozenui/css/frozen.css">
        <link rel="stylesheet" href="frozenui/css/demo.css">
        <script src="frozenui/lib/zepto.min.js"></script>
        <!--<script src="frozenui/js/frozen.js"></script>-->
    </head>
    <body ontouchstart>
    	<header class="ui-header ui-header-positive ui-border-b">
            <i class="ui-icon-return" onclick="history.back()"></i><h1>视频列表</h1><button onclick="window.location.href='index.php';" class="ui-btn">回首页</button>
        </header>

        <section class="ui-container">
		<section id="panel">
    <div class="demo-item">
        <p class="demo-desc">第<b><?php echo $page?></b>页</p>


        <div class="demo-block">
            <div class="ui-form ui-border-t">
                <form action="#">
                    <div class="ui-form-item ui-border-b">
                        <label>分类</label>
                        <div class="ui-select" style="background-color: #5fb336">
                            <select id="category" name="category">
                                <option value="">全部</option>
                                <option value="rf">精华</option>
                                <option value="hot">当前最热</option>
                                <option value="rp">最近得分</option>
                                <option value="long">10分钟以上 </option>
                                <option value="md">本月讨论</option>
                                <option value="tf">本月收藏</option>
                                <option value="mf">收藏最多</option>
                                <option value="rf">最近加精</option>
                                <option value="top">本月最热</option>
                                <option value="top&m=-1">上月最热</option>
<!--                                <option value="hd">高清</option>-->
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <section class="ui-panel">
                <ul class="ui-grid-trisect">
                	<?php
                	foreach ($list as $key => $value) {  ?>              		
	                    <li data-href="video.php?url=<?php echo urlencode($aes->encryot($value["link"])); ?>">
	                        <div class="ui-border">
	                            <div class="ui-grid-trisect-img">
                                    <img src="<?php echo $value["pic"]?>" onerror="showImgDelay(this,'pic.php?url=<?php echo urlencode($aes->encrypt($value['pic']))?>',1)">
	                            </div>
	                            <div style="padding: 2%;height:250px;">
	                                <h4 class="ui-nowrap-multi" style="height:50px"><?php echo $value["title"]; ?></h4>
                                    <p>  <?php echo trim($value['info']); ?></p>
                                </div>
	                        </div>
	                    </li>
                	<?php }	?>
                    
                </ul>
            </section>
        </div>
    </div>
		</section>
                
		<?php if($page>1){ ?>
			<div><a href="index.php?page=<?php echo $page - 1 ?>" class="ui-btn-lg">上一页</a><br></div>
		<?php } ?>		
		<a href="index.php?page=<?php echo $page + 1 ?>" class="ui-btn-lg ui-btn-primary">下一页</a>
            </div>

		</section>
		<script src="https://cdn.bootcss.com/jquery/2.1.2/jquery.min.js"></script>
        <script src="https://cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
		<script>

        $("[data-href]").click(function(){
        	location.href = ($(this).data('href'));
        });

        $(function(){
            $.cookie("category",$.cookie("category") || "rf");
            $("#category").change(function(){
                $.cookie("category",$(this).val());
                location.reload();
            });
            $("#category").val($.cookie("category"));
        })
        function showImgDelay(imgObj,imgSrc,maxErrorNum){
            showSpan.innerHTML += "--" + maxErrorNum;
            if(maxErrorNum>0){
                imgObj.onerror=function(){
                    showImgDelay(imgObj,imgSrc,maxErrorNum-1);
                };
                setTimeout(function(){
                    imgObj.src=imgSrc;
                },500);
            }
        }
        </script>
        <span id="showSpan" style="display:none"></span>
    </body>
</html>



















