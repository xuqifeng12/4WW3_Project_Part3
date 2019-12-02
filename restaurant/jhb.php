<?php



require 'import/aws/aws-autoloader.php';

use Aws\Credentials\Credentials;

//https://blog.csdn.net/u011477914/article/details/88534191
//$key = "AKIAJVKTFBQRXXOCQWDQ";
//$secret = "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";
//$credit = new Credentials($key, $secret);
////Create a S3Client
//$s3 = new Aws\S3\S3Client([
//    'profile' => 'default',
//    'version' => 'latest',
//    'region' => 'ca-central-1'
//]);
//
//$bucket = "cystal0429.com";
//

/**
 * AWS S3上传文件
 * @param string $file 文件名称
 * @return array
 */

function fileUpload($file)
{
    //设置超时
    set_time_limit(0);
    //证书 AWS access KEY ID  和  AWS secret  access KEY 替换成自己的
//    $credentials = new Aws\Credentials\Credentials('AWS access KEY ID ', 'AWS secret  access KEY');

//    //s3客户端
//    $s3 = new Aws\S3\S3Client([
//        'version' => 'latest',
//        //地区 亚太区域（新加坡）
//        //AWS区域和终端节点： http://docs.amazonaws.cn/general/latest/gr/rande.html
//        'region' => 'ap-southeast-1',
//        //加载证书
//        'credentials' => $credentials,
//        //开启bug调试
//        //'debug'   => true
//    ]);
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
    $source = "D:/xx/" . $file;
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


$arr = fileUpload("2.jpg");
var_dump($arr);