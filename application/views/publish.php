<?php include_once('rh_header.php'); ?>
<?php include_once('rh_nav.php'); ?>

<!-- 时间日期组件 -->
<link href="/static/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="/static/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="/static/js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<!-- 上传多文件组件 -->
<link href="/static/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="/static/js/fileinput.min.js"></script>

</br></br></br>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          <legend><h3 class="text-center">填写一些简单的信息</h3></legend>
            <form id="pub_this_form" onsubmit="return validateform()" class="form-horizontal" role="form" method="post" action="/house/pub">
              <div class="form-group">
                 <label class="col-sm-2 control-label">小区 *</label>
                 <div class="col-sm-10">
                    <input type="text" id="community" name="community" value="" placeholder="小区简称（滨兴东苑）">
                 </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-2 control-label">POPO号 *</label>
                  <div class="col-sm-10">
                     <input type="text" id="popo" name="popo" readonly="true" value="<?php echo $email; ?>" placeholder="Corp邮箱前缀">@corp.netease.com
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-2 control-label">手机</label>
                  <div class="col-sm-10">
                     <input type="text" id="phone" name="phone" value="" placeholder="手机号-可不填">
                  </div>
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">房间数 *</label>
                  <div class="col-sm-10">
                    <select id="room_num" name="room_num" class="form-control" style="width:auto;">
                       <option value="3">3 室</option>
                       <option value="2">2 室</option>
                       <option value="1">1 室</option>
                       <option value="4">4 室</option>
                       <option value="5">5 室</option>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">卧室类型 *</label>
                <div class="col-sm-10">
                  <select id="room_type" name="room_type" class="form-control" style="width:auto;">
                     <option value="slave">次卧</option>
                     <option value="master">主卧</option>
                     <option value="single">单居室</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label  class="col-sm-2 control-label">长短租 *</label>
                <div class="col-sm-10">
                  <select id="rent_type" name="rent_type" class="form-control" style="width:auto;">
                     <option value="long">长租</option>
                     <option value="short">短租</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">人员限制 *</label>
                  <label class="checkbox-inline">
                     <input type="radio" name="man" id="just_girl" value="girl" >女生
                  </label>
                  <label class="checkbox-inline">
                     <input type="radio" name="man" id="just_boy" value="boy" >男生
                  </label>
                  <label class="checkbox-inline">
                     <input type="radio" name="man" id="girl_boy" value="no" checked>都可以
                  </label>
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">宠物</label>
                  <div class="col-sm-10">
                    <label class="checkbox-inline">
                       <input type="checkbox" id="animal" name="animal[]" value="cat">喵星人
                    </label>
                    <label class="checkbox-inline">
                       <input type="checkbox" id="animal" name="animal[]" value="dog">汪星人
                    </label>
                  </div>
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">价格(￥) *</label>
                  <div class="col-sm-10">
                    <input type="text" id="price" name="price" value="1500" placeholder="1500">
                  </div>
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">地理位置 *</label>
                  <div class="col-sm-10">
                    <input id="xy_point" name="xy_point" type="text" readonly="true"  value="" placeholder="在地图上找到小区&点击">
                    <a class=" btn btn-danger" onClick="loadiframe('/home/pos')" data-toggle="modal" data-target="#myModal">打开地图</a>
                  </div>
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">看舍 *</label>
                  <div class="col-sm-10">
                    <input id="s_date" name="s_date" size="16" type="text" value="" placeholder="点击" readonly class="form_datetime">Notify：在此日期之前有效，过期自动清理！
                  </div>
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">其他信息</label>
                  <div class="col-sm-10">
                     <textarea id="other_info" name="other_info" value="" class="form-control" placeholder="比如：朝向南北，房间多大，附近吃玩的地方，舍友都是哪些公司的 ..." rows="1"></textarea>
                  </div>
              </div>
              <div class="form-group">
                  <label  class="col-sm-2 control-label">猪舍图片</label>
                  <div class="col-sm-10">
                  <!-- 页面唯一标志 -->
                  <input id="ukey" name="ukey" value="" type="hidden">
                  <!-- 文件上传组件  -->
                  <input id="multi_imgs" name="multi_imgs[]" type="file" multiple class="file-loading">
                  <h6 class="form-control" style="border:none;">一次选择不多于3张(jpg,png,gif)，单张大小<2M，在【发布】前点击Upload！</h6>
                  </div>
              </div>

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
    var ukey = document.getElementById("ukey").value;
    var s_date = document.getElementById("s_date").value;
    var xy_point = document.getElementById("xy_point").value;
    var price = document.getElementById("price").value;
    var community = document.getElementById("community").value;
    var popo = document.getElementById("popo").value;

    if (popo == "" || community == "" || price == "" | isNaN(price) || xy_point == "" || s_date == "" || ukey == "" || isNaN(ukey)) {
      alert('亲～出错啦~\(≧▽≦)/~\n请检查一下必选参数有没有填错？');
      return false;
    }
    return true;
  }
