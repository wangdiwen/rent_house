<?php include_once('rh_header.php'); ?>
<?php include_once('rh_nav.php'); ?>

</br></br></br>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          <legend><h4 class="text-center">猪舍详情</h4></legend>
        </div>
    </div>
</div>

<!-- 显示图片 -->
<div class="container">
  <div class="row">
    <div class="col-md-offset-2 col-md-8">
      <div class="row">

        <!-- <a href="#" id="pop" class="thumb_image">
            <img id="imageresource-0" src="http://36.media.tumblr.com/de356cd6570d7c26e73979467f296f67/tumblr_mrn3dc10Wa1r1thfzo6_1280.jpg" class="col-sm-4" onclick="open_img(0)">
        </a>-->

        <a href="#" id="pop" class="thumb_image">
            <!-- <img id="imageresource-1" src="" class="col-sm-4" onclick="open_img(1)"> -->
            <?php
            foreach ($detail['imgs'] as $k => $v) {
              echo '<img id="imageresource-' . $k . '" src="' . $v . '" class="col-sm-4" style="width: 260px; height: 225px;" onclick="open_img(' . $k . ')">';
            }
            ?>
        </a>

      </div>

    </div>
  </div>
</div>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

            <table class="table" style="table-layout:fixed ;">
               <!-- <caption>猪舍详情信息</caption> -->
               <!-- <thead>
                  <tr>
                     <th>产品</th>
                     <th>付款日期</th>
                     <th>状态</th>
                  </tr>
               </thead> -->
               <tbody>
                  <tr class="warning">
                     <td class="text-right" style="width: 120px;">小区名称</td>
                     <td><?php echo $detail['community']; ?></td>
                  </tr>
                  <tr class="success">
                     <td class="text-right">入舍截止时间</td>
                     <td><?php echo $detail['s_date']; ?></td>
                  </tr>
                  <tr  class="warning">
                     <td class="text-right">POPO号</td>
                     <td><?php echo $detail['popo']; ?>@corp.netease.com</td>
                  </tr>
                  <tr  class="danger">
                     <td class="text-right">手机</td>
                     <td><?php echo $detail['phone'] ? $detail['phone'] : '无'; ?></td>
                  </tr>
                  <tr class="warning">
                     <td class="text-right">房租</td>
                     <td><?php echo $detail['price']; ?></td>
                  </tr>
                  <tr class="success">
                    <td class="text-right">猪舍规格</td>
                    <td>
                      <?php
                        $type = '';
                        if ($detail['room_type'] == 'master') $type = '主卧';
                        elseif ($detail['room_type'] == 'slave') $type = '次卧';
                        else $type = '一居室';
                        echo $type . '&nbsp;&nbsp;&nbsp;&nbsp;';

                        echo $detail['room_num'] . ' 室' . '&nbsp;&nbsp;&nbsp;&nbsp;';

                        $man = '男女不限';
                        if ($detail['man'] == 'girl') $man = '限女生';
                        elseif ($detail['man'] == 'boy') $man = '限男生';
                        echo $man . '&nbsp;&nbsp;&nbsp;&nbsp;';

                        $rent = '短租' . '&nbsp;&nbsp;&nbsp;&nbsp;';
                        if ($detail['rent_type'] == 'long') $rent = '长租';
                        echo $rent;
                      ?>
                    </td>
                    <tr  class="warning">
                       <td class="text-right">其他说明</td>
                       <td style="word-wrap:break-word;"><?php echo $detail['other']; ?></td>
                    </tr>
                    <tr  class="success">
                       <td class="text-right">发布时间 </td>
                       <td ><?php echo $detail['pub_time']; ?></td>
                    </tr>
               </tbody>
            </table>

        </div>
    </div>
</div>

<!-- 图片打开对话框modal  -->
<script>
function open_img(img_id) {
  $('#imagepreview').attr('src', $('#imageresource-' + img_id).attr('src'));
  $('#imagemodal').modal('show');
}
</script>

<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">猪舍预览</h4>
      </div>
      <div class="modal-body">
        <img src="" id="imagepreview" style="width: 100%; height: 100%;" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include_once('rh_footer.php'); ?>
