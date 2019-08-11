# XyunDLs
# 蓝奏云下载系统

演示：http://dl.nkxingxh.top:8088/index.php

## 说明
1. 支持检测文件是否被取消

2. 支持带密码的文件分享链接但不支持分享的文件夹

3. 支持生成直链或直接下载

4. 增加ios应用在线安装

5. 解析最终直链

## 使用方法

你可以直接使用，也可以通过API进行调用

id:文件ID（即分享地址的后面那一部分，如果地址是http://www.lanzous.com/xxxxxx，那么id就是xxxxxx）

url:蓝奏云外链链接

type:是否直接下载 值：down

pwd:外链密码

### 直接下载：
无密码：/api.php?url=https://www.lanzous.com/i1aesgj&type=down

有密码：/api.php?url=https://www.lanzous.com/i19pnjc&type=down&pwd=1pud


### 输出直链：

无密码：/index.php?url=https://www.lanzous.com/i1aesgj

有密码：/index.php?url=https://www.lanzous.com/i19pnjc&pwd=1pud

