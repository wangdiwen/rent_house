<?php include_once('rh_header.php'); ?>
<?php include_once('rh_nav.php'); ?>

</br></br></br>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

            <table class="table" style="table-layout:auto ;">
               <caption>我的发布列表</caption>
               <thead>
                  <tr>
                     <th>编号</th>
                     <th>小区</th>
                     <th>房租</th>
                     <th>类型</th>
                     <th>发布时间</th>
                     <th>操作</th>
                  </tr>
               </thead>
               <tbody>
                  <!-- <tr class="warning">
                     <td >123</td>
                     <td >滨兴家园</td>
                     <td >1400</td>
                     <td >3室 限女生 有宠物</td>
                     <td >2016-07-11 12:12:12</td>
                     <td >
                       <a href="">查看</a>
                       &nbsp;&nbsp;&nbsp;
                       <a href="">删除</a>
                     </td>
                  </tr> -->

                  <?php
                    foreach ($houses as $k => $v) {
                      echo '<tr class="warning">';
                      echo '<td >' . ($k + 1) . '</td>';
                      echo '<td >' . $v['community'] . '</td>';
                      echo '<td >' . $v['price']  . '</td>';
                      $type = '主卧';
                      if ($v['room_type'] == 'slave') $type = '次卧';
                      elseif ($v['room_type'] == 'single') $type = '一居室';
                      echo '<td >' . $v['room_num'] . ' 室， ' . $type . '</td>';
                      echo '<td >' . $v['pub_time'] . '</td>';
                      echo '<td >';
                      echo '<a href="/house/detail?id=' . $v['id'] . '">查看</a>';
                      echo '&nbsp;&nbsp;&nbsp;';
                      echo '<a href="/user/del?id=' . $v['id'] . '">删除</a>';
                      echo '</td>';
                      echo '</tr>';
                    }
                  ?>

               </tbody>
            </table>

        </div>
    </div>
</div>

</br></br></br>
</br></br></br>

<?php include_once('rh_footer.php'); ?>
