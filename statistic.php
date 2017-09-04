<!DOCTYPE HTML>
<html>
<meta name="renderer" content="webkit"> 
<meta charset="UTF-8">
<title>经验共享平台</title>
<link rel="bookmark" type="image/x-icon" href="img/+1.ico" />
<link rel="shortcut icon" href="img/+1.ico">
<link rel="icon" href="img/+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>
<script src="style/js/echarts.min.js"></script>
<script src="style/js/dark.js"></script>


<body>
<?php include("common.php"); echo_banner("mission"); ?>
<div style="margin: 60px"></div>
<div class="container">
<header>
  <h3><i></i>统计信息<small></small></h3>
</header>
<hr>
<div id="ECharts-user" style="width: 100%; height:800px; margin: auto;"></div>
<hr>
<div id="ECharts-passage" style="width: 100%; height:800px; margin: auto;"></div>
<script type="text/javascript">
  var myChart_user = echarts.init(document.getElementById('ECharts-user'));
  var myChart_passage = echarts.init(document.getElementById('ECharts-passage'));
  myChart_user.setOption({
      title: {text: '注册人员部门统计'},
      tooltip : {trigger: 'item', formatter: "{b} : {c} ({d}%)"},
      legend: {x: 'center', y: 'bottom', data: []},
      toolbox: {
        show : true,
        textStyle: {fontSize: 20},
        feature : {
          saveAsImage : {show: true},
          mark : {show: true},
          dataView : {show: true, readOnly: true},
          magicType : {show: true, type: ['pie', 'funnel']},
        }
      },
      series: [{
        name: '人数',
        type: 'pie',
        radius : [80, 300],
        // center : ['75%', '50%'],
        roseType : 'area',
        data: [],
        itemStyle:{normal:{label:{formatter: '{b}({c}人)', textStyle: {fontSize: '24'}}}},
      }]
  });

  myChart_passage.setOption({
      title: {text: '文章统计'},
      tooltip : {trigger: 'item', formatter: "{b} : {c} ({d}%)"},
      legend: {x: 'center', y: 'bottom', data: []},
      toolbox: {
        show : true,
        feature : {
          saveAsImage : {show: true},
          mark : {show: true},
          dataView : {show: true, readOnly: true},
          magicType : {show: true, type: ['pie', 'funnel']},
        }
      },
      series: [{
        name: '篇数',
        type: 'pie',
        radius : [80, 300],
        // center : ['75%', '50%'],
        roseType : 'area',
        data: [],
        itemStyle:{normal:{label:{formatter: '{b}({c}篇)', textStyle: {fontSize: '24'}}}},
      }]
  });

  $(document).ready(function(){
    $.ajax({
      type: "post",
      data: {type: 'user'},
      async: false, //同步执行
      url: "mapdata.php",
      dataType: "json", //返回数据形式为json
      success: function(result) {
        myChart_user.hideLoading(); //隐藏加载动画
        myChart_user.setOption({ //渲染数据
            legend: [{data: result}],
            series: [{name: '人数',data: result}]
        });
      },
      error: function() {
        alert("请求数据失败!");
      }
    });

    $.ajax({
      type: "post",
      data: {type: 'passage'},
      async: false, //同步执行
      url: "mapdata.php",
      dataType: "json", //返回数据形式为json
      success: function(result) {
          myChart_passage.hideLoading(); //隐藏加载动画
          myChart_passage.setOption({ //渲染数据
          legend: [{data: result}],
          series: [{name: '人数',data: result}]
        });
      },
      error: function() {
          alert("请求数据失败!");
      }
    });
  });
</script>
        </div>
    </div>
</div>
</div>

<?php echo_webfooter(); ?>
</body>

</html>