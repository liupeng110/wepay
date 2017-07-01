<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <title><?php echo ($info["name"]); ?></title>
        <link rel="stylesheet" href="/wepay/Template/default/static/css/frozen.css">
        <script src="/wepay/Template/default/static/lib/zepto.min.js"></script>
        <script src="/wepay/Template/default/static/js/frozen.js"></script>
        <!-- <script src="/wepay/Template/default/static/js/echarts.min.js"></script> -->
        <style>
            #main{
                width:100%;height:170px;
            }
            #main img{
                width:100%;
            }

            #pay .ui-btn-wrap .ui-btn{
                margin-bottom:10px;
            }

            .layui-m-layersection>.layui-m-layerchild>h3{
                height:20px;
                line-height:20px;
                margin:0;
                padding:0;
            }
        </style>
    </head>
    
    <body ontouchstart>
        <header class="ui-header ui-header-positive ui-border-b">
            <i class="ui-icon-return" onclick="history.back()"></i>
            <h1><?php echo ($info["name"]); ?></h1>
        </header>

        <section class="ui-container" id="app">
            <ul class="ui-tiled ui-border-b" style="margin-bottom:5px;background-color:#fff;">
                <li>
                    <div class="ui-txt-warning"> <h2 v-text="rateName"></h2> </div>

                    <h5 class="ui-txt-muted" v-text="dateTime">--:--</h5>
                </li>
            </ul>

            <ul class="ui-tiled ui-border-b" style="margin-bottom:5px;background-color:#fff;">
                <li>
                    <div class="ui-txt-warning"> <h2 v-text="rate"></h2> </div>
                </li>
                <li>
                    <div class="ui-txt-muted"><h5>最低</h5></div>
                    <i><h2 v-text="bad">--.--</h2></i>
                </li>
                <li>
                    <div class="ui-txt-muted"><h5>最高</h5></div>
                    <i><h2 v-text="ask">--.--</h2></i>
                </li>
            </ul>

            <section id="tab">

            	<div class="demo-item">
                    <div id="main" style="height:240px;">
                        <img alt="" :src="rate_k" width="99%">
                    </div>
            	</div>

                <div class="ui-tab">
                    <ul class="ui-tab-nav ui-border-b">
                        <li @click="kLine('D')" class="current" onclick="select_k(this)">日</li>
                        <li @click="kLine('W')" onclick="select_k(this)">周</li>
                        <li @click="kLine('M')" onclick="select_k(this)">月</li>
                    </ul>
                </div>
             
            </section>

            <ul class="ui-tiled ui-border-t ui-border-b" style="margin-top:5px;background-color:#fff;">
                <li><div class="ui-txt-muted"><h5>涨幅</h5></div> 
                    <i class="ui-border"><h2 v-text="rate_plus"></h2></i> 
                </li>
                <li><div class="ui-txt-muted"><h5>涨跌</h5></div> 
                    <i class="ui-border"><h2 v-text="rate_minus"></h2></i> 
                </li>
                <li><div class="ui-txt-muted"><h5> <a :href="rate_down">导出</a> </h5></div> </li>
            </ul>

<?php if( empty($bet) ): ?>
            <ul class="ui-tiled " >
                <li>
                    <button class="ui-btn ui-btn-primary" style="position:fixed;left:0;top:50px;height:40px;width:80px;"  @click="buy(0)">
                        买涨
                    </button>
                </li>
                <li>

                <button class="ui-btn ui-btn-danger" style="position:fixed;right:0;top:50px;height:40px;width:80px;"  @click="buy(1)">
                    买跌
                </button>  
                </li>
            </ul>
<?php else: ?>     
            <!--<ul class="ui-tiled " >-->

                <!--<li>
                    <button class="ui-btn ui-btn-primary" style="position:fixed;left:0;top:50px;height:40px;width:80px;"  @click="buy(0)">
                        买涨111
                    </button>
                </li>-->
                <li>

                <button class="ui-btn ui-btn-danger" style="position:fixed;right:0;top:50px;height:40px;width:80px;" >
                    已购买
                </button>  
                </li>

            <!--</ul>       -->
<?php endif; ?>

        </section><!-- /.ui-container-->




<!-- footer -->
           <div  style="height:56px;"></div> 

        <footer class="ui-footer ui-footer-btn">
            <ul class="ui-tiled ui-border-t">
                <li data-href="<?php echo U('Index/index');?>" class="ui-border-r"><div>商品行情</div></li>
                <li data-href="<?php echo U('Pay/index');?>" class="ui-border-r"><div>交易记录</div></li>
                <li data-href="<?php echo U('User/index');?>"><div>个人账户</div></li>
            </ul>
        </footer>

        <script>
        $('.ui-list li,.ui-tiled li').click(function(){
            if($(this).data('href')){
                location.href= $(this).data('href');
            }
        });
        $('.ui-header .ui-btn').click(function(){
            location.href= "<?php echo U('Index/index');?>";
        });
        </script>

        <script class="demo-script">
        (function (){
            var tab = new fz.Scroll('.ui-tab', {
                role: 'tab',
                autoplay: false,
                interval: 3000
            });
            /* 滑动开始前 */
            tab.on('beforeScrollStart', function(fromIndex, toIndex) {
                console.log(fromIndex,toIndex);// from 为当前页，to 为下一页
            })
        })();

        </script>        
