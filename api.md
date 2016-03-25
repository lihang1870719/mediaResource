## APP 目录下的IndexController中是api的入口文件
api 统一地址：http://xxx/mediaResource/app/index/funtionname
这里如何客户端与服务端在同一个局域网下
xxx 直接替换成为服务端的ip地址即可

#### 说明：

- 返回类型为json

- 返回值有两种：

成功后返回： flag 为 success； msg 是指相关的提示信息，可以为空； data 是返回的数据

{
    "flag": "Success",
    "msg": "",
    "data": [
        {
            "id": "28",
            "pid": "3",
            "title": "地方广东省规范大概",
            "link": null,
            "time": "1458834464",
            "create_at": "0",
            "update_at": "0",
            "content": "<p>地方广东省风格</p>",
            "cate_id": "1",
            "user_id": "1",
            "status": "0",
            "type": "1",
            "image": "uploads/20160324234740_628.jpg",
            "image_status": "1",
            "image_sort": "1"
        }
    ]
}

失败后返回： flag 是Error； msg是指失败的提示信息
{"flag":"Error","msg":"\u4ec0\u4e48\u4e5f\u6ca1\u67e5\u5230(+_+)\uff01"}

#### 首页接口
获得移动段首页相关信息，包括轮播，课程列表，分类

地址： http://xxxx/mediaResource/app/index/getIndex

#### 获得所有分类：

地址：http://xxxx/mediaResource/app/index/getCategory
 
#### 获得所有课程
需要注意的是，这里返回的是原始数据，包括了课程与相关的章节，需要客户端进一步处理

地址：http://xxxx/mediaResource/app/index/getCourse

#### 获得所有直播：

地址：http://xxxx/mediaResource/app/index/getLive
 
#### 获得所有文章

地址：http://xxxx/mediaResource/app/index/getPost

#### 获得轮播图

地址：http://xxxx/mediaResource/app/index/getCarousel

#### 获得所有评论留言

地址：http://xxxx/mediaResource/app/index/getComments

#### 获得当前用户相关信息

地址：http://xxxx/mediaResource/app/index/getUserInfo

### 搜索课程接口

地址：http://xxxx/mediaResource/app/index/searchCourse/key/xxx

### 搜索课程接口

地址：http://xxxx/mediaResource/app/index/searchPost/key/xxx
