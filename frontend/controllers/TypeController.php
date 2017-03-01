<?php
namespace frontend\controllers;

use Yii;
use app\models\AisType;
use yii\web\Controller;
use app\models\Music;
use app\models\AisDesc;

class TypeController extends Controller
{
    #404时调用
    public $enableCsrfValidation =false;
    #禁用Yii框架的样式
    public $layout = 'comm';

    public function actionIndex(){
        if(yii::$app->request->isPost){
            $title = htmlspecialchars(yii::$app->request->post('title'));
            $song_id = yii::$app->request->post('song_id');
            $type_id = yii::$app->request->post('type_id');
            $desc = htmlspecialchars(yii::$app->request->post('desc'));

            if($song_id==0 || $type_id == 0){
                return "请输入二级分类";
            }

            //文件上传
            $upload = new UploadController();
            $res = $upload->upload('img','./type');
            if($res){
                $imgArr = $upload->get_data();
                $img = $imgArr['file_path'].'/'.$imgArr['file_name'];
            }

            //数据入库
            //查询类型是否已经入过库
            $arr = [];
            $type = new AisDesc();
            $type = $type->find()->select('type_id')->asArray()->all();

            foreach($type as $key=>$val){
                $arr[$key]=$val['type_id'];
            }
            $res = in_array($type_id,$arr);

            //查询主题是否重复
            $arrTitle = [];
            $type = new AisDesc();
            $type = $type->find()->select('title')->asArray()->all();
            foreach($type as $key=>$val){
                $arrTitle[$key]=$val['title'];
            }
            $resTitle = in_array($title,$arrTitle);


            if($res && $resTitle){
                //修改数据
                $sql = "update `ais_desc` set `song_id` = CONCAT(`song_id`,',$song_id' ) where type_id = '$type_id'";
                $resu = yii::$app->db->createCommand($sql)->execute();
                if($resu){
                    return $this->redirect('?r=type/show');
                }
            }else{
                //把数据插入到表中
                $sql = "insert into `ais_desc`(`type_id`,`title`,`des`,`song_id`,`img`) VALUES ('$type_id','$title','$desc','$song_id','$img')";
                $resu = yii::$app->db->createCommand($sql)->execute();
                if($resu){
                    return $this->redirect('?r=type/show');
                }
            }


        }else{
            //查找所有分类
            $type = new AisType();
            $typeData =  $type->find()->asArray()->all();

            foreach($typeData as $k=>$v){
                if($v['parent_id'] == 0){
                    $arr[$k] = $v;
                    foreach($typeData as $kk=>$vv){
                        if($vv['parent_id'] == $v['type_id']){
                            $arr[$k]['son'][$kk] = $vv;
                        }
                    }
                }
            }
            //查询出歌曲名称和歌曲id
            $music = new Music();
            $musicData = $music->find()->select(['music_id','music_name'])->asArray()->all();

            //渲染视图
            return $this->render('type',['type'=>$arr,'music'=>$musicData]);
        }
    }

    /*
     * 歌曲类型展示
     */
    public function actionShow(){
        //查询类型数据进行展示

        return $this->render('show');
    }

    /*
     *    在同一类型下不能重复添加歌曲
     */
    public function actionCheckSong(){
        $check_id = yii::$app->request->get('song_id');
        $type_id = yii::$app->request->get('type_id');

        $type = new AisDesc();
        $song_id = $type->find()->select('song_id')->where(['type_id'=>$type_id])->asArray()->all();
        if(!empty($song_id)){
            $song_id = $song_id[0]['song_id'];
            $check = strpos($song_id,$check_id);
            if($check=='/\d/'){
                echo '0';
            }else{
                echo '1';
            }
        }else{
            echo '1';
        }
    }

    /*
     * 精品添加页面
     */
    public function actionHot(){
        //查询类型数据
        $type = new AisType();
        $typeData = $type->find()->asArray()->all();
        return $this->render('hot',['type'=>$typeData]);
    }

    public function actionHotinsert(){
        $id = yii::$app->request->post('id');
        $text = yii::$app->request->post('text');

        //修改数据库中的hot状态
        $sql = "update `ais_type` set `hot`='$text' where `type_id` = '$id'";
        $res = yii::$app->db->createCommand($sql)->execute();
        if($res){
            echo "OK";
        }else{
            echo "ON";
        }
    }


    public function actionDel(){
        return yii::$app->request->get('id');
    }





















}