</script>

<!-- 初始化上传多文件组件 -->
<script>
$(document).on('ready', function() {
    // var randnum = Math.floor(Math.random() * 65635) + 1;   // not use
    var d = new Date();  // getTime() -> 毫秒数
    document.getElementById("ukey").value = d.getTime();

    $("#multi_imgs").fileinput({
        // language: 'zh', //设置语言
        uploadAsync: true,
        showUpload: true,
        showRemove: true,
        mainClass: "input-group-lg",
        allowedFileExtensions: ['jpg', 'gif', 'png'],//接收的文件后缀
        uploadUrl: '/upimgs/recv', //上传的地址
        showCaption: true,//是否显示标题
        browseClass: "btn btn-primary", //按钮样式
        dropZoneEnabled: false,//是否显示拖拽区域
        //minImageWidth: 50, //图片的最小宽度
        //minImageHeight: 50,//图片的最小高度
        //maxImageWidth: 1000,//图片的最大宽度
        //maxImageHeight: 1000,//图片的最大高度
        maxFileSize: 2000,//单位为kb，如果为0表示不限制文件大小
        //minFileCount: 0,
        maxFileCount: 3, //表示允许同时上传的最大文件个数
        enctype: 'multipart/form-data',
        validateInitialCount:true,
        initialPreviewAsData: true,
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
        msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值({m})！",
        uploadExtraData: function() {
            return {
              popo: $("#popo").val(),
              ukey: document.getElementById("ukey").value,
            };
        }
    });
});
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


<!-- 处理远程iframe -->
<script>
function loadiframe(htmlHref) //load iframe
{
    document.getElementById('targetiframe').src = htmlHref;
}

function unloadiframe() //just for the kicks of it
{
    var frame = document.getElementById("targetiframe");
    frameHTML = frame.contentDocument || frame.contentWindow.document;

    // get the remote iframe hide input-text value
    // alert(frameHTML.getElementById("lnglat").value);
    document.getElementById("xy_point").value = frameHTML.getElementById("lnglat").value;

    frameHTML.removeChild(frameDoc.documentElement);  // delete the remote iframe dialog
}
</script>

<!-- modal iframe dialoge -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header" style="border:hidden">
        <!-- <button type="button" class="close" onClick="unloadiframe()" data-dismiss="modal" aria-label="Close"><span aria-   hidden="true">&times;</span></button> -->
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <h4 class="modal-title" id="myModalLabel">STEP:放大->找到你的小区->鼠标点击->OK</h4>
        <!-- <input type="text" readonly="true" id="xy_point" > -->
      </div>

      <div class="modal-body" style="padding-top:5px; padding-left:5px; padding-right:0px; padding-bottom:0px;">

      <iframe src="" frameborder="0" id="targetiframe" style=" height:500px; width:100%;" name="targetframe" allowtransparency="true"></iframe> <!-- target iframe -->

      </div> <!--modal-body-->

      <div class="modal-footer" style="margin-top:0px;">
        <button type="button" class="btn btn-default pull-right" data-dismiss="modal" onClick="unloadiframe()">OK</button>
      </div>

    </div>
  </div>
</div>

<?php include_once('rh_footer.php'); ?>
