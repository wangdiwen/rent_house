<?php include_once('rh_header.php'); ?>
<?php include_once('rh_nav.php'); ?>

<link href="//cdn.bootcss.com/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script src="//cdn.bootcss.com/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="//cdn.bootcss.com/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>

</br></br></br>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          <legend><h4 class="text-center">The Latest Timeline</h4></legend>
           <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>小区名称</th>
                <th>入舍时间</th>
                <th>Popo</th>
                <th>手机</th>
                <th>房租</th>
                <th>查看地图</th>
                <th>发布时间</th>
            </tr>
        </thead>

        <tbody>
          <?php
            foreach ($pos as $k => $v) {
              echo '<tr><td>' . $v['community'] . ' </td>';
              echo '<td>' . $v['s_date'] . ' </td>';

              if ($has_login) {
                echo '<td>' . $v['popo'] . '</td>';
                echo '<td>' . $v['phone'] . '@corp.netease.com </td>';
              }
              else {
                echo '<td><a href="/home/login">登录可查看</a></td>';
                echo '<td><a href="/home/login">登录可查看</a></td>';
              }

              echo '<td>' . $v['price'] . ' </td>';
              echo '<td><a href="/home/list2map/' . $v['id'] . '" />查看地图</a> </td>';
              echo '<td>' . substr($v['pub_time'], 0, 16) . ' </td> </tr>';
            }
          ?>
        </tbody>
    </table>




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
  $(document).ready(function() {
    $('#data').DataTable({
    language: {
        "sProcessing": "处理中...",
        "sLengthMenu": "显示 _MENU_ 项结果",
        "sZeroRecords": "没有匹配结果",
        "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
        "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
        "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
        "sInfoPostFix": "",
        "sSearch": "搜索:",
        "sUrl": "",
        "sEmptyTable": "表中数据为空",
        "sLoadingRecords": "载入中...",
        "sInfoThousands": ",",
        "oPaginate": {
            "sFirst": "首页",
            "sPrevious": "上页",
            "sNext": "下页",
            "sLast": "末页"
        },
        "oAria": {
            "sSortAscending": ": 以升序排列此列",
            "sSortDescending": ": 以降序排列此列"
        }
    }
});
} );
</script>


<?php include_once('rh_footer.php'); ?>
