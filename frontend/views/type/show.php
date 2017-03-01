<?php
use yii\widgets\LinkPager;
use yii\helpers\Html;
?>
<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">歌曲类型展示</h1>
</div>
<div class="wrapper-md">
    <div class="row">
        <div class="col-sm-6"></div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            歌曲类型展示
        </div>
        <div class="row wrapper">

            <div class="col-sm-3">
                <form action="?r=song/discuss" method="post">
                    <div class="input-group">
                        <input type="text" name="search" class="input-sm form-control" placeholder="请输入搜索歌名..." value="">
          <span class="input-group-btn">
          <input type="submit" class="btn btn-sm btn-default" value="Go!">  
          </span>
                    </div>
                </form>
            </div>
            <div class="col-sm-4">
            </div>

        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                <tr>
                    <th style="width:3%">
                        <label class="i-checks m-b-none">
                            <input type="checkbox"><i></i>
                        </label>
                    </th>
                    <th style="width:10%;">序号</th>
                    <th style="width:15%;">图片logo</th>
                    <th style="width:15%;">类型名称</th>
                    <th style="width:15%;">标题</th>
                    <th style="width:10%;">类型描述</th>
                    <th style="width:10%;">歌曲名称</th>
                    <th style="width:10%;">热门推荐</th>
                    <th style="width:10%;">操作</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-sm-4 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm"></small>
                </div>
                <div>
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li>

                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>