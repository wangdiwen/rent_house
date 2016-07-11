<?php include_once('rh_header.php'); ?>
<?php include_once('rh_nav.php'); ?>
<link href="//cdn.bootcss.com/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<script src="//cdn.bootcss.com/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.bootcss.com/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
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
          <legend><h4 class="text-center">Timeline</h4></legend>
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
              echo '<td>' . $v['popo'] . '@corp.netease.com </td>';
              echo '<td>' . $v['phone'] . ' </td>';
              echo '<td>' . $v['price'] . ' </td>';
              echo '<td><a href="/home/list2map/' . $v['id'] . '" />查看地图</a> </td>';
              echo '<td>' . $v['pub_time'] . ' </td> </tr>';
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
