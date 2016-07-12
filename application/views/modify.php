<?php include_once('rh_header.php'); ?>
<?php include_once('rh_nav.php'); ?>

<!-- 时间日期组件 -->
<link href="/static/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="/static/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="/static/js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<!-- 上传多文件组件 -->
<!-- <link href="/static/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="/static/js/fileinput.min.js"></script> -->

</br></br></br>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          <legend><h3 class="text-center">修改猪舍信息</h3></legend>
            <form id="pub_this_form" onsubmit="return validateform()" class="form-horizontal" role="form" method="post" action="/house/pub_mod?id=<?php echo $id ?>">
              <div class="form-group">
                 <label class="col-sm-2 control-label">小区 *</label>
                 <div class="col-sm-10">
                    <input type="text" id="community" name="community" value=<?php echo $info['community']; ?> placeholder="小区简称（滨兴东苑）">
                 </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-2 control-label">手机</label>
                  <div class="col-sm-10">
                     <input type="text" id="phone" name="phone" value=<?php echo $info['phone']; ?> placeholder="手机号-可不填">
                  </div>
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">房间数 *</label>
                  <div class="col-sm-10">
                    <select id="room_num" name="room_num" class="form-control" style="width:auto;">
                      <?php
                        $a = array(3, 2, 1, 4, 5);
                        echo '<option value="' . $info['room_num'] . '" selected="selected">' . $info['room_num'] . ' 室</option>';
                        foreach ($a as $k => $v) {
                          if ($v !== (int)$info['room_num'])
                            echo '<option value="' . $v . '">' . $v . ' 室</option>';
                        }
                      ?>
                       <!-- <option value="3">3 室</option>
                       <option value="2">2 室</option>
                       <option value="1">1 室</option>
                       <option value="4">4 室</option>
                       <option value="5">5 室</option> -->
                    </select>
                  </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">卧室类型 *</label>
                <div class="col-sm-10">
                  <select id="room_type" name="room_type" class="form-control" style="width:auto;">
                    <?php
                      $b = array('slave' => '次卧', 'master' => '主卧', 'single' => '一居室');
                      echo '<option value="' . $info['room_type'] . '" selected="selected">' . $b[$info['room_type']] . '</option>';
                      foreach ($b as $key => $value) {
                        if ($key !== $info['room_type'])
                          echo '<option value="' . $key . '">' . $b[$key] . '</option>';
                      }
                    ?>
                     <!-- <option value="slave">次卧</option>
                     <option value="master">主卧</option>
                     <option value="single">单居室</option> -->
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">长短租 *</label>
                <div class="col-sm-10">
                  <select id="rent_type" name="rent_type" class="form-control" style="width:auto;">
                     <?php
                     if ($info['rent_type'] === 'long')
                        echo '<option value="long" selected="selected">长租</option><option value="short">短租</option>';
                     else
                        echo '<option value="long">长租</option><option value="short" selected="selected">短租</option>';
                     ?>
                     <!-- <option value="long">长租</option>
                     <option value="short">短租</option> -->
                  </select>
                </div>
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">人员限制 *</label>
                  <label class="checkbox-inline">
                     <input type="radio" name="man" id="just_girl" value="girl" <?php if ($info['man'] === 'girl') echo 'checked'; ?> >女生
                  </label>
                  <label class="checkbox-inline">
                     <input type="radio" name="man" id="just_boy" value="boy" <?php if ($info['man'] === 'boy') echo 'checked'; ?> >男生
                  </label>
                  <label class="checkbox-inline">
                     <input type="radio" name="man" id="girl_boy" value="no" <?php if ($info['man'] === 'no') echo 'checked'; ?> >都可以
                  </label>
              </div>
              <!-- <div class="form-group">
                  <label  class="col-sm-2 control-label">宠物</label>
                  <div class="col-sm-10">
                    <label class="checkbox-inline">
                       <input type="checkbox" id="animal" name="animal[]" value="cat">喵星人
                    </label>
                    <label class="checkbox-inline">
                       <input type="checkbox" id="animal" name="animal[]" value="dog">汪星人
                    </label>
                  </div>
              </div> -->
              <div class="form-group">
                  <label  class="col-sm-2 control-label">价格(￥) *</label>
                  <div class="col-sm-10">
                    <input type="text" id="price" name="price" value=<?php echo $info['price']; ?> placeholder="1500">
                  </div>
              </div>
              <!-- <div class="form-group">
                  <label  class="col-sm-2 control-label">地理位置 *</label>
                  <div class="col-sm-10">
                    <input id="xy_point" name="xy_point" type="text" readonly="true"  value="" placeholder="在地图上找到小区&点击">
                    <a class=" btn btn-danger" onClick="loadiframe('/home/pos')" data-toggle="modal" data-target="#myModal">打开地图</a>
                  </div>
              </div> -->
              <div class="form-group">
                  <label  class="col-sm-2 control-label">看舍 *</label>
                  <div class="col-sm-10">
                    <input id="s_date" name="s_date" size="16" type="text" value=<?php echo $info['s_date']; ?> placeholder="点击" readonly class="form_datetime">Notify：在此日期之前有效，过期自动清理！
                  </div>
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">其他信息</label>
                  <div class="col-sm-10">
                     <textarea id="other_info" name="other_info" class="form-control" placeholder="比如：朝向南北，房间多大，附近吃玩的地方，舍友都是哪些公司的 ..." rows="2"><?php echo $info['other']; ?></textarea>
                  </div>
              </div>
              <!-- <div class="form-group">
                  <label  class="col-sm-2 control-label">猪舍图片</label>
                  <div class="col-sm-10"> -->
                  <!-- 页面唯一标志 -->
                  <!-- <input id="ukey" name="ukey" value="" type="hidden"> -->
                  <!-- 文件上传组件  -->
                  <!-- <input id="multi_imgs" name="multi_imgs[]" type="file" multiple class="file-loading">
                  <h6 class="form-control" style="border:none;">一次选择不多于3张(jpg,png,gif)，单张大小<2M，在【发布】前点击Upload！</h6>
                  </div>
              </div> -->

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                   <button type="submit" class="btn btn-success">发布我的猪舍</button>
                </div>
             </div>
            </form>

        </div>
    </div>
</div>

<!-- 发布submit之前，校验必选参数  -->
<script>
  function validateform() {
    // var ukey = document.getElementById("ukey").value;
    var s_date = document.getElementById("s_date").value;
    // var xy_point = document.getElementById("xy_point").value;
    var price = document.getElementById("price").value;
    var community = document.getElementById("community").value;

    if (community == "" || price == "" | isNaN(price) || s_date == "") {
      alert('亲～出错啦~\(≧▽≦)/~\n请检查一下必选参数有没有填错？');
      return false;
    }
    return true;
  }
</script>


<!-- 初始化日期组件 -->
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd",
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  0,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 1
    });
</script>


<?php include_once('rh_footer.php'); ?>
