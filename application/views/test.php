<?php include_once('rh_header.php'); ?>
<?php include_once('rh_nav.php'); ?>

    <!-- 高德地图样式 -->
    <style type="text/css">
      body,html,#container{
        height: 97%;
        margin: 0px;
        font-size: 12px;
        font: 12px Helvetica, 'Hiragino Sans GB', 'Microsoft Yahei', '微软雅黑', Arial, sans-serif;
      }
      .title{
        margin: 0px;
        color: #666;
        font-size: 14px;
        background-color: #eee;
        border-bottom: solid 1px silver;
        line-height: 26px;
        padding: 0px 0 0 6px;
        font-weight: lighter;
        letter-spacing: 1px
      }
      .content{
        padding: 4px;
        color: #666;
        line-height: 23px;
      }
      .content img{
        float: left;
        margin: 1px;
      }
      .amap-info-content{
        padding: 0 0 2px 0px;
      }
    </style>
    <!-- 高德地图API -->
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=f160266b25ff0d2ac809419b71ac9f85"></script>

    <!-- 地图容器 -->
    <div id="container" tabindex="0"></div>
    <script type="text/javascript">
      // 地图画布
      var map = new AMap.Map('container',{
            resizeEnable: true,
            zoom: 15,
            center: [116.39,39.9]
      });
      // 4公里圆圈, radius(m)
      var circle = new AMap.Circle({
        center: [116.39,39.9],
        radius: 3000,
        fillOpacity:0.1,
        fillColor:'#09f',
        strokeColor:'#09f',
        strokeWeight:1
      });
      circle.setMap(map);

      // 比例尺
      AMap.plugin(['AMap.ToolBar','AMap.Scale'],function(){
        var toolBar = new AMap.ToolBar();
        var scale = new AMap.Scale();
        map.addControl(toolBar);
        map.addControl(scale);
      });

      map.setFitView();     // don't change it

    </script>

<?php include_once('rh_footer.php'); ?>
