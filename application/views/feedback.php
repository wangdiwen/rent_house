<?php include_once('rh_header.php'); ?>
<?php include_once('rh_nav.php'); ?>

<!-- 时间日期组件 -->
<!-- <link href="/static/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="/static/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="/static/js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script> -->
<!-- 上传多文件组件 -->
<!-- <link href="/static/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" /> -->
<!-- <script src="path/to/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
<script src="path/to/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="path/to/js/plugins/purify.min.js" type="text/javascript"></script> -->
<!-- <script src="/static/bootstrap-fileinput/js/fileinput.min.js"></script> -->

</br></br></br>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          <legend><h4 class="text-center">提需求&建议&BUG</h4></legend>
            <form id="pub_this_form" onsubmit="return validate_feed()" class="form-horizontal" role="form" method="post" action="/feedback/advice">
              <div class="form-group">
                  <label class="col-sm-2 control-label">网络ID *</label>
                  <div class="col-sm-10">
                     <input type="text" id="net_nick" name="net_nick" value="" placeholder="网络称呼，比如：天蝎">
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-2 control-label">POPO</label>
                  <div class="col-sm-10">
                     <input type="text" id="popo" name="popo" value="" placeholder="可选，Corp前缀">@corp.netease.com
                  </div>
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">说点啥 *</label>
                  <div class="col-sm-10">
                     <textarea id="say" name="say" value="" class="form-control" placeholder="比如：增加用户登陆管理，界面优化，高级搜索，增加找房功能，Bug说明 etc ..." rows="2"></textarea>
                  </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                   <button type="submit" class="btn btn-success">提交</button>
                </div>
             </div>
            </form>

          <legend><h4 class="text-center">Demand List</h4></legend>
          <!-- <h5><strong>熊猫 说：</strong></h5>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我最近开发了一个分享内部租房信息的小工具。<br/><br/>
          <div align="right">— 2016-07-09 12:12:12</div>
          <div align="right">hzwangdiwen1@corp.netease.com</div> -->

          <?php
            foreach ($advice as $k => $v) {
              echo '<h5><strong>' . $v['nick'] . ' 说：</strong></h5>';
              echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
              echo $v['say'] . '<br/><br/>';
              echo '<div align="right">— ' . $v['pub_time'] . '</div>';
              if ($v['popo'])
                echo '<div align="right">' . $v['popo'] . '@corp.netease.com</div>';
            }
          ?>

        </div>
    </div>
</div>

<!-- 发布submit之前，校验必选参数  -->
<script>
  function validate_feed() {
    var net_nick = document.getElementById("net_nick").value;
    var say = document.getElementById("say").value;
    var popo = document.getElementById("popo").value;

    if (net_nick == "" || say == "") {
      alert('亲~\(≧▽≦)/~\n请检查一下必选参数有没有填错？');
      return false;
    }
    return true;
  }
</script>


<?php include_once('rh_footer.php'); ?>
