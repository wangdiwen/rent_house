<?php include_once('rh_header.php'); ?>
<?php include_once('rh_nav.php'); ?>

<br/>

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
        zoom: 10,
        center: [120.19, 30.18],
        // zooms: [10, 18]
      });

      // 4公里圆圈, radius(m)
      var circle = new AMap.Circle({
        // center: [120.19066572, 30.18783305],
        center: [120.19, 30.18],
        radius: 3000,
        fillOpacity:0.1,
        fillColor:'#09f',
        strokeColor:'#09f',
        strokeWeight:1
      });
      circle.setMap(map);

      // 麻点0 -- 杭研
      var hz_mk = new AMap.Marker({
        position: [120.19068718, 30.18779595],
        icon : 'http://vdata.amap.com/icons/b18/1/2.png',  //24px*24px
      });
      hz_mk.setMap(map);
      hz_mk.on('click',function(e){
        var hz_card = new AMap.InfoWindow({
          content: '<h3 class="title">网易杭研</h3><div class="content">'+ '3公里范围数据</div>',
        });
        hz_card.open(map,e.target.getPosition());
      });

      // 麻点点击回调
      function markerClick(e){
        infoWindow.setContent(e.target.content);
        infoWindow.open(map, e.target.getPosition());
      }

      // 接受数据
      var poses = <?php echo json_encode($pos); ?>;   // is a json obj

      // 麻点经纬度列表
      var infoWindow = new AMap.InfoWindow();
      for(var i= 0,marker;i < poses.length;i++){
        marker=new AMap.Marker({
            position: poses[i]['xy_point'],
            map: map
        });

        var room_type = '次卧';
        if (poses[i]['room_type'] == 'master') {
          room_type = '主卧';
        }
        else if (poses[i]['room_type'] == 'single') {
          room_type = '一居室';
        }
        var con_str = '<h3 class="title">' + poses[i]['community'] +'</h3><div class="content">' +
            // '<img src="http://webapi.amap.com/images/amap.jpg">'+
            '房租：' + poses[i]['price'] + '<br/>' +
            '房间：' + room_type + '    ' + poses[i]['room_num'] + ' 室<br/>' +
            '入住时间：' + poses[i]['s_date'] + '<br/>' +
            '发布时间：' + poses[i]['pub_time'] + '<br/>' +
            '<a target="_blank" href = "/house/detail?id=' + poses[i]['id'] + '">点击&查看详细</a></div>';

        marker.content = con_str;
        marker.on('click', markerClick);
      }

      // // 麻点经纬度列表
      // var lnglats = [
      //   [120.18652439, 30.17944917], [120.19489288, 30.18080325]
      // ];
      // var infoWindow = new AMap.InfoWindow();
      // for(var i= 0,marker;i<lnglats.length;i++){
      //   marker=new AMap.Marker({
      //       position:lnglats[i],
      //       map:map
      //   });
      //   var con_str = '<h3 class="title">网易杭研</h3><div class="content">' +
      //       '<img src="http://webapi.amap.com/images/amap.jpg">'+
      //       '网易杭州研究院，4公里范围数据<br/>'+
      //       '<a target="_blank" href = "http://mobile.amap.com/">查看具体</a></div>';
      //
      //   marker.content = con_str;
      //   marker.on('click', markerClick);
      // }

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
