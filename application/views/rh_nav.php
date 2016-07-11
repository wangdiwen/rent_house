<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
      <a class="navbar-brand" href="/home/index">NE租房分享</a>
    </div>
    <div>
      <ul class="nav navbar-nav pull-right">
          <li class=""><a href="/home/index">3公里猪舍</a></li>
          <li class=""><a href="/home/publish">我要发布</a></li>
          <li class=""><a href="/feedback/index">需求&建议&BUG</a></li>
          <li class=""><a href="/release/index">ReleaseLog</a></li>
          <li class=""><a href="/home/about">About</a></li>
          <!-- <li class=""><a href="/home/openid">OpenID</a></li> -->
          <li>
            <form class="navbar-form navbar-right" id="search" onsubmit="return validatesearch()" role="form" method="post" action="/house/search">
              <div class="form-group">
                <input type="text" value="" id="zoon_name" name="zoon_name" class="form-control" placeholder="小区，例如：滨兴">
              </div>
              <button type="submit" class="btn btn-success">搜索</button>
            </form>
          </li>
          <li class=""><a href="/home/index">Pv：
            <?php
              echo file_get_contents('hits.dat');
            ?>
          </a></li>
          <?php
            $name = $this->session->userdata('fullname');
            if ($name) {
              echo '<li class=""><a href="/user/myhouse">欢迎你：' . $name . '</a></li>';
              echo '<li class=""><a href="/home/clean">退出</a></li>';
            }
            else
              echo '<li class=""><a href="/home/login">登录</a></li>';
          ?>

      </ul>
    </div>
</nav>

<script>
  function validatesearch() {
    var zoon_name = document.getElementById('zoon_name').value;
    if (zoon_name == "" || ! zoon_name) {
      alert("请填写正确的小区名称，例如：滨兴 ！");
      return false;
    }

    return true;
  }
</script>
