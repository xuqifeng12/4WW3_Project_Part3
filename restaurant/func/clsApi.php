<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 11/30/2019
 * Time: 15:04
 */
require 'import/aws/aws-autoloader.php';

use Aws\Credentials\Credentials;
class clsApi
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "restaurant";

    function mysqlQuery($sql)
    {
        $ret = array();
        try {
            $conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            $stmt = $conn->prepare("SELECT id, firstname, lastname FROM MyGuests");
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            // 设置结果集为关联数组
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($stmt->fetchAll() as $k => $v) {
                array_push($ret, $v);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;
//        var_dump($ret);
        return $ret;

    }

    //执行单条sql
    function mysqlExexuteOne($sql)
    {
        try {
//            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname, $this->username, $this->password);
            // 设置 PDO 错误模式，用于抛出异常
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            $sql = "INSERT INTO MyGuests (firstname, lastname, email)    VALUES ('John', 'Doe', 'john@example.com')";
            // 使用 exec() ，没有结果返回
            $conn->exec($sql);
            echo "新记录插入成功";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
    }


    function fileUpload($file, $path, &$error, $type = array(), $size = 2000000)
    {
//判断本身文件是否有效
        if (!isset($file['error'])) {
            $error = '文件无效';
            return false;
        }
        //有效路径的判断
        if (!is_dir($path)) {
            $error = '存储路径无效';
            return false;
        }
        //判断文件本身上传是否成功
        switch ($file['error']) {
            case 1:
            case 2:
                $error = '文件超过服务器允许大小';
                return false;
            case 3:
                $error = '文件只有部分上传';
                return false;
            case 4:
                $error = '用户没有选择文件上传';
                return false;
            case 6:
            case 7:
                $error = '服务器操作失败';
                return false;
        }
        //判断类型是否符合
        if (!empty($type) && !in_array($file['type'], $type)) {
            $error = '当前上传的文件类型不符合';
            return false;
        }
        //大小判断
        if ($file['size'] > $size) {
            $error = '文件大小超过当前允许范围.当前允许大小是：' . string($size / 1000000) . 'M';
            return false;
        }
        //转存，移动文件
        $newfilename = $this->getNewName($file['name']);
        if (@move_uploaded_file($file['tmp_name'], $path . '' . $newfilename)) {
            return $newfilename;
        } else {
            $error = '文件上传失败';
            return false;
        }

    }

//随机产生一个文件名
    function getNewName($filename, $rand = 6)
    {
        $newname = date('YmdHis');//时间日期部分
        //随机部分
        $old = array_merge(range('a', 'z'), range('A', 'Z'));
        shuffle($old);
        for ($i = 0; $i < $rand; $i++) {
            $newname .= $old[$i];
        }
        return $newname . strstr($filename, '.');//组织有效文件名
    }


    function prompt($prompt)
    {
        echo "<script>alert('" . $prompt . "')</script>";
    }

    function fileUploadAws($file)
    {
        //设置超时
        set_time_limit(0);
        $key = "AKIAI32ZQWAMQ27PM3WA";
        $secret = "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";
        $credentials = new Credentials($key, $secret);


        $s3 = new Aws\S3\S3Client([
            'version' => 'latest',
            //地区 亚太区域（新加坡）
            //AWS区域和终端节点： http://docs.amazonaws.cn/general/latest/gr/rande.html
            'region' => 'ca-central-1',
            //加载证书
            'credentials' => $credentials,
            //开启bug调试
//        'debug'   => true
        ]);
        //存储桶 获取AWS存储桶的名称
//    $bucket = 'test';//'AWS存储桶名称';
        $bucket = "uploads1234";
        //需要上传的文件
        //ROOT_PATH项目根目录，文件的本地路径例:D:/www/abc.jpg;
        $source = "D:/code/www/tmp/restaurant/upload/" . $file;
        echo $source;
        //多部件上传
        $uploader = new Aws\S3\MultipartUploader($s3, $source, [
            //存储桶
            'bucket' => $bucket,
            //上传后的新地址
            'key' => $file,
            //设置访问权限  公开,不然访问不了
            'ACL' => 'public-read',
            //分段上传
            'before_initiate' => function (\Aws\Command $command) {
                // $command is a CreateMultipartUpload operation
                $command['CacheControl'] = 'max-age=3600';
            },
            'before_upload' => function (\Aws\Command $command) {
                // $command is an UploadPart operation
                $command['RequestPayer'] = 'requester';
            },
            'before_complete' => function (\Aws\Command $command) {
                // $command is a CompleteMultipartUpload operation
                $command['RequestPayer'] = 'requester';
            },
        ]);

        try {
            $result = $uploader->upload();
            //上传成功--返回上传后的地址
            $data = [
                'type' => '1',
                'data' => urldecode($result['ObjectURL'])
            ];
        } catch (Aws\Exception\MultipartUploadException $e) {
            //上传失败--返回错误信息
//        $uploader = new Aws\S3\MultipartUploader($s3, $source, [
//            'state' => $e->getState(),
//        ]);
//        var_dump($uploader);
            $data = [
                'type' => '0',
                'data' => $e->getMessage()
            ];
        }
        return $data;
    }


}