<!-- footer -->


    </body>
</html>


<?php  dump($_SERVER['HTTP_HOST']); ?>

<script src="/wepay/Template/default/static/js/socket.io-1.2.0.js"></script>
<!--<script src="/wepay/Template/default/static/js/jquery-1.11.1.js"></script>-->
<script src="/wepay/Template/default/static/js/vue.js"></script>

<script src="/wepay/Template/default/static/layer_mobile/layer.js"></script>

<script>
var vue=new Vue({
  el: '#app',
  data:{
    rate:'--.--',
    ask:'--.--',
    bad:'--.--',
    rateName:'--.--',
    dateTime:'--:--',
    rate_k:"/wepay/Public/images/none.gif",
    rate_k_d:"/wepay/Public/images/none.gif",
    rate_k_w:"/wepay/Public/images/none.gif",
    rate_k_m:"/wepay/Public/images/none.gif",
    rate_plus:'--.--',
    rate_minus:'--.--',
    rate_down:'',
    bet_type:0
  },
  mounted:function(){
    layer.open({type: 2});
    this.start();
  },
  methods: {
    start:function(){
        var _this = this;

        var socket = io("http://<?php echo $_SERVER['HTTP_HOST'];?>:2345");

        socket.emit("api","<?php echo ($info['api']); ?>");

        setInterval(draw, 1000*60);

        //发送给服务器
        function draw(){
            socket.emit("api","<?php echo ($info['api']); ?>");
        }

        socket.on('api', function(msg){
            var json =JSON.parse(msg);

            layer.closeAll()
            // console.log(json);

            // k线
            _this.rate_k = json.query.results.kline.d;
            _this.rate_k_d = json.query.results.kline.d;
            _this.rate_k_w = json.query.results.kline.w;
            _this.rate_k_m = json.query.results.kline.m;



            if( json.query.results.today.length > 0 ){
                // 涨幅
                _this.rate_plus = json.query.results.today[7];
               _this.rate_minus = json.query.results.today[6]+"%"; 
            }
            

            // 下载地址
            _this.rate_down = json.query.diagnostics.url[1].content;

            // 参数
            _this.rate = json.query.results.rate.Rate;      
            _this.ask = json.query.results.rate.Ask;      
            _this.bad = json.query.results.rate.Bid;      
            _this.rateName = json.query.results.rate.Name;      
            _this.dateTime = json.query.results.rate.Time;     
        });

    },
    kLine:function(type,obj){
        
        if( type == 'D' ){
            this.rate_k = this.rate_k_d;
        }else if(type == 'W'){
            this.rate_k = this.rate_k_w;
        }else if(type == 'M'){
            this.rate_k = this.rate_k_m;
        }
    },
    buy:function(type){
        if( type ==0 ){
             var typeTitle = '买涨-'+this.rateName;
             this.bet_type = 0;
        }else{
            var typeTitle = '买跌-'+this.rateName;
            this.bet_type = 1;
        }
       
        layer.open({
            type: 1
            ,title: [ typeTitle ]
            ,anim: 'up'
            ,content:`
     <div id="pay">
     
   <div class="ui-btn-wrap">
    <center>
     <button class="ui-btn ui-btn-primary" onclick="payMoney(10,this)">10￥</button> 
     <button class="ui-btn ui-btn-primary" onclick="payMoney(50,this)">50￥</button> 
     <button class="ui-btn ui-btn-primary" onclick="payMoney(100,this)">100￥</button> 
     <button class="ui-btn ui-btn-primary" onclick="payMoney(200,this)">200￥</button> 
     <button class="ui-btn ui-btn-primary" onclick="payMoney(500,this)">500￥</button> 
     <button class="ui-btn ui-btn-primary" onclick="payMoney(1000,this)">1000￥</button>
    </center>
   </div>
   <div class="demo-block" style="position:fixed;bottom:0;width:100%">
    <section class="ui-input-wrap ui-border-t">
     <div class="ui-input">
      <input type="text" name="payMoney" id="payMoney" value="100" placeholder="任意金额" />
      <input type="text" name="type" id="type" value="" placeholder="任意金额" />
     </div>
     <button class="ui-btn" onclick="bet()">确定购买</button>
    </section>
   </div>
  </div>         
            `
            ,anim: 'up'
            ,style: 'position:fixed;bottom:0;left:0;width:100%;height:155px; padding:10px 0;border:none;'
        });  
    }

  }

});
    

</script>

<script>

// k线切换状态
function select_k(obj){
    $('.current').removeClass("current");
    $(obj).addClass("current");
}




// 金额切换
function payMoney(values,obj){
    $('#pay .ui-btn-danger').removeClass('ui-btn-danger');
    
    $(obj).addClass('ui-btn-danger');
    $('#payMoney').val(values);
}

function bet(){
    var money =$('#payMoney').val();;
    // console.log(money);
    // console.log( vue.rate );
    var gid ='<?php echo ($info["id"]); ?>';
    $.post('/wepay/index.php/Pay/bet', { gid:gid,money: money,rate:vue.rate,type:vue.bet_type }, function(res){
        layer.closeAll();
        var res =JSON.parse(res);
        if(res.error == 0){

        }else{

        }

        layer.open({
            content: res.msg
            ,skin: 'msg'
            ,time: 2 //2秒后自动关闭
        });

        // console.log(res);
    })    
}

</script>