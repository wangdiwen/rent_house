<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
    <title>鼠标Click拾取地图坐标</title>
    <link rel="stylesheet" href="http://cache.amap.com/lbs/static/main1119.css"/>
    <script type="text/javascript"
            src="http://webapi.amap.com/maps?v=1.3&key=f160266b25ff0d2ac809419b71ac9f85"></script>
    <script type="text/javascript" src="http://cache.amap.com/lbs/static/addToolbar.js"></script>

    <style type="text/css">
      #container {width:99%; height: 100%; }
    </style>
</head>
<body>

<div id="container"></div>
<!-- <div id="myPageTop">
    <table>
        <tr>
            <td class="column2">
                <label>左击获取经纬度：</label>
            </td>
        </tr>
        <tr>
            <td class="column2">
                <input type="text" readonly="true" id="lnglat">
            </td>
        </tr>
    </table>
</div> -->
<div><input type="hidden" readonly="true" id="lnglat" name="pos_point" value=""></div>
<script type="text/javascript">
    // 地图画布
    var map = new AMap.Map("container", {
      resizeEnable: true,
      zoom: 14,
      center: [120.19066572, 30.18783305]
    });

    // 麻点0 -- 杭研
    var hz_mk = new AMap.Marker({
      position: [120.19068718, 30.18779595],
      icon : 'http://vdata.amap.com/icons/b18/1/2.png',  //24px*24px
    });
    hz_mk.setMap(map);
    hz_mk.on('click',function(e){
      var hz_card = new AMap.InfoWindow({
        content: '<h3 class="title">网易杭研</h3><div class="content">'+
            '网易杭州研究院，4公里范围</div>',
      });
      hz_card.open(map,e.target.getPosition());
    });

    // 麻点，鼠标点击后进行初始化
    var marker = null;
    //为地图注册click事件获取鼠标点击出的经纬度坐标
    var clickEventListener = map.on('click', function(e) {
        document.getElementById("lnglat").value = e.lnglat.getLng() + ',' + e.lnglat.getLat();
        // alert(document.getElementById("lnglat").value);

        if (marker) {
          marker.setMap(null);
          marker = null;
        }
        marker = new AMap.Marker({
          icon: "http://webapi.amap.com/theme/v1.3/markers/n/mark_b.png",
          position: [e.lnglat.getLng(), e.lnglat.getLat()]
        });
        marker.setMap(map);
    });
</script>
</body>
</html>
