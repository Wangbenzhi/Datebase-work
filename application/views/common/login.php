<!DOCTYPE html>
<html lang="zh-CN" style="height: 100%;">
<meta charset="UTF-8">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>数据库管理系统</title>
    <!--jquery-->
    <script src="/Resources/jquery.min.js"></script>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="/Resources/bootstrap.min.css">
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="/Resources/bootstrap.min.js"></script>
</head>
<body style="background-image: url(/Resources/index.jpg);background-size:100% 100%;">
    <div class="container" style="padding:200px 0px">
        <div class="login" style="width:300px;height:280px;margin:0 auto;padding: 1px 40px;background-color: rgba(255, 255, 255, 0.55);border-radius:20px">
            <h2 class="text-center">数据库管理系统</h2>
            <form id="form" style="margin-top:20px;">
                <div class="form-group">
                    <div class="input-group" style="width:100%">
                        <input type="text" class="form-control" name="username" placeholder="请输入账号">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group" style="width:100%">
                        <input type="password" class="form-control" name="password" placeholder="请输入密码">
                    </div>
                </div>
                <div class="form-group form-inline">
                    <div class="input-group" style="width:155px">
                        <input type="text" class="form-control" name="verify" placeholder="请输入验证码">
                    </div>
                    <div class="input-group">
                        <img src="/captcha/get" id="verifyPic" style="width:60px;height:34px;border-radius:4px;">
                    </div>
                </div>
                <button type="button" class="form-control btn btn-primary" id="submit">登录</button>
            </form>
        </div>
    </div>
</body>
<script type="text/javascript">

    $(function(){
        $(".login").fadeIn(800);
        
        //注册点击更换验证码事件
        $("#verifyPic").click(function(){
            $(this).attr('src',"/Captcha/get"); 
        });

        //注册回车登陆事件
        $("[name='verify']").keydown(function(event){
            if(event.keyCode == 13){
                $("#submit").click();
            }
        });
        //登陆
        $("#submit").click(function(){
            if($("[name='username']").val().length == 0 || $("[name='password']").val().length == 0){
                alert("请输入账号或密码！");
                return false;
            }else if($("[name='verify']").val().length != 4){
                alert("验证码必须为4位！");
                return false;
            }
            $.post({
                url:"/user/login",
                data:$("#form").serialize(),
                success:function(data){
                    if(data.code == 0 && data.admin == 1){
                        //管理员登陆
                        location.href = "/Admin/index";
                    }else if(data.code == 0 && data.admin == 0){
                        //普通用户登陆
                        location.href = "/Staff/index";
                    }else{
                        alert(data.message);
                        $("#verifyPic").click();
                        $("[name='verify']").val("");
                    }
                }
            });
        })
    });
</script>

</